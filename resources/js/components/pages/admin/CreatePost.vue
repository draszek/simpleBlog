<template>
    <div>
        <form v-on:submit="create">
            <div class="form-group">
                <label for="title">title</label>
                <input type="text" required class="form-control" v-model="post.title" id="title"
                       placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="description">Content:</label>
                <input type="text" required class="form-control" v-model="post.description" id="description"
                       placeholder="Enter description">
            </div>
            <div class="form-group">
                <label>description:</label>
                <wysiwyg v-model="post.content"/>
            </div>
            <button type="submit" class="btn float-right btn-primary">Save</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "CreatePost",
        methods: {
            create(e) {
                e.preventDefault();
                if (this.$route.params.id === undefined) {
                    axios.post('/api/posts', this.post).then(response => {
                        this.$router.push({name: 'post', params: {id: response.data.data.id}});
                    });
                } else {
                    axios.put('/api/posts/' + this.$route.params.id, this.post).then(response =>{
                        this.$router.push({name: 'post', params: {id: this.$route.params.id}});
                    });
                }
            }
        },
        data() {
            return {
                post: {}
            }
        },
        mounted() {
            if (this.$route.params.id !== undefined) {
                axios.get('/api/posts/' + this.$route.params.id).then((response => {
                    this.post = response.data.data;
                }));
            }
        },
    };
</script>

<style scoped>

</style>
