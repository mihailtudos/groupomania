<template>
    <div class="post">
        <div class="post__avatar">
                    <span class="material-icons">
                        <i class="fas fa-user-tie"></i>
                    </span>
        </div>
        <div class="post__body">
            <div class="post__header">
                <div class="post__header-text">
                    <h2>Somanth Coutne
                        <span class="post__header-special">
                            @somethgoth
                        </span>
                    </h2>
                </div>
                <div class="post__header-description">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, tempora!</p>
                </div>
            </div>
            <img src="https://images.unsplash.com/photo-1593642532842-98d0fd5ebc1a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80" alt="test">
            <div class="post__footer">
                <span class="material-icons"><i class="fas fa-retweet"></i></span>
                <span class="material-icons"><i class="far fa-heart"></i></span>
                <span class="material-icons"><i class="fas fa-upload"></i></span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Post"
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;
/* post styling */
.post {
    display: flex;
    align-items: flex-start;
    border-bottom: 1px solid $twitter-background;
    padding: 10px;
    &__avatar span {
        border-radius: 50%;
        height: 40px;
        font-size: 30px;
    }
    &:hover {
        background-color: $twitter-background;
        cursor: pointer;
    }
   &__body {
       img {
           max-width: 500px;
           border-radius: 20px;
           object-fit: contain;
       }
   }
    &__footer {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }
    &__header {
        padding: 10px;
        &-special {
            font-weight: 600;
            font-size: .8rem;
            color: gray;
        }
        &-text h2 {
            font-size: 1.5rem;
        }
        &-description {
            margin-bottom: 5px;
            font-size: 14px;
        }
    }
}
</style>
