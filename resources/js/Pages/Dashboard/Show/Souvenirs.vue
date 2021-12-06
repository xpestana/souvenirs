<template>
    <Head title="Souvenir"/>
<Layout>
    <Breadcrumb :title="product.title"/>
    <!-- Product Thumbnail Start -->
    <div class="main-product-thumbnail white-bg pt-90 pb-50">
        <div class="container">
            <div class="row">
                <!-- Main Thumbnail Image Start -->
                <div class="col-lg-5 col-md-6 mb-all-40">
                    <!-- Thumbnail Large Image start -->
                    <div class="tab-content" >
                        <div id="thumb1" class="tab-pane fade show active">
                            <a v-if="product.images.length != 0" data-fancybox="images" :href="'/storage/souvenirs/'+product.images[0].url">
                                <div :style="'background:url(/storage/souvenirs/'+product.images[0].url+')'" class="img-back"></div>
                            </a>
                        </div>
                    </div>
                    <!-- Thumbnail Large Image End -->
                    <!-- Thumbnail Image End -->
                    <div v-if="product.images.length != 0" class="product-thumbnail">
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
                    </div>
                    <!-- Thumbnail image end -->
                </div>
                <!-- Main Thumbnail Image End -->
                <!-- Thumbnail Description Start -->
                <div class="col-lg-7 col-md-6">
                    <back/>
                    <div class="thubnail-desc fix mt-4">
                        <h3 class="product-header">{{ product.title }}</h3>
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
                        <div class="pro-price mt-30">
                            <p class="d-flex align-items-center"><span class="prev-price" hidden>16.51</span><span class="price">Precio:  € {{ product.price }}</span><span class="saving-price" hidden>-5%</span></p>
                        </div>
                        <p class="pro-desc-details" hidden>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                        <div class="pt-10 quatity-stock">
                           <label>Quantity</label>
                            <ul class="d-flex flex-wrap  align-items-center">
                                <li class="box-quantity">
                                    <form action="#">
                                        <input class="quantity" type="number" min="1" value="1">
                                    </form>
                                </li>
                                <li>
                                    <button class="pro-cart">Añadir Al Carrito</button>
                                </li>
                                <li class="pro-ref">
                                    <p><span class="in-stock"><i class="ion-checkmark-round"></i>{{ product.stock }} disponibles</span></p>
                                </li>
                            </ul>
                        </div>
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
    <div class="thumnail-desc white-bg">
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
    <souvenirs/>
</Layout>
</template>
<script>
    import { Link, Head } from '@inertiajs/inertia-vue3'
    import Layout from '@/Layouts/Layout.vue' 
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
        data: () => {
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
            }

        },
        props: {
            product: Object,
        },
        created(){
            console.log(this.product.description);
        }
    }
</script>
<style scope>
    .img-back{
        height: 300px;
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
</style>