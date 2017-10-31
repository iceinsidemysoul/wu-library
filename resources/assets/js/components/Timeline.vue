<template>
    <div class="sidebar-left">
        <div :class="{'collapse-bar': true, 'open': showNav}">
          <!-- sorter -->
          <div class="menu-side">
            <div class="sorting">
              Sort
              <div class="sorting-toggle" @click="toggleSort()">
                <div :class="{'newer': sort_by == 'newer', 'older': sort_by == 'older'}">{{ sort_by }}</div>
              </div>
            </div>
            <!-- tags or categories -->
            <div class="categories">
              Categories
                <ul class="category-list">
                 <li class="active" >All <span>(<span class="num">376</span>)</span></li>
                 <li >Campus <span>(<span class="num">193</span>)</span></li>
                 <li >Commencement <span>(<span class="num">56</span>)</span></li>
                 <li >Community <span>(<span class="num">46</span>)</span></li>
                 <li >Firsts <span>(<span class="num">16</span>)</span></li>
                 <li >Global <span>(<span class="num">22</span>)</span></li>
                 <li >Leaders <span>(<span class="num">55</span>)</span></li>
                 <li >Learning <span>(<span class="num">152</span>)</span></li>
                 <li >Philanthropy <span>(<span class="num">24</span>)</span></li>
                 <li >Presidents <span>(<span class="num">10</span>)</span></li>
                 <li >Research <span>(<span class="num">110</span>)</span></li>
                 <li >Sports <span>(<span class="num">17</span>)</span></li>
              </ul>
            </div>
            <!-- search bar -->
            <div class="search">
              <form id="ajaxSearch">
                <input id="s" type="text">
                <input type="submit" id="searchsubmit" value="Search">
              </form>
              <div class="clearSearch">Clear Search</div>
            </div>
          </div>
          
        </div>
        <div class="timeline-nav">
          <!-- collapse bar switch -->
          <div :class="{'collapse-switch': true,  'off': !showNav, 'on': showNav}" @click="showCollapse()">
          </div>

          <!-- timeline -->
          <div class="timeline">

              <div class="pointer text-center" id="draggable"> 2017</div>
              <div class="year" title="2017"></div>
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
              <div class="year" title="2003"></div>
              
          </div>
        </div>
      </div>
</template>

<style>

</style>

<script>
    export default {
        data() {
          return {
            showNav: false,
            sort_by: 'newer'
          };
        },
        mounted() {
          console.log('timeline is mounted!!');
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
