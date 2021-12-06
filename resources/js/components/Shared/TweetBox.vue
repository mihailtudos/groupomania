<template>
    <div class="tweet-box">
        <form>
            <div class="input--group">
                    <span class="material-icons">
                       <i class="fas fa-user-tie"></i>
                    </span>
                <input type="text" placeholder="What's happening?">
            </div>
            <div class="footer">
                <ImageFileBrowseIcon :size="'20'"/>
                <button class="tweet-button">Tweet</button>
            </div>
        </form>
    </div>
</template>

<script>
import ImageFileBrowseIcon from "../UI/ImageFileBrowseIcon";
export default {
    name: "TweetBox",
    components: {ImageFileBrowseIcon},
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;

.tweet-box {
    padding: 1rem;
    border-bottom: 8px solid $twitter-background;
    background-color: white;
    form {
        .input--group {
            display: flex;
            span {
                border-radius: 50px;
                font-size: 60px;
            }
            input {
                flex: 1;
                margin-left: 20px;
                font-size: 20px;
                border: none;
                outline: none;
            }
        }
        .footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            button {
                background-color: $twitter-color;
                border: none;
                color: white;
                font-weight: 900;
                border-radius: 30px;
                width: 100px;
                height: 40px;
                cursor: pointer;
            }
        }
    }
}
</style>
