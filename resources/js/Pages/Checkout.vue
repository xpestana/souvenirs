<template>
    <Head title="Checkout"/>  
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 py-1 border-bottom border-dark">
                <div class="absolute left-3 top-5">
                    <Link :href="route('cart.index')"><i class="fas fa-times text-lg"></i></Link>
                </div>
                <img src="/vendor_asset/img/logo/hilogo.png" class="mx-auto w-32 py-1">
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area Start Here -->
    <!-- <div class="breadcrumb-area pt-65 pb-70 bg-img" style="background-image:url(/vendor_asset/img/bg-image/hop-brech-bg.jpg);">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h3>Checkout</h3>
                <ol class="breadcrumb breadcrumb-list" hidden>
                    <li class="breadcrumb-item"><Link :href="route('home')">Inicio</Link></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </div>
        </div>
    </div> -->
    <!-- Breadcrumb Area End Here -->
    <form @submit.prevent="submit">
    <!-- checkout-area start -->
    <template v-if="showForm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 py-1">
                    <div class="text-right">
                        <img src="/vendor_asset/img/icons/padlock.png" class="d-inline mr-2 w-4">
                        <p class="d-inline">Pago seguro</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-3 px-3 px-md-5">
            <div class="row">
                <div class="col-12 mb-2">
                    <h3 class="text-lg">Persona de contacto</h3>
                </div>
                <div class="col-12 col-md-6">
                    <input type="text" placeholder="Nombre*" v-model="form.name" class="border rounded py-1 w-100" required/>
                </div>
                <div class="col-12 col-md-6 mt-3 mt-md-0">
                    <input type="text" placeholder="Móvil*" v-model="form.phone" class="border rounded py-1 w-100" required/>
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <input type="email" placeholder="Correo electrónico*" v-model="form.email" class="border rounded py-1 w-100" required/>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 mb-2">
                    <h3 class="text-lg">Dirección de envío</h3>
                    <p class="mt-1 text-center text-grayc leading-4" v-if="hotel !== null">
                        ¡Su anfitrión ya ha rellenado estos campos <br> para facilitar el envío!
                    </p>
                </div>
                <div class="col-12 col-md-6">
                    <input type="text" placeholder="Dirección*" v-model="form.address" class="border rounded py-1 w-100" required/>
                </div>
                <div class="col-12 col-md-6 mt-3 mt-md-0">
                    <input type="text" placeholder="Piso, escalera, puerta, etc. (opcional)" v-model="form.hab" class="border rounded py-1 w-100"/>
                </div>
                <div class="col-12 col-md-6 mt-3 mt-md-4">
                    <input type="text" placeholder="Escriba aqui sus observaciones para la agencia" v-model="form.observations" class="border rounded py-1 w-100"/>
                </div>
                <div class="col-12 col-md-6 mt-3 mt-md-4">
                    <input type="text" placeholder="Código postal*" v-model="form.cp" class="border rounded py-1 w-100" required/>
                </div>
            </div>
            <div class="row mt-4" v-if="forms_extra.length > 0">
                <div class="col-12 mb-2">
                    <h3 class="text-lg">Datos extra</h3>
                </div>
                <div class="col-12 col-md-6 mt-1" v-for="(input, index) in forms_extra" :key="index">
                    <template v-if="input.name.split('\n')[0]=='Idioma del tour : '">
                        <label>Eligir Idioma del tour</label>
                        <select :id="'input'+index" class="rounded border w-100">
                            <option value="">Eligir Idioma del tour</option>
                            <option v-if="input.name.split('\n')[4] !== undefined" :value="input.name.split('\n')[4]">{{input.name.split('\n')[4]}}</option>
                            <option v-if="input.name.split('\n')[5] !== undefined" :value="input.name.split('\n')[5]">{{input.name.split('\n')[5]}}</option>
                            <option v-if="input.name.split('\n')[6] !== undefined" :value="input.name.split('\n')[6]">{{input.name.split('\n')[6]}}</option>
                            <option v-if="input.name.split('\n')[7] !== undefined" :value="input.name.split('\n')[7]">{{input.name.split('\n')[7]}}</option>
                        </select>
                    </template>
                    <template v-else>
                        <label>{{input.name}}</label>
                        <textarea :id="'input'+index" class="rounded border w-100" :placeholder="input.name+'*'"></textarea>
                    </template>
                </div>
                <div class="col-12 mt-1" v-if="mensajeInputs !== ''">
                    <p class="text-center text-danger">{{mensajeInputs}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-20 mb-4">
                    <button type="button" class="btn btn-info opacity-40 d-block text-white float-right py-0 mt-2" @click="validarForm">Continuar</button>
                </div>
            </div>

        </div>
    </template>
    <template v-if="showCheckout">
        <div class="checkout-area white-bg">
            <div class="container">
                <div class="row px-0 justify-content-md-center md:mt-24">
                    <div class="col-12 col-md-8 d-flex justify-between pt-1 px-1">
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
                    <div class="col-12 col-md-8 mt-3">
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
                        <div class="d-flex justify-between" v-if="totalSouvenirs.precio > 0">
                            <p class="text-muted">Envío</p>
                            <p class="font-weight-bolder text-muted" v-if="totalSouvenirs.precio < this.$page.props.settings.shippings"><Decimals :precio="5"/>€</p>
                            <p class="font-weight-bolder text-muted" v-else>GRATIS</p>
                        </div>
                        <div class="d-flex justify-between mt-2">
                            <p class="font-weight-bolder">Importe</p>
                            <p class="font-weight-bolder text-lg"><Decimals :precio="importeTotal"/> Euros</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 border-bottom border-dark mt-1 mb-3"></div>
                    <div class="col-12 col-md-8 mt-2">
                        <div class="d-block">
                            <input type="checkbox" class="form-control mr-1" v-model="checkTerminos">
                            <a class="text-primary d-inline text-xs" target="_blank" href="/politicas/terminosycondiciones">He leído y acepto los términos y condiciones</a>
                        </div>
                        <button type="submit" class="btn btn-info opacity-40 d-block text-white float-right py-0 mt-2">Pagar</button>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <!-- checkout-area end -->
</form>

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
            forms_extra: Object,
        },
        created(){
            console.log(this.forms_extra)
            if (this.hotel) {
                let address = this.hotel.address + " Zona: " + this.hotel.zone;
                let text = '<strong>Por favor asegúrese que la <u>dirección de envio</u> sea la correcta:</strong>';
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
            }
            var cart = this.$page.props.cart;
            var total = 0;
            var total_souvenirs = 0;

            Object.keys(cart).forEach(function(key) {
                if (cart[key].name) {
                    if (cart[key].attributes.type == 'souvenir') {
                        total += (cart[key].price * cart[key].quantity);
                        total_souvenirs += (cart[key].price * cart[key].quantity);
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
                paymentProcessing: false,
                showCheckout:false,
                showForm:true,
                form: {
                    name: '',
                    phone: '',
                    email: '',
                    address: (this.hotel) ? this.hotel.calle : '',
                    hab: (this.hotel) ? this.hotel.planta : '',
                    observations: '',
                    cp: (this.hotel) ? this.hotel.cp : '',
                    data: [],
                },
                checkTerminos:false,
                mensajeInputs:''
            }
        },
       /* async mounted() {

            this.stripe = await loadStripe('pk_test_51Jz1DqKb9p440caATQOa5mvwIe3UzVaJmzMJfdolAuuJ3RDcPVWNsNYX7W46CRmVdG0N9DUzX1GdenKgKaV3VvOk00vpli1M7n');

            const elements = this.stripe.elements();
            this.cardElement = elements.create('card', {
                classes: {
                    base: 'bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out'
                }
            });

            this.cardElement.mount('#card-element');
        },*/
        methods: {
            validarForm(){
                let full = true;
                this.form.data = [];
                for (let i = 0; i < this.forms_extra.length; i++) {
                    if(document.getElementById('input'+i).value == ''){
                        full = false;
                        this.mensajeInputs = 'El campo '+this.forms_extra[i].name.split('\n')[0]+' es obligatorio';
                    }
                    this.form.data.push({[this.forms_extra[i].name.split('\n')[0]]: document.getElementById('input'+i).value})
                }
                if(this.form.name == '' || this.form.phone == '' || this.form.address == '' || this.form.cp == ''){
                    this.$swal({
                        title: 'Nombre, móvil, dirección y código postal son campos obligatorios!',
                        icon: 'info',
                        showCloseButton: false,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText:
                            '<i class="fa fa-thumbs-up"></i> Aceptar!',
                        confirmButtonAriaLabel: 'Aceptar!',
                    })
                }else{
                    if(full){
                        this.showForm = false;
                        this.showCheckout = true;
                    }
                }
            },
            submit() {
                console.log(this.form)
                if(this.checkTerminos){
                    Inertia.post(route('sale'), this.form);
                }
                else{
                    this.$swal({
                        title: '¡Debe aceptar los términos y condiciones del servicio de pago!',
                        icon: 'info',
                        showCloseButton: false,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText:
                            '<i class="fa fa-thumbs-up"></i> Aceptar!',
                        confirmButtonAriaLabel: 'Aceptar!',
                    })
                }
             /*this.form.post(,{
                 _token: this.$page.props.csrf_token,
                 errorBag: 'submit',
                 preserveScroll: true,
                 forceFormData: true,
             })*/
        },
            /*async processPayment() {
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
            }*/
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
                    precio:acc.precio + el.attributes.pedido.reduce((acc,col)=>{
                        return acc + Number(col.split(':')[0])*Number(col.split(':')[1])
                    },0),
                }),{num:0,precio:0});
            },
            importeTotal(){
                let envio;
                this.totalSouvenirs.precio > this.$page.props.settings.shippings ? envio=0 : envio=5;
                this.totalSouvenirs.precio == 0 ? envio=0 : '';
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