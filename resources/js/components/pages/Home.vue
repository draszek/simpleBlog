<template>
    <div>
        <div class="row justify-content-center buttons">
            <div class="col-md-8">
                <button type="submit" v-on:click="addPost" class="btn btn-primary"><i class="fa fa-plus"/> Post</button>
            </div>
        </div>
        <post v-bind:key="post.id" v-bind:posts="posts" v-bind:post="post" v-for="post in posts"></post>
        <paginate
            v-model="currentPage"
            :page-count="pages"
            :click-handler="getPosts"
            :prev-text="'Prev'"
            :next-text="'Next'"
            :container-class="'pagination'"
            :page-class="'page-item'"
            :page-link-class="'page-link'"
            :prev-class="'page-item'"
            :prev-link-class="'page-link'"
            :next-class="'page-item'"
            :next-link-class="'page-link'"
        >
        </paginate>
    </div>
</template>

<script>
    import Post from "../layout/Post";
    import Paginate from 'vuejs-paginate'
    export default {
        name: "Home",
        components: {Post, Paginate},
        data() {
            return {
                posts: [],
                currentPage: 1,
                numberOfPosts: 10,
                pages: 1
            };
        },
        methods: {
            addPost() {
                this.$router.push({ name: 'createPost'})
            },
            getPosts(page) {
                this.currentPage = parseInt(page);
                axios.get('/api/posts?page=' + page).then((response => {
                    this.posts = response.data.data;
                    this.pages = parseInt(response.data.count / 10);
                    if(response.data.count % 10 !== 0) {
                        this.pages++;
                    }
                }));
            }
        },
        mounted() {
            let page = this.$route.params.page ?? 1;
            this.getPosts(page);
        },
    };
</script>

<style scoped>
    .buttons {
        margin-bottom: 20px;
    }

    .pagination {
       justify-content: center;
    }
</style>
