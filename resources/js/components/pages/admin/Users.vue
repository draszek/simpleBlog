<template>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Account type</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-bind:key="user.id" v-for="user in users">
            <th scope="row">{{user.id}}</th>
            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td>
                <select v-model="user.type" v-on:change="changeType(user)">
                    <option value="user">User</option>
                    <option value="redactor">Redactor</option>
                    <option value="administrator">Administrator</option>
                </select>
            </td>
            <td>
                <button v-on:click="remove(user.id)" class="fa fa-trash"></button>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: "Users",
        data() {
            return {
                users: []
            }
        },
        methods: {
            remove(id) {
                if (confirm("Do you really want to delete?")) {
                    axios.delete('/api/users/' + id).then(response => {
                        let index = this.users.findIndex(e => e.id === id);
                        this.users.splice(index, 1);
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
            changeType(user) {
                if (confirm("Do you really want to change type of user?")) {
                    console.log(user);
                    axios.put('/api/users/' + user.id, {type: user.type}).then(response => {
                        console.log(response);
                    }).catch(error => {
                        console.log(error);
                    });
                }
            }
        },
        mounted() {
            axios.get('/api/users').then((response) => {
                this.users = response.data.data;
            });
        }
    };
</script>

<style scoped>
    button {
        background: none;
        border: none;
        box-shadow: none;
    }
</style>
