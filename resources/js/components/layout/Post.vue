<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{post.title}}
                    <span class="float-right">
                        <span v-on:click="edit" class="fa fa-edit"></span>
                        <span v-on:click="remove" class="fa fa-trash"></span>
                    </span>
                </div>
                <div class="card-body">
                    {{post.description}}
                    <div>
                        <router-link :to="{ name: 'post', params: {id: post.id}}">
                            Read more...
                        </router-link>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Post",
        props: ['post', 'posts'],
        methods: {
            remove() {
                if (confirm("Do you really want to delete?")) {
                    axios.delete('/api/posts/' + this.post.id)
                        .then(response => {
                            let index = this.posts.findIndex(e => e.id === this.post.id);
                            console.log(index);
                            this.posts.splice(index, 1);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            },
            edit() {
                this.$router.push({ name: 'editPost', params: {id: this.post.id}});
            }
        }
    };
</script>

<style scoped>
    .row {
        margin-bottom: 20px;
    }

</style>
