<template>
    <div>
        <header-nav-bar></header-nav-bar>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import HeaderNavBar from './layout/HeaderNavBar';

    export default {
        name: "App",
        components: {
            HeaderNavBar
        }
    };
</script>

<style scoped>
    .container {
        margin-top: 80px;
    }
</style>
