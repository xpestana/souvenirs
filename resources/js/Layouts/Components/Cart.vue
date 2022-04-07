<template>
            <li class="pb-0 mb-0 pl-0 lis" style="padding-top:1.2em">
                <Link :href="route('cart.index')" class="pr-0" style="opacity:0.4">
                    <img class="d-inline" src="/vendor_asset/img/carts.png" alt="logo"  width="30">
                    <span>{{ $page.props.cart.count }}</span>
                </Link>
                <!-- Cart Box Start -->
                <ul class="ht-dropdown cart-box-width">
                    <template v-for="product in $page.props.cart" :key="product.id">
                    	
                    <li class="single-cart-box" v-if="product.name">
                        <div class="cart-img">
                            <Link :href="route('product.souvenir.show',{product : product.id})">
                            	<div :style="'background:url(/storage/souvenirs/'+product.attributes.url+')'" class="img-cart"></div>
                            </Link>
                        </div>
                        <div class="cart-content">
                            <h6><a :href="route('product.souvenir.show',{product : product.id})">{{ product.name }} </a></h6>
                            <span class="cart-price" v-if="product.attributes.type == 'souvenir'">{{ product.price }} €</span>
                            <span class="cart-price" v-if="product.attributes.type == 'activity'">
                                <template v-if="product.attributes.priceN">
                                    Adultos: {{ product.attributes.priceA }} € <br>Niños: {{ product.attributes.priceN }} €
                                </template>
                                <template v-else>
                                    Precio: {{ product.attributes.priceA }} €
                                </template>
                            </span>
                            <span v-if="product.attributes.type == 'souvenir'">Cantidad: {{ product.quantity }}</span>
                            <span><a href="javascript:void(0)" class="text-danger" @click="deleteCart(product.id)"><i class="ion-close"></i> Eliminar</a></span>
                        </div>
                    </li>
                    </template>
                    <li class="cart-footer">
                        <ul class="price-content">
                            <li hidden>Sub-total <span>{{ sub_total }} €</span></li>
                            <li v-if="total_souvenirs<40  && total_souvenirs > 0">Envío <span>5 €</span></li>
                            <li>Total <span>{{ total }} €</span></li>
                        </ul>
                        <div class="cart-actions text-center">
                            <Link class="cart-checkout" :href="route('checkout.souvenirs')">Pagar Ahora</Link>
                        </div>
                    </li>
                </ul>
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
                sub_total: null,
                total_souvenirs: 0,
                total: null
            }
        },
        created(){
            var cart = this.$page.props.cart;
            var total = 0;
            var total_souvenirs = 0;

            Object.keys(cart).forEach(function(key) {
                if (cart[key].name) {
                    if (cart[key].attributes.type == 'souvenir') {
                        total += (cart[key].price * cart[key].quantity);
                        total_souvenirs += (cart[key].price * cart[key].quantity);
                    }else{
                        if (cart[key].attributes.priceN) {
                            total += ((cart[key].attributes.adult * cart[key].attributes.priceA) +  (cart[key].attributes.children * cart[key].attributes.priceN));
                        }else{
                            total += ((cart[key].attributes.adult * cart[key].attributes.priceA) +  (cart[key].attributes.children * cart[key].attributes.priceA));
                        }
                    }
                }
            });
            this.total_souvenirs = total_souvenirs;
            this.sub_total = total;
            if (total_souvenirs < 40 && total_souvenirs > 0) {
                total += 5 ;
            }
            this.total = total;
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
    .lis > a > span {
        right: -21px !important;
        top: 5px !important;
    }
</style>