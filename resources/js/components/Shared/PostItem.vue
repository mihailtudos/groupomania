<template>
    <div class="post">
        <div class="post-container">
            <div class="post--header">
                <div class="post--header__author">
                    <h2>Somanth Coutne <span>@somethgoth</span></h2>
                </div>
                <div class="post__header--description">
                    <p>{{ item.excerpt }}</p>
                </div>
            </div>
            <div class="post__body">
                <div class="post__body--media">
                    <img width="400px" height="100%" src="/images/post-default.webp" alt="test">
                </div>
                <div class="post__footer">
                    <span class="material-icons"><i class="fas fa-retweet"></i></span>
                    <span class="material-icons"><i class="far fa-heart"></i></span>
                    <span class="material-icons"><i class="fas fa-upload"></i></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Post",
    props: {
        item: {
            type: Object,
            required: true
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
        justify-content: center;
        gap: 1rem;
    }
}
</style>
