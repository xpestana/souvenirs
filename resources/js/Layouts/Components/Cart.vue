<template>
            <li class="pb-0 mb-0 pl-0 lis" style="padding-top:1.2em">
                <Link :href="route('cart.index')" class="pr-0" style="opacity:0.4">
                    <img class="d-inline pt-0.5" src="/vendor_asset/img/icons/carrito.png" alt="logo"  width="30">
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
                                <span class="cart-price">Precio: <Decimals :precio="Number(calcPrecioAct(product.attributes.pedido))" /> €</span>
                            </template>
                            <span v-if="product.attributes.type == 'souvenir'">Quantity: {{ product.quantity }}</span>
                            <span><a href="javascript:void(0)" class="text-danger" @click="deleteCart(product.id)"><i class="ion-close"></i> Remove</a></span>
                        </div>
                    </li>
                    </template>
                    <li class="cart-footer">
                        <ul class="price-content">
                            <li hidden>Sub-total <span>{{ sub_total }} €</span></li>
                            <li v-if="total_souvenirs<Number($page.props.settings.shippings)  && total_souvenirs > 0">Shipping <span> 5 €</span></li>
                            <li>Total <span> <Decimals :precio="Number(total)" /> €</span></li>
                        </ul>
                        <div class="cart-actions text-center">
                            <Link class="cart-checkout" :href="route('checkout.souvenirs')">Pay Now</Link>
                        </div>
                    </li>
                </ul>
            </li>
</template>
<script>
    import { Link } from '@inertiajs/inertia-vue3';
    import Decimals from '@/Layouts/Components/Decimals.vue'
	export default{
        components: {
        	Link,
            Decimals
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
            this.calcularTotal()
        },
        updated(){
            this.calcularTotal()
        },
        methods: {
            calcularTotal(){
                var cart = this.$page.props.cart;
                var total = 0;
                var total_souvenirs = 0;

                Object.keys(cart).forEach(function(key) {
                    if (cart[key].name) {
                        if (cart[key].attributes.type == 'souvenir') {
                            total += (cart[key].price * cart[key].quantity);
                            total_souvenirs += (cart[key].price * cart[key].quantity);
                        }else{
                            for(let act of cart[key].attributes.pedido){
                                if(Number(act.split(':')[0]) > 0){
                                    total += Number(act.split(':')[0])*Number(act.split(':')[1])
                                }
                            }
                        }
                    }
                });
                this.total_souvenirs = total_souvenirs;
                this.sub_total = total;
                if (total_souvenirs < Number(this.$page.props.settings.shippings) && total_souvenirs > 0) {
                    total += 5 ;
                }
                this.total = total;
            },
            calcPrecioAct(actividad){
                let total = 0;
                for(let act of actividad){
                    if(Number(act.split(':')[0]) > 0){
                        total += Number(act.split(':')[0])*Number(act.split(':')[1])
                    }
                }
                return total.toFixed(2);
            },
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