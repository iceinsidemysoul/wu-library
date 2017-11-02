<template>
    <div class="row">
        <Timeline></Timeline>
        <Posts :posts="posts"></Posts>
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
                categories: [],
                year_lists: []
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
        }
    }
</script>
