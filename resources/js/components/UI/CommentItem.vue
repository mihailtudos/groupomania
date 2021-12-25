<template>
    <div class="comment shadow-primary">
        <div class="comment--avatar">
            <div class="comment--avatar__img">
                <img width="60px" height="60px" src="/images/post-default.webp" alt="test">
            </div>
        </div>
        <div class="comment--content">
            <p class="comment--content__username">{{ 'Alexander MacQueen' }}</p>
            <p class="comment--content__date">{{ comment.created_at | fromNow }}</p>
            <p class="comment--content__content">{{ comment.content }}</p>
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
    }
}
</script>

<style scoped lang="scss">
.comment {
    padding: 1rem;
    border-radius: 1rem;
    display: flex;
    gap: 1rem;
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
    }
}
</style>
