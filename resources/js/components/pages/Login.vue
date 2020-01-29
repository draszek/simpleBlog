<template>
    <div>
        <form v-on:submit="login">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" required class="form-control" v-model="credentials.email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input required v-model="credentials.password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <router-link class="btn btn-primary" :to="{ name: 'register'}">Register</router-link>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                credentials: {
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            login(e) {
                e.preventDefault();
                this.$store.dispatch('login', this.credentials);
            },
        },
    };
</script>

<style scoped>

</style>
