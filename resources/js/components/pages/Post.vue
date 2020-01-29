<template>
    <div v-if="post">
        <h1>{{post.title}}</h1>
        <div v-html="post.content"></div>
    </div>
</template>

<script>
    import Post from "../layout/Post";

    export default {
        name: "Home",
        components: {Post},
        data() {
            return {
                post: {}
            };
        },
        mounted() {
            axios.get('/api/posts/' + this.$route.params.id).then((response => {
                this.post = response.data.data;
            }));
        },
    };
</script>

<style scoped>

</style>
