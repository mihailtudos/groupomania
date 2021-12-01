<template>
    <div id="app-container">
        <Sidebar />
        <div class="content">
            <div class="content__header">
                <h2>Home</h2>
                <SearchBar class="search-mobile"/>
                <span class="mobile-menu" @click="mobileMenuHandler">
                    <i class="fas fa-search"></i>
                </span>
            </div>
            <router-view/>
        </div>
        <Widget />
    </div>
</template>

<script>
import Sidebar from "./components/Sidebar/Sidebar";
import Post from "./components/Shared/PostItem";
import Widget from "./components/Widget/Widget";
import SearchBar from "./components/Shared/SearchBar";
export default {
    name: "Index",
    components: {SearchBar, Widget, Post, Sidebar},
    methods: {
        mobileMenuHandler() {
            const content = document.querySelector('.content');
            const sidebar = document.querySelector('.sidebar');
            console.log(sidebar)
            content.classList.toggle('show-menu');
            sidebar.classList.toggle('show-sidebar');
        }
    }
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;

#app-container {
    display: flex;
    height: 100vh;
    padding: 0 10px;
    justify-content: space-between;
    font-family: "Open Sans", sans-serif;
    font-size: 16px;
    h1 {
        text-align: center;
        color: red;
    }
    .content {
        width: 100%;
        border: 1px solid $twitter-background;
        overflow-y: scroll;
        -ms-overflow-style: none;
        scrollbar-width: none;
        &.show-menu {

        }
        &__header {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 100;
            border: 1px solid $twitter-background;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            align-items: baseline;
            h2 {
                font-size: 20px;
                font-weight: 800;
            }
            .search-mobile {
                visibility: hidden;
            }
            .mobile-menu {
                display: none;
            }
        }
    }
    .content::-webkit-scrollbar {
        display: none;
    }
}
@media (max-width: 1000px) {
    #app-container {
        .search-mobile {
            max-width: 200px;
            visibility: visible!important;
        }
    }
}

@media (max-width: 650px) {
    #app-container {
        .content__header {
            flex-direction: row-reverse;
            .search-mobile {
                display: none;
            }
            .mobile-menu {
                display: inline-block!important;
                font-size: 30px;
                cursor: pointer;
            }
        }
    }
}
</style>
