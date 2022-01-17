<template>
    <div class="widgets">
        <SearchBar />
        <div>
            <div class="widgets--container">
                <h2>What's happening?</h2>
                <blockquote v-for="(post, index) in posts" :key="index" class="twitter-tweet">
                    <p v-html="post.excerpt"></p>
                    <span style="display: flex; justify-content: flex-end">
                        <router-link :to="{ name: 'announcement', params: { id: post.id } }">read more...</router-link>
                    </span>
                </blockquote>
            </div>
        </div>
    </div>
</template>

<script>
import SearchBar from "../Shared/SearchBar";
import LoadingContainer from "../Shared/LoadingContainer";
export default {
    name: "Widget",
    components: {LoadingContainer, SearchBar},

    computed: {
       posts() {
           return this.$store.getters["explorePosts/posts"]
        }
    },
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;

.widgets {
    width: 100%;
    flex: 0.2!important;
    min-width: 300px;
    margin-left: 20px;
    &--container {
        margin-top: 15px;
        padding: .5rem;
        background-color: #f5f8fa;
        border-radius: 20px;
        h2 {
            font-size: 18px;
            font-weight: 800;
        }
        blockquote {
            padding: 1rem;
            font-weight: 200;
            margin: 0;
            border-bottom: 2px solid $twitter-color;
            a {
                font-weight: bold;
                font-size: .8rem;
                color: $twitter-color;
                text-align: right;
            }
        }
    }
}
@media (max-width: 1000px) {
    .widgets {
        display: none;
    }
}
</style>
