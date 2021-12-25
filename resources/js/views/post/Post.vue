<template>
    <div class="post">
        <div v-if="!loading">
            <div class="post--description">
                <img width="400px" height="100%" src="/images/post-default.webp" alt="test">
                <p v-if="post">{{ post.excerpt }}</p>
                <div class="post--description__footer">
                    <p>{{'@' + this.getUsername(post.user.email) }}</p>
                    <p>{{ post.created_at | fromNow }}</p>
                </div>
            </div>
            <div class="post--comments">
                <h2>Comments ({{ post.comments.length }})</h2>
                <CommentItem id="comments"  v-for="(comment, index) in post.comments" :comment="comment" :key="index+'comment'" />
            </div>
        </div>
        <LoadingContainer v-else/>
    </div>
</template>

<script>
import LoadingContainer from "../../components/Shared/LoadingContainer";
import CommentItem from "../../components/UI/CommentItem";
export default {
    name: "Post",
    components: {CommentItem, LoadingContainer},
    data() {
        return {
            post: null,
            loading: false,
            error: false,
        }
    },
    created() {
        if (this.$route.params.post) {
            this.post = this.$route.params.post;
        } else {
            this.loading = true;
            this.error = false;
            axios.get(`/api/posts/${this.$route.params.id}`)
            .then(response => this.post = response.data)
            .catch(e => this.error = true)
            .then(() => this.loading = false);
        }
    },
    mounted() {
        if(this.$router.currentRoute['hash']){ 	Vue.use(VueScrollTo); 	VueScrollTo.scrollTo(this.$router.currentRoute['hash'], 500); 	}
},
}
</script>

<style scoped lang="scss">
    .post {
        margin: .5rem auto;
        padding: .5rem;
        .post--description {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 1rem 0.5rem;
            border-radius: 1rem;
            img {
                border-radius: 20px;
                object-fit: cover;
                width: 100%;
                height: 100%;
                margin-bottom: 2rem;
                max-width: 500px;
            }
            p {
                text-align: justify;
                max-width: 500px;
                font-weight: 200;
            }
            &__footer {
                display: flex;
                align-items: baseline;
                justify-content: space-between;
                width: 100%;
                max-width: 500px;
                p {
                    color: #50B7F5FF;
                    font-weight: bold!important;
                }
            }
        }
        .post--comments {
            margin: 2rem auto;
            max-width: 500px;
            h2 {
                margin-bottom: 1rem;
            }
        }
    }
    h1 {
        text-align: center;
    }
</style>
