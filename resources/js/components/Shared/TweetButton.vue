<template>
    <div>
        <button class="sidebar__tweet btn-primary" @click="showModal">
            <i class="fas fa-feather-alt"></i> {{ title ? title : 'Tweet' }}
        </button>
        <Modal @closeModal="hideModal" @create="handleCreate" :title="'New tweet'">
           <slot></slot>
        </Modal>
    </div>
</template>

<script>
import Modal from "./Modal";
import TweetBox from "./TweetBox";
import TweetForm from "./TweetForm";
export default {
    name: "TweetButton",
    components: {TweetForm, TweetBox, Modal},
    data() {
        return {
            show: false,
        }
    },
    props: ['title'],
    methods: {
        hideModal() {
            this.show = false;
            this.$emit('closeModal');
        },
        showModal() {
            this.show = true;
        },
        handleCreate() {
            this.$emit('create');
        }
    }
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;

.sidebar__tweet {
    background-color: $twitter-color;
    width: 100%;
    border: none;
    color: white;
    font-weight: 900;
    border-radius: 30px;
    height: 50px;
    margin-top: 20px;
    cursor: pointer;
    font-size: 1rem;
}

</style>
