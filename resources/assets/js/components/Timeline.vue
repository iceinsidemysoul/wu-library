<template>
    <div class="sidebar-left">
        <div :class="{'collapse-bar': true, 'open': showNav}">
          <!-- sorter -->
          <div class="menu-side">
            <div class="sorting">
              เรียงลำดับ
              <div class="sorting-toggle" @click="toggleSort()">
                <div :class="{'newer': sort_by == 'newer', 'older': sort_by == 'older'}">{{ sort_by == 'newer' ? 'ล่าสุด' : 'แรกสุด' }}</div>
              </div>
            </div>
            <!-- tags or categories -->
            <div class="categories">
              หัวข้อ
                <ul class="category-list">
                  <li @click="byCategory(0)" :class="{'active': !current_category }">all <span>(<span class="num">{{ $parent.posts.length }}</span>)</span></li>
                  <li @click="byCategory(category.id)" :class="{'active': current_category == category.id}" v-for="category in categories">{{ category.title }} <!-- <span>(<span class="num">{{ category.posts_count }}</span>)</span> --></li>
              </ul>
            </div>
            <!-- search bar -->
            <div class="search">
              <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <input type="text" class="form-control" id="inlineFormInputGroup" v-model="keyword" @change="bySearch()" placeholder="Search..">
                <div class="input-group-addon bg-danger text-white" v-if="searching" @click="clearSearch()"><i class="fa fa-times"></i></div>
                <div class="input-group-addon" @click="bySearch()"><i class="fa fa-search"></i></div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="timeline-nav">
          <!-- collapse bar switch -->
          <div :class="{'collapse-switch': true,  'off': !showNav, 'on': showNav}" @click="showCollapse()">
          </div>
          <h4 class="text-left pl-3 mb-3"><i class="fa fa-history"></i></h4>
          <!-- timeline -->
          <div class="timeline">
              <div class="pointer text-center" id="draggable"></div>
              <div class="year" :title="year" v-for="year in year_lists" v-if="year_lists.length>0"></div>
          </div>
        </div>
      </div>
</template>

<style>

</style>

<script>
    require('jquery-ui');
    export default {
        data() {
          return {
            showNav: false,
            sort_by: 'newer',
            searching: false,
            keyword: '',
            year_lists: [],
            categories: [],
            current_category: 0,
            current_year: ''
          };
        },
        beforeCreate(){
          axios.get('/timeline')
            .then( response => {
              this.year_lists = response.data;
              this.setUp();
            })
            .catch( error => {
              console.log(error);
            });

          axios.get('/categories')
              .then( response => {
                this.categories = response.data;
              })
              .catch( error => {
                  console.log(error);
              });
        },
        mounted() {
        },
        methods: {
          showCollapse: function() {
             this.showNav = !this.showNav;
          },
          toggleSort: function() {
            if (this.sort_by == 'newer'){
              this.sort_by = 'older';
            } else {
              this.sort_by = 'newer';
            }
            this.current_year = $('.pointer').text();
            console.log($('.pointer').text());
            this.fetchPost();
          },
          byCategory: function (id) {
            this.current_category = id;
            this.fetchPost();
          },
          bySearch: function () {
            if (this.keyword){
              this.searching = true;
              this.fetchPost();
            }
          },
          clearSearch: function() {
            this.keyword = '';
            this.searching = false;
            this.fetchPost();
          },
          fetchPost: function (){
            let url = '/posts';
            let filters = {};
            if (this.sort_by == 'older'){
              filters.sort = 'asc';
            }
            if (this.keyword !== ''){
              filters.search = this.keyword;
            }
            if (this.current_category > 0) {
              filters.cate = this.current_category;
            }
            console.log(filters);
            axios.get(url,{
                params: filters
              })
              .then( response => {
                this.$parent.posts = response.data;
              })
              .catch( error => {
                console.log(error);
              });
            this.fetchYearLists();
          },
          fetchYearLists: function() {
            // TODO:: can we make pointer stay the same year if we toggle sort
            let filters = {};
            if (this.sort_by == 'older'){
              filters.sort = 'asc';
            }
            if (this.keyword !== ''){
              filters.search = this.keyword;
            }
            if (this.current_category > 0) {
              filters.cate = this.current_category;
            }
            axios.get('/timeline', {
                params: filters
              })
              .then( response => {
                let result = Object.keys(response.data).map(function(key) {
                  return response.data[key];
                });
                this.year_lists = result;
                this.setUp();
              })
              .catch( error => {
                console.log(error);
              });
          },
          setUpPost: function(){
            var vm = this;
            setTimeout(function() {

            }, 1); 
          },
          setUp: function (){
            var vm = this;
            setTimeout(function() {
              // TODO:: check if this work properly
              if (vm.current_year == ''){
                var current_year = $('.year:eq(0)');
              } else {
                var current_year = vm.current_year;
              }
              var year_lists = $('.year');
              var post_lists = $('.post');
              var years_position = [];
              var posts_position = [];
              var pointer = $('.pointer');
              // ***************

              // for page scrolled
              var page_top_position = 0;
              var first_post_for_each_year = [];
              // ********************

              $(pointer).text(current_year.prop('title'));

              document.addEventListener('scroll', function() {
                
              });

              getYearsPosition();
              setCurrentYearStyle();

              $('#draggable').draggable({
                  axis: 'y',
                  containment: '.timeline',
                  start: function start() {
                      getYearsPosition();
                      var pointer_position = getPositionOfCenter(pointer);
                  },
                  drag: function drag() {
                      findClosestYear();
                      $(pointer).text($(current_year).prop('title'));
                  },
                  stop: function stop() {
                      setPointerToClosestYear();
                      // set style for current year
                      setCurrentYearStyle();
                      vm.$emit('dragEnd', current_year);
                      // TODO:: then scroll to the point of first post of current year
                  }
              });

              // when user scroll the page
              // detect height and 

              function getYearsPosition() {
                  if ($(year_lists).length < 0 ) return ;
                  $.each(year_lists, function (k, v) {
                      // years position
                      years_position[k] = getPositionOfCenter(v);

                      // posts position
                      let year = $(v).prop('title');
                      let first_post = $('.year-thumbnail:contains(' + year + '):eq(0)').parent().parent();
                      if (k>0)
                        posts_position[k] = getPositionOfCenter(first_post) - posts_position[0];
                      else
                        posts_position[0] = 0;
                  });
              }

              function getPositionOfCenter(obj) {
                  if (!$(obj).offset()) return ;
                  var h = $(obj).outerHeight();
                  var top = $(obj).offset().top;

                  return top + h / 2;
              }

              function findClosestYear() {
                  var current_pointer_position = getPositionOfCenter(pointer);
                  getYearsPosition();
                  if (current_pointer_position < years_position[0]) return 0;else if (current_pointer_position > years_position[years_position.length - 1]) return years_position.length - 1;
                  for (var i = 0; i < years_position.length - 1; i++) {
                      if (current_pointer_position > years_position[i] && current_pointer_position < years_position[i + 1]) {
                          if (current_pointer_position - years_position[i] < years_position[i + 1] - current_pointer_position) {
                              current_year = $('.year:eq(' + i + ')');
                          } else {
                              current_year = $('.year:eq(' + (i + 1) + ')');
                          }
                          break;
                      }
                  }
              }

              function setPointerToClosestYear() {
                  var x = $(pointer).offset().left;
                  var h = $(pointer).outerHeight();
                  var t = getPositionOfCenter($(current_year));
                  $(pointer).offset({ left: x, top: t - h / 2 });
                  scrollToPositionOfFirstPosts();
              }

              function setCurrentYearStyle() {
                  $('.year').removeClass('current');
                  $(current_year).addClass('current');
                  setPointerToClosestYear();
              }

              function scrollToPositionOfFirstPosts() {
                  // get header height
                  // for each year, store the offset top position of first post
                  let year = $(current_year).prop('title');
                  let target_post = $('.year-thumbnail:contains(' + year + '):eq(0)');
                  window.scrollTo(0, $(target_post).offset().top - 265);
                  // console.log('');
                  // 
              }

            }, 1);
          }
        }
    }
</script>
