<template>
    <Head title="Souvenirs"/>
	<Layout>
    <Breadcrumb title="Souvenirs"/>
    <!-- Shop Page Start -->
    <div class="main-shop-page white-bg pt-10 md:ptb-80 bg-light">
        <div class="container">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h5 class="text-muted md:text-lg">{{ count }} Souvenirs disponibles</h5>
                </div>
            </div>
            <!-- Row End -->
            <div class="row">

                <!-- Sidebar Shopping Option Start -->
                <div class="col-lg-3 d-none">
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
                <div class="col-12">
                     <div class="col-md-12 d-none">
                        <div class="container">
                            <div class="row py-4">
                                <div class="col-lg-12">
                                    <div class="about-content mb-all-40">
                                    <!-- Section Title Start -->
                                        <div class="section-title section-heading">
                                            <h2 class="text-info">ATENCIÓN</h2>
                                        </div>
                                        <!-- Section Title End -->
                                        <p class="mb-20">Si compras un souvenir, llegará aproximadamente entre 15 y 30 minutos al hotel o apartamento donde te alojas. Los últimos pedidos deberán realizarse antes de las 22:30, en caso contrario, llegará al día siguiente.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Grid & List View Start -->
                    <div class="grid-list-top border-default universal-padding justify-content-md-center align-items-center mb-30 d-none" >
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
                                    <div v-for="product in data" :key="product.id" class="col-lg-4 col-md-4 col-6">
                                        <!-- Single Product Start -->
                                        <div class="single-aboss-product mx-2 my-2">
                                            <div class="pro-img">
                                                <a title="Añadir Al Carrito" href="javascript:void(0)" @click="cart(product.id,product.stock)">
                                                    <div class="add-cart mt-1 p-1 absolute block right-0" id="boton-agregar">
                                                        <img src="/vendor_asset/img/icons/plust.png" alt="">
                                                    </div>
                                                </a>
                                                <Link :href="route('product.souvenir.show',{product : product.id})">
                                                    <div :style="'background:url(/storage/souvenirs/'+product.images[0].url+')'" class="img-prod h-48"></div>
                                                </Link>
                                                <div class="pro-actions hidden md:block">
                                                    <Link class="quick-view" :href="route('product.souvenir.show',{product : product.id})"><i class="icon-zoom"></i></Link>
                                                </div>
                                            </div>
                                            <div class="pro-content  bg-white hidden">
                                                <Link :href="route('product.souvenir.show',{product : product.id})"><h4 class="hidden md:block" >{{ product.title }}</h4></Link>
                                                
                                                <div class="pro-price-cart absolute top-0 right-0 md:static" style="z-index:19">
                                                    <div class="pro-home-price hidden">
                                                        <span><Decimals :precio="product.price" />€</span>
                                                    </div>
                                                    <div class="pro-cart hidden">
                                                        <a title="Añadir Al Carrito" href="javascript:void(0)" @click="cart(product.id,product.id)"><i class="icon-cart"></i></a>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="pro-mobile p-2 bg-white">
                                                <div class="pro-mobile-title text-left">
                                                    <h4 class="md:text-base text-muted whitespace-nowrap truncate ..."><Link :href="route('product.souvenir.show',{product : product.id})" v-html="product.title"></Link></h4>
                                                </div>
                                                <div class="pro-mobile-price text-xl font-bold text-right">
                                                    <span class="d-inline"><Decimals :precio="product.price" /></span><span class="d-inline">€</span>
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
                    <div class="shop-breadcrumb-area mt-40 mb-5">
                        <div class="row justify-content-center">
                            <div v-if="show.show != 1" class="col-12">
                                <div class="row justify-content-center mb-5">
                                    <div class="col-6 text-center">
                                        <a href="javascript:void(0)" class="btn btn-outline-primary rounded-pill px-4 py-1" @click="load_more()">Ver más</a>
                                    </div>
                                </div>
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

    <div class="row justify-content-md-end">
        <div class="col-12 col-md-4">
            <Transition>
                <div v-if="showPopup" class="fixed-bottom" id="popup">
                    <div class="alert alert-primary alert m-0 text-center py-4 text-muted" role="alert" style="background-color:#d8ecf3" v-html="$page.props.flash.mensaje">
                    </div>
                </div>
            </Transition>
        </div>
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
    import Decimals from '@/Layouts/Components/Decimals.vue'
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
            Paginator,
            Decimals
        },
        props: {
            products: Object,
            max: Number,
            search: String,
            min_r:Number,
            max_r:Number,
            count: Number,
            showr: Number,
        },
        updated(){
            if(this.$page.props.flash.mensaje){
                this.showPopup=true;
            }
            setTimeout(()=>this.showPopup=false, 3000);
        },
        data(){
            return {
                data: (this.products.data) ? this.products.data : this.products,
                max: this.max,
                form: this.$inertia.form({
                    search: this.search,
                    price: [this.min_r,this.max_r],
                }),
                show: this.$inertia.form({
                    show: this.showr,
                }),
                formCart: this.$inertia.form({
                    quantity: 1,
                }),
                showPopup:false
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
            cart(id,stock){
                this.formCart.put(route('cart.update',{checkout: id}),{
                    _token: this.$page.props.csrf_token,
                    preserveScroll: true,
                })
            },
            load_more(){
                this.show.show = 1;
                this.show.get(route('souvenirs'),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'submit',
                    preserveScroll: true,
                    
                })
            },
            
        },
        computed:{
            
        }
}

</script>
<style src="@vueform/slider/themes/default.css"></style>
<style scope>
    #boton-agregar:hover{
        background-color: transparent;
    }
    .v-enter-active,
    .v-leave-active {
    transition: opacity 0.5s ease;
    }

    .v-enter-from,
    .v-leave-to {
    opacity: 0;
    }
    .img-prod{
        width: 100%;
        height: 13em !important;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
    }
    .bg-img{
        background-repeat: no-repeat !important;
        background-position: 50% 50% !important;
        background-size: cover !important;
    }
    .shop-area .single-aboss-product img{
        width: 50%;
    }    
@media (max-width: 767px){
    .pro-content{
        padding: 5px 5px 10px 5px !important;
    }
    .shop-area .single-aboss-product{
        border:none;
    }
    .shop-area .tab-content span{
        color:#767676;
    }
    .shop-area .tab-content {
        color:#acacac;  
    }
}
</style>
