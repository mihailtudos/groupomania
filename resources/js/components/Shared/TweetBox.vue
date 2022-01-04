<template>
    <div class="tweet-box">
        <form @submit.prevent="submitForm">
            <div class="input--group">
                    <span class="material-icons">
                       <i class="fas fa-user-tie"></i>
                    </span>
                <div class="input--group__input">
                    <input :maxlength="max" name="excerpt" id="excerpt" v-model="dataForm.excerpt" type="text" placeholder="What's happening?">
                    <div class="details">
                        <span>
                            <v-error :errors="errorFor('excerpt')" />
                        </span>
                        <span>
                            {{ max - dataForm.excerpt.length }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="footer">
                <ImageFileBrowseIcon @imageUploaded="imageUploadHandler" :size="'20'"/>
                <button class="tweet-button">Tweet</button>
            </div>
        </form>
    </div>
</template>

<script>
import ImageFileBrowseIcon from "../UI/ImageFileBrowseIcon";
import validationErrors from "./mixins/validationErrors";
export default {
    name: "TweetBox",
    mixins: [validationErrors],
    components: {ImageFileBrowseIcon},
    data() {
        return {
            max: 160,
            dataForm: {
                excerpt: '',
                image: ''
            }
        }
    },
    methods: {
        async submitForm() {
            if (this.dataForm.excerpt.length < 15) {
                this.errors = {
                    excerpt: ['Tweet content must be at least 15 characters long']
                }
                return;
            }
            let formData = new FormData();
            if (this.dataForm.image) {
                formData.append("image", this.dataForm.image);
            }
            formData.append("excerpt", this.dataForm.excerpt);
            try {
                const response = (await axios.post(`/api/posts`, formData));
                console.log(response)
            } catch (error) {
                this.errors = error.response && error.response.data.errors;
            }
        },
        imageUploadHandler(file) {
            this.dataForm.image = file;
        }
    }
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;

.tweet-box {
    padding: 1rem;
    border-bottom: 8px solid $twitter-background;
    background-color: white;
    form {
        width: 100%;
        .input--group {
            width: 100%;
            display: flex;
            span.material-icons {
                border-radius: 50px;
                font-size: 60px;
            }
            input {
                width: 100%;
                font-size: 20px;
                border: none;
                outline: none;
            }
            &__input {
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                gap: .3rem;
                margin-left: 20px;
                .details {
                    display: flex;
                    justify-content: inherit;
                    align-items: center;
                    margin-bottom: .5rem;
                    font-size: .7rem;
                }
            }
        }
        .footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            button {
                background-color: $twitter-color;
                border: none;
                color: white;
                font-weight: 900;
                border-radius: 30px;
                width: 100px;
                height: 40px;
                cursor: pointer;
            }
        }
    }
}
</style>
