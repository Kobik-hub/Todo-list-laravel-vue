<template>
    <div class="wrapper">
        <router-link tag="h1" class="title link" to="/">Todo list</router-link>
        <router-link v-if="!loggedIn" class="register link" to="/register">Register</router-link>
        <router-link class="logout link" v-if="!loggedIn" to="/login">Log In</router-link>

        <router-link v-if="loggedIn" class="todo-list link" to="/">Todo list</router-link>
        <router-link v-if="loggedIn" class="deleted link" to="/deleted">Deleted</router-link>
        <router-link v-if="loggedIn" class="new link" to="/create">New Todo</router-link>
        <div @click="handleLogout" class="logout" v-if="loggedIn">Logout</div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
    computed: {
        ...mapGetters(['user']),
        loggedIn() {
            if(this.user === null) return false;
            return 'token' in this.user
        }
    },
    methods: {
        handleLogout() {
            localStorage.removeItem('user');
            this.$store.dispatch("authState/setUser", {});
            this.$router.push('/login');
            axios.post('api/logout').then(_);
        }
    }
}
</script>
<style scoped lang="scss">
.wrapper {
    padding: 20px;
    width: 100vw;
    height: 5vh;
    background: #9ED2C6;
    display: flex;
    align-items: center;
    justify-content: end;
    .link{
        text-decoration: none;
        color: black;
    }

    .logout {
        cursor: pointer;
    }

    .register,
    .deleted,
    .todo-list,
    .new {
        margin-right: 20px;
    }

    .title {
        margin-right: auto;
        cursor: pointer;
    }
}
</style>
