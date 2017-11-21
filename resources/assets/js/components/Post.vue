<template>
    <div class="card post border-0">
        
        <a :href='"/post/"+post.id' target="_blank">
            <div class="post-thumbnail">
                <img class="img-fluid" :src="post.image" alt="/">
                <div class="year-thumbnail">
                    {{ post.date | getYear }}
                </div>
            </div>
            <div class="card-block p-2">
                <p><span class="cate text-post-categories" v-for="cate in post.categories"> {{ cate.title }} </span></p>
                <h6 class="card-title post-title text-post-title">{{ post.title }}</h6>
            </div>
        </a>
    </div>
</template>

<script>
    export default {
        props: {
            post: {
              type: Object,
              required: true
            }
        },
        filters: {
          getYear: function(y) {
            let a = parseInt(y.substr(0, 4)) + 543;
            return a;
          }
        },
    }
</script>
