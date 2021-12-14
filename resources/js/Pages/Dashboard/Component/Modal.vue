<template>
	 <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="about-content mb-all-40">
                       <!-- Section Title Start -->
                        <div class="shop-area mb-all-40">
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
                                    	<p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
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
                            	<li style="font-size: 15px;" class="mb-4">{{ order.shippings[0].firstname }} {{ order.shippings[0].lastname }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ order.shippings[0].email }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ order.shippings[0].address  }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ order.shippings[0].company  }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ order.shippings[0].apart  }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ order.shippings[0].city  }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ order.shippings[0].state  }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ order.shippings[0].zip_code  }}</li>
    							<li style="font-size: 15px;" class="mb-4">{{ order.shippings[0].phone   }}</li>
                            </ul>
                    </div>
                    
                    
                </div>
            </div>
        </div>
</template>
<script>
	 import { Head, Link } from '@inertiajs/inertia-vue3';

	 export default {
        components: {
            Head,
            Link,
        },
        props: {
            order: Object,
        },
        created(){
        	console.log(this.order);
        },
        data(){
        	return{
        		shipping: this.order.shippings[0],	
        	}
        },
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
</style>