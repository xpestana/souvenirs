<template>
    <Head title="Checkout"/>
    <Layout>
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumb-area pt-65 pb-70 bg-img" style="background-image:url(/vendor_asset/img/bg-image/hop-brech-bg.jpg);">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h3>Checkout</h3>
                <ol class="breadcrumb breadcrumb-list" hidden>
                    <li class="breadcrumb-item"><Link :href="route('home')">Inicio</Link></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->

    <!-- checkout-area start -->
    <div class="checkout-area white-bg pt-60 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form mb-sm-40">
                        <h3>Detalles de Facturación</h3>
                        <div class="row">
                            <div class="col-md-12" hidden>
                                <div class="country-select clearfix mb-30">
                                    <label>País <span class="required">*</span></label>
                                    <select id="country" class="wide" v-model="form.country">
                                        <option  v-for="(country, index) in countries" :value="index">{{ country }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-sm-30">
                                    <label>Nombre <span class="required">*</span></label>
                                    <input type="text" placeholder="" v-model="form.firstname"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Apellido <span class="required">*</span></label>
                                    <input type="text" placeholder="" v-model="form.lastname"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Dirección <span class="required">*</span></label>
                                    <input type="text" placeholder="Calle" v-model="form.address"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mtb-30">
                                    <input type="text" placeholder="Apartamento, suite, unidad etc. (opcional)" v-model="form.apart"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label>Poblado / Ciudad <span class="required">*</span></label>
                                    <input type="text" placeholder="Poblado / Ciudad" v-model="form.city"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Estado / Provincia <span class="required">*</span></label>
                                    <input type="text" placeholder="Estado / Provincia" v-model="form.state"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Nro de habitación <span class="required">*</span></label>
                                    <input type="text" placeholder="Nro de habitación" v-model="form.hab"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Código Postal <span class="required">*</span></label>
                                    <input type="text" placeholder="Código postal" v-model="form.zip_code"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Correo <span class="required">*</span></label>
                                    <input type="email" placeholder="" v-model="form.email"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Teléfono  <span class="required">*</span></label>
                                    <input type="text" placeholder="Teléfono" v-model="form.phone"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row px-0">
                        <div class="col-12">
                            <img src="/vendor_asset/img/logo/logo.png" class="mx-auto w-12">
                        </div>
                        <div class="col-12 border-bottom border-dark"></div>
                        <div class="col-12 d-flex justify-between pt-1 px-1">
                            <div>
                                <img src="/vendor_asset/img/icons/visa.png" class="d-inline w-10">
                                <img src="/vendor_asset/img/icons/mastercard.png" class="d-inline w-10">
                                <img src="/vendor_asset/img/icons/redsys.png" class="d-inline ml-2 w-14">
                            </div>
                            <div>
                                <img src="/vendor_asset/img/icons/padlock.png" class="d-inline mr-2 w-4">
                                <p class="d-inline">Pago seguro</p>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <p class="text-muted">Resumen:</p>
                            <div class="d-flex justify-between" v-if="totalSouvenirs.num > 0">
                                <p class="text-muted">
                                <template v-if="totalSouvenirs.num > 1">
                                    {{totalSouvenirs.num}} souvenirs
                                </template>
                                <template v-if="totalSouvenirs.num == 1">
                                    {{totalSouvenirs.num}} souvenir
                                </template>
                                </p>
                                <p class="font-weight-bolder text-muted"><Decimals :precio="totalSouvenirs.precio"/>€</p>
                            </div>
                            <div class="d-flex justify-between" v-if="totalActivities.num > 0">
                                <p class="text-muted">
                                    <template v-if="totalActivities.num > 1">
                                        {{totalActivities.num}} actividades
                                    </template>
                                    <template v-if="totalActivities.num == 1">
                                        {{totalActivities.num}} actividad
                                    </template>
                                </p>
                                <p class="font-weight-bolder text-muted"><Decimals :precio="totalActivities.precio"/>€</p>
                            </div>
                            <div class="d-flex justify-between" v-if="totalSouvenirs.precio > 0 || totalActivities.precio > 0">
                                <p class="text-muted">Envío</p>
                                <p class="font-weight-bolder text-muted" v-if="totalSouvenirs.precio < this.$page.props.settings.shippings"><Decimals :precio="5"/>€</p>
                                <p class="font-weight-bolder text-muted" v-else>GRATIS</p>
                            </div>
                            <div class="d-flex justify-between mt-2">
                                <p class="font-weight-bolder">Importe</p>
                                <p class="font-weight-bolder text-lg"><Decimals :precio="importeTotal"/> Euros</p>
                            </div>
                        </div>
                        <div class="col-12 border-bottom border-dark mt-1 mb-3"></div>
                        <div class="col-12 mt-2">
                            <div class="d-block">
                                <input type="checkbox" class="form-control mr-1">
                                <a class="text-primary d-inline text-xs" target="_blank" href="/politicas/terminosycondiciones">He leído y acepto los términos y condiciones</a>
                            </div>
                            <button class="btn btn-info opacity-40 d-block text-white float-right py-0 mt-2">Pagar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->

    </Layout>
</template>

<script>
    import { Link, Head } from '@inertiajs/inertia-vue3'
    import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
    import Decimals from '@/Layouts/Components/Decimals.vue'
    import Layout from '@/Layouts/Layout.vue'   
    import { loadStripe } from '@stripe/stripe-js'
    import { Inertia } from '@inertiajs/inertia'  

    export default {
        components: {
            Link,
            Head,
            BreezeValidationErrors,
            Layout,
            Decimals
        },
        props: {
            hotel: Object,
        },
        created(){
            console.log(this.totalActivities)
            console.log(this.cartList)
            var text = 'No hay dirección!!!';
            var address = 'No entro por medio de un codigo QR, asegurese que la dirección de envío que coloque, sea la correcta';

            if (this.hotel) {
                address = this.hotel.address + " Zona: " + this.hotel.zone;
                text = '<strong>Por favor asegúrese que la <u>dirección de envio</u> sea la correcta:</strong>';
            }
            this.$swal({
                    title: text,
                    icon: 'info',
                    html: address,
                    showCloseButton: false,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText:
                        '<i class="fa fa-thumbs-up"></i> Aceptar!',
                    confirmButtonAriaLabel: 'Aceptar!',
                })
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
            if (total_souvenirs <= this.$page.props.settings.shippings && total_souvenirs > 0) {
                total += 5 ;
            }
            this.total = total;
        },
        data() {
            return {
                sub_total: null,
                total_souvenirs: 0,
                total: null,
                stripe: {},
                cardElement: {},
                form: {
                    firstname: null,
                    lastname: null,
                    email: null,
                    address: (this.hotel) ? this.hotel.address : null,
                    apart: null,
                    city: null,
                    state: (this.hotel) ? this.hotel.zone : null,
                    zip_code: null,
                    phone: null,
                    country: null,
                    amount: null,
                    hab: null
                },
                paymentProcessing: false
            }
        },
        async mounted() {

            this.stripe = await loadStripe('pk_test_51Jz1DqKb9p440caATQOa5mvwIe3UzVaJmzMJfdolAuuJ3RDcPVWNsNYX7W46CRmVdG0N9DUzX1GdenKgKaV3VvOk00vpli1M7n');

            const elements = this.stripe.elements();
            this.cardElement = elements.create('card', {
                classes: {
                    base: 'bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out'
                }
            });

            this.cardElement.mount('#card-element');
        },
        methods: {
            calculate(priceA, priceN, adult, children){
                if (priceN) {
                    var amount = ((adult * priceA) +  (children * priceN));
                }else{
                    var amount = ((adult * priceA) +  (children * priceA));
                }
                return amount;
            },
            async processPayment() {
                this.paymentProcessing = true;

                const {paymentMethod, error} = await this.stripe.createPaymentMethod(
                    'card', this.cardElement, {
                        billing_details: {
                            name: this.form.firstname + " " + this.form.lastname,
                            address: {
                                line1: this.form.address,
                                city: this.form.city,
                                state: this.form.state,
                                postal_code: this.form.zip_code,
                            }
                        }
                    }
                );

                if (error) {
                    this.paymentProcessing = false;
                    console.error(error);
                } else {
                    this.form.amount = Math.round(this.total * 100);
                    this.form.payment_method_id = paymentMethod.id;
                    Inertia.post(route('sale'),
                            this.form,{
                                preserveScroll: false,
                                onFinish: visit => {
                                    this.paymentProcessing = false;
                                },
                            })
                }
            }
        },
        computed:{
            cartList(){
                let cart = this.$page.props.cart;
                let largo = Number(Object.values(cart).length) - 2;
                let array = Object.values(cart).splice(0,largo);
                return array;
            },
            souvenirsList(){
                return this.cartList.filter((product)=> product.attributes.type=="souvenir");
            },
            activitiesList(){
                return this.cartList.filter((product)=> product.attributes.type=="activity");
            },
            totalSouvenirs(){
                return this.souvenirsList.reduce((acc, el) => ({
                    ...acc,
                    num:Number(el.quantity) + acc.num,
                    precio:Number(el.quantity*el.price) + acc.precio,
                }),{num:0,precio:0});
            },
            totalActivities(){
                return this.activitiesList.reduce((acc, el) => ({
                    ...acc,
                    num:++acc.num,
                    precio:(Number(el.attributes.adult)*el.attributes.priceA + Number(el.attributes.children)*el.attributes.priceN) + acc.precio,
                }),{num:0,precio:0});
            },
            importeTotal(){
                let envio;
                this.totalSouvenirs.precio > this.$page.props.settings.shippings ? envio=0 : envio=5;
                return this.totalActivities.precio+this.totalSouvenirs.precio+envio;
            }
        }
    }
</script>
<style>
    .swal2-select{
        display: none;
    }
</style>