<template>
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row mt-5">
<!--            <div class="col-lg-12">-->
<!--                <div id="carouselExampleIndicators" class="carousel slide mb-5" data-ride="carousel">-->
<!--                    <ol class="carousel-indicators">-->
<!--                        <li data-target="#carouselExampleIndicators" v-for="(item, index) in images" :key="index" data-slide-to=":key" v-bind:class="[index==0 ? 'active' : '']"></li>-->
<!--                    </ol>-->
<!--                    <div class="carousel-inner" role="listbox">-->
<!--                        <div class="carousel-item" v-for="(item, index) in images" v-bind:class="[index==0 ? 'active' : '']">-->
<!--                            <img class="d-block img-fluid" height="300px" v-bind:src="/storage/ + item.photo" alt="">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">-->
<!--                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--                        <span class="sr-only">Previous</span>-->
<!--                    </a>-->
<!--                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">-->
<!--                        <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--                        <span class="sr-only">Next</span>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
            <div class="col-lg-3">
                <h1 class="">Viagens</h1>
                <div class="list-group">
                    <input v-model="search_post" placeholder="Pesquise..." class="list-group-item mb-1" v-on:input="getPost(search_post)">
                </div>
                <div class="list-group">
                    <a class="list-group-item selecionado" href="#" v-bind:class="[isActive==0 ? activeClass : '']" v-on:click="loadPosts">
                        Todos
                    </a>
                    <a class="list-group-item selecionado" href="#" v-bind:class="[isActive==category.id ? activeClass : '']" v-on:click="getCategory(category.id)" v-for="(category, index) in categories">
                        {{ category.title }}
                    </a>
                </div>
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-9">
                <div class="row justify-content-center">
                    <div :class="{'loading' : loading}">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4" v-for="post in posts">
                        <div class="card">
                            <img v-bind:src="/storage/ + post.photo" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ post.title }}</h5>
                                <p class="card-text">{{ post.description }}</p>
                                <a class="stretched-link" v-bind:href="/postagem/ + post.slug"></a>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-12 text-center my-5">
<!--                        <pagination v-if="isActive==0" class="col-12 justify-content-center" :data="laravelData" @pagination-change-page="loadPosts"></pagination>-->
<!--                        <infinite-loading @distance="1" @infinite="handleLoadMore"></infinite-loading>-->
                        <button v-if="loadmoreButton == true" class="btn btn-primary" v-on:click="handleLoadMore">Carregar Mais</button>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->
<!--        <div class="row">-->
<!--            <div class="col-12">-->
<!--                <div id="instafeed"></div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
    <!-- /.container -->
</template>
<script>
export default {
    name: "Front",
    data: function () {
        return {
            categories: [],
            images: [],
            posts: [],
            search_post: '',
            loading: true,
            page: 1,
            isActive: 0,
            activeClass: 'active',
            laravelData: {},
            last_page: 2,
            loadmoreButton: true
        }
    },
    // computed: {
    //     classObject: function () {
    //         return {
    //             active: this.isActive && !this.error,
    //             'text-danger': this.error && this.error.type === 'fatal'
    //         }
    //     }
    // },
    mounted() {
        this.loadCategories();
        this.loadPosts();
        this.loadSlides();
    },
    methods: {
        loadCategories: function () {
            //Carregar categorias
            axios.get('/api/categories')
            .then((response) => {
                this.categories = response.data.data
            })
            .catch(function (error){
                console.log(error)
            });
        },
        loadPosts: function (page = 1) {
            //Carregar postagens
            axios.get('/api/posts?page='+ page)
                .then((response) => {
                    this.isActive = 0
                    this.page = 2;
                    this.posts = response.data.data
                    this.laravelData = response.data
                    this.loading = false
                    this.loadmoreButton = true
                    //console.log(this.posts.length)
                })
                .catch(function (error){
                    console.log(error)
                });
        },
        loadSlides: function () {
            //Carregar imagens
            axios.get('/api/slides')
                .then(response => {
                    //console.log(response.data.data[0].photos)
                    this.images = response.data.data[0].photos;
                });
        },
        getCategory: function (category) {
            axios.get('/api/post/' + category)
                .then((response) => {
                    this.loadmoreButton = false
                    this.isActive = category
                    console.log(this.isActive)
                    this.posts = response.data.data[0].posts

                })
                .catch(function (error){
                    console.log(error)
                });
        },
        getPost: function (evt){
            console.log(evt)
            axios.get('/api/post_search/' + evt)
                .then((response) => {
                    //console.log(response)
                    this.isActive = -1
                    this.posts = response.data.data
                })
                .catch(function (error){
                    console.log(error)
                });
        },
        handleLoadMore: function () {

            axios.get('/api/posts?page=' + this.page)
                .then(res => {
                    //console.log(res.data.meta.current_page);
                $.each(res.data.data, (key, value) => {
                    this.posts.push(value);
                });
                this.last_page = res.data.meta.last_page;
                console.log(this.page)
                //if(this.page == this.last_page) this.isActive = 99999999
            });
            if(this.page < this.last_page){
                this.page = this.page + 1;
            }
            if(this.page == this.last_page){
                this.loadmoreButton = false
            }
        },
    }
}
</script>

<style scoped>

</style>
