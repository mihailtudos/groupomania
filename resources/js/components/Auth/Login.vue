<template>
    <div id="login">
        <div class="login">

        </div>
    </div>
</template>

<script>
export default {
    name: "Login",

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
    }
}
</style>
