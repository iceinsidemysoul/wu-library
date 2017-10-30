<template>
    <div class="sidebar-left">
        <div class="collapse-bar">
          <!-- sorter -->
          <!-- tags or categories -->
          <!-- search bar -->
        </div>
        <div class="timeline-nav">
          <!-- collapse bar switch -->
          <div class="collapse-switch">
            <!-- img of hamburger and times -->
            <a href="#" onclick="event.preventDefault()">
              <h1 class="text-center mt-3" style="line-height:0.2">
                -<br>-<br>-
              </h1>
            </a>
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
        data(){
            // var year = $('.year');   
            return {
            };
        },
        mounted() {
           
        },
        created() {
            // this.year = $('.year');
            // console.log(this.year);
        },
        filters: {

        },
        methods: {
           
        }
        
    }
</script>
