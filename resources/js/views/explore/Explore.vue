<template>
    <div>
        <div v-for="(post, index) in this.$store.getters['explorePosts/posts']">
            <PublicPost :item="post" :key="'publicPost'+index"/>
        </div>
    </div>
</template>

<script>
import PublicPost from "../../components/Shared/PublicPost";
export default {
    name: "Explore",
    data() {
      return {
          posts: []
      }
    },
    components: {
        PublicPost,
    },
}
</script>

<style scoped>

</style>
