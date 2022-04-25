<template>

    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <img :src="'/storage/souvenirs/'+product.images[0].url">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 mb-all-40">
                <div class="grid-list-view d-flex align-items-center  mb-sm-15 mt-4">
                    <ul class="nav tabs-area d-flex align-items-center">
                        <li><a class="active mr-3 mb-4" href="#description"><i class="fas fa-clipboard-list"></i> Descripción</a></li>
                        <li><a class="active mr-3 mb-4" href="#price"><i class="fas fa-euro-sign"></i> Precios de la actividad</a></li>
                        <li><a class="active mr-3 mb-4" href="#details"><i class="fas fa-info-circle"></i> Cancelación</a></li>
                        <li><a class="active mr-3 mb-4" href="#point"><i class="fas fa-map-marker-alt"></i> Punto de encuentro</a></li>
                    </ul>
                </div>
                <div id="description" class="col-md-12 mt-4 border-bottom">
                    <h3 style="font-size: 2rem;">Descripción</h3> 
                </div>
                <div class="col-md-12 mt-3 pb-15" style="word-wrap: break-word ;" v-html="product.description"> 
                </div>
                <div id="price" class="col-md-12 mt-4 pb-15">
                    <h3 style="font-size: 2rem;" class="mt-3 border-bottom">Precio</h3> 
                    <div class="row ">
                        <template v-if="product.activities.priceN">
                            <div class="col-md-6 mt-4">
                                <ul>
                                    <li class="mt-4"><h3 class="mb-4" style="font-size: 1.175rem;">Adultos <i style="color: #6cb2eb !important" class="fas fa-arrow-right"></i> {{ product.activities.priceA }} €</h3></li>
                                    <li class="mt-4"><h3 class="mb-4" style="font-size: 1.175rem;">Niños <i style="color: #6cb2eb !important" class="fas fa-arrow-right"></i> {{ product.activities.priceN }} €</h3></li>
                                </ul>
                            </div>
                        </template>
                        <template v-else>
                            <div class="col-md-6">
                                <ul>
                                    <li class="mt-4"><h3 class="mb-4" style="font-size: 1.175rem;"><i style="color: #6cb2eb !important" class="fas fa-arrow-right"></i> {{ product.activities.priceA }} €</h3></li>
                                </ul>
                            </div>    
                        </template>
                    </div>
                </div>
                <div id="details" class="col-md-12 mt-4 border-bottom">
                    <h3 style="font-size: 2rem;" class="mt-3">Detalles de cancelación</h3> 
                </div>
                <div style="word-wrap: break-word ;" class="col-md-12 mt-3 pb-15" v-html="product.activities.details">
                </div>
                <div id="point" class="col-md-12 mt-4  border-bottom">
                    <h3 style="font-size: 2rem;" class="mt-3">Punto de encuentro</h3> 
                </div>
                <div style="word-wrap: break-word ;" class="col-md-12 mt-3 pb-15" v-html="product.activities.iframe">
                </div>
            </div>
            <!-- <div class="col-lg-4 col-md-4 mb-all-40">
                <calendar :product="product"/>
            </div> -->
        </div>
    </div>
    
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
        layout:Layout,
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
</style>