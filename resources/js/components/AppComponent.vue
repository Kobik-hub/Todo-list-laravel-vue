<template>
    <div>
        <Nav/>
        <router-view>
        </router-view>
    </div>

</template>

<script>
import { mapGetters } from 'vuex';
import Login from './Auth/Login.vue'
import Nav from './Nav.vue'
export default {
    mounted() {
        const user = JSON.parse(localStorage.getItem('user'));
        this.$store.dispatch("authState/setUser", user);
    },
    methods: {
    },
    computed: {
        ...mapGetters(['user']),
    },
    components: { Login, Nav }
}
</script>
