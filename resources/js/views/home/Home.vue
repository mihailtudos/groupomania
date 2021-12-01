<template>
    <div id="home">
        <TweetBox />
        <LoadingContainer v-if="loading" />
        <div v-else>
            <PostItem
                v-for="(item, index) in posts"
                :key="'post'+index"
                :item="item"/>
        </div>
        <Modal @hide-modal="show = false" :title="'Login form'">
            <h1>Hello</h1>
        </Modal>
    </div>
</template>

<script>
import PostItem from "../../components/Shared/PostItem";
import TweetBox from "../../components/Shared/TweetBox";
import Spinner from "../../components/Shared/Spinner";
import LoadingContainer from "../../components/Shared/LoadingContainer";
import Modal from "../../components/Shared/Modal";
export default {
    name: "Home",
    data() {
        return {
            loading: false,
            posts: [],
            errors: [],
            show: false
        }
    },
    components: {
        Modal,
        LoadingContainer,
        Spinner,
        TweetBox,
        PostItem
    },
    created() {
        this.loading = true;
        axios.get('api/posts')
        .then(response => {
            this.posts = response.data;
        })
        .catch(error => {
            this.errors = error.response.data.errors;
        })
        .then(() => {
           this.loading = false;
        });
    }
}
</script>

<style scoped lang="scss">
    #home {
        width: 100%;
        margin: auto;
    }
</style>
