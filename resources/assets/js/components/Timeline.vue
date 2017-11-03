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
                 <li class="active" >วลัยลักษณ์ <span>(<span class="num">376</span>)</span></li>
                 <li >ทำเนียบบุคคลสำคัญ <span>(<span class="num">193</span>)</span></li>
                 <li >อาคารและสิ่งก่อสร้าง <span>(<span class="num">56</span>)</span></li>
                 <li >เหตุการณ์และกิจกรรม <span>(<span class="num">46</span>)</span></li>
                 <li >การวิจัย <span>(<span class="num">16</span>)</span></li>
                 <li >การเรียนการสอน <span>(<span class="num">22</span>)</span></li>
                 <li >การบริการวิชาการ <span>(<span class="num">55</span>)</span></li>
              </ul>
            </div>
            <!-- search bar -->
            <div class="search">
              <form class="form-inliness" id="ajaxSearch">
                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                  <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Search..">
                  <div class="input-group-addon"><i class="fa fa-search"></i></div>
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

              <div class="pointer text-center" id="draggable"></div>
              <div class="year" :title="year.year" v-for="year in year_lists" v-if="year_lists.length>0"></div>
              <!-- <div class="year" title="2017"></div>
              <div class="year" title="2016"></div>
              <div class="year" title="2015"></div>
              <div class="year" title="2014"></div>
              <div class="year" title="2013"></div>
              <div class="year" title="2012"></div>
              <div class="year" title="2011"></div>
              <div class="year" title="2010"></div>
              <div class="year" title="2009"></div>
              <div class="year" title="2008"></div>
              <div class="year" title="2007"></div>
              <div class="year" title="2006"></div>
              <div class="year" title="2005"></div>
              <div class="year" title="2004"></div>
              <div class="year" title="2003"></div> -->
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
            year_lists: [],
            categories: []
          };
        },
        beforeCreate(){
          // get year lists
          axios.get('/timeline')
            .then( response => {
              this.year_lists = response.data.year_lists;
              this.categories = response.data.categories;
              // require('../core/Timeline.js');
            })
            .catch( error => {
              console.log(error);
            });
        },
        beforeUpdate() {
          $('.pointer').draggable({
            axis: 'y',
            containment: '.timeline'
          });
          // document.getElementsByClassName('pointer')[0].draggable();
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
          }
        }
    }
</script>
