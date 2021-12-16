<template>
    <Head title="Souvenirs"/>
	<Layout>
    <Breadcrumb title="Souvenirs"/>
    <!-- Shop Page Start -->
    <div class="main-shop-page white-bg ptb-80">
        <div class="container">
            <!-- Row End -->
            <div class="row">

                <!-- Sidebar Shopping Option Start -->
                <div class="col-lg-3 col-md-4">
                    <div class="sidebar">
                        <form @submit.prevent="submit">
                        <!-- Price Filter Options Start -->
                        <div class="search-filter mb-30">
                            <h3 class="sidebar-title">Filtrar por precio</h3>
                            <div class="product-price mt-1 mb-4">
                                <h6 class="filter-heading  text-center text-md-left mb-5">Price</h6>
                                <Slider 
                                    v-model="form.price"
                                    :max="max"
                                />
                            </div>
                        </div>
                        <!-- Price Filter Options End -->

                        <!-- Sidebar Categorie Start -->
                        <div class="sidebar-categorie mb-30">
                            <h3 class="sidebar-title">Categorias</h3>
                            <ul class="sidbar-style">
                                <li class="form-check mb-3" v-for="cat in $page.props.categories" :key="cat.id">
                                    <input :id="'category'+cat.id" type="radio" class="form-check-input" v-model="form.category" :value="cat.id">
                                    <label class="form-check-label mt-1" :for="'category'+cat.id">{{ cat.name }}</label>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div align="center" class="col-md-12 mb-3">
                                <button type="submit" class="view-cart bg-info" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Filtrar</button>
                            </div> 
                        </div>
                    </form>
                    </div>
                </div>
                <!-- Sidebar Shopping Option End -->
                <!-- Product Categorie List Start -->
                <div class="col-lg-9 col-md-8">
                     <div class="col-lg-12">
                        <div class="container">
                            <div class="row py-4">
                                <div class="col-lg-7">
                                    <div class="about-content mb-all-40">
                                    <!-- Section Title Start -->
                                        <div class="section-title section-heading">
                                            <h2 class="text-info">Disclaimer</h2>
                                        </div>
                                        <!-- Section Title End -->
                                        <p class="mb-20">Si compras un souvenir, llegará aproximadamente en 20 minutos al hotel o apartamento donde te alojas.</p>

                                        <p>Los últimos pedidos deberán realizarse antes de las 22:30, en caso contrario, llegará al día siguiente.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Grid & List View Start -->
                    <div class="grid-list-top border-default universal-padding d-lg-flex justify-content-md-between align-items-center mb-30">
                        <div class="grid-list-view d-flex align-items-center  mb-sm-15">
                        </div>
                        <!-- Toolbar Short Area Start -->
                        <div class="main-toolbar-sorter clearfix">
                            <form @submit.prevent="submit">
                            <div class="toolbar-sorter d-md-flex align-items-center">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="submit"><i class="icon-search" aria-hidden="true"></i></button>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" aria-describedby="basic-addon1" v-model="form.search">
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- Toolbar Short Area End -->
                    </div>
                    <!-- Grid & List View End -->
                    <div class="shop-area mb-all-40">
                        <!-- Grid & List Main Area End -->
                        <div class="tab-content Products-area">
                            <div id="grid-view" class="tab-pane fade  show active">
                                <div class="row">
                                    <div v-for="product in products.data" :key="product.id" class="col-lg-4 col-md-6 col-sm-6">
                                        <!-- Single Product Start -->
                                        <div class="single-aboss-product mb-3">
                                            <div class="pro-img">
                                                <Link :href="route('product.souvenir.show',{product : product.id})">
                                                    <div :style="'background:url(/storage/souvenirs/'+product.images[0].url+')'" class="img-prod"></div>
                                                </Link>
                                                <div class="pro-actions">
                                                    <Link class="quick-view" :href="route('product.souvenir.show',{product : product.id})"><i class="icon-zoom"></i></Link>
                                                </div>
                                            </div>
                                            <div class="pro-content">
                                                <h4><Link :href="route('product.souvenir.show',{product : product.id})">{{ product.title }}</Link></h4>
                                                <div class="pro-price-cart">
                                                    <div class="pro-home-price">
                                                        <span>{{ product.price }} €</span>
                                                    </div>
                                                    <div class="pro-cart">
                                                        <a title="Añadir Al Carrito" href="javascript:void(0)" @click="cart(product.id)"><i class="icon-cart"></i></a>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                </div>
                                <!-- Row End -->
                            </div>
                        </div>
                        <!-- Grid & List Main Area End -->
                    </div>
                    <!-- Shop Breadcrumb Area Start -->
                    <div class="shop-breadcrumb-area border-default mt-40">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-md-6 col-sm-7">
                                <paginator :paginator="products"/>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Breadcrumb Area End -->
                </div>
                <!-- product Categorie List End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Shop Page End -->
</Layout>
<QuickView /> <!--Sidebar-->
</template>

<script>

    import { Inertia } from '@inertiajs/inertia';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Layout from '@/Layouts/Layout.vue'        
    import QuickView from '@/Components/QuickView.vue';
    import Breadcrumb from '@/Layouts/Components/Breadcrumb.vue'     
    import '/vendor_asset/js/vendor/jquery-3.2.1.min.js';
    import '/vendor_asset/js/jquery-ui.min.js';
    import Paginator from '@/Components/Paginator.vue'  
    import Slider from '@vueform/slider' 

    export default {
        components: {
            Head,
            Link,
            Layout,
            QuickView,
            Breadcrumb,
            Slider,
            Paginator
        },
        props: {
            products: Object,
            max: Number,
            search: String,
            category: Number,
        },
        data(){
            return {
                max: this.max,
                form: this.$inertia.form({
                    search: this.search,
                    category: this.category,
                    price: [20,150],
                }),
            }
        },
        methods: {
            submit() {
                this.form.get(route('souvenirs'),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'submit',
                    preserveScroll: true,
                    
                })
            },
            cart(id){
                this.$inertia.put(route('cart.update',{checkout: id}),{
                    preserveScroll: true
                })
            }
        }
}

</script>
<style src="@vueform/slider/themes/default.css"></style>
<style scope>
    .img-prod{
        width: 100%;
        height: 250px;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
    }
</style>
