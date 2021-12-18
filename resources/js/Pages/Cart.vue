<template>
    <Head title="Carrito"/>
    <Layout>
    <Breadcrumb title="Carrito"/>
     <!-- Cart Main Area Start -->
    <div class="cart-main-area white-bg ptb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                        <!-- Table Content Start -->
                        <div class="table-content table-responsive mb-45">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Imagen</th>
                                        <th class="product-name">Producto</th>
                                        <th class="product-price">Precio</th>
                                        <th class="product-quantity">Cantidad</th>
                                        <th class="product-subtotal">Total</th>
                                        <th class="product-remove">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="product in $page.props.cart" :key="product.id">
                                        <tr v-if="product.name">
                                            <td class="product-thumbnail">
                                                <Link :href="route('product.souvenir.show',{product : product.id})">
                                                    <div :style="'background:url(/storage/souvenirs/'+product.attributes.url+')'" class="img-cart-2"></div>
                                                </Link>
                                            </td>
                                            <td class="product-name">
                                                <Link :href="route('product.souvenir.show',{product : product.id})">{{ product.name }}</Link>
                                            </td>
                                            <td class="product-price" v-if="product.attributes.type == 'souvenir'">
                                                <span class="amount">{{ product.price }} €</span>
                                            </td>
                                            <td class="product-price"  v-if="product.attributes.type == 'activity'">
                                                <template v-if="product.attributes.priceN">
                                                    Adultos: {{ product.attributes.priceA }} € <br>Niños: {{ product.attributes.priceN }} €
                                                </template>
                                                <template v-else>
                                                    Precio: {{ product.attributes.priceA }} €
                                                </template>
                                            </td>
                                            <td class="product-quantity" v-if="product.attributes.type == 'souvenir'">
                                                <a href="javascript:void(0)" class="mr-3" @click="upCart(product.id)"><i style="color: #31516B" class="fas fa-plus"></i></a> 
                                                <strong>{{ product.quantity }}</strong> 
                                                <a href="javascript:void(0)" class="ml-3" @click="downCart(product.id)"><i style="color: #31516B" class="fas fa-minus"></i></a>
                                            </td>
                                            <td class="product-quantity"   v-if="product.attributes.type == 'activity'"> 
                                                Adultos: {{ product.attributes.adult }}<br>
                                                Niños: {{ product.attributes.children }}
                                            </td>
                                            <td class="product-subtotal"  v-if="product.attributes.type == 'souvenir'">{{ product.quantity * product.price }} €</td>
                                            <td class="product-subtotal"  v-if="product.attributes.type == 'activity'">
                                                {{ calculate(product.attributes.priceA, product.attributes.priceN, product.attributes.adult, product.attributes.children) }} €
                                            </td>
                                            <td class="product-remove"> <a href="javascript:void(0)"  @click="deleteCart(product.id)"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        <!-- Table Content Start -->
                        <div class="row">
                           <!-- Cart Button Start -->
                            <div class="col-md-8 col-sm-12">
                                <div class="buttons-cart">
                                    <Link class="bg-secondary" :href="route('souvenirs')">Continuar Comprando</Link>
                                </div>
                            </div>
                            <!-- Cart Button Start -->
                            <!-- Cart Totals Start -->
                            <Total :key="$page.props.flash.id"/>
                            
                            <!-- Cart Totals End -->
                        </div>
                        <!-- Row End -->
                </div>
            </div>
             <!-- Row End -->
        </div>
    </div>
    <!-- Cart Main Area End -->
</Layout>
<QuickView /> <!--Sidebar-->
</template>

<script>

    import { Inertia } from '@inertiajs/inertia';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Layout from '@/Layouts/Layout.vue'        
    import Breadcrumb from '@/Layouts/Components/Breadcrumb.vue'    
    import Total from '@/Pages/Total.vue' 

    export default {
        components: {
            Head,
            Link,
            Layout,
            Breadcrumb,
            Total
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
<style src="@vueform/slider/themes/default.css"></style>
<style scope>
    .img-cart-2 {
    width: 100%;
    height: 120px;
    background-size: cover !important;
    background-repeat: no-repeat !important;
    background-position: center !important;
}
</style>