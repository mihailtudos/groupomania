<template>
    <div class="post">
        <div class="post-container">
            <div class="post--header">
                <div class="post--header__author">
                    <h2>{{ item.user.name }} <span>@somethgoth</span></h2>
                </div>
                <div class="post__header--description">
                    <p v-if=" item.excerpt.length <= 100">{{ item.excerpt }}</p>
                    <p  v-else>{{ item.excerpt.slice(0, 100) + '...' }} <router-link :to="{name: 'post', params: {id: this.item.id, post: this.item }}" style="color: #50b7f5;">read more</router-link></p>
                </div>
            </div>
            <div class="post__body">
                <div class="post__body--media">
                    <img width="400px" height="100%" src="/images/post-default.webp" alt="test">
                </div>
                <div class="post__footer">
                    <Like @like="handleLikeEvent" :can-like="canLike(user.id)" :likes="item.likes.length" />
                    <Dislike @dislike="handleDislikeEvent" :can-dislike="canDislike(user.id)" :dislikes="item.dislikes.length"/>
                    <router-link :to="{ name: 'post', params: {id: this.item.id, post: this.item, hash: '#comments' } }" class="post__footer--item">
                        <span class="material-icons">comment </span> <span>{{ item.comments.length }}</span>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Like from "../UI/Like";
import Dislike from "../UI/Dislike";
import {mapGetters} from "vuex";
export default {
    name: "Post",
    components: {Dislike, Like},
    data() {
      return {
          ableToLike: true,
          ableToDislike: true,
      }
    },
    props: {
        item: {
            type: Object,
            required: true
        }
    },
    computed: {
        ...mapGetters({
            user: 'currentUser/user'
        }),
    },
    methods: {
        canLike(id) {
            if  (id) {
                return this.item.likes.find(item => item === id) === undefined;
            }
        },
        canDislike(id) {
            if  (id) {
                return this.item.dislikes.find(item => item === id) === undefined;
            }
        },
        handleLikeEvent(canLike) {
            if (canLike) {
                this.removeFromArray(this.item.dislikes, this.user.id);
                this.item.likes.push(this.user.id);
            } else {
                this.removeFromArray(this.item.likes, this.user.id);
            }
            this.updatePostLikes();
        },
        handleDislikeEvent(canDislike) {
           if (canDislike) {
               this.removeFromArray(this.item.likes, this.user.id);
               this.item.dislikes.push(this.user.id);
           } else {
               this.removeFromArray(this.item.dislikes, this.user.id);
           }
           this.updatePostLikes();
        },
        removeFromArray(array, value) {
            const userIdIndex = array.indexOf(value);
            if (userIdIndex > -1) {
                array.splice(userIdIndex, 1);
            }
        },
        async updatePostLikes() {
            await axios.post(`/api/${this.item.id}/likes`, {
                likes: this.item.likes,
                dislikes: this.item.dislikes
            })
        }
    }
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;
/* post styling */
.post {
    width: 100%;
    display: flex;
    padding: 1rem;
    align-items: baseline;
    flex-direction: column;
    margin: auto;
    border-bottom: 2px solid $twitter-background;
    &-container {
        max-width: 400px;
        margin: auto;
    }
    &:hover {
        background-color: $twitter-background;
    }
    &--header {
        &__author {
            font-weight: 600;
            font-size: .8rem;
            color: gray;
            h2 {
                font-size: 1.3rem;

                span {
                    font-size: .7rem;
                    color: #50B7F5FF;
                }
            }
        }
        &--description {
            margin-bottom: 5px;
            font-size: 12px;
        }
    }
   &__body {
       &--media {
           width: 100%;
           img {
               height: 100%;
               width: 400px;
               border-radius: 20px;
               object-fit: contain;
           }
       }
   }
    &__footer {
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        &--item {
            cursor: pointer;
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: .3rem;
            font-size: .8rem;
            &:hover {
                color: #50B7F5FF;
            }
        }
    }
}

@media (max-width: 400px) {
    .post {
        &__body {
            &--media {
                width: 100%;
                img {
                    height: 100%;
                    width: 100%;
                    border-radius: 20px;
                    object-fit: contain;
                }
            }
        }
        &__footer {
            padding: 1rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
    }
}
</style>
