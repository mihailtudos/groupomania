<template>
    <div class="item" :class="canDislike ? '' : 'disliked'" @click="handleDislikeClick">
        <span class="material-icons">thumb_down</span>
        <span>{{ dislikes }}</span>
    </div>
</template>

<script>
export default {
    name: "Dislike",
    props: {
        dislikes: {
            type: Number,
            required: true
        },
        canDislike: {
            required: true
        }
    },
    methods: {
        handleDislikeClick() {
            this.$emit('dislike', this.canDislike);
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
    &.disliked {
        color: #50b7f5;
        &:hover {
            color: #1587b4;
        }
    }
}
</style>
