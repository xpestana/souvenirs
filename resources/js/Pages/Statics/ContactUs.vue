<template>
    <Head title="Contact us"/>
    <Layout>
    
    <Breadcrumb title="Contact us"/>
    <!-- Regester Page Start Here -->
    <div class="register-area white-bg ptb-80">
        <div class="container">
        <h3 class="login-header text-info">Contact us</h3>
            <div class="row">
                <div class="col-xl-12">
                    <div class="register-contact  clearfix">
                        <form id="contact-form" class="contact-form" @submit.prevent="submit">
                            <div class="address-wrapper row">
                                <div class="col-md-6">
                                    <div class="address-fname">
                                        <input class="form-control" type="text" v-model="form.firstname" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-fname">
                                        <input class="form-control" type="text" v-model="form.lastname" placeholder="Surname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-email">
                                        <input class="form-control" type="email" v-model="form.email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-web">
                                        <input class="form-control" type="number" v-model="form.phone" placeholder="Telephone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-subject">
                                        <input class="form-control" type="text" v-model="form.subject" placeholder="Issue">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="type">Contact us by:</label>
                                    <select id="type" class="form-control block w-100" v-model="form.contact">
                                        <option value="Venta">Sale</option>
                                        <option value="Información">Information</option>
                                        <option value="Devolución">Return</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="address-textarea">
                                        <textarea name="message" class="form-control" v-model="form.message" placeholder="Write us..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-content mail-content clearfix">
                                <div class="send-email float-md-right">
                                    <BreezeButton class="return-customer-btn bg-info" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Send
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
            <div class="row datos mt-5">
                <div class="col-12 text-center">
                    <h1>If you prefer, call <br>+34722193903  o <br>send us an email to <br>info@hicitty.es</h1>
                </div>
            </div>
            <div class="row mt-3 datos justify-content-center">
                <div class="col-2 col-md-1">
                    <div class="p-3">
                        <i class="far fa-envelope"></i>
                    </div>
                    <div class="p-3">
                        <i class="far fa-address-card"></i>
                    </div>
                </div>
                <div class="col-7 col-md-3 pl-0 pt-1">
                    <div class="p-3">
                        <p>info@hicitty.es</p>
                    </div>
                    <div class="p-3">
                        <p>+34 722 19 39 03</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Page End Here -->
    </Layout>
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
<style scoped>
.datos h1{
    font-size: 2.5em;
}
.datos i{
    font-size: 2em;
}
.datos p{
    font-size: 1.5em;
}
@media (max-width:700px)
{
    .datos h1{
        font-size: 2em;
    }   
}
</style>