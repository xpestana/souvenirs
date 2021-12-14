
<template>
    <Layout>
	 <div class="container tab-content dashboard-content mt-all-40">
            <div class="row">
                <div class="col-lg-8">

                    <div class="about-content mb-all-40">
                        <back/>
                       <!-- Section Title Start -->
                        <div class="shop-area mb-all-40 mt-4">
                        <!-- Grid & List Main Area End -->
                        <div id="list-view" class="tab-pane fade  show active">
                                    <!-- Single Product Start -->
                                <div class="single-aboss-product" v-for="product in order.shippings" :key="product.id">
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
                                        <ul>
                                            <li class="mb-4" style="font-size: 15px;" v-if="product.quantity">Cantidad de compra: {{ product.quantity }}</li>
                                            <li class="mb-4" style="font-size: 15px;" v-if="product.adult"> Adultos: {{ product.adult }}</li>
                                            <li class="mb-4" style="font-size: 15px;" v-if="product.children">  Niños: {{ product.children }}</li>
                                            <li class="mb-4" style="font-size: 15px;" v-if="product.date_init"> Fecha 1: {{ moment(product.date_init).format('DD/MM/YYYY') }}</li>
                                            <li class="mb-4" style="font-size: 15px;" v-if="product.date_end"> Hecha 2: {{ moment(product.date_end).format('DD/MM/YYYY') }}</li>
                                        </ul>
                            		</div>
                        		</div>
                        </div>
                        <!-- Grid & List Main Area End -->
                    </div>
                    </div>
                    <div class="col-md-12" v-if="$page.props.auth.role == 'Hotel'">
                    	<div  align="center" class="section-title section-heading">
                    		<h2 align="center" class="text-info mb-4">Contacta al vendedor:</h2>
                    	</div>
                    	<ul >
                        	<li class="mb-4"><a style="color: #31516B" href="https://api.whatsapp.com/send?phone=5804149774393&text=hola,%20acabo%20de%20comprar%20en%20HiCitty"> <i style="font-size: 25px; font-weight: 700;" class="fab fa-whatsapp"></i> Envíanos un Whatsapp</a></li>
                        	<li class="mb-4" hidden><a style="color: #31516B" href="javascript:void(0)" target="_blank"> <i style="font-size: 25px; font-weight: 700;" class="fab fa-telegram"></i> Envíanos un Telegram</a></li>
                        	<li class="mb-4"><Link style="color: #31516B" :href="route('contact')"> <i style="font-size: 25px; font-weight: 700;" class="fas fa-at"></i> Envíanos un Correo Electrónico</Link></li>
                    	</ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div  align="justify" class="section-title section-heading">
                            <h2 align="center" class="text-info">Datos de envio:</h2>
                           <ul>
                            	<li style="font-size: 15px;" class="mb-4">{{ shipping.firstname }} {{ shipping.lastname }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ shipping.email }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ shipping.address  }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ shipping.company  }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ shipping.apart  }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ shipping.city  }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ shipping.state  }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ shipping.zip_code  }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ shipping.phone   }}</li>
                            </ul>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </Layout>
</template>
<script>
     import { Head, Link } from '@inertiajs/inertia-vue3';
     import Layout from '@/Layouts/LayoutProfile.vue'
     import Back from '@/Layouts/Components/Back.vue'   
     import Moment from 'moment'

     export default {
        components: {
            Head,
            Link,
            Layout,
            Back,
        },
        props: {
            order: Object,
        },
        created(){
            this.moment=Moment;
        },
        data(){
            return{
                moment:null,
                shipping: this.order.shippings[0],    
            }
        },
    }
</script>
<style scope>
    .img-prod {
    width: 100%;
    height: 200px;
    background-size: cover !important;
    background-repeat: no-repeat !important;
    background-position: center !important;
}
</style>