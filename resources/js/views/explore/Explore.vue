<template>
    <div>
        <div v-for="post in posts">
            <PublicPost :item="post"/>
        </div>
    </div>
</template>

<script>
import PublicPost from "../../components/Shared/PublicPost";
export default {
    name: "Explore",
    components: {
        PublicPost,
    },
    computed: {
        posts() {
            return this.$store.getters["explorePosts/posts"];
        }
    }
}
</script>

<style scoped>

</style>
