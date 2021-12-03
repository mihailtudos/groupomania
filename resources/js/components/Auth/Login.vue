<template>
    <div id="login">
        <div class="login">
            <form method="POST" @submit.prevent="handleLogin">
                <div class="form-group">
                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Addres</label>
                    <div class="col-md-6">
                        <input id="email" v-model="formData.email"  type="email" class="form-control" name="email" required autocomplete="email" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-4 col-form-label text-md-right"> Password </label>

                    <div class="col-md-6">
                        <input id="password" v-model="formData.password" type="password" class="form-control" name="password" required>
                    </div>
                </div>
                <div class="login--button">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
      return {
          formData: {
              email: '',
              password: ''
          }
      }
    },
    methods: {
        handleLogin() {
            //obtain csrf cookie
            axios.get('/sanctum/csrf-cookie')
            .then((response) => {
                axios.post('/api/login', this.formData)
                .then((response) => {
                    console.log(response)
                })
            })
        }
    }
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
                margin-top: 1rem;
                display: flex;
                flex-direction: column;
                gap: .3rem;
                input {
                    width: 100%;
                    padding: .5rem .2rem;
                    font-size: 1rem;
                }
            }
            button {
                margin-top: 1rem;
                width: 100px;
            }
        }
        &--button {
            display: flex;
            justify-content: flex-end;
        }
    }
}
    input {
        border: 2px solid #1a202c;
    }
</style>
