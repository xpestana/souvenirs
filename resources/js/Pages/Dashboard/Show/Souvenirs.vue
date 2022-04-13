<template>
    <Head title="Souvenir"/>
<Layout>
    <!-- Product Thumbnail Start -->
    <div class="main-product-thumbnail white-bg pb-50">
        <div class="container-fluid">
            <div class="row">
                <!-- Main Thumbnail Image Start -->
                <div class="col-12 px-0">
                    <!-- Thumbnail Large Image start -->
                    <div class="product-img">
                        <div id="thumb1" class="tab-pane fade show active">
                            <a v-if="product.images.length != 0" data-fancybox="images" :href="'/storage/souvenirs/'+product.images[0].url">
                                <img :src="'/storage/souvenirs/'+product.images[0].url" class="img-product">
                            </a>
                        </div>
                    </div>
                    <div class="alert font-weight-bolder text-center py-1" role="alert" style="background:#d8edf3">
                        Envío gratuito en pedidos superiores de X
                    </div>
                    <!-- Thumbnail Large Image End -->
                    <!-- Thumbnail Image End -->
                    <!-- <div v-if="product.images.length != 0" class="product-thumbnail d-none d-md-block">
                         <Carousel :settings="settings" :breakpoints="breakpoints" :wrap-around="true">
                            <Slide v-for="image in product.images" :key="image.id">
                                <a data-fancybox="images" :href="'/storage/souvenirs/'+image.url" class="w-100">
                                    <div :style="'background:url(/storage/souvenirs/'+image.url+')'" class="img-thumb"></div>
                                </a>
                            </Slide>
                            <template #addons>
                                <Navigation />
                            </template>
                        </Carousel>
                    </div> -->
                    <!-- Thumbnail image end -->
                </div>
                <!-- Main Thumbnail Image End -->
                <!-- Thumbnail Description Start -->
                <div class="col-lg-7 col-md-6">
                    <back/>
                    <div class="thubnail-desc fix mt-1 mt-md-4">
                        <div class="product-header-mobile">
                            <h3 class="text-azulc font-weight-bolder text-lg d-inline">{{ product.title }}</h3>
                            <div class="d-inline">
                                <img v-if="this.product.offer > 0" class="raya-img d-inline" src="/vendor_asset/img/slash.png" style="opacity:0.6">
                                <h3 class="font-weight-bolder text-2xl d-inline ml-3" :class="{'opacidad':this.product.offer > 0}">{{ product.price.toLocaleString('de-DE') }}€</h3>
                                <h3 v-if="this.product.offer > 0" class="font-weight-bolder text-2xl d-inline ml-3">{{ product.offer.toLocaleString('de-DE') }}€</h3>
                            </div>
                            <div class="d-block">
                                <form @submit.prevent="submit">
                                <div class="quatity-stock-mobile d-inline">
                                    <button type="button" class="rounded-circle bg-azulc text-white d-inline text-xs px-1" @click="form.quantity > 1 ? --form.quantity: ''"><i class="fas fa-minus"></i></button>
                                    <p class="text-muted d-inline mx-2">Cantidad <input v-model="form.quantity" type="number" min="1"></p>
                                    <button type="button" class="rounded-circle bg-azulc text-white d-inline text-xs px-1" @click="++form.quantity"><i class="fas fa-plus"></i></button>
                                </div>
                                <div class="d-inline ml-3">
                                    <button href="#" type="submit" class="text-azulc">Añadir al carrito</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        <ul class="rating-summary" hidden>
                            <li class="rating-pro">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                            <li class="read-review"><a href="#">Lee los reviews (1)</a></li>
                            <li class="write-review"><a href="#">Escribe un review</a></li>
                        </ul>
                        <div class="pro-desc-details mt-4"> 
                            <span v-html="product.description"></span>
                        </div>
                        <!-- <div class="pro-price mt-30 d-none d-md-block">
                            <p class="d-flex align-items-center"><span class="prev-price" hidden>16.51</span><span class="price">Precio:  € {{ product.price }}</span><span class="saving-price" hidden>-5%</span></p>
                        </div> -->
                        
                        <!-- <div class="pt-10 quatity-stock d-none d-md-block">
                           <label>Quantity</label>
                           <form @submit.prevent="submit">
                            <ul class="d-flex flex-wrap  align-items-center">
                                <li class="box-quantity">
                                    
                                    <input class="quantity" v-model="form.quantity" type="number" min="1">
                                    
                                </li>
                                <li>
                                    <button type="submit" class="pro-cart">Añadir Al Carrito</button>
                                </li>
                                <li class="pro-ref" hidden>
                                    <p><span class="in-stock"><i class="ion-checkmark-round"></i>{{ product.stock }} disponibles</span></p>
                                </li>
                            </ul>
                            </form>
                        </div> -->
                        
                        <div class="pt-10 quatity-stock" v-if="$page.props.auth.role == 'Admin'">
                            <Link :href="route('souvenirs.edit',{souvenir:product.id})" class="pro-cart">Editar Souvenir</Link>
                        </div>
                    </div>
                </div>
                <!-- Thumbnail Description End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
        <!-- Product Thumbnail End -->
    <!-- Product Thumbnail Description Start -->
    <div class="thumnail-desc white-bg" hidden="">
        <div class="container">
            <div id="thumb-desc-inner" class="thumb-desc-inner">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="main-thumb-desc nav tabs-area" role="tablist">
                            <li><a class="active" data-toggle="tab" href="#dtail">Descripción</a></li>
                        </ul>
                        <!-- Product Thumbnail Tab Content Start -->
                        <div class="tab-content thumb-content">
                            <div id="dtail" class="tab-pane fade show active">
                                <span v-html="product.description"></span>
                            </div>
                        </div>
                        <!-- Product Thumbnail Tab Content End -->
                    </div>
                </div>
                <!-- Row End -->
            </div>
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
</Layout>
</template>
<script>
    import { Link, Head } from '@inertiajs/inertia-vue3'
    import Layout from '@/Layouts/Layout.vue' 
    import { Inertia } from '@inertiajs/inertia'
    import Back from '@/Layouts/Components/Back.vue' 
    import Souvenirs from '@/Layouts/Components/Souvenirs.vue' 
    import Breadcrumb from '@/Layouts/Components/Breadcrumb.vue'  
    import { Carousel, Navigation, Slide } from 'vue3-carousel'
    import 'vue3-carousel/dist/carousel.css';

    export default {
        components: {
            Link,
            Head,
            Back,
            Layout,
            Breadcrumb,
            Souvenirs,
            Carousel,
            Slide,
            Navigation,
        },
        data() {
            return {
                
            settings: {
                itemsToShow: 1,
                snapAlign: 'center',
                },
            breakpoints: {
              700: {
                itemsToShow: 3,
                snapAlign: 'center',
                },
              1024: {
                itemsToShow: 3,
                snapAlign: 'start',
                },
                },
                form: this.$inertia.form({
                    quantity: 1,
                    
                }),
                showPopup:false
            }

        },
        created(){
            console.log(this.product)
        },
        updated(){
            if(this.$page.props.flash.mensaje){
                this.showPopup=true;
            }
            setTimeout(()=>this.showPopup=false, 3000);
        },
        props: {
            product: Object,
        },
        methods: {
            submit() {
                    this.form.put(route('cart.update',{checkout: this.product.id}),{
                        _token: this.$page.props.csrf_token,
                        errorBag: 'submit',
                        preserveScroll: true,
                    })
            },
                
        }
    }
</script>
<style scope>
    .img-product {
        height: 30em;
        background-size: contain !important;
        background-repeat: no-repeat !important;
        min-width: 100% !important;
    }
    .img-thumb{
        width: 100%;
        height: 100px;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        margin-left: 10px;
    }
    .carousel__prev, .carousel__next{
        background-color: #31516B !important; 
    }
    .pro-price{
        margin-bottom: 0px;
    }
    .thubnail-desc .quatity-stock-mobile input{
        padding: 0;
        border: none;
        width: 8px;
        margin: 0 2px;
    }
    
    .thubnail-desc .product-header-mobile .raya-img {
        height: 33px;
        width: 50px;
        position: absolute;
        margin-left: 4px;
    }
    .thubnail-desc .product-header-mobile .opacidad{
        opacity: 0.8;
    }
    @media(max-width:767px){
        .img-product {
            height: 20em;
            background-size: cover !important;
            background-repeat: no-repeat !important;
        }
        .main-product-thumbnail .tab-content {
            margin-bottom: 0px;
        }
        .thubnail-desc .quatity-stock-mobile .text-xs{
            font-size: 0.65rem !important;
            line-height: 1.2rem !important;
        }
        .thubnail-desc .pro-desc-details p, ul {
            line-height: 17px;
            font-family: 'Futur';
            font-size: 15px;
            text-align: justify;
        }
    }
    
</style>