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
                <div class="col-lg-6 col-md-6">
                    <div class="your-order">
                        <h3>Tu orden</h3>
                        <div class="your-order-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-name">Producto</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="product in $page.props.cart" :key="product.id">
                                    <tr class="cart_item" v-if="product.name">
                                        <td class="product-name"  v-if="product.attributes.type == 'souvenir'">
                                            {{ product.name }} <span class="product-quantity"> × {{ product.quantity }}</span>
                                        </td>
                                        <td class="product-name"  v-if="product.attributes.type == 'activity'">
                                            {{ product.name }} 
                                            <span class="product-quantity"> 
                                                    <br>
                                                    Adultos: {{ product.attributes.adult }}
                                                    <br>
                                                    Niños: {{ product.attributes.children }}
                                            </span>
                                        </td>
                                        <td class="product-total" v-if="product.attributes.type == 'souvenir'">
                                            <span class="amount">{{ product.quantity * product.price }} €</span>
                                        </td>
                                        <td class="product-total" v-if="product.attributes.type == 'activity'">
                                            <span class="amount">
                                                {{ calculate(product.attributes.priceA, product.attributes.priceN, product.attributes.adult, product.attributes.children) }} €
                                            </span>
                                        </td>
                                    </tr>
                                    </template>
                                </tbody>
                                <tfoot>
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
                                        <td><span class=" total amount">{{ total }} €</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="card-element" class="leading-7 text-sm text-gray-600">Información de pago</label>
                                    <div id="card-element"></div>
                                </div>
                            </div>
                        </div>
                        <BreezeValidationErrors class="mb-3" />
                        <div class="col-md-12 login-footer text-center">
                            <div v-if="status" class="mb-4 font-medium text-sm text-danger">
                                {{ status }}
                            </div>
                        </div>
                        <div class="payment-method d-flex justify-content-center">
                            <button
                                class="login-btn bg-secondary"
                                @click="processPayment"
                                :disabled="paymentProcessing"
                                v-text="paymentProcessing ? 'Procesando' : 'Pagar'"
                            ></button>
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
    import Layout from '@/Layouts/Layout.vue'   
    import { loadStripe } from '@stripe/stripe-js'
    import { Inertia } from '@inertiajs/inertia'  

    export default {
        components: {
            Link,
            Head,
            BreezeValidationErrors,
            Layout,
        },
        props: {
            countries: Object,
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
                total: null,
                stripe: {},
                cardElement: {},
                form: {
                    firstname: null,
                    lastname: null,
                    email: null,
                    address: null,
                    apart: null,
                    city: null,
                    state: null,
                    zip_code: null,
                    phone: null,
                    country: null,
                    amount: null
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
                                preserveScroll: true,
                                onFinish: visit => {
                                    this.paymentProcessing = false;
                                },
                            })
                }
            }
        },
    }
</script>