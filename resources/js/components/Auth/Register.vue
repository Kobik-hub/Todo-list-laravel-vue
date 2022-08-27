<template>
    <div class="wrapper">
            <div class="register-form">
        <h1>Register</h1>
        <form action="#" @submit.prevent="handleRegister">
            <div class="form-row">
                <input type="name" name="name" v-model="formData.name" class="form-control" placeholder="name" />
            </div>
            <div class="form-row">
                <input type="email" name="email" v-model="formData.email" class="form-control" placeholder="email" />
            </div>
            <div class="form-row">
                <input type="password" name="password" v-model="formData.password" class="form-control"
                    placeholder="password" />
            </div>
            <div class="form-row">
                <input type="password" name="password_confirmation" v-model="formData.password_confirmation"
                    class="form-control" placeholder="password confirmation" />
            </div>
            <div class="form-row">
                <button type="submit" class="btn btn-primary">Register</button>
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
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            }
        };
    },
    methods: {
        handleRegister() {
            axios.post('api/register', this.formData)
                .then(response => {
                    const { user, token } = response.data;
                    localStorage.setItem('user', JSON.stringify({ user, token }));
                    this.$store.dispatch("authState/setUser", { user, token });
                    axios.defaults.headers.common["Authorization"] = "Bearer " + token;
                    this.$router.push('/');
                })
                .catch(error => {
                    alert(error);
                })
        },
    },
};
</script>
<style scoped lang="scss">
.wrapper{
        height: 95vh;
    background-color: #F7ECDE;
    .register-form {
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
