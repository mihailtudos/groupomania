<template>
    <div class="post">
        <Modal @closeModal="handleCloseModal" :noCreate="1" title="Opps something went wrong">
            <h3>We couldn't process your request please try again later :(</h3>
        </Modal>
        <div v-if="!loading">
            <div class="post--description">
                <img v-if="post.image" width="400px" height="100%" :src="post.image" alt="test">
                <p v-if="post">{{ post.excerpt }}</p>
                <div class="post--description__footer">
                    <p> posted {{ post.created_at | fromNow }} {{'by @' + this.getUsername(post.user.email) }}</p>
                </div>
            </div>
            <div v-if="loadingComments">
                <loading-container/>
            </div>
            <div v-else>
                <div class="post--comments" ref="commentsContainer" id="commentsContainer">
                    <h2>Comments ({{ post.comments.length }})</h2>
                    <CommentItem
                        id="comments"
                        @deleteComment="handleDeleteItem"
                        @editComment="handleEditItem"
                        v-for="(comment, index) in comments.slice(0, commentsSize)"
                        :comment="comment" :key="index+'comment'" />
                    <div v-if="comments.length > 9 && commentsSize < comments.length" class="post--comments__pagination">
                        <p></p>
                        <p>{{ `${commentsSize} of ${comments.length}` }}</p>
                        <p @click="commentsSize < comments.length ? commentsSize += 5 : ''">load more</p>
                    </div>
                    <TweetComment
                        @create="handleCreate"
                        @closeModal="handleCloseModal"
                        :update="commentToUpdate ? 1 : 0"
                        :title="'comment'">
                        <div>
                            <div>
                                <label>Enter your comment</label>
                                <textarea
                                    v-model="comment"
                                    style="border: 1px solid #000; width: 100%; margin-top: .5rem"
                                    rows="10"
                                    :class="[{'is-invalid': errorFor('content')}]"></textarea>
                                <v-error :errors="errorFor('content')" />
                                <button @click="saveClickHandler" v-show="commentToUpdate" class="btn-secondary" style=" margin-top: .5rem; width: 100%">Save</button>
                            </div>
                        </div>
                    </TweetComment>
                </div>
            </div>
        </div>
        <LoadingContainer v-else/>
    </div>
</template>

<script>
import LoadingContainer from "../../components/Shared/LoadingContainer";
import CommentItem from "../../components/UI/CommentItem";
import validationErrors from "../../components/Shared/mixins/validationErrors";
import Modal from "../../components/Shared/Modal";
import TweetComment from "../../components/Shared/TweetComment";

export default {
    name: "Post",
    mixins: [validationErrors],
    components: {TweetComment, Modal, CommentItem, LoadingContainer},
    data() {
        return {
            post: null,
            comments: null,
            loading: false,
            errors: {},
            comment: '',
            loadingComments: false,
            errorLoadingComments: false,
            commentsSize: 10,
            show: false,
            commentToUpdate: null,
        }
    },
    created() {
        this.loading = true;
        this.errors = {};
        axios.get(`/api/posts/${this.$route.params.id}`)
        .then(response => {
            this.post = response.data;
            this.loadComments();
        })
        .catch(error => this.errors = error.response && error.response.data.errors)
        .then(() => this.loading = false);
    },
    mounted() {
        if(this.$router.currentRoute['hash']){ 	Vue.use(VueScrollTo); 	VueScrollTo.scrollTo(this.$router.currentRoute['hash'], 500); 	}
    },
    methods: {
        handleCloseModal() {
            this.loading = false;
            this.errors = {};
            this.comment = '';
            this.show = false;
            this.commentToUpdate = null;
            const closeBtn = document.getElementById('closeModal');
            if (closeBtn) {
                closeBtn.click();
            }
        },
        async handleCreate() {
            this.errors = {};
           if (this.comment.length > 5) {
               try {
                   const comment = (await axios.post('/api/comments', {
                       post_id: this.post.id,
                       user_id: this.$store.state.currentUser.user.id,
                       content: this.comment
                   })).data.comment;
                   this.updateComments(comment, 'created');
               } catch (error) {
                   this.errors = error.response && error.response.data.errors;
               }
           } else {
               this.errors.content = ["The content must be at least 5 characters."]
           }
        },
        async handleDeleteItem(id) {

           try {
               const response = (await axios.delete(`/api/comments/${id}`, {
                   userId: this.$store.getters["currentUser/user"].id
               }));
               if (Number.parseInt(response.status) === 204) {
                   this.updateComments(id, 'deleted')
               }
           } catch (error) {
               console.log(id)
                this.show = true;
           }
        },
        async saveClickHandler() {
          try {
              const response = await axios.put(`/api/comments/${this.commentToUpdate.id}`, {
                  content: this.comment,
              });
              if (response.status === 204) {
                  this.updateComments(this.commentToUpdate.id, 'edited')
              } else {
                  this.show = true;
              }
          }  catch (error) {
              if (error.response.status === 422) {
                  this.errors = error.response.data.errors;
              }
              this.errorLoadingComments = true;
          }
        },
        handleEditItem(id) {
            this.commentToUpdate = this.comments[this.comments.findIndex(comment => comment.id === id)];
            document.getElementById('commentModal').click();
            this.comment = this.commentToUpdate.content;
        },

        updateComments(comment, action) {
            if (action === 'edited') {
                this.comments[this.comments.findIndex(comment => comment.id === this.commentToUpdate.id)].content = this.comment;
            }

            if (action === 'deleted') {
                this.comments.splice(this.comments.findIndex(element => element.id === comment),1);
            }

            if (action === 'created') {
                this.comments.push(comment);
                this.commentsSize = this.comments.length;
                this.scrollToBottom();
            }

            this.handleCloseModal();
        },
        async loadComments() {
            this.loadingComments = true;
            this.errorLoadingComments = false;
            try {
                this.comments = (await axios.get(`/api/posts/${this.post.id}/comments`)).data.comments;
                this.loadingComments = false;
            } catch (error) {
                this.errorLoadingComments = true;
            }
        },
        scrollToBottom() {
            document.querySelector('.content .post').scrollIntoView(false);
        }
    }
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
