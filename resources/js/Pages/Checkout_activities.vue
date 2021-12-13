<template>
	<div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form mb-sm-40">
                        <h3>Detalles de Facturación</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-sm-30">
                                    <label>Nombre <span class="required">*</span></label>
                                    <input type="text" placeholder="" v-model="customer.firstname"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Apellido <span class="required">*</span></label>
                                    <input type="text" placeholder="" v-model="customer.lastname"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label>Compañía</label>
                                    <input type="text" placeholder="" v-model="customer.company"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Dirección <span class="required">*</span></label>
                                    <input type="text" placeholder="Calle" v-model="customer.address"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mtb-30">
                                    <input type="text" placeholder="Apartamento, suite, unidad etc. (opcional)" v-model="customer.apart"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label>Poblado / Ciudad <span class="required">*</span></label>
                                    <input type="text" placeholder="Poblado / Ciudad" v-model="customer.city"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Estado / Provincia <span class="required">*</span></label>
                                    <input type="text" placeholder="Estado / Provincia" v-model="customer.state"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Código Postal <span class="required">*</span></label>
                                    <input type="text" placeholder="Código postal" v-model="customer.zip_code"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Correo <span class="required">*</span></label>
                                    <input type="email" placeholder="" v-model="customer.email"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Teléfono  <span class="required">*</span></label>
                                    <input type="text" placeholder="Teléfono" v-model="customer.phone"/>
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
                                <tbody>
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            Adulto <span class="product-quantity"> {{ adult }} × {{ product.activities.priceA }} €</span>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">{{ adult * product.activities.priceA }} €</span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item" v-if="product.activities.priceN">
                                        <td class="product-name" >
                                            Niños <span class="product-quantity"> {{ children }} × {{ product.activities.priceN }} €</span>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">{{ children * product.activities.priceN }} €</span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item" v-else>
                                    	<td class="product-name" >
                                            Niños <span class="product-quantity"> {{ children }} × {{ product.activities.priceA }}</span>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">{{ children * product.activities.priceA }} €</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>fechas</th>
                                        <td><span class="amount">
                                        	<template v-if="date_end">
            									De {{ moment(date_start).format('DD/MM/YYYY') }} a {{ moment(date_end).format('DD/MM/YYYY') }}
            								</template>
            								<template v-else>
            									El {{ moment(date_start).format('DD/MM/YYYY')}}
            								</template>
                                        </span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total orden</th>
                                        <td><span class="total amount">
                                        	{{ amount }} €
                                        </span>
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
</template>
<script>
    import { Link, Head } from '@inertiajs/inertia-vue3'
    import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
    import Layout from '@/Layouts/Layout.vue'   
    import { loadStripe } from '@stripe/stripe-js'
    import { Inertia } from '@inertiajs/inertia'  
    import Moment from 'moment'

    export default {
        components: {
            Link,
            Head,
            Layout,
            BreezeValidationErrors,
        },
        props: {
            form: Object,
            product: Object,
        },
        created(){
        	this.moment=Moment;

 			var fecha1 = this.moment(this.form.range.start);
			var fecha2 = this.moment(this.form.range.end);

 			this.days = fecha2.diff(fecha1, 'days')+1;

 			if (this.product.activities.priceN) {
 				this.amount = ((this.adult * this.product.activities.priceA) +  (this.children * this.product.activities.priceN)) * this.days;
 			}else{
 				this.amount = ((this.adult * this.product.activities.priceA) +  (this.children * this.product.activities.priceA)) * this.days;
 			}
        },
        data() {
            return {
            	amount:null,
            	days:null,
            	moment:null,
            	adult: this.form.adult,
            	children: this.form.children,
            	date_start: this.form.range.start,
            	date_end: this.form.range.end,
                stripe: {},
                cardElement: {},
                customer: {
                    firstname: null,
                    lastname: null,
                    email: null,
                    address: null,
                    company: null,
                    apart: null,
                    city: null,
                    state: null,
                    zip_code: null,
                    phone: null,
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
            async processPayment() {
                this.paymentProcessing = true;

                const {paymentMethod, error} = await this.stripe.createPaymentMethod(
                    'card', this.cardElement, {
                        billing_details: {
                            name: this.customer.firstname + " " + this.customer.lastname,
                            email: this.customer.email,
                            address: {
                                line1: this.customer.address,
                                city: this.customer.city,
                                state: this.customer.state,
                                postal_code: this.customer.zip_code,
                            }
                        }
                    }
                );

                if (error) {
                    this.paymentProcessing = false;
                    console.error(error);
                } else {
                    this.customer.amount = Math.round(this.amount * 100);
                    this.customer.payment_method_id = paymentMethod.id;
                    this.customer.date_init = this.date_start;
                    this.customer.date_end = this.date_end;
                    this.customer.days = this.days;
                    this.customer.adult = this.adult;
                    this.customer.children = this.children;
                    this.customer.product_id = this.product.id;

                    Inertia.post(route('sale.activities'),
                            this.customer,{
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