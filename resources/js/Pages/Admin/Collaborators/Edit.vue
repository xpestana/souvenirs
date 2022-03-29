<template>
    <notify v-if="$page.props.flash" :key="$page.props.flash.id"/>
    <div class="container">
        <div class="row p-2">
            <div class="col-1">
                <Link :href="route('admin.colaboradores')"><i class="fas fa-angle-left bg-info text-white px-2 py-1"></i></Link>    
            </div>
        </div>
        <form @submit.prevent="submit">
        <div class="row bg-light p-3 mx-auto my-3 shadow-md w-75">
                <div class="col-12 py-1"><h3>Datos de registro</h3></div>
                <div class="col-12 col-md-6">
                    <BreezeInput type="text" class="form-control my-2 py-4 credenciales" autocomplete="on" placeholder="E-mail*" v-model="form.email" required/>
                    <BreezeInput type="text" class="form-control my-2 py-4 credenciales" autocomplete="on" placeholder="Confirmar E-mail" v-model="form.email_confirmation" required/>
                    <BreezeInput type="password" class="form-control my-2 py-4 credenciales" autocomplete="off" placeholder="Contraseña" v-model="form.password" />
                </div>
                <div class="col-12 col-md-6">
                    <BreezeInput  type="text" class="form-control  my-3" v-model="form.name" autocomplete="name" placeholder="Persona en contacto *" required/>
                    <BreezeInput  type="text" class="form-control  mt-3" v-model="form.phone" autocomplete="phone" placeholder="Número de teléfono *" required/>
                    <select name="gestor" id="gestor" class="my-3 w-100 select" required v-model="form.gestor">
                        <option value="0">Eres gestor de *: </option>
                        <option value="1">Hotel</option>
                        <option value="2">Apartamento</option>
                    </select>
                    
                </div>
                <div class="col-12 pt-2"><h3>Datos fiscales</h3></div>
                <div class="col-12 col-md-6">
                    <BreezeInput  type="text" class="form-control w-100 my-3 py-3" v-model="form.razon" autocomplete="razon" placeholder="Razón social *" required/>
                    <BreezeInput  type="text" class="form-control w-100 my-3 py-3" v-model="form.id" autocomplete="id" placeholder="N° de Identificador Fiscal *" required/>
                    <BreezeInput  type="text" class="form-control w-100 my-3 py-3" v-model="form.city" autocomplete="city" placeholder="Ciudad *" required/>
                </div>
                <div class="col-12 col-md-6 pt-md-3">    
                    <select name="nif" id="nif" v-model="form.nif" class="w-100 select" required>
                        <option value="NIF Español">NIF Español</option>
                        <option value="Número VAT intracomunitario">Número VAT intracomunitario</option>
                        <option value="Pasaporte">Pasaporte</option>
                        <option value="Documento oficial país de residencia">Documento oficial país de residencia</option>
                        <option value="Certificado de residencia">Certificado de residencia</option>
                        <option value="Otro documento probatorio">Otro documento probatorio</option>
                        <option value="No censado">No censado</option>
                    </select>
                    <BreezeInput  type="text" class="form-control w-100 my-pais py-3" v-model="form.country" autocomplete="country" placeholder="País *" value="España" readonly=""/>
                    <BreezeInput  type="text" class="form-control w-100 my-3 py-3" v-model="form.cp" autocomplete="cp" placeholder="Codigo Postal *" required/>
                </div>
                <div class="col-12 col-lg-9">
                    <BreezeInput  type="text" class="form-control w-100 py-3" v-model="form.address" autocomplete="address" placeholder="Dirección fiscal *" required/>
                </div>
                <div class="col-12 col-lg-3 text-center text-lg-right">
                    <button class="btn btn-primary rounded-pill py-0 px-3 mt-3">Crear cuenta</button>
                </div>
                <div class="col-12">
                    <ValidationErrors/>
                </div>
        </div>
        </form>
    </div>
</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import BreezeInput from '@/Components/Input.vue'
import BreezeButton from '@/Components/Button.vue'
import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors'
import Notify from '@/Layouts/Components/Toast.vue'
import { Link } from '@inertiajs/inertia-vue3'
export default {
    layout:Layout,
    components:{
        BreezeInput,
        BreezeButton,
        ValidationErrors,
        Notify,
        Link
    },
    props: {
        user: Object
    },
    data(){
        return {
            form: this.$inertia.form({
                _method:"PUT",
                email: this.user.email,
                email_confirmation: this.user.email,
                password: '',
                name: this.user.profile.firstname,
                phone: this.user.profile.phone,
                gestor: this.user.profile.gestor,
                razon: this.user.profile.razon,
                nif: this.user.profile.nif,
                id: this.user.profile.identify,
                city: this.user.profile.city,
                cp: this.user.profile.cp,
                address: this.user.profile.address,
            })
        }
    },
    methods: {
        submit() {
            var gestor = document.getElementById('gestor').value;
            this.form.gestor = gestor;
            this.form.put(route('admin.collaborator.updt',{id:this.user.id}),{
                _token: this.$page.props.csrf_token,
                errorBag: 'submit',
                preserveScroll: true,
            })
        },
    }
}
</script>