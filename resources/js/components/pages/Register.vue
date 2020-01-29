<template>
    <div>
        <form v-on:submit="login">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" required class="form-control" v-model="credentials.email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="name">Nickname</label>
                <input type="text" required class="form-control" v-model="credentials.name" id="name" aria-describedby="emailHelp" placeholder="Enter nickname">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input required v-model="credentials.password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="repeat-password">Repeat password</label>
                <input required v-model="credentials.password_confirmation" type="password" class="form-control" id="repeat-password" placeholder="Repeat password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Register",
        data() {
            return {
                credentials: {
                    email: '',
                    name: '',
                    password: '',
                    password_confirmation: ''
                }
            }
        },
        methods: {
            login(e) {
                e.preventDefault();
                this.$store.dispatch('register', this.credentials);
            },
        },
    };
</script>

<style scoped>

</style>
