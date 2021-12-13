<template>
	<li><Link :href="route('cart.index')"><i class="header-cart icon-cart"></i><span>{{ $page.props.cart.count }}</span></Link>
                <!-- Cart Box Start -->
                <ul class="ht-dropdown cart-box-width">
                    <!-- Single Cart Box Start -->
                    <template v-for="product in $page.props.cart" :key="product.id">
                    	
                    <li class="single-cart-box" v-if="product.name">
                        <div class="cart-img">
                            <Link :href="route('product.souvenir.show',{product : product.id})">
                            	<div :style="'background:url(/storage/souvenirs/'+product.attributes.url+')'" class="img-cart"></div>
                            </Link>
                        </div>
                        <div class="cart-content">
                            <h6><a :href="route('product.souvenir.show',{product : product.id})">{{ product.name }} </a></h6>
                            <span class="cart-price">{{ product.price }} €</span>
                            <span>Cantidad: {{ product.quantity }}</span>
                            <span><a href="javascript:void(0)" class="text-danger" @click="deleteCart(product.id)"><i class="ion-close"></i> Eliminar</a></span>
                        </div>
                    </li>
                    </template>
                    <!-- Single Cart Box End -->
                    <!-- Cart Footer Inner Start -->
                    <li class="cart-footer">
                        <ul class="price-content">
                            <li>Productos <span>{{ $page.props.cart.count }}</span></li>
                            <li>Total <span>{{ this.$page.props.cart.total }} €</span></li>
                        </ul>
                        <div class="cart-actions text-center">
                            <Link class="cart-checkout" :href="route('checkout.souvenirs')">Checkout</Link>
                        </div>
                    </li>
                    <!-- Cart Footer Inner End -->
                </ul>
                <!-- Cart Box End -->
            </li>
</template>
<script>
	 import { Link } from '@inertiajs/inertia-vue3';

	export default{
        components: {
        	Link
        },
        data(){
            return {
            	count: null,
            }
        },
        methods: {
            deleteCart(id){
                this.$inertia.delete(route('cart.destroy',{checkout : id}),
                    {
                        preserveScroll: true,
                    })
            }
        }
    }
</script>
<style scope>
	.img-cart {
    width: 100%;
    height: 65px;
    background-size: cover !important;
    background-repeat: no-repeat !important;
    background-position: center !important;
}
</style>