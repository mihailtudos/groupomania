<template>
    <form method="POST" @submit.prevent="handleLogin">
        <div class="form-group">
            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
            <input id="email"
                   v-model="formData.email"
                   type="email"
                   class="form-control"
                   name="email"
                   required
                   autocomplete="email"
                   autofocus>
            <div class="is-invalid">
                <span v-show="formData.errors.email.length">
                    {{ formData.errors.email[0] }}
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-md-4 col-form-label text-md-right"> Password </label>
            <input id="password" v-model="formData.password" type="password" class="form-control" name="password" required>
            <div class="is-invalid">
                <span v-show="formData.errors.password.length">
                    {{ formData.errors.password[0] }}
                </span>
            </div>
        </div>
        <div class="login--button">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</template>

<script>
import {logIn} from "../Shared/util/auth";

export default {
    name: "LoginForm",
    data() {
        return {
            formData: {
                email: '',
                password: '',
                errors: {
                    email: [],
                    password: []
                }
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
                console.log('hit')
                window.location.href('/');
                window.location.go();
            } catch (error) {
                this.errors = error.response && error.response.data.errors;
            }
            this.loading = false;
        },
    },
}
</script>

<style scoped lang="scss">
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
            font-size: 1rem;
        }
        .is-invalid {
            height: 10px;
            font-size: .8rem;
            color: red;
            font-weight: bold;
        }
    }
    button {
        width: 100px;
    }
}
.login--button {
    display: flex;
    justify-content: flex-end;
}
input {
    border: 2px solid #1a202c;
}
</style>
