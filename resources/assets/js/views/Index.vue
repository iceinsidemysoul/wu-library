<template>
    <div class="row">
        <Timeline v-on:dragEnd="moveToFirstPost($event.prop('title'))"></Timeline>
        <!-- <Posts :posts="posts"></Posts> -->
    </div>
</template>

<script>
    import Timeline from '../components/Timeline.vue';
    import Posts from '../components/Posts.vue';
    export default {
        components: {
            Timeline, Posts
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
        mounted() {
        },
        methods: {
            moveToFirstPost: function(){
                var vm = this;
                setTimeout(function(){

                }, 1);
            }
        }

    }
</script>
