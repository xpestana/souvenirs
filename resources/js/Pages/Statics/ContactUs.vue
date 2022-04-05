<template>
    <Head title="Contáctanos"/>
    
    <Header />

    <notify v-if="$page.props.flash" :key="$page.props.flash.id"/>
    
    <Breadcrumb title="Contáctanos"/>
    <!-- Regester Page Start Here -->
    <div class="register-area white-bg ptb-80">
        <div class="container">
        <h3 class="login-header text-info">Contáctanos</h3>
            <div class="row">
                <div class="col-xl-12">
                    <div class="register-contact  clearfix">
                        <form id="contact-form" class="contact-form" @submit.prevent="submit">
                            <div class="address-wrapper row">
                                <div class="col-md-6">
                                    <div class="address-fname">
                                        <input class="form-control" type="text" v-model="form.firstname" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-fname">
                                        <input class="form-control" type="text" v-model="form.lastname" placeholder="Apellido">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-email">
                                        <input class="form-control" type="email" v-model="form.email" placeholder="Correo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-web">
                                        <input class="form-control" type="number" v-model="form.phone" placeholder="Teléfono">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-subject">
                                        <input class="form-control" type="text" v-model="form.subject" placeholder="Asunto">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="type">Nos contacta por:</label>
                                    <select id="type" class="form-control mt-1 block w-100" v-model="form.contact">
                                        <option value="Venta">Venta</option>
                                        <option value="Información">Información</option>
                                        <option value="Devolución">Devolución</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="address-textarea">
                                        <textarea name="message" class="form-control" v-model="form.message" placeholder="Escríbenos..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-content mail-content clearfix">
                                <div class="send-email float-md-right">
                                    <BreezeButton class="return-customer-btn bg-info" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Enviar
                                    </BreezeButton>
                                </div>
                            </div>
                             <BreezeValidationErrors class="mb-3" />
                        <div class="login-footer text-center">
                            <div v-if="status" class="mb-4 font-medium text-sm text-danger">
                                {{ status }}
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Page End Here -->
    
</template>

<script>
    import { Link, Head } from '@inertiajs/inertia-vue3'
    import Breadcrumb from '@/Layouts/Components/Breadcrumb.vue' 
    import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
    import BreezeButton from '@/Components/Button.vue'
    import Header from '@/Layouts/Components/Header.vue'
    import Notify from '@/Layouts/Components/Toast.vue'

    export default {
        components: {
            Link,
            Head,
            Breadcrumb,
            BreezeButton,
            Header,
            Notify,
            BreezeValidationErrors
        },
        data() {
            return {
                form: this.$inertia.form({
                    firstname: null,
                    lastname: null,
                    email: null,
                    phone: null,
                    subject: null,
                    message: null,
                    contact: 'Venta',
                })
            }
        },
        methods: {
            submit() {
                var type = $('#type').val();
                this.form.contact = type;
                this.form.post(route('contact.send'),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'submit',
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: (result) => {
                        this.form.reset()
                    }
                    
                })
            },
        }
    }
</script>