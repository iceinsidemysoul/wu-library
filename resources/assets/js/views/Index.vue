<template>
    <div class="row" style="min-height:1000px">
        <Timeline v-on:dragEnd="moveToFirstPost($event.prop('title'))"></Timeline>
        <Posts :posts="posts"></Posts>
        <Survey></Survey>
    </div>
</template>

<script>
    import Timeline from '../components/Timeline.vue';
    import Posts from '../components/Posts.vue';
    import Survey from '../components/Survey.vue';
    export default {
        components: {
            Timeline, Posts, Survey
        },
        data() {
            return {
                posts: [],
            }
        },
        beforeCreate () {
            axios.get('/posts')
                .then( response => {
                    this.posts = response.data;
                })
                .catch( error => {
                    console.log(error);
                });
        },
        created() {
            
        },
        methods: {
            moveToFirstPost: function(){
                var vm = this;
                setTimeout(function(){

                }, 1);
            },
            testScroll(){
                console.log('scrolling');
            }
        }

    }
</script>
