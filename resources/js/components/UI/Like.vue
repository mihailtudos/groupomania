<template>
    <div class="item" :class="canLike ? '' : 'liked'" @click="handleLikeClick">
        <span class="material-icons">thumb_up</span>
        <span>{{ likes }}</span>
    </div>
</template>

<script>
export default {
    name: "Like",
    props: {
        likes: {
            type: Number,
            required: true
        },
        canLike: {
            required: true
        }
    },
    methods: {
        handleLikeClick() {
            this.$emit('like', this.canLike);
        }
    }
}
</script>

<style scoped lang="scss">
    .item {
        cursor: pointer;
        display: flex;
        align-items: baseline;
        justify-content: center;
        gap: .3rem;
        font-size: .8rem;
        &:hover {
            color: #50b7f5;
        }
        &.liked {
            color: #50b7f5;
            &:hover {
                color: #1587b4;
            }
        }
    }
</style>
