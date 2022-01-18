<template>
    <div class="sidebar" @click="handleMenuClick">
        <div class="sidebar--menu">

            <router-link :to="{ name: 'home' }" class="sidebar--option active" >
                <img src="/images/logo/logo.svg" alt="Gropomania logo" height="50px" width="200px">
            </router-link>
            <router-link :to="{ name: 'home' }" class="sidebar--option active" >
                <span class="material-icons">
                    <i class="fab fa-accusoft"></i>
                </span>
                <h2>Home</h2>
            </router-link>
            <router-link :to="{ name: 'explore' }" class="sidebar--option" id="explore" >
                <span class="material-icons">
                    <i class="fas fa-search"></i>
                </span>
                <h2>Explore</h2>
            </router-link >
            <div class="sidebar--option">
                <span class="material-icons">
                    <i class="fas fa-bell"></i>
                </span>
                <h2>Notifications</h2>
            </div>
            <div class="sidebar--option">
                <span class="material-icons">
                    <i class="fas fa-envelope"></i>
                </span>
                <h2>Messages</h2>
            </div>
            <router-link v-if="user.id" :to="{name:'profile', params:{id: user.id} }" class="sidebar--option" >
                <span class="material-icons">
                    <i class="fas fa-id-badge"></i>
                </span>
                <h2>Profile</h2>
            </router-link>
        </div>
        <div class="sidebar--footer" >
            <div class="sidebar--footer__account">
                <span>{{ user.name }}</span>
                <i class="fas fa-sign-out-alt" @click="handleLogout"></i>
            </div>
            <div class="sidebar--footer__links">
                <router-link class="sidebar--footer__link" :to="{ name: 'policy'}">Policy</router-link >
                <router-link class="sidebar--footer__link" :to="{ name: 'policy'}">Cookie</router-link >
                <router-link class="sidebar--footer__link" :to="{ name: 'policy'}">About</router-link >
            </div>
            <div class="sidebar--footer__rights">
                <p>Gropomania @2021 by Mihail Tudos</p>
            </div>
        </div>
    </div>
</template>

<script>
import TweetButton from "../Shared/TweetButton";
export default {
    name: "Sidebar",
    components: {TweetButton},
    methods: {
        handleLogout() {
            this.$store.dispatch('currentUser/logout');
        },
        handleMenuClick() {
            this.$emit('menuClicked');
        }
    },
    computed: {
        user() {
            return this.$store.state.currentUser.user;
        },
    }
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;

.sidebar {
    border-right: 1px solid $twitter-background;
    flex: 0.3;
    margin-top: 20px;
    padding-left: 20px;
    padding-right: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    &--option {
        display: flex;
        align-items: baseline;
        justify-content: flex-start;
        cursor: pointer;
        margin-bottom: .5rem;
        padding: .5rem 1rem;
        h2 {
            font-weight: 700;
            font-size: 1rem;
        }
        i {
            font-size: 1.5rem;
        }
        &:hover {
            background-color: $twitter-background;
            border-radius: 30px;
            color: $twitter-color;
            transition: color 100ms ease-out;
        }
        &.active {
            color: $twitter-color;
        }
    }
    &--option .material-icons,
    .fa-twitter,
    .fa-campground {
        padding: 10px;
    }
    .fa-campground {
        color: $twitter-color;
        font-size: 30px;
        padding: 20px;
    }
    &--footer {
        margin-bottom: 1rem;
        &__links {
            border-top: 2px solid $twitter-background;
            padding-top: .3rem;
            display: flex;
            flex-flow: row wrap;
            align-items: center;
            justify-content: space-between;
            gap: .5rem;
            a {
                text-decoration: underline;
            }
        }
        &__rights {
            margin-top: .5rem;
            text-align: center;
            font-size: .7rem;
        }
        &__account {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: .5rem;
            i {
                font-size: 1rem;
                cursor: pointer;
            }
        }
    }
}

@media (min-width: 1000px) {
    #explore {
        display: none;
    }
}
@media (max-width: 650px) {
    .sidebar {
        display: none;
    }
}
</style>
