<template>
    <div class="sidebar-left">
        <!-- <div class="page-sensor">
          <div class="line-detector" style="position:fixed;left:0;top:20%;width:100%;">
            <hr style="border-top: 2px solid black;">
          </div>
        </div> -->
        <div :class="{'collapse-bar': true, 'open': showNav}">
          <!-- sorter -->
          <div class="menu-side">
            <div class="sorting wu-sorter-head-text h4">
              เรียงลำดับ
              <div class="sorting-toggle" @click="toggleSort()">
                <div :class="{ 'wu-sorter-text': true, 'newer': sort_by == 'newer', 'older': sort_by == 'older'}">{{ sort_by == 'newer' ? 'ล่าสุด' : 'แรกสุด' }}</div>
              </div>
            </div>
            <!-- tags or categories -->
            <div class="categories">
                <span class="wu-category-head-text h4">หัวข้อ</span>
                <ul class="category-list">
                  <li @click="byCategory(0)" :class="{'active': !current_category }">
                    <span class="wu-category-text">ทั้งหมด </span> <span>(<span class="num">{{ $parent.posts.length }}</span>)</span>
                  </li>
                  <li @click="byCategory(category.id)" :class="{'active': current_category == category.id}" 
                    v-for="category in categories">
                    <span class="wu-category-text">
                      {{ category.title }} <!-- <span>(<span class="num">{{ category.posts_count }}</span>)</span> -->
                    </span>
                  </li>
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
              let year_dc = [];
              // console.log ( year_dc);
              for ( let year of response.data ) {
                year_dc.push(parseInt(year) + 543);
              }
              this.year_lists = year_dc;
              let vm = this;
              setTimeout(function() {
                vm.setUp();
              }, 1000);
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
                let year_dc = [];
                for (let year of result) {
                  year_dc.push( parseInt(year) + 543 );
                }
                this.year_lists = year_dc;
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
              // TODO:: fixed later, make it stable
              var year_lists = $('.year');
              var post_lists = $('.post');
              var years_position = [];
              var posts_position = [];
              var page_position = [];
              var current_year = $('.year:eq(0)');
              var pointer = $('.pointer');

              $(pointer).text(current_year.prop('title'));


              // getYearsPosition();
              setPointerToCurrentYear();
              setCurrentYearStyle();

              document.addEventListener('scroll', function() {
                getYearsPosition();
                findCurrentYearByScroll();
              });

              $('#draggable').draggable({
                  axis: 'y',
                  containment: '.timeline',
                  start: function start() {

                  },
                  drag: function drag() {
                    findClosestYear();
                    $(pointer).text($(current_year).prop('title'));
                    setCurrentYearStyle();
                  },
                  stop: function stop() {
                    scrollToCurrentYearPosts();
                    setPointerToCurrentYear();
                  }
              });
              

              function findClosestYear() {
                  var current_pointer_position = getCenterOffset(pointer);
                  getYearsPosition();
                  if (current_pointer_position < years_position[0]) return 0;
                  else if (current_pointer_position > years_position[years_position.length - 1]) return years_position.length - 1;
                  for (let i = 0; i < years_position.length - 1; i++) {
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

              function getYearsPosition() {
                if ($(year_lists).length < 0 ) return ;
                $.each(year_lists, function (k, v) {
                  // years position
                  years_position[k] = getCenterOffset(v);

                  // posts position
                  getPostPosition(k, v);
                });
                arrangePostsPosition();
                // console.log (posts_position);
              }

              function getPostPosition(k, v) {
                let year = $(v).prop('title');
                let first_post = $('.year-thumbnail:contains(' + year + '):eq(0)').parent().parent().parent().parent();
                let last_post = $('.year-thumbnail:contains(' + year + '):last').parent().parent().parent().parent();
                if ( k == 0) {
                  posts_position[k] = [0, getBottomOffset(first_post) - 150, getBottomOffset(last_post) - 150];
                // console.log (posts_position[k]);
                } else {
                  posts_position[k] = [getTopOffset(first_post)-150, getBottomOffset(first_post) - 150,  getBottomOffset(last_post) - 150];
                }
              }

              function arrangePostsPosition() {
                let pos = posts_position;

                for (let k = 0; k < pos.length - 1; k++) {
                  let count_same_top = 0;
                  let count_same_bot = 0;

                  // case 0:: not intersect at all
                  if ( pos[k][2] <= pos[k+1][0] ) {
                    // do nothing
                    continue;
                  }// end case 0

                  // case 1:: next is subset of current, or intersect some
                  if ( pos[k][0] < pos[k+1][0] && pos[k][2] == pos[k+1][2] ) {
                    // set position[k][2] == position[k+1][0]
                    pos[k][2] = pos[k+1][0];
                    continue;
                  } // end case 1

                  // case 2:: next is the same height as the current
                  if ( pos[k][0] == pos[k+1][0] && pos[k][2] == pos[k+1][2] ) {
                    let d = 2;
                    let h = pos[k][2] - pos[k][0];
                    let part;
                    // find out how many item is in the same row

                    // check if 3rd item exists
                    if ( k < pos.length - 2) {
                      if ( pos[k][0] == pos[k+2][0] && pos[k][2] == pos[k+2][2] ) { 
                        // check 4th item
                        if ( k < pos.length - 3) {
                          if ( pos[k][0] == pos[k+3][0] && pos[k][2] == pos[k+3][2] ) {
                            // mean this row have 4 distinct year and the next would be in next row = 2.0
                            d = 4; 
                            part = h/d;

                            // got 4 year to tear apart
                            rowPartition(pos, k, d, part);

                            // skip 3 item
                            k += 3;
                          } else {
                            // no 4th item
                            d = 3; 
                            part = h/d;

                            // got 4 year to tear apart
                            rowPartition(pos, k, d, part);

                            // skip 3 item
                            if ( pos[k][0] == pos[k+3][0] && pos[k][2] < pos[k+3][2]  && k < pos.length - 3){
                              pos[k+3][0] = pos[k][2];
                            }
                            k += 2;
                          }
                        } // end check if 4th item exists
                        else {
                          // no 4th item
                          d = 3; 
                          part = h/d;

                          // got 4 year to tear apart
                          rowPartition(pos, k, d, part);

                          // skip 3 item
                          k += 2;
                        }

                      } else {
                        // got 2 year to tear apart
                        d = 2; 
                        part = h/d;

                        // got 4 year to tear apart
                        rowPartition(pos, k, d, part);

                        // skip 1 item
                        // check if it 2.0 or 2.3
                        if ( pos[k][0] == pos[k+2][0] && pos[k][2] < pos[k+2][2]) {
                          pos[k+2][0] = pos[k][2];
                        }
                        k += 1;
                      }
                    }  // end check 3rd item
                    else {
                      // got 2 year to tear apart
                      d = 2; 
                      part = h/d;

                      // got 4 year to tear apart
                      rowPartition(pos, k, d, part);

                      // skip 1 item
                      k += 1;
                    } 
                    continue;

                  }// end case 2

                  // case 3:: current is subset of next
                  if ( pos[k][0] == pos[k+1][0] && pos[k][2] < pos[k+1][2] ) {
                    pos[k+1][0] = pos[k][2];

                    continue;
                  } // end case 3

                }
                // console.log(pos);
                page_position = pos;
              }

              function rowPartition(pos, k, d, p) {
                for ( let i = 0; i < d - 1; i++ ) {
                  pos[k+i][2] = pos[k+i][0] + p;
                  pos[k+i+1][0] = pos[k+i][2];
                }
              }


              function getTopOffset(obj) {
                  if (!$(obj).offset()) return ;

                  let top = $(obj).offset().top; 

                  return top;
              }

              function getCenterOffset(obj) {
                  if (!$(obj).offset()) return ;
                  let h = $(obj).outerHeight();
                  let top = $(obj).offset().top;

                  return top + h / 2;
              }

              function getBottomOffset(obj) {
                  if (!$(obj).offset()) return ;
                  let h = $(obj).outerHeight();
                  let top = $(obj).offset().top;

                  return top + h;
              }

              function findCurrentYearByScroll() {
                // let former_year = $(current_year).prop('title');
                let y = window.pageYOffset + 50;

                // console.log(y);
                for (let i = 0; i < page_position.length; i++) {
                  if ((y > page_position[i][0]) &&  (y < page_position[i][2])) {
                    current_year = $('.year:eq(' + i + ')');
                    $('.pointer').text($(current_year).prop('title'));
                    changePointerByScroll();
                    return ;
                  }
                }
              }

              function changePointerByScroll() {
                  // getYearsPosition();
                  // let pointer_position = getCenterOffset(pointer);

                  setCurrentYearStyle();
                  setPointerToCurrentYear();
              }

              function setCurrentYearStyle() {
                // if ($('.post').length < 1 ) return ;
                $('.post').removeClass('current-year');
                $('.year-thumbnail:contains(' + $(current_year).prop('title') + ')').parent().parent().parent().addClass('current-year');
                // console.log($('.year-thumbnail:contains(2017)').parent().parent());
              }

              function setPointerToCurrentYear() {
                  getYearsPosition();
                  var x = $(pointer).offset().left;
                  var h = $(pointer).outerHeight();
                  var t = getCenterOffset($(current_year));
                  $(pointer).offset({ left: x, top: t - h / 2 });
              }

              function scrollToCurrentYearPosts() {
                  let year = $(current_year).prop('title');
                  let target_post = $('.year-thumbnail:contains(' + year + '):eq(0)');
                  // let target = $(target_post).offset().top - 265 ;
                  let target = getTopOffset(target_post) - 215;
                  if (target < 0 )
                    target = 0;
                  window.scrollTo(0, target);
              }

            }, 1);
          }
        }
    }
</script>
