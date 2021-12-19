<template>
    <div id="register">
        <div class="register">
            <form @submit.prevent="handleLogin">
                <div class="form-group">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                    <input id="name"
                           v-model="formData.name"
                           type="text"
                           class="form-control"
                           name="name"
                           autocomplete="name"
                           :class="[{'is-invalid': errorFor('name')}]"
                           autofocus>
                    <v-error :errors="errorFor('name')" />
                </div>
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
                <div class="form-group">
                    <label for="confirm_password" class="col-md-4 col-form-label text-md-right"> Re-type password </label>
                    <input
                        id="confirm_password"
                        v-model="formData.confirm_password"
                        type="password"
                        class="form-control"
                        :class="[{'is-invalid': errorFor('confirm_password')}]"
                        name="confirm_password" >
                    <v-error :errors="errorFor('confirm_password')" />
                </div>
                <div class="register--button">
                    <button style="width: 100%"  type="submit" class="btn btn-primary" >Login</button>
                </div>
                <hr />
                <div>
                    Already registered?
                    <router-link :to="{name: 'login'}" class="register--footer">login</router-link>
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
    name: "Register",
    data() {
        return {
            loading: false,
            formData: {
                email: '',
                password: '',
                confirm_password: '',
                name: ''
            }
        }
    },
    methods: {
        async handleLogin() {
            this.loading = true;
            this.errors = null;

            try {
                await axios.get("/sanctum/csrf-cookie");
                await axios.post("/login", this.formData);
                logIn();
                // await this.$store.commit('currentUser/setUser', user);
                await this.$store.dispatch("currentUser/loadUser");
                await this.$router.push({ name: "home" });
            } catch (error) {
                this.errors = error.response && error.response.data.errors;
            }
            this.loading = false;

            // if (!this.isEmailValid(this.formData.email)) {
            //     this.formData.errors.email.push('Entered email has an incorrect format');
            // } else {
            //     this.formData.errors.email = () => [];
            //     if (this.isPasswordValid(this.formData.password)) {
            //         this.formData.errors.password = () => [];
            //
            //     } else {
            //         this.formData.errors.password.push('Password must be at least 6 characters');
            //     }
            // }
        },
    },
}
</script>

<style scoped lang="scss">
#register {
    display: flex;
    margin-top: 5rem;
    justify-content: center;
    .register {
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
                    width: 100%;
                    padding: .5rem .2rem;
                    border: 2px solid #1a202c;
                    font-size: 1rem;
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
            color: #50b7f5;
            font-weight: bold;
        }
    }
}
</style>
