<template>
    <div class="tweet-box">
        <Modal @closeModal="handleCloseModal" :noCreate="1" title="Opps something went wrong">
            <h3>We couldn't process your request please try again later :(</h3>
        </Modal>
        <form @submit.prevent="submitForm">
            <div class="input--group">
                    <span class="material-icons">
                       <i class="fas fa-user-tie"></i>
                    </span>
                <div class="input--group__input">
                    <input :maxlength="max" name="excerpt" id="excerpt" v-model="dataForm.excerpt" type="text" placeholder="What's happening?">
                    <div v-if="imgUrl">
                        <p>Selected image:</p>
                        <img  :src="imgUrl" alt="Post image preview">
                    </div>
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
                <button class="tweet-button">{{ item ? 'Update' : 'Tweet' }}</button>
            </div>
        </form>
    </div>
</template>

<script>
import ImageFileBrowseIcon from "../UI/ImageFileBrowseIcon";
import validationErrors from "./mixins/validationErrors";
import Modal from "./Modal";
export default {
    name: "TweetBox",
    mixins: [validationErrors],
    components: {Modal, ImageFileBrowseIcon},
    data() {
        return {
            max: 160,
            loading: false,
            show: false,
            imgUrl: null,
            dataForm: {
                excerpt: '',
                image: ''
            }
        }
    },
    props: {
        item: {
            required: false,
            type: Object,
        }
    },
    methods: {
        submitForm: async function () {
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
                this.loading = true;
                let response = '';
                if (!this.item) {
                     response = (await axios.post(`/api/posts`, formData));
                } else  {
                    formData.append('_method', 'PATCH');
                    response = (await axios.post(`/api/posts/${this.item.id}`, formData));
                }
                if (response.status >= 200 && response.status <= 202) {
                    if (this.item) {
                        this.$emit('postUpdated', response.data);
                    } else  {
                        this.$emit('newPostCreated', response.data);
                    }
                    this.resetData();
                } else {
                    throw new Error('Something went wrong')
                }
                this.loading = false;
            } catch (error) {
                if (error.response.status === 422) {
                    this.errors = error.response && error.response.data.errors;
                } else {
                    this.show = true;
                }
                this.loading = false;
            }
        },
        handleCloseModal() {
          this.resetData();
        },
        resetData() {
            this.loading = false;
            this.show = false;
            this.dataForm = {
                excerpt: '',
                image: ''
            };
            this.errors = false;
        },
        imageUploadHandler(file) {
            this.imgUrl = URL.createObjectURL(file);
            URL.revokeObjectURL(file); // free memory
            this.dataForm.image = file;
        }
    },
    created() {
        if (this.item) {
            this.dataForm.excerpt = this.item.excerpt;
            this.imgUrl = this.item.image;
        }
    },
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
                p {
                    margin: 1rem 0;
                }
                img {
                    object-fit: contain;
                    max-width: 300px;
                    border-radius: 10px;
                }
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
