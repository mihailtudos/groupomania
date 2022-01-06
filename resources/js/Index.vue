<template>
    <div>
        <div id="app-container" v-if="loggedIn">
            <Sidebar />
            <div class="content">
                <div id="overlap" @click="mobileMenuHandler"></div>
                <div class="content__header">
                    <h2>{{ this.$route.name }}</h2>
                    <SearchBar class="search-mobile"/>
                    <span class="mobile-menu" @click="mobileMenuHandler">
                    <i class="fas fa-bars"></i>
                </span>
                </div>
                <router-view/>
            </div>
            <Widget />
        </div>
        <div v-else>
            <div class="login-container">
                <router-view/>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "./components/Sidebar/Sidebar";
import Post from "./components/Shared/PostItem";
import Widget from "./components/Widget/Widget";
import SearchBar from "./components/Shared/SearchBar";
import { mapState, mapGetters } from "vuex";
import {logOut} from "./components/Shared/util/auth";

export default {
    name: "Index",
    components: {SearchBar, Widget, Post, Sidebar},
    methods: {
        mobileMenuHandler() {
            const overlap = document.querySelector('#overlap');
            const sidebar = document.querySelector('.sidebar');
            overlap.classList.toggle('show-menu');
            sidebar.classList.toggle('show-sidebar');
        }
    },
    computed: {
        ...mapGetters({
            user: "currentUser/user"
        }),
        ...mapState({
           'isLoggedIn' : 'currentUser/user'
        }),
        loggedIn: {
            get() {
                return this.$store.state.currentUser.isLoggedIn;
            }
        },
    },
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
        #overlap {
            visibility: hidden;
            &.show-menu {
                position: fixed;
                visibility: visible!important;
                top: 0;
                bottom: 0;
                width: 100vw;
                height: 100vh;
                background: #4a5568;
                opacity: .2;
                z-index: 999;
            }
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
                text-transform:capitalize;
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
    .login-container {
        height: 80vh;
        width: 100%;
        display: flex;
        align-content: center;
        justify-items: center;
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
