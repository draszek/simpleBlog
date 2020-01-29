<template>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <router-link class="navbar-brand" :to="{ name: 'home'}">Simple Blog ;-)</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse right navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto text-right">
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'home'}">Home</router-link>
                </li>
                <li v-if="getAccountType == 'administrator'" class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'users'}">Users</router-link>
                </li>
                <li class="nav-item">
                    <router-link v-if="!isLogged" class="nav-link" :to="{ name: 'login'}">Login</router-link>
                    <a v-else class="nav-link" @click="logout" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "HeaderNavBar",
        computed: mapGetters(['isLogged', 'getAccountType']),
        methods: {
            logout() {
                this.$store.dispatch('logout');
            }
        }
    };
</script>
