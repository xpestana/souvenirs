<template>
            <li class="pb-0 mb-0 pl-0 lis" style="padding-top:1.2em">
                <Link :href="route('cart.index')" class="pr-0" style="opacity:0.4">
                    <img class="d-inline" src="/vendor_asset/img/carts.png" alt="logo"  width="30">
                    <span>{{ $page.props.cart.count }}</span>
                </Link>
                <!-- Cart Box Start -->
                <ul class="ht-dropdown cart-box-width overflow-auto max-h-96">
                    <template v-for="product in $page.props.cart" :key="product.id">
                    	
                    <li class="single-cart-box" v-if="product.name">
                        <div class="cart-img">
                            <template v-if="product.attributes.type == 'souvenir'">
                                <Link :href="route('product.souvenir.show',{product : product.id})">
                            	    <div :style="'background:url(/storage/souvenirs/'+product.attributes.url+')'" class="img-cart"></div>
                                </Link>    
                            </template>
                            <template v-if="product.attributes.type == 'activity'">
                                <Link :href="route('product.activities.show',{product : product.id})">
                                    <template v-if="product.images !== undefined">
                                        <div :style="'background:url('+product.images[0].name+')'" class="img-cart"></div>
                                    </template>
                                </Link>
                            </template>
                        </div>
                        <div class="cart-content">
                            <h6>
                                <template v-if="product.attributes.type == 'activity'">
                                    <a :href="route('product.activities.show',{product : product.id})">{{ product.name }} </a>
                                </template>
                                <template v-if="product.attributes.type == 'souvenir'">
                                    <a :href="route('product.souvenir.show',{product : product.id})">{{ product.name }} </a>
                                </template>
                            </h6>
                            <span class="cart-price" v-if="product.attributes.type == 'souvenir'">{{ product.price }} €</span>
                            <template v-if="product.attributes.type == 'activity'">
                                <span class="cart-price">Precio: {{ Number(product.attributes.adult) * Number(product.attributes.priceAdult) +  Number(product.attributes.children) * Number(product.attributes.priceChildren) +  Number(product.attributes.student) * Number(product.attributes.priceStudent) +  Number(product.attributes.baby) * Number(product.attributes.priceBaby) }} €</span>
                            </template>
                            <span v-if="product.attributes.type == 'souvenir'">Cantidad: {{ product.quantity }}</span>
                            <span><a href="javascript:void(0)" class="text-danger" @click="deleteCart(product.id)"><i class="ion-close"></i> Eliminar</a></span>
                        </div>
                    </li>
                    </template>
                    <li class="cart-footer">
                        <ul class="price-content">
                            <li hidden>Sub-total <span>{{ sub_total }} €</span></li>
                            <li v-if="total_souvenirs<40  && total_souvenirs > 0">Envío <span> 5 €</span></li>
                            <li>Total <span> {{ total }}€</span></li>
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
                        if (cart[key].attributes !== null) {
                            total += Number(cart[key].attributes.adult) * Number(cart[key].attributes.priceAdult) +  Number(cart[key].attributes.children) * Number(cart[key].attributes.priceChildren) +  Number(cart[key].attributes.student) * Number(cart[key].attributes.priceStudent) +  Number(cart[key].attributes.baby) * Number(cart[key].attributes.priceBaby);
                        }else{
                            total += 0;
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