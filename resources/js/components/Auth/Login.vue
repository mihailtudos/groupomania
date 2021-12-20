<template>
    <div id="login">
        <div class="login">
            <form @submit.prevent="handleLogin">
                <div class="form-group">
                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                    <input id="email"
                           v-model="formData.email"
                           type="email"
                           class="form-control"
                           name="email"
                           autocomplete="email"
                           :class="[{'is-invalid': errorFor('email')}]"
                           autofocus>
                    <v-error :errors="errorFor('email')" />
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-4 col-form-label text-md-right"> Password </label>
                    <input
                        id="password"
                        v-model="formData.password"
                        type="password"
                        class="form-control"
                        autocomplete="email"
                        :class="[{'is-invalid': errorFor('password')}]"
                        name="password" >
                    <v-error :errors="errorFor('password')" />
                </div>
                <div class="login--button">
                    <button style="width: 100%" type="submit" class="btn btn-primary" >Login</button>
                </div>
                <hr />

               <div class="login--footer">
                   <div>
                       No account yet?
                       <router-link :to="{name: 'register'}" class="font-weight-bold">register</router-link>
                   </div>

                   <div>
                       Forgotten password?
                       <router-link :to="{name: 'home'}" class="font-weight-bold">reset password</router-link>
                   </div>
               </div>
            </form>
        </div>
    </div>
</template>

<script>
import validationErrors from "../Shared/mixins/validationErrors";
import {logIn} from "../Shared/util/auth";

export default {
    mixins: [validationErrors],
    name: "Login",
    data() {
        return {
            loading: false,
            errors: {},
            formData: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        async handleLogin() {
            this.loading = true;
            this.errors = {};
            try {
                if (!this.isEmailValid(this.formData.email)) {
                    this.errors.email = [];
                    this.errors.email.push('Entered email has an incorrect format');
                } else {
                    if (this.isPasswordValid(this.formData.password)) {
                        await axios.get("/sanctum/csrf-cookie");
                        await axios.post("/login", this.formData);
                        logIn();
                        await this.$store.dispatch("currentUser/loadUser");
                        await this.$router.push({ name: "home" });
                    } else {
                        this.errors.password = [];
                        this.errors.password.push('Password must be at least 6 characters');
                    }
                }
            } catch (error) {
                this.errors = error.response && error.response.data.errors;
            }
            this.loading = false;
        },
    },
}
</script>

<style scoped lang="scss">
#login {
    display: flex;
    margin-top: 5rem;
    justify-content: center;
    .login {
        width: 100%;
        max-width: 400px;
        form {
            width: 100%;
            .form-group {
                margin-bottom: .3rem;
                display: flex;
                flex-direction: column;
                gap: .3rem;
                input {
                    border: 2px solid #1a202c;
                    width: 100%;
                    padding: .5rem .2rem;
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
        &--button {
            display: flex;
            justify-content: flex-end;
        }
        &--footer {
            a {
                font-weight: bold;
                color: #50b7f5;
            }
        }
    }
}
</style>
