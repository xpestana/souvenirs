<template>
    <Head title="Activities"/>
<Layout>
<!-- Breadcrumb Area Start Here -->
<div class="breadcrumb-area pt-65 pb-70 bg-img bg-info">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1 style="font-size: 2.5rem;" class="text-white">{{ product.title }}</h1>        
            </div>
            <div class="col-md-3">
                <div align="center" class="col-md-12">
                    <template v-if="product.activities.priceN">
                        <h3 style="font-size: 1.175rem;" class="text-white">Adulto: {{ product.activities.priceA }} € / Niño: {{ product.activities.priceN }} € </h3>
                    </template>
                    <template v-else>
                       <h3 style="font-size: 1.175rem;" class="text-white">Precio: {{ product.activities.priceA }} € </h3>
                    </template>
                </div>
                <div align="center" class="col-md-12 mt-3">
                    <div class="d-single-info text-lg-center">
                       <a style="background-color: #31516B;" class="view-cart p-15" href="javascript:void(0)">Ver disponbilidad</a>
                    </div>
                </div>
                <div class="col-md-12 mt-3 row">
                    <div class="main-toolbar-sorter clearfix col-md-5">
                            <div class="toolbar-sorter d-md-flex align-items-center">
                                <div style="width: auto !important;" class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button style="background-color: #31516B;" class="btn btn-outline-secondary" type="button"><i class="icon-search text-white" aria-hidden="true"></i></button>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <Carousel :settings="settings" :breakpoints="breakpoints" :wrap-around="true" :autoplay="7000">
                    <Slide v-for=" image in product.images" :key="image.id">
                        <div :style="'background:url(/storage/souvenirs/'+image.url+')'" class="img-act"></div>
                    </Slide>
                </Carousel>
            </div>
        </div>
        
    </div>
</div>
<!-- Breadcrumb Area End Here -->

<div class="main-product-thumbnail white-bg pt-90 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 mb-all-40">
                <Back/>
                <div class="grid-list-view d-flex align-items-center  mb-sm-15 mt-4">
                    <ul class="nav tabs-area d-flex align-items-center">
                        <li><a class="active mr-3 mb-4" href="#description"><i class="fas fa-clipboard-list"></i> Descripción</a></li>
                        <li><a class="active mr-3 mb-4" href="#price"><i class="fas fa-euro-sign"></i> Precios de la actividad</a></li>
                        <li><a class="active mr-3 mb-4" href="#details"><i class="fas fa-info-circle"></i> Detalles</a></li>
                        <li><a class="active mr-3 mb-4" href="#point"><i class="fas fa-map-marker-alt"></i> Punto de encuentro</a></li>
                    </ul>
                </div>
                <div id="description" class="col-md-12 mt-4 border-bottom">
                    <h3 style="font-size: 2rem;">Descripción</h3> 
                </div>
                <div class="col-md-12 mt-3 pb-15" v-html="product.description"> 
                </div>
                <div class="col-md-12 mt-4 border-bottom">
                    <h3 style="font-size: 2rem;">Fechas</h3> 
                </div>
                <div class="col-md-12 mt-3 pb-15"> 
                    <template v-if="product.activities.end">
                        De {{ moment(product.activities.init).format('DD/MM/YYYY') }} a {{ moment(product.activities.end).format('DD/MM/YYYY') }}
                    </template>
                    <template v-else>
                        El {{ moment(product.activities.init).format('DD/MM/YYYY')}}
                    </template>
                </div>
                <div id="price" class="col-md-12 mt-4 pb-15">
                    <h3 style="font-size: 2rem;" class="mt-3 border-bottom">Precio</h3> 
                    <div class="row ">
                        <div class="col-md-2"></div>
                        <template v-if="product.activities.priceN">
                            <div class="col-md-3 mt-4">
                                <h3 class="mb-4" style="font-size: 1.175rem;">Adultos</h3>
                                <span class="price mt-3 bg-info text-white">{{ product.activities.priceA }} €</span>
                            </div>
                            <div class="col-md-3 mt-4">
                                <h3 class="mb-4" style="font-size: 1.175rem;">Niños</h3>
                                <span class="price mt-3 bg-info text-white">{{ product.activities.priceN }} €</span>
                            </div>    
                        </template>
                        <template v-else>
                            <div class="col-md-6">
                                <div class="col-md-6 mt-4">
                                    <span class="price mt-3 bg-info text-white">{{ product.activities.priceA }} €</span>
                                </div>
                            </div>    
                        </template>
                    </div>
                </div>
                <div id="details" class="col-md-12 mt-4 border-bottom">
                    <h3 style="font-size: 2rem;" class="mt-3">Detalles</h3> 
                </div>
                <div class="col-md-12 mt-3 pb-15" v-html="product.activities.details">
                </div>
                <div id="point" class="col-md-12 mt-4  border-bottom">
                    <h3 style="font-size: 2rem;" class="mt-3">Punto de encuentro</h3> 
                </div>
                <div style="overflow-x: scroll;" class="col-md-12 mt-3 pb-15" v-html="product.activities.iframe">
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-all-40">
                <calendar :product="product"/>
            </div>
        </div>
    </div>
</div>
    <activities/>
</Layout>
</template>
<script>
    import { Link, Head } from '@inertiajs/inertia-vue3'
    import Layout from '@/Layouts/Layout.vue' 
    import Back from '@/Layouts/Components/Back.vue'
    import Calendar from '@/Layouts/Components/Calendar.vue' 
    import Activities from '@/Layouts/Components/Activities.vue' 
    import { Carousel, Navigation, Slide } from 'vue3-carousel'
    import 'vue3-carousel/dist/carousel.css';
    import Moment from 'moment'

    export default {
        components: {
            Link,
            Head,
            Back,
            Layout,
            Activities,
            Carousel,
            Slide,
            Navigation,
            Calendar,
        },
        data: () => {
            return {
                moment:null,
            settings: {
                itemsToShow: 1,
                snapAlign: 'center',
                },
            breakpoints: {
              700: {
                itemsToShow: 1,
                snapAlign: 'center',
                },
              1024: {
                itemsToShow: 2.5,
                snapAlign: 'start',
                },
                },
            }

        },
        props: {
            product: Object,
        },
        created(){
            this.moment=Moment;
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
    .img-act{
        width: 100%;
        height: 300px;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        margin-left: 10px;
    }
    #description p{
        font-size: 17px;
    }
    .border-bottom{
        border-bottom: 2px solid #ccc !important;
            padding-bottom: 10px !important;
    }
    .price{
        font-size: 25px !important;
        border-radius: 100%;
        padding: 20px 20px;
    }
</style>