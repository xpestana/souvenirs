<template>
	 <!-- Product Thumbnail Description End -->
    <div class="best-seller-area pt-60 pb-50">
        <div class="container">
            <div class="section-title text-center mb-45">
                <h2>Souvenirs</h2>
                <p>Otras ofertas disponibles.</p>
            </div>
            <div class="best-seller-active owl-carousel">
                <Carousel :settings="settings" :breakpoints="breakpoints" :wrap-around="true" :autoplay="4000">
                    <Slide v-for=" product in $page.props.souvenirs" :key="product.id">
                        <div  class="single-aboss-product w-100 p-4">
                            <div class="pro-img">
                                <Link :href="route('product.souvenir.show',{product : product.id})">
                                    <template v-if="product.images.length != 0">
                                        <div :style="'background:url(/storage/souvenirs/'+product.images[0].url+')'" class="img-slide"></div>
                                    </template>
                                </Link>
                                <div class="pro-actions">
                                    <Link :href="route('product.souvenir.show',{product : product.id})" data-toggle="modal" data-target="#product-window" class="quick-view"><i class="far fa-eye"></i></Link>
                                </div>
                            </div>
                            <div class="pro-content">
                                <h4><Link :href="route('product.souvenir.show',{product : product.id})">{{ product.title }}</Link></h4>
                                <div class="pro-price-cart">
                                    <div class="pro-home-price">
                                        <span>€ {{ product.price }}</span>
                                    </div>
                                    <div class="pro-cart">
                                        <Link title="Añadir Al Carrito" @click="cart(product.id)"><i class="icon-cart"></i></Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Slide>
                    <template #addons>
                        <Navigation />
                        </template>
                    </Carousel>
            </div>
        </div>
    </div>
</template>
<script>
	import { Link, Head } from '@inertiajs/inertia-vue3'
	import { Carousel, Navigation, Slide } from 'vue3-carousel'
    import 'vue3-carousel/dist/carousel.css';

	export default {
		components: {
            Link,
            Head,
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
        methods: {
            cart(id){
                this.$inertia.put(route('cart.update',{checkout: id}),{
                    preserveScroll: true
                })
            }
        }
	}
</script>
<style scope>
	.img-slide{
		width: 100%;
    	height: 250px;
    	background-size: cover !important;
    	background-repeat: no-repeat !important;
    	background-position: center !important;
	}
</style>