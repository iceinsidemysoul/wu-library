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
                  <li @click="byCategory(category.id)" :class="{'active': current_category == category.id}" v-for="category in categories">{{ category.title }} <span>(<span class="num">{{ category.posts_count }}</span>)</span></li>
                 <!-- <li class="active">วลัยลักษณ์ <span>(<span class="num">376</span>)</span></li>
                 <li >ทำเนียบบุคคลสำคัญ <span>(<span class="num">193</span>)</span></li>
                 <li >อาคารและสิ่งก่อสร้าง <span>(<span class="num">56</span>)</span></li>
                 <li >เหตุการณ์และกิจกรรม <span>(<span class="num">46</span>)</span></li>
                 <li >การวิจัย <span>(<span class="num">16</span>)</span></li>
                 <li >การเรียนการสอน <span>(<span class="num">22</span>)</span></li>
                 <li >การบริการวิชาการ <span>(<span class="num">55</span>)</span></li> -->
              </ul>
            </div>
            <!-- search bar -->
            <div class="search">
              <form class="form-inliness" id="ajaxSearch">
                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                  <input type="text" class="form-control" id="inlineFormInputGroup" v-model="keyword" @change="bySearch()" placeholder="Search..">
                  <div class="input-group-addon" @click="bySearch()"><i class="fa fa-search"></i></div>
                </div>
              </form>
              <div class="clearSearch" v-if="searching">Clear Search</div>
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
              <!-- <Pointer></Pointer> -->
              <div class="pointer text-center" id="draggable"></div>
              <div class="year" :title="year.year" v-for="year in year_lists" v-if="year_lists.length>0"></div>
              <!-- TODO:: make year list and categories dynamic and also still drag -->
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
            current_category: 0
          };
        },
        beforeCreate(){
          // get year lists
          axios.get('/timeline')
            .then( response => {
              this.year_lists = response.data.year_lists;
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
              // axios.get('/posts?sort=asc')
              //   .then( response => {
              //     this.$parent.posts = response.data;
              //   })
              //   .catch( error => {
              //     console.log(error);
              //   });
              // axios.get('/timeline?sort=asc')
              //   .then( response => {
              //     this.year_lists = response.data.year_lists;
              //     this.categories = response.data.categories;
              //     this.setUp();
              //   })
              //   .catch( error => {
              //     console.log(error);
              //   });
            } else {
              this.sort_by = 'newer';
              // axios.get('/posts')
              //   .then( response => {
              //     this.$parent.posts = response.data;
              //   })
              //   .catch( error => {
              //     console.log(error);
              //   });
              // axios.get('/timeline')
              //   .then( response => {
              //     this.year_lists = response.data.year_lists;
              //     this.categories = response.data.categories;
              //     this.setUp();
              //   })
              //   .catch( error => {
              //     console.log(error);
              //   });
            }
            this.fetchPost();
          },
          byCategory: function (id) {
            this.current_category = id;
            this.fetchPost();
          },
          bySearch: function () {
            this.fetchPost();
          },
          fetchYearLists: function() {

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
          },
          setUp: function (){
            var vm = this;
            setTimeout(function() {
              // for pointer movement
              var current_year = $('.year:eq(0)');
              var year_lists = $('.year');
              var years_position = [];
              var pointer = $('.pointer');
              // ***************

              // for page scrolled
              var page_top_position = 0;
              var first_post_for_each_year = [];
              // ********************

              $(pointer).text(current_year.prop('title'));

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
                  $.each(year_lists, function (k, v) {
                      years_position[k] = getPositionOfCenter(v);
                  });
              }

              function getPositionOfCenter(obj) {
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
              }

              function setCurrentYearStyle() {
                  $('.year').removeClass('current');
                  $(current_year).addClass('current');
                  setPointerToClosestYear();
              }

            }, 1);
          }
        }
    }
</script>
