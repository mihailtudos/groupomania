<template>
    <div class="post">
        <div>
            <div class="post--description" v-if="post">
                <img v-if="post.image" width="400px" height="100%" :src="post.image" alt="test">
                <p v-if="post" v-html="post.excerpt"></p>
                <div class="post--description__footer">
                    <p> posted {{ post.created_at | fromNow }} {{'by @' + this.getUsername(post.user.email) }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Announcement",
    computed: {
         post() {
            return this.$store.getters["explorePosts/post"](this.$route.params.id);
        }
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
            width: 100%;
            max-width: 500px;
            p {
                color: #50B7F5FF;
                font-weight: bold!important;
                text-align: right;
            }
        }
    }
    .post--comments {
        margin: 2rem auto;
        max-width: 500px;
        h2 {
            margin-bottom: 1rem;
        }
        &__pagination {
            display: flex;
            color: #50B7F5FF;
            gap: 1rem;
            justify-content: space-between;
            p:last-child {
                cursor: pointer;
            }
        }
    }
}
h1 {
    text-align: center;
}
</style>
