<template>
    <!-- Product Thumbnail Start -->
    <div class="main-product-thumbnail white-bg pb-8">
        <div class="container-fluid">
            <div class="row">
                <!-- Main Thumbnail Image Start -->
                <div class="col-12 px-0">
                    <!-- Thumbnail Large Image start -->
                    <div class="product-img" id="product-img">
                        <div id="thumb1" class="tab-pane fade show active">
                            <template v-if="product.images.length > 0">
                                <Carousel :settings="settings" :breakpoints="breakpoints" :wrap-around="true">
                                <Slide v-for="img in product.images" :key="img.id">
                                    <img :src="'/storage/souvenirs/'+img.name" :onerror="img.name"  id="img-product">
                                </Slide>
                                <template #addons>
                                    <Navigation />
                                </template>
                                </Carousel>
                            </template>
                            <template v-else>
                                    
                                <img src="/vendor_asset/img/bg-image/act-default.jpg" class="bg-contain mx-auto w-4/6 h-56 md:h-96">    
                            
                            </template>
                        </div>
                    </div>
                </div>
                <!-- Main Thumbnail Image End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
        <!-- Product Thumbnail End -->
    <div class="container">
        <div class="row section-description">
            <div class="col-12 px-3 mt-1">
                <h1 class="font-weight-bolder text-xl">{{ product.title }}</h1>
            </div>
            <div class="col-12 d-flex flex-row justify-around mt-2 pb-2 border-bottom">
                <div class="time text-center">
                    <i class="far fa-hourglass mr-1 text-grayc"></i>
                    <p class="text-grayc"> <ConvertirMinutos :minutos="product.activities.duration" /></p>
                </div>
                <div class="lenguage text-center">
                    <i class="far fa-comment-alt mr-2 text-grayc"></i>
                    <p class="text-grayc">{{ product.activities.language }}</p>
                </div>
            </div>
            <div class="col-12 mt-2 pb-2 border-bottom">
                <template v-if="product.summary !== null">
                    <div class="break-words">{{product.summary}}</div>
                </template>
                <template v-else>
                    <div class="break-words" v-html="product.description">
                    </div>
                </template>
            </div>
        </div>
        <div class="row">
            <div class="col-12 px-0">
                <div class="w-100" id="accordionExample">
                    <div class="tarjeta border-bottom">
                        <button @click="cambiarColor('descripcion-color')" class="w-100" type="button" data-toggle="collapse" data-target="#descripcion" aria-expanded="true" aria-controls="descripcion" >
                            <div class="d-flex" id="headingOne">
                                    <div class="mr-auto">
                                        <p class="leading-8 text-grayc pl-1" id="descripcion-color">DESCRIPCIÓN</p>
                                    </div>
                                    <div>
                                        <i class="fas fa-angle-down text-grayc font-weight-bolder text-3xl pr-2"></i>
                                    </div>
                            </div>
                        </button>

                        <div id="descripcion" class="collapse py-3 px-3" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <template v-if="product.description !== null">
                                <div class="" v-html="product.description">
                                </div>
                            </template>
                            <template v-else>
                                <div>{{product.summary}}</div>
                            </template>
                            
                        </div>
                    </div>
                    <div class="tarjeta border-bottom">
                        <button @click="cambiarColor('precio-color')" class="w-100" type="button" data-toggle="collapse" data-target="#precio" aria-expanded="true" aria-controls="precio">
                            <div class="d-flex" id="headingtwo">
                                    <div class="mr-auto">
                                        <p class="leading-8 text-grayc pl-1" id="precio-color">PRECIOS</p>
                                    </div>
                                    <div>
                                        <i class="fas fa-angle-down text-grayc font-weight-bolder text-3xl pr-2"></i>
                                    </div>
                            </div>
                        </button>

                        <div id="precio" class="collapse p-3" aria-labelledby="headingtwo" data-parent="#accordionExample" style="background-color:#e6e6e6d4">
                            <template v-if="this.precios.length == 0">
                                <div class="text-center">   
                                    Esta actividad no esta disponible
                                </div>
                            </template>
                            <template v-if="this.precios.length > 0">
                                <div class="text-right">
                                    <template v-if="editados">
                                        <div class="mb-4" v-if="this.precios[0] !== undefined && this.precios[0] !== null">
                                        <p class="text-lg d-inline mr-4">Adultos</p>
                                        <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline" :class="{'p-0 py-2 px-2.5':this.precios[0]== 0 }">{{this.precios[0]}}€</h5>
                                        </div>
                                        <div class="mb-4" v-if="this.precios[1] !== undefined && this.precios[1] !== null">
                                            <p class="text-lg d-inline mr-4">Niños</p>
                                            <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline" :class="{'p-0 py-2 px-2.5':this.precios[1]== 0 }">{{this.precios[1]}}€</h5>
                                        </div>
                                        <div class="mb-4" v-if="this.precios[2] !== undefined && this.precios[2] !== null">
                                            <p class="text-lg d-inline mr-4">Estudiantes</p>
                                            <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline" :class="{'p-0 py-2 px-2.5':this.precios[2]== 0 }">{{this.precios[2]}}€</h5>
                                        </div>
                                        <div v-if="this.precios[3] !== undefined && this.precios[3] !== null">
                                            <p class="text-lg d-inline mr-4">Bebés</p>
                                            <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline" :class="{'p-0 py-2 px-2.5':this.precios[3]== 0 }">{{this.precios[3]}}€</h5>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="mb-4" v-if="this.precios[0] !== undefined && this.precios[0] !== null">
                                        <p class="text-lg d-inline mr-4">Adultos</p>
                                        <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline" :class="{'p-0 py-2 px-2.5':this.precios[0]== 0 }">{{this.precios[0]}}€</h5>
                                        </div>
                                        <div class="mb-4" v-if="this.precios[1] !== undefined && this.precios[1] !== null">
                                            <p class="text-lg d-inline mr-4">Niños</p>
                                            <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline" :class="{'p-0 py-2 px-2.5':this.precios[1]== 0 }">{{this.precios[1]}}€</h5>
                                        </div>
                                        <div class="mb-4" v-if="this.precios[2] !== undefined && this.precios[2] !== null">
                                            <p class="text-lg d-inline mr-4">
                                                <template v-if="this.precios.length == 3 && this.precios[2]==0 || this.precios.length > 3 && this.precios[3] > this.precios[2]">
                                                    Bebés
                                                </template>
                                                <template v-else>
                                                    Estudiantes
                                                </template>
                                            </p>
                                            <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline" :class="{'p-0 py-2 px-2.5':this.precios[2]== 0 }">{{this.precios[2]}}€</h5>
                                        </div>
                                        <div v-if="this.precios[3] !== undefined && this.precios[3] !== null">
                                            <p class="text-lg d-inline mr-4">
                                                <template v-if="this.precios[3] < this.precios[2]">
                                                    Bebés
                                                </template>
                                                <template v-else>
                                                    Estudiantes
                                                </template>
                                            </p>
                                            <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline" :class="{'p-0 py-2 px-2.5':this.precios[3]== 0 }">{{this.precios[3]}}€</h5>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div class="tarjeta border-bottom">
                        <button @click="cambiarColor('horarios-color')" class="w-100" type="button" data-toggle="collapse" data-target="#horario" aria-expanded="true" aria-controls="horario">
                            <div class="d-flex" id="head3">
                                    <div class="mr-auto">
                                        <p class="leading-8 text-grayc pl-1" id="horarios-color">HORARIOS</p>
                                    </div>
                                    <div>
                                        <i class="fas fa-angle-down text-grayc font-weight-bolder text-3xl pr-2"></i>
                                    </div>
                            </div>
                        </button>

                        <div id="horario" class="collapse py-2 px-0" aria-labelledby="head3" data-parent="#accordionExample">
                            <div class="px-0 mb-2 py-1 d-flex"  style="background-color:#bedfef;">
                                <button @click="cambiarColor('horarios-color')" type="button" data-toggle="collapse" data-target="#horario" aria-expanded="true" aria-controls="horario"><i class="fas fa-angle-left text-muted pl-2 font-weight-bolder text-3xl pr-2 text-left"></i></button>
                                <div class="text-center flex-grow-1"> 
                                    <h3 class="text-base font-weight-bolder">Selecciona fecha y hora</h3>
                                </div>
                            </div>
                            <div class="px-3">
                                <calendar :ticket="ticket" :prices="prices" :token="access_token" :product="product" :eventos="eventosAbiertos" :precios="precios" />
                            </div>
                        </div>
                    </div>
                    <div class="tarjeta border-bottom">
                        <button @click="cambiarColor('detalles-color')" class="w-100" type="button" data-toggle="collapse" data-target="#detalles" aria-expanded="true" aria-controls="detalles">
                            <div class="d-flex" id="head4">
                                    <div class="mr-auto">
                                        <p class="leading-8 text-grayc pl-1" id="detalles-color">DETALLES</p>
                                    </div>
                                    <div>
                                        <i class="fas fa-angle-down text-grayc font-weight-bolder text-3xl pr-2"></i>
                                    </div>
                            </div>
                        </button>

                        <div id="detalles" class="collapse py-3 px-3" aria-labelledby="head4" data-parent="#accordionExample">
                            <template v-if="product.activities.details !== null">
                                <div v-html="filtroDetalles(product.activities.details)">
                                </div>    
                            </template>
                            <template v-else>
                                    No hay información para esta sección
                            </template>
                        </div>
                    </div>
                    <div class="tarjeta border-bottom">
                        <button @click="cambiarColor('cancelaciones-color')" class="w-100" type="button" data-toggle="collapse" data-target="#cancelaciones" aria-expanded="true" aria-controls="cancelaciones">
                            <div class="d-flex" id="head5">
                                    <div class="mr-auto">
                                        <p class="leading-8 text-grayc pl-1" id="cancelaciones-color">CANCELACIONES</p>
                                    </div>
                                    <div>
                                        <i class="fas fa-angle-down text-grayc font-weight-bolder text-3xl pr-2"></i>
                                    </div>
                            </div>
                        </button>

                        <div id="cancelaciones" class="collapse py-2 px-3" aria-labelledby="head5" data-parent="#accordionExample">
                            <template v-if="product.activities.price_notes !== null">
                                <div v-html="filtroDetalles(product.activities.price_notes)">
                                </div>    
                            </template>
                            <template v-else>
                                    No hay información para esta sección
                            </template>
                        </div>
                    </div>
                    <div class="tarjeta border-bottom">
                        <button @click="cambiarColor('punto-color')" class="w-100" type="button" data-toggle="collapse" data-target="#punto" aria-expanded="true" aria-controls="punto">
                            <div class="d-flex" id="head6">
                                    <div class="mr-auto">
                                        <p class="leading-8 text-grayc pl-1" id="punto-color">PUNTO DE ENCUENTRO</p>
                                    </div>
                                    <div>
                                        <i class="fas fa-angle-down text-grayc font-weight-bolder text-3xl pr-2"></i>
                                    </div>
                            </div>
                        </button>

                        <div id="punto" class="collapse py-2 px-3" aria-labelledby="head6" data-parent="#accordionExample">
                            <template v-if="product.activities">
                                <div class="d-flex justify-center" v-if="product.activities.coordinates !== ''">
                                    <iframe class="h-64 w-96" id="gmap_canvas" 
                                     :src="'https://maps.google.com/maps?q='+product.activities.coordinates+'&t=&z=13&ie=UTF8&iwloc=&output=embed'"
                                      frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                    </iframe>
                                </div>
                            </template>
                            <template v-if="product.activities && product.activities.coordinates == ''">
                                <div class="text-center">
                                    No hay punto de encuentro registrado para esta actividad. 
                                </div>
                            </template>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>

<Transition>
    <div v-if="showPopup" class="fixed-bottom" id="popup">
        <div class="alert alert-primary alert m-0 text-center py-4 text-muted" role="alert" style="background-color:#d8ecf3" v-html="$page.props.flash.mensaje">
        </div>
    </div>
</Transition>
</template>
<script>
    import { Link, Head } from '@inertiajs/inertia-vue3'
    import Layout from '@/Layouts/Layout.vue' 
    import Back from '@/Layouts/Components/Back.vue'
    import Calendar from '@/Layouts/Components/Calendar.vue' 
    import ConvertirMinutos from '@/Layouts/Components/ConvertirMinutos.vue'
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
            ConvertirMinutos
        },
        data: () => {
            return {
                moment:null,
                precios:[],
                eventos:[],
            settings: {
                itemsToShow: 1,
                snapAlign: 'center',
                },
                showPopup:false,
                editados:false
            }
        },
        props: {
            product: Object,
            access_token: String,
            prices: Object,
            ticket: Object
        },
        updated(){
            if(this.$page.props.flash.mensaje){
                this.showPopup=true;
            }
            setTimeout(()=>this.showPopup=false, 3000);
        },
        created(){
            this.moment=Moment;
            if(this.product.activities.priceA !== "null")
            {
                let precios = JSON.parse(this.product.activities.priceA)
                if(precios.status == 'ERROR'){}
                else{
                    let acc=0;
                    for(let val in precios.prices_per_ticket){
                        if(val.slice(0,3) == '111'){
                            this.editados = true;    
                        }
                        if(precios.prices_per_ticket[val] == null){
                            ++acc;
                        }
                        this.precios.push(precios.prices_per_ticket[val])   
                    }
                    if(acc == 4){
                        this.precios = [];
                    }
                    console.log(this.precios)
                    
                }
            }
            
            if(this.product.activities.events.length >0){
                let lista = JSON.parse(this.product.activities.events)
                if(lista.status == 'ERROR'){}
                else{
                    this.eventos = JSON.parse(this.product.activities.events);
                }
            } 
        },
        mounted(){
            if(this.prices.prices_per_ticket !== undefined){
                document.getElementById('horario').classList.add('show');
            }
        },
        methods:{
            cambiarColor(id){
               document.getElementById(id).classList.toggle("text-azulc");
            },
            filtroDetalles(string){
                if(string.includes('&lt;br/&gt;')){
                    let array = string.split('&lt;br/&gt;')
                    let template = ''
                    for(let val of array){
                        template += val+"<br/>"
                    }
                    return template;
                }
                return string;
            }
        },
        computed:{
            eventosAbiertos(){
                if(this.eventos.status == 'ERROR'){}
                else{
                    return this.eventos.filter(evt => evt.status == "open")   
                }
            }
        }
    }
</script>
<style scoped>
.text-grayc{
    color:#a9a9a9;
}
.btn{
    border-radius:0;
}
#product-img .carousel #img-product {
    height: 27em !important;
}
@media(min-width:1300px){
    #product-img .carousel #img-product {
        height: 38em !important;
    }
}
@media(max-width:767px){
    #product-img .carousel #img-product {
        height: 16em !important;
        min-width: 100% !important;
    }
}
</style>