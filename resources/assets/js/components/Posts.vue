<template>
    <div class="col-md-10 offset-2 col-lg-11 offset-lg-1 px-5 my-4">
        <wuHeader></wuHeader>
        <div class="row">
            <div class="col-xs-6 col-sm-4 col-lg-3 px-4 my-3" v-for="post in posts">
                <Post :post="post"></Post>
            </div>
        </div>
    </div>
</template>

<script>
    import Post from './Post.vue';
    import wuHeader from './wuHeader.vue';
    export default {
        components: {
            Post, wuHeader
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
