<template>
   <div v-if="!loading">
       <div id="profile">
           <Modal v-if="success" @closeModal="handleCloseModal" :noCreate="1" :title="'Success'">
               <p>Password updated successfully!</p>
           </Modal>
           <Modal v-if="!success" @closeModal="handleCloseModal" :noCreate="1" :title="'Fail'">
               <p>Something went wrong, please try again later!</p>
           </Modal>
           <div class="profile">
               <div class="profile--header">
                   <h1>Welcome to your profile <br><span>{{this.$store.getters["currentUser/user"].name}}</span></h1>
               </div>
               <div class="profile--body">
                   <div class="profile--body__controls">
                       <ul>
                           <li aria-label="account" @click="handleTabClick('account')" class="active">account</li>
                           <li aria-label="channel" @click="handleTabClick('channel')">channels</li>
                       </ul>
                   </div>
                   <div class="profile--body__option active" id="account">
                       <h2>Update password</h2>
                       <div class="form-group">
                           <label for="current_password" class="col-md-4 col-form-label text-md-right"> Current password </label>
                           <input
                               id="current_password"
                               v-model="formData.current_password"
                               type="password"
                               class="form-control"
                               :class="[{'is-invalid': errorFor('current_password')}]"
                               name="current_password"
                               required>
                           <v-error :errors="errorFor('current_password')" />
                       </div>
                       <div class="form-group">
                           <label for="password" class="col-md-4 col-form-label text-md-right"> Password </label>
                           <input
                               id="password"
                               v-model="formData.password"
                               type="password"
                               class="form-control"
                               :class="[{'is-invalid': errorFor('password')}]"
                               name="password"
                               required>
                           <v-error :errors="errorFor('password')" />
                       </div>
                       <div class="form-group">
                           <label for="password_confirmation" class="col-md-4 col-form-label text-md-right"> Re-type password </label>
                           <input
                               id="password_confirmation"
                               v-model="formData.password_confirmation"
                               type="password"
                               class="form-control"
                               :class="[{'is-invalid': errorFor('password_confirmation')}]"
                               name="password_confirmation"
                               required>
                           <v-error :errors="errorFor('password_confirmation')" />
                           <v-error :errors="errorFor('passwords')" />
                       </div>
                       <div style="display: flex; justify-content: flex-end;">
                           <button  @click="updatePassword" class="btn-secondary">update</button>
                       </div>
                   </div>
                   <div class="profile--body__option" id="channel">
                       <h2>Channels followed</h2>
                       <p>Currently you are subscribed to the following channels:</p>
                       <br>
                       <ul>
                           <li><strong>@public</strong> - a channel that managers uses to share news, announcements and important information</li>
                           <li><strong>@{{profile}}</strong> - this is the main channel used by your department to share news, information and discussions</li>
                       </ul>
                       <div style="display: flex; justify-content: flex-end;">
                           <button class="btn-secondary">update</button>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
    <div v-else>
        <LoadingContainer />
    </div>
</template>

<script>
import validationErrors from "../../components/Shared/mixins/validationErrors";
import Modal from "../../components/Shared/Modal";
import LoadingContainer from "../../components/Shared/LoadingContainer";
export default {
    name: "Profile",
    components: {LoadingContainer, Modal},
    mixins: [validationErrors],
    data() {
        return {
            loading: false,
            show: false,
            success: false,
            profile: '',
            formData: {
                password: '',
                password_confirmation: '',
                current_password: ''
            }
        }
    },
    methods: {
        handleCloseModal() {
            this.formData = {
                password: '',
                password_confirmation: '',
                current_password: ''
            }
            this.show = false;
        },
        handleTabClick(id) {
            const options = document.querySelectorAll('.profile--body__option');
            const tabs = document.querySelectorAll('.profile--body__controls li');
            options.forEach(option => {
              option.classList.remove('active');
              if (option.id === id) {
                  option.classList.add('active');
              }
            });
            tabs.forEach(tab => {
               tab.classList.remove('active');
                if (tab['ariaLabel'] === id) {
                    tab.classList.add('active');
                }
            });
        },
        async updatePassword() {
            this.loading = true;
            this.errors = null;
            if (this.formData.current_password.length >= 6 && this.formData.password.length >= 6 && this.formData.password_confirmation === this.formData.password && this.formData.password === this.formData.current_password) {
                try {
                    const response = (await axios.post('/api/users/password', {
                        current_password: this.formData.current_password,
                        password: this.formData.password,
                        password_confirmation: this.formData.password_confirmation
                    }));
                    this.loading = false;
                    if (response.status === 204) {
                        this.show = true;
                        this.success = true;
                    } else {
                        throw new Error('Something went wrong');
                    }
                } catch (error) {
                    this.success = false;
                    this.show = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.errors;
                    }
                }
            } else {
                this.loading = false;
                this.errors = {
                    passwords:  ['Entered passwords don\'t match']
                };
            }
        }
    },
    async created() {
        this.loading = true;
        try {
            this.profile = (await axios.post('/api/profiles/', {
                userId: this.$route.params.id
            })).data;
            console.log(this.profile);
        } catch (error) {

        }
        this.loading = false;
    }
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;
    #profile {
        margin: 2rem 0;
        display: flex;
        gap: 2rem;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        .profile {
            width: 100%;
            &--header {
                h1 {
                    font-size: 1.3rem;
                    width: 100%;
                    text-align: center;
                    margin: auto;
                    span {
                        color: $twitter-color;
                    }
                }
            }
            &--body {
                width: 100%;
                margin: 2rem auto;
                display: flex;
                gap: 1rem;
                padding: .5rem;
                &__controls {
                    flex: 1;
                    ul {
                        margin: 0;
                        padding: 0;
                        list-style: none;
                        li {
                            font-weight: bold;
                            cursor: pointer;
                            padding: 0.5rem 2rem 0.5rem  0.5rem;
                            margin: .5rem;
                            letter-spacing: 1px;
                            &:hover {
                                border-bottom:2px solid $twitter-color;
                            }
                            &.active {
                                border-bottom:2px solid $twitter-color;
                                background: $twitter-color;
                            }
                        }
                    }
                }
                &__option {
                    flex: 3;
                    display: none;
                    &.active {
                        display: block;
                    }
                    .form-group {
                            margin-bottom: .3rem;
                            display: flex;
                            flex-direction: column;
                            gap: .3rem;
                            input {
                                width: 100%;
                                padding: .5rem .2rem;
                                border: 2px solid #1a202c;
                                font-size: 1rem;
                                border-radius: 5px;
                                &.is-invalid {
                                    border-color: red;
                                }
                            }
                        }
                    ul {
                        margin: 0;
                        padding: 0;
                        list-style: none;
                        li {
                            strong {
                                color: $twitter-color;
                            }
                            margin-bottom: .5rem;
                        }
                    }
                }
            }
        }
    }

@media (max-width: 750px) {
    #profile {
        .profile {
            &--body {
                flex-direction: column;
                &__controls {
                   ul {
                       li {
                           margin: 0 0 0.5rem 0;
                       }
                   }
                }
            }
        }
    }
}
@media (max-width: 450px) {
    #profile {
        .profile {
            &--body {
                &__option {
                    flex-direction: column;
                }
            }
        }
    }
}
</style>
