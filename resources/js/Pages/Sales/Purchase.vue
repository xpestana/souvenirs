<template>
    <Head title="Compra"/>
    <Layout>
    <div class="d-none d-md-block">
        <Breadcrumb title="Compra"/>
    </div>
    <div class="skill-area white-bg ptb-80 d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="about-content mb-all-40">
                       <!-- Section Title Start -->
                        <div class="section-title section-heading">
                            <h2 class="text-info">Gracias por su compra</h2>
                        </div>
                        <div class="shop-area mb-all-40">
                        <!-- Grid & List Main Area End -->
                        <div class="tab-content Products-area">
                            <div id="grid-view" class="tab-pane fade  show active">
                                <div class="row">
                                    <div v-for="product in order.shippings" :key="product.id" class="col-lg-4 col-md-4 col-sm-6">
                                    <!-- Single Product Start -->
                                        <div class="single-aboss-product mb-3">
                                            <div class="pro-img">
                                                <Link :href="route('product.souvenir.show',{product : product.product.id})">
                                                    <div :style="'background:url(/storage/souvenirs/'+product.product.images[0].url+')'" class="img-prod"></div>
                                                </Link>
                                                <div class="pro-actions">
                                                    <Link class="quick-view" :href="route('product.souvenir.show',{product : product.product.id})"><i class="icon-zoom"></i></Link>
                                                </div>
                                            </div>
                                            <div class="pro-content">
                                                <h4><Link :href="route('product.souvenir.show',{product : product.product.id})">{{ product.product.title }}</Link></h4>
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
                    </div>
                </div>
                <div class="col-lg-4">
                    <div  align="center" class="section-title section-heading">
                            <h2 class="text-info">Comunicate con el vendedor</h2>
                        </div>
                    <ul>
                        <li class="mb-4"><a style="color: #31516B" href="https://api.whatsapp.com/send?phone=5804149774393&text=hola,%20acabo%20de%20comprar%20en%20HiCitty"> <i style="font-size: 25px; font-weight: 700;" class="fab fa-whatsapp"></i> Envíanos un Whatsapp</a></li>
                        <li class="mb-4" hidden><a style="color: #31516B" href="javascript:void(0)" target="_blank"> <i style="font-size: 25px; font-weight: 700;" class="fab fa-telegram"></i> Envíanos un Telegram</a></li>
                        <li class="mb-4"><Link style="color: #31516B" :href="route('contact')"> <i style="font-size: 25px; font-weight: 700;" class="fas fa-at"></i> Envíanos un Correo Electrónico</Link></li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-section bg-light p-0">
        <div class="titulos text-center pt-5">
            <h1 class="text-muted font-weight-bolder text-3xl">¡Tu pago se ha <br> realizado con éxito!</h1>
            <h5 class="text-muted text-lg">En unos minutos recibirá su pedido</h5>
        </div>
        <div class="logo">
            <img class="mx-auto" src="/vendor_asset/img/logo/logo.png" alt="logo">
        <div class="order-num pb-5">
        </div>
            <h3 class="text-muted font-weight-bolder text-xl text-center">Número de pedido:S8GL</h3>
        </div>
    </div>
   </Layout> 	 
</template>

<script>
    import { Inertia } from '@inertiajs/inertia';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Layout from '@/Layouts/Layout.vue'        
    import Breadcrumb from '@/Layouts/Components/Breadcrumb.vue'     

    export default {
        components: {
            Head,
            Link,
            Layout,
            Breadcrumb,
        },
        created () {
            //console.log(this.order.shippings[0].product.images.);
        },
        props: {
            order: Object,
        },
        methods: {
            
        }
}

</script>
<style scope>
    .img-prod {
    width: 100%;
    height: 150px;
    background-size: cover !important;
    background-repeat: no-repeat !important;
    background-position: center !important;
}
.logo img{
    height: 15em;
    min-width: 14em !important;
}
</style>