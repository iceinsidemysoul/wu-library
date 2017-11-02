<template>
    <div class="card post border-0">
        <div class="post-thumbnail">
            <img class="img-fluid" :src="post.image" alt="/">
            <div class="year-thumbnail">
                {{ post.date.substr(0,4) }}
                <!-- width = height -->
                <!-- border-radius 50% -->
                <!-- position absolute -->
                <!-- color white -->
                <!-- background red if match current year -->
                <!-- background blue if hover -->
                <!-- display none if note match curret year -->
            </div>
        </div>
        <div class="card-block post-title p-2">
            <h5 class="card-title">{{ post.title }}</h5>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            post: {
              type: Object,
              required: true
            }
        }
    }
</script>
