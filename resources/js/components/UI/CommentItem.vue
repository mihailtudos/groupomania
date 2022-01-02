<template>
    <div class="comment shadow-primary">
        <div class="comment--avatar">
            <div class="comment--avatar__img">
                <img width="60px" height="60px" src="/images/post-default.webp" alt="test">
            </div>
        </div>
        <div class="comment--content">
            <p class="comment--content__username">{{ comment.user.name }}</p>
            <p class="comment--content__date">{{ comment.created_at | fromNow }}</p>
            <p class="comment--content__content">{{ comment.content }}</p>
            <div v-if="this.$store.getters['currentUser/user'].id === comment['user_id']" class="comment--content__controls">
                <span @click="handleDeleteClick(comment.id)" class="delete"><i class="fas fa-trash-alt"></i></span>
                <span @click="handleEditClick(comment.id)" class="edit"><i class="fas fa-pen-nib"></i></span>
            </div>
        </div>
    </div>
</template>

<script>
import Like from "./Like";
export default {
    name: "CommentItem",
    components: {Like},
    props: {
        comment: {
            type: Object,
            required: true
        }
    },
    methods: {
        handleDeleteClick(id) {
            this.$emit('deleteComment', id);
        },
        handleEditClick(id) {
            this.$emit('editComment', id);
        }
    }
}
</script>

<style scoped lang="scss">
.comment {
    padding: 1rem;
    border-radius: 1rem;
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    &--avatar {
        &__img {
            background: #4dc0b5;
            max-width: 30px;
            max-height: 30px;
            border-radius: 50%;
            img {
                object-fit: cover;
                max-width: 30px;
                max-height: 30px;
                border-radius: 50%;
            }
        }
    }
    &--content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        width: 100%;
        p {
            margin: 0;
            padding: 0;
        }
        &__username {
            font-weight: bold;
        }
        &__date {
            margin-bottom: 1rem!important;
            font-weight: 400;
            color: gray;
        }
        &__content {
            font-weight: 200;
            color: black;
        }
        &__controls {
            position: absolute;
            display: flex;
            justify-content: space-between;
            gap: .5rem;
            top: 0;
            right: 1rem;
            span {
                font-size: .8rem;
                cursor: pointer;
                &.edit {
                    color: #4dc0b5;
                }
                &.delete {
                    color: #bb1111;
                }
            }
        }
    }
}
</style>
