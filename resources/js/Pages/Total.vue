<template>
	<div class="col-md-4 col-sm-12">
    	<div class="cart_totals float-md-right text-md-right">
        	<h2>Total carrito</h2>
            <br />
            <table class="float-md-right">
            	<tbody>
                	<tr class="cart-subtotal">
                    	<th>Sub-total</th>
                        <td><span class="amount">{{ sub_total }} €</span></td>
                    </tr>
                    <tr class="cart-subtotal" v-if="total_souvenirs<40 && total_souvenirs > 0">
                    	<th>Envío</th>
                        <td><span class="amount">5 €</span></td>
                    </tr>
                    <tr class="order-total">
                    	<th>Total</th>
                        <td>
                        	<strong><span class="amount">{{ total }} €</span></strong>
                        </td>
                    </tr>
                </tbody>
            </table>
         	<div class="wc-proceed-to-checkout">
            	<Link class="bg-info" :href="route('checkout.souvenirs')">Pagar Ahora</Link>
            </div>
        </div>
    </div>
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
            Breadcrumb
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
            if (total_souvenirs <= 40 && total_souvenirs > 0) {
                total += 5 ;
            }
            this.total = total;
        },
        data() {
            return {
                sub_total: null,
                total_souvenirs: 0,
                total: null
            }
        },
        methods: {
            upCart(id) {
               this.$inertia.put(route('cart.update',{checkout: id}),{
                    preserveScroll: true
                })
            },
            downCart(id) {
               this.$inertia.delete(route('cart.destroy',{checkout : id, update:true}),
                    {
                        preserveScroll: true,
                    })
            },
            deleteCart(id){
                this.$inertia.delete(route('cart.destroy',{checkout : id}),
                    {
                        preserveScroll: true,
                    })
            },
            calculate(priceA, priceN, adult, children){
                if (priceN) {
                    var amount = ((adult * priceA) +  (children * priceN));
                }else{
                    var amount = ((adult * priceA) +  (children * priceA));
                }
                return amount;
            }
        }
}

</script>