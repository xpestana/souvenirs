<template>
    <section id="banner">
        <div class="h-52 md:h-64 bg-cover relative md:bg-center" style="background-image:url('/vendor_asset/img/contact.png')">
            <div class="py-12 md:py-20 flex">
                <h1 style="background-color:#00000069" class="mx-auto py-8 w-3/4 md:w-1/2 text-4xl text-center text-white font-weigth-bolder">Contáctanos</h1>
            </div>       
        </div>
    </section>
    <section id="form">
        <form @submit.prevent="submit">
            <div class="container mt-5 px-5">
                <div class="row pb-2">
                    <div class="col-12 px-0">
                        <h1 class="text-2xl font-weight-bolder">Contáctanos</h1>
                    </div>
                </div>
                <div class="row bg-contact-gray py-2">
                    <div class="col-12 col-md-6">
                        <input class="border-input rounded w-100 bg-contact-gray my-1" type="text" v-model="form.firstname" placeholder="Nombre">
                    </div>
                    <div class="col-12 col-md-6">
                        <input class="border-input rounded w-100 bg-contact-gray my-1" type="text" v-model="form.lastname" placeholder="Apellido">
                    </div>
                    <div class="col-12 col-md-6">
                        <input class="border-input rounded w-100 bg-contact-gray my-1" type="number" v-model="form.phone" placeholder="Teléfono">
                    </div>
                    <div class="col-12 col-md-6">
                        <input class="border-input rounded w-100 bg-contact-gray my-1" type="text" v-model="form.email" placeholder="Correo">
                    </div>
                    <div class="col-12">
                        <input class="border-input rounded w-100 bg-contact-gray my-1" type="text" v-model="form.subject" placeholder="Asunto">
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-12 px-0">
                        <h1 class="text-2xl font-weight-bolder">Nos contacta por:</h1>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-12 px-0">
                        <select id="type" class="form-control mt-1 block w-100 my-2" v-model="form.contact">
                            <option value="Venta">Venta</option>
                            <option value="Información">Información</option>
                            <option value="Devolución">Devolución</option>
                        </select>
                    </div>
                    <div class="col-12 px-0">
                        <textarea name="message" class="rounded border w-100 my-2 h-24" v-model="form.message" placeholder="Escríbenos..."></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <ValidationErrors class="mb-3" />
                        <button class="return-customer-btn bg-info rounded" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Enviar
                        </button>
                    </div>
                </div>
            </div>
        </form>  
    </section>  
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
import 'vue3-carousel/dist/carousel.css';
import Layout from '@/Layouts/Layout.vue'
import Notify from '@/Layouts/Components/Toast.vue'
import ValidationErrors from '@/Components/ValidationErrors.vue'

export default{
    layout:Layout,
    components: {
        Link,
        Notify,
        ValidationErrors
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
 #form .bg-contact-gray{
     background-color:#f3f3f4;
 }
 #form .border-input{
     border: 1px #d5d5d5 solid;
 }
</style>