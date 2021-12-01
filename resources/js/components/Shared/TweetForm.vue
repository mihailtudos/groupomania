<template>
    <form enctype="multipart/form-data" @submit.prevent="handleTweet">
        <div class="input-group">
            <textarea
                id="excerpt"
                v-model="excerpt"
                rows="5"
                required
                name="excerpt" placeholder="What's happening?"></textarea>
        </div>
        <div class="form--footer">
            <input type="file" name="file">
            <button
                class="btn-secondary form-button">
                Create tweet <i class="fas fa-feather-alt"></i>
            </button>
        </div>
    </form>
</template>

<script>
export default {
    name: "TweetForm",
    data() {
        return {
            excerpt: '',
            image: '',
        }
    },
    methods: {
        handleTweet() {
            console.log('sss')
        }
    }
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;
    form {
        width: 100%;
        padding-bottom: 1rem;
        .input-group {
            width: 100%;
            textarea {
                width: 100%;
                border: 1px solid $twitter-color;
                font-size: 1.2rem;
                padding: .5rem;
                resize: none;
            }
        }
        .form--footer {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;

        }
        border-bottom: 5px solid $twitter-color;
    }
</style>
