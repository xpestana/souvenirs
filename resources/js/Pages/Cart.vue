<template>
    <Head title="Carrito"/>
    <Layout>
    <div class="cart-head">
        <div class="w-100 text-right pr-2 pr-md-4" style="background-color:#aad8eb;">
            <img src="/vendor_asset/img/icons/padlock.png" width="20" class="d-inline mb-1">
            <p class="ml-2 d-inline">Pago seguro</p>
        </div>

        <div class="text-center mt-3 mt-md-4" v-if="souvenirsList.length < 1 && activitiesList.length < 1">
            <p class="md:text-lg leading-4" style="color:#a3a3a3">Aun no ha sido añadida ninguna <br> actividad o souvenir</p>
        </div>
        <div class="text-center mt-3 mt-md-4">
            <h3 class="font-weight-bolder md:text-lg">Envío gratis</h3>
            <p class="md:text-base">En compras superiores a X</p>
        </div>
        <div class="container mt-2 mb-2 px-md-5" v-if="souvenirsList.length > 0">
            <div class="row justify-content-between">
                <div class="col-12 text-left">
                    <h3 class="text-lg md:text-xl">Souvenirs</h3>
                </div>  
            </div>
        </div>
    </div>

    <template v-if="souvenirsList.length < 1 && activitiesList.length < 1">
        <div class="container">
            <div class="row justify-content-center my-4">
                <div class="col-4 text-center">
                    <Link :href="route('activities')">
                        <i class="fas fa-biking text-azulc text-3xl"></i>
                        <p class="font-weight-bolder">Actividades</p>
                    </Link>
                </div>
                <div class="col-4 text-center">
                    <Link :href="route('souvenirs')">
                        <i class="fas fa-gift text-azulc text-3xl"></i>
                        <p class="font-weight-bolder">Souvenirs</p>
                    </Link>
                </div>
            </div>
        </div>
    </template>

    <template v-if="souvenirsList.length > 0">
    <div class="souvenirs-list">
        <div class="container px-4 px-md-5">
            <template v-for="product in souvenirsList" :key="product.id">
                <div  class="row p-2 mt-1"  style="background-color:#ededed;" v-if="product.name">
                    <div class="col-3 col-md-2 px-0" >
                        <Link :href="route('product.souvenir.show',{product : product.id})">
                            <img :src="'/storage/souvenirs/'+product.attributes.url" alt="product" class="h-16  w-100 md:h-24">                    
                        </Link>
                    </div>
                    <div class="col-8 col-md-9 pl-2 pr-0 d-flex flex-column justify-content-between" v-if="product.name">
                        <div class="product d-flex justify-between">
                            <div class="product-name">
                                <p class="d-inline text-sm md:text-xl font-weight-bolder">
                                {{ product.name }}
                                    <!-- <Link :href="route('product.souvenir.show',{product : product.id})"></Link> -->
                                </p>
                            </div>
                            <div class="product-price pr-1">
                                <p class="text-sm md:text-xl font-weight-bolder">{{ product.price*product.quantity }} €</p>
                            </div>
                        </div>
                        <div class="quantity-product d-inline-flex mb-md-1">
                            <p class="text-xs md:text-lg pr-2">Cantidad</p>
                            <input type="text" class="w-11 h-5 border rounded ml-md-2 md:w-12 md:h-7" :value="product.quantity">
                            <div class="ml-1 ml-md-2 pt-md-1 quantity-buttons">
                                <a href="javascript:void(0)"><i class="fas fa-angle-up d-block" @click="upCart(product.id,product.quantity)"></i></a>
                                <a href="javascript:void(0)"><i class="fas fa-angle-down d-block" @click="downCart(product.id)"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 px-2 text-right" v-if="product.name">
                        <a href="javascript:void(0)"  @click="deleteCart(product.id)"><i id="trash" class="fas fa-trash" style="color:#9e9e9e"></i></a>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <div class="totales">
        <div class="container px-4 px-md-5">
            <div class="row justify-content-between">
                <div class="col-5 text-center mt-3 px-0 pl-1">
                    <p class="text-muted">Resumen del pedido</p>
                    <p class="text-center text-muted">({{n_souvenirs}})</p>
                </div>
                <div class="col-6 text-right mt-3 px-0 pr-1">
                    <p class="text-muted leading-4">Sub total: {{sub_total}} €</p>
                    <p class="text-muted leading-4">Costes del envío:  {{costo_envio}}€</p>
                    <p class="text-muted leading-4">Envío gratuito: -{{costo_gratuito}}€</p>
                    <p class="leading-4">Total Souvenirs {{total_souvenirs}}€</p>
                </div>
            </div>
            <div class="row mt-3" v-if="sub_total < n_gratuito">
                <div class="col-12 px-0 text-center">
                    <h4 class="text-sm text-muted">¡Te faltan {{diferencia.toFixed(2)}}€ para conseguir envío gratuito!</h4>
                    <Link :href="route('souvenirs')"><h3 class="text-base text-primary">Añade otro souvenir</h3></Link>
                </div>
            </div>
        </div>
    </div>
    </template>

    <template v-if="souvenirsList.length > 0 || activitiesList.length > 0">
    <div class="w-100 border-bottom border-dark my-2"></div>

    <div class="actividades">
        <div class="container mt-1 mb-2 px-4 px-md-5">
            <div class="row justify-content-between">
                <div class="col-12 text-left mb-1">
                    <h3 class="text-lg md:text-xl">Actividades</h3>
                </div>
                <div class="col-12 text-center" v-if="activitiesList.length < 1">
                    <h4 class="text-sm md:text-lg text-muted">¿Vas a perderte nuestras actividades?</h4>
                    <Link :href="route('activities')"><h4 class="text-base md:text-xl text-primary">¡Echales un ojo!</h4></Link>
                </div>         
            </div>
            <template v-for="act in activitiesList" :key="act.id">
                <div  class="row p-2 mt-1"  style="background-color:#ededed;" v-if="activitiesList.length > 0">
                    <div class="col-3 col-md-2 px-0" >
                        <Link :href="route('product.souvenir.show',{product : act.id})">
                            <img :src="'/storage/souvenirs/'+act.attributes.url" alt="product" class="h-16  w-100 md:h-24">                    
                        </Link>
                    </div>
                    <div class="col-8 col-md-9 pl-2 pr-0 d-flex flex-column justify-content-between" v-if="act.name">
                        <div class="product">
                            <div class="product-name">
                                <p class="text-sm md:text-xl">{{ act.name }}</p>
                            </div>
                            <div class="product-price pr-1">
                                <p class="text-sm md:text-xl">Adultos: {{ act.attributes.adult }}</p>
                                <p class="text-sm md:text-xl">Niños: {{ act.attributes.children }}</p>
                                <p class="text-sm md:text-xl">Total: {{ act.attributes.priceA*Number(act.attributes.adult) + act.attributes.priceN*Number(act.attributes.children)}}€</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 px-2 text-right" v-if="act.name">
                        <a href="javascript:void(0)"  @click="deleteCart(act.id)"><i id="trash" class="fas fa-trash" style="color:#9e9e9e"></i></a>
                    </div>
                </div>
            </template>
        </div>
    </div>
    </template>
    <template v-if="souvenirsList.length > 0 || activitiesList.length > 0">
    <div class="w-100 border-bottom border-dark my-2"></div>
    
    <div class="importe">
        <div class="container mt-3 px-md-5">
            <div class="row justify-content-between">
            <div class="col-6 text-left">
                <p class="d-inline text-base">Importe total: <b>{{total}}€</b> </p>
            </div>
            <div class="col-5 text-right">
                <Link class="btn btn-info rounded-xl px-3 py-1 text-white opacity-60" :href="route('checkout.souvenirs')">Pagar</Link>
            </div>
        </div>
        </div>
    </div>
    </template>
    
    <div class="row justify-content-md-end">
        <div class="col-12 col-md-4">
            <Transition>
                <div v-if="showPopup" class="fixed-bottom" id="popup">
                    <div class="alert alert-primary alert m-0 text-center py-4 text-muted" role="alert" style="background-color:#d8ecf3" v-html="$page.props.flash.mensaje">
                    </div>
                </div>
            </Transition>
        </div>
    </div>
</Layout>

</template>

<script>

    import { Inertia } from '@inertiajs/inertia';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Layout from '@/Layouts/Layout.vue'        
    import Total from '@/Pages/Total.vue' 

    export default {
        components: {
            Head,
            Link,
            Layout,
            Total
        },
        created(){
            this.totalesSouvenirs();
            console.log(this.activitiesList)
        },
        updated(){
            this.totalesSouvenirs();
            if(this.$page.props.flash.mensaje){
                this.showPopup=true;
            }
            setTimeout(()=>this.showPopup=false, 3000);
        },
        data() {
            return {
                sub_total: null,
                total_souvenirs: 0,
                total: null,
                n_souvenirs:0,
                n_gratuito:20,
                diferencia:0,
                costo_envio:5,
                costo_gratuito:0,
                formCart: this.$inertia.form({
                    quantity: 1, 
                }),
                showPopup:false
            }
        },
        methods: {
            upCart(id,quantity) {
                this.formCart.quantity = quantity;
                this.formCart.put(route('cart.update',{checkout: id}),{
                    _token: this.$page.props.csrf_token,
                    preserveScroll: true,
                })
            },
            downCart(id) {
               this.$inertia.delete(route('cart.destroy',{checkout : id, update:true}),
                    {
                        preserveScroll: true,
                    })
            },
            deleteCart(id){
                document.getElementById('trash').classList.add('text-danger');
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
            },
            totalesSouvenirs(){
                var cart = this.$page.props.cart;
                var total = 0;
                var total_souvenirs = 0;
                var total_activities = 0;
                let numero_souvenirs = 0;

                Object.keys(cart).forEach(function(key) {
                    if (cart[key].name) {
                        if (cart[key].attributes.type == 'souvenir') {
                            total += (cart[key].price * cart[key].quantity);
                            numero_souvenirs +=cart[key].quantity;
                            total_souvenirs += (cart[key].price * cart[key].quantity);
                        }
                        if (cart[key].attributes.type == 'activity') {
                            total_activities = (Number(cart[key].attributes.adult) * cart[key].attributes.priceA) + (Number(cart[key].attributes.children) * cart[key].attributes.priceN);
                        }
                    }
                });
                    
                this.n_souvenirs = numero_souvenirs == 1 ? numero_souvenirs+' artículo' : numero_souvenirs+' artículos';
                this.total_souvenirs = total_souvenirs;
                this.sub_total = total;
                this.diferencia = this.n_gratuito -this.sub_total;
                if (total_souvenirs < 20 && total_souvenirs > 0) {
                    total += this.costo_envio ;
                    this.total_souvenirs+= this.costo_envio;
                    this.costo_gratuito = 0;
                }
                else{
                    total = this.sub_total ;
                    this.costo_gratuito = this.costo_envio;
                }
                this.total = total+total_activities;
                }
        },
        computed:{
            souvenirsList(){
                let cart = this.$page.props.cart;
                let largo = Number(Object.values(cart).length) - 2;
                let array = Object.values(cart).splice(0,largo);
                return array.filter((product)=> product.attributes.type =="souvenir")
            },
            activitiesList(){
                let cart = this.$page.props.cart;
                let largo = Number(Object.values(cart).length) - 2;
                let array = Object.values(cart).splice(0,largo);
                return array.filter((product)=> product.attributes.type =="activity")
            }
        }
}

</script>
<style src="@vueform/slider/themes/default.css"></style>
<style scope>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0; 
}
.img-cart-2 {
    width: 100%;
    height: 120px;
    background-size: cover !important;
    background-repeat: no-repeat !important;
    background-position: center !important;
}
.souvenirs-list .quantity-buttons{
    margin-top: -4px;
    color:#cacaca;
}
</style>