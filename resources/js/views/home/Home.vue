<template>
    <div id="home">
        <Modal @closeModal="show = false" :noCreate="1" title="Opps something went wrong">
            <h3>We couldn't process your request please try again later :(</h3>
        </Modal>
        <TweetBox @newPostCreated="handleNewPostCreated"/>
        <LoadingContainer v-if="loading" />
        <div v-else>
            <PostItem
                @postDelete="handlePostDelete"
                v-for="(item, index) in posts"
                :key="'post'+index"
                :item="item"/>
        </div>
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
    },
    methods: {
        handleNewPostCreated(post) {
            this.posts.unshift(post);
        },
        async handlePostDelete(id) {
            try {
                const response = (await axios.delete(`/api/posts/${id}`));
                if (response.status === 204) {
                    this.updatePostsList(id, 'deleted');
                    return '';
                }
                throw new Error('Something went wrong.');
            } catch (error) {
                this.show = true;
            }
        },
        updatePostsList(id, action) {
            if (action === 'edited') {
                this.comments[this.comments.findIndex(comment => comment.id === this.commentToUpdate.id)].content = this.comment;
            }

            if (action === 'deleted') {
                this.posts.splice(this.posts.findIndex(element => element.id === id),1);
            }
        }
    }
}
</script>

<style scoped lang="scss">
    #home {
        width: 100%;
        margin: auto;
    }
</style>
