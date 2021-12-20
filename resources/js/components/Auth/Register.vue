<template>
    <div id="register">
        <div class="register">
            <form @submit.prevent="handleRegistration">
                <div class="form-group">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                    <input id="name"
                           v-model="formData.name"
                           type="text"
                           class="form-control"
                           name="name"
                           autocomplete="name"
                           :class="[{'is-invalid': errorFor('name')}]"
                           autofocus
                           required>
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
                           autofocus
                           required>
                    <v-error :errors="errorFor('email')" />
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
                        required
                        autocomplete>
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
                <div class="register--button">
                    <button style="width: 100%"  type="submit" class="btn btn-primary">Register</button>
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
            errors: {},
            formData: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }
        }
    },
    methods: {
        async handleRegistration() {
            this.loading = true;
            this.errors = {};
            try {
                if (this.formData.name.length < 3) {
                    this.errors.name = [];
                    this.errors.name.push('Entered name is incorrect');
                } else if (!this.isEmailValid(this.formData.email)){
                    this.errors.email = [];
                    this.errors.email.push('Entered email has an incorrect format');
                } else if (!this.isPasswordValid(this.formData.password)) {
                    this.errors.password = [];
                    this.errors.password.push('Entered password is too short');
                } else if (this.formData.password !== this.formData.password_confirmation ) {
                    this.errors.password_confirmation = [];
                    this.errors.password_confirmation.push('Entered passwords do not match');
                } else {
                    const response = await axios.post("/register", this.formData);
                    console.log(response.status)
                    if (201 === response.status) {
                        logIn();
                        await this.$store.dispatch("currentUser/loadUser");
                        await this.$router.push({ name: "home" });
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
            color: #50b7f5;
            font-weight: bold;
        }
    }
}
</style>
