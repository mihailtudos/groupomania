<template>
    <div id="app-body">
        <!-- Sidebar starts -->
        <div class="sidebar">
            <router-link to="/" style="">
                <i class="fas fa-campground "></i>
            </router-link>
            <div class="sidebar-option active">
                <span class="material-icons">
                    <i class="fab fa-accusoft"></i>
                </span>
                <h2>Home</h2>
            </div>
            <div class="sidebar-option">
                <span class="material-icons">
                    <i class="fas fa-search"></i>
                </span>
                <h2>Explore</h2>
            </div>
            <div class="sidebar-option">
                <span class="material-icons">
                    <i class="fas fa-bell"></i>
                </span>
                <h2>Notifications</h2>
            </div>
            <div class="sidebar-option">
                <span class="material-icons">
                    <i class="fas fa-envelope"></i>
                </span>
                <h2>Messages</h2>
            </div>
            <div class="sidebar-option">
                <span class="material-icons">
                    <i class="fas fa-id-badge"></i>
                </span>
                <h2>Profile</h2>
            </div>
            <button class="sidebar__tweet">
                <i class="fas fa-feather-alt"></i> Tweet
            </button>
        </div>
        <!-- Sidebar ends -->
        <!-- Feed starts -->
        <div class="feed">
            <div class="feed__header">
                <h2>Home</h2>
            </div>
            <!-- tweetbox starts -->
            <div class="tweet-box">
                <form>
                    <div class="tweet-box__input">
                    <span class="material-icons">
                       <i class="fas fa-user-tie"></i>
                    </span>
                        <input type="text" placeholder="What's happening?">
                    </div>
                    <button class="tweet-box__tweet-button">Tweet</button>
                </form>
            </div>
            <!-- tweetbox ends -->
            <!-- post starts -->

            <Post />
            <Post />
            <!-- post ends -->
        </div>
        <!-- Feed ends -->
        <!-- widgets starts -->
        <div class="widgets">
            <div class="widgets__input">
                <span class="material-icons widgets__search-icon"> <i class="fas fa-search"></i></span>
                <input type="text" placeholder="Search Twitter">
            </div>
            <div class="widgets__widget-container">
                <h2>What's happening?</h2>
                <blockquote class="twitter-tweet">
                    <p lang="en" dir="ltr">Sunsets don&#39;t get much better than this one over <a
                        href="https://twitter.com/GrandTetonNPS?ref_src=twsrc%5Etfw">@GrandTetonNPS</a>. <a
                        href="https://twitter.com/hashtag/nature?src=hash&amp;ref_src=twsrc%5Etfw">#nature</a> <a
                        href="https://twitter.com/hashtag/sunset?src=hash&amp;ref_src=twsrc%5Etfw">#sunset</a> <a
                        href="http://t.co/YuKy2rcjyU">pic.twitter.com/YuKy2rcjyU</a></p>&mdash; US Department of the Interior
                    (@Interior) <a href="https://twitter.com/Interior/status/463440424141459456?ref_src=twsrc%5Etfw">May 5, 2014</a>
                </blockquote>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "./components/Sidebar/Sidebar";
import Post from "./components/Shared/Post";
export default {
    name: "Index",
    components: {Post, Sidebar}
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;
#app-body {
    display: flex;
    height: 100vh;
    max-width: 1300px;
    padding: 0 10px;
    margin: auto;
    font-family: "Open Sans", sans-serif;
    font-size: 16px;
}

h1 {
    text-align: center;
    color: red;
}
.sidebar-option {
    display: flex;
    align-items: center;
    cursor: pointer;
    margin-bottom: 1rem;
}

.sidebar-option .material-icons,
.fa-twitter,
.fa-campground {
    padding: 10px;
}

.sidebar-option h2 {
    font-weight: 800;
    font-size: 20px;
    margin-right: 20px;
}

.sidebar-option:hover {
    background-color: $twitter-background;
    border-radius: 30px;
    color: $twitter-color;
    transition: color 100ms ease-out;
}

.sidebar-option.active {
    color: $twitter-color;
}

.sidebar__tweet {
    background-color: $twitter-color;
    width: 100%;
    border: none;
    color: white;
    font-weight: 900;
    border-radius: 30px;
    height: 50px;
    margin-top: 20px;
    cursor: pointer;
}
.sidebar {
    border-right: 1px solid $twitter-background;
    flex: 0.2;
    min-width: 250px;
    margin-top: 20px;
    padding-left: 20px;
    padding-right: 20px;
}

.fa-campground {
    color: $twitter-color;
    font-size: 30px;
    padding: 20px;
}

/* Feed styles */
.feed {
    flex: 0.5;
    border: 1px solid $twitter-background;
    min-width: fit-content;
    overflow-y: scroll;
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.feed::-webkit-scrollbar {
    display: none;
}

.feed__header {
    position: sticky;
    top: 0;
    background-color: white;
    z-index: 100;
    border: 1px solid $twitter-background;
    padding: 15px 20px;
}

.feed__header h2 {
    font-size: 20px;
    font-weight: 800px;
}

/* tweet box */
.tweet-box__input span {
    border-radius: 50px;
    font-size: 60px;
}

.tweet-box {
    padding-bottom: 10px;
    border-bottom: 8px solid $twitter-background;
    padding-right: 10px;
}

.tweet-box form {
    display: flex;
    flex-direction: column;
}

.tweet-box__input {
    display: flex;
    padding: 20px;
}

.tweet-box__input input {
    flex: 1;
    margin-left: 20px;
    font-size: 20px;
    border: none;
    outline: none;
}

.tweet-box__tweet-button {
    background-color: $twitter-color;
    border: none;
    color: white;
    font-weight: 900;
    border-radius: 30px;
    width: 80px;
    height: 40px;
    margin-top: 20px;
    margin-left: auto;
}

/* widgets */
.widgets {
    flex: 0.3;
}

.widgets__input {
    display: flex;
    align-items: center;
    background-color: $twitter-background;
    padding: 10px;
    border-radius: 20px;
    margin-top: 10px;
    margin-left: 20px;
}

.widgets__input input {
    border: none;
    background-color: $twitter-background;
    outline: none;
}

.widgets__search-icon {
    color: gray;
}

.widgets__widget-container {
    margin-top: 15px;
    margin-left: 20px;
    padding: 20px;
    border-radius: 20px;
    background-color: #f5f8fa;
    border-radius: 20px;
}

.widgets__widget-container h2 {
    font-size: 18px;
    font-weight: 800;
}
</style>
