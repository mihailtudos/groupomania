<template>
    <div id="profile">
       <div class="profile">
           <div class="profile--header">
               <h1>Welcome to your profile <br><span>{{this.$store.getters["currentUser/user"].name}}</span></h1>
           </div>
           <div class="profile--body">
               <div class="profile--body__option">
                   <p class="title">change password</p>
                   <div>
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
                       </div>
                   </div>
               </div>
               <div class="profile--body__option">

               </div>
           </div>
       </div>
    </div>
</template>

<script>
import validationErrors from "../../components/Shared/mixins/validationErrors";
export default {
    name: "Profile",
    mixins: [validationErrors],
    data() {
        return {
            formData: {
                password: null,
                password_confirmation: null,
                current_password: null
            }
        }
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
                max-width: 500px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-between;
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
                    button {
                        width: 100px;
                    }
            }
        }
    }
</style>
