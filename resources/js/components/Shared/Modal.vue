<template>
    <div>
        <transition name="fade" appear>
            <div v-if="$parent.show" class="modal-overlay">
                <transition name="slide" appear>
                    <div class="modal">
                        <p class="modal--title">{{ title }}</p>
                        <slot class="model--content"></slot>
                        <div class="modal--controls">
                            <button v-show="!noCreate" class="btn-primary" @click="createHandler">Create</button>
                            <button id="closeModal" class="btn-primary" @click="hideModal">Close</button>
                        </div>
                    </div>
                </transition>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name: "Modal",
    props: ['title', 'video', 'modalHandler', 'noCreate'],
    methods: {
        hideModal() {
            this.$emit('closeModal');
        },
        createHandler() {
            this.$emit('create');
        }
    },
    mounted() {
        document.body.style.overflow = 'hidden';
        const iframe = document.getElementById('video-modal');
    },
    destroyed() {
        document.body.style.overflow = 'scroll';
    }
}
</script>

<style scoped lang="scss">
.modal-overlay {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    max-height: 100vh;
    background-color: rgba(0,0,0, 0.3);
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}
.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.modal {
    box-sizing: border-box;
    z-index: 101;
    position: relative;
    width: 100%;
    max-width: 600px;
    background-color: #fff;
    border-radius: 30px;
    padding: 25px;
    transition: all .6s ease-in;
    &--title {
        color: #222;
        font-size: 32px;
        font-weight: 900;
        margin-bottom: 15px;
    }
    &--content {
        color: #666;
        font-size: 18px;
        font-weight: 400;
        margin-bottom: 15px;
    }
    &--controls {
        display: flex;
        gap: .5rem;
        padding-top: 1rem;
        justify-content: flex-end;
        align-items: center;
    }
}

.slide-enter-active,
.slide-leave-active {
    transition: transform 1s;
}
.slide-enter,
.slide-leave-to {
    opacity: 1;
}
@media (max-width: 650px) {
    .modal {
        width: 90%;
        &--video {
            width: 100%;
            height: 300px;
        }
    }
}
</style>
