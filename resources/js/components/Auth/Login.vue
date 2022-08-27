<template>
    <div class="wrapper">
            <div class="login-form">
        <h1>Login</h1>
        <form action="#" @submit.prevent="handleLogin">
            <div class="form-row">
                <input type="email" name="email" v-model="formData.email" class="form-control" placeholder="email" />
            </div>
            <div class="form-row">
                <input type="password" name="passowrd" v-model="formData.password" class="form-control"
                    placeholder="password" />
            </div>
            <div class="form-row">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
        </form>
    </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            formData: {
                email: "",
                password: ""
            }
        };
    },
    methods: {
        handleLogin() {
            axios.post('api/login', this.formData)
                .then(response => {
                    const { user, token } = response.data;
                    axios.defaults.headers.common["Authorization"] = "Bearer " + token;
                    localStorage.setItem('user', JSON.stringify({ user, token }));
                    this.$store.dispatch("authState/setUser", { user, token });
                    this.$router.push('/');
                }).catch(error => {
                    alert(error);
                })
        },
    },
};
</script>
<style scoped lang="scss">
.wrapper {
    height: 95vh;
    background-color: #F7ECDE;

    .login-form {
        margin: auto;
        width: 30%;

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            justify-self: center;
            align-items: center;
        }
    }

    .form-row {
        margin-bottom: 8px;
    }
}
</style>
