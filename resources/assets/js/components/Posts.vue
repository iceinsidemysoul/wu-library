<template>
    <div class="col-md-10 offset-md-2 col-lg-11 offset-lg-1 my-4">
        <!-- below will be header -->
        <p style="margin-left: -3%; margin-bottom: 2%;"> <span class="h3">Walailak University</span> <span class="text-muted h5 ml-3">Timeline</span></p>
        <div class="row">
            <div class="col-xs-6 col-sm-4 col-lg-3 px-5 my-4" v-for="post in posts">
                <Post :post="post"></Post>
            </div>
        </div>
    </div>
</template>

<script>
    import Post from './Post.vue';
    export default {
        components: {
            Post
        },
        props: {
            posts: {
              type: Array,
              required: true
            }
        },
        data(){
            return {
            };
        },
        beforeCreate() {
        },
        mounted(){
            console.log(this.$props.posts);
        },
        methods: {
            toggleSort: function (){

            },
            filterByCategory: function (category) {

            },
            filterBySearch: function (keyword) {

            }
        }

    }
</script>
