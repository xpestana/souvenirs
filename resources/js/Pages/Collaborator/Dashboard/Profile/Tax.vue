<template>
    <section id="dashboard-perfil-tax" class="container py-8 ml-2 md:ml-0 md:px-24">
        <!-- Header section-->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted"><i class="fas fa-arrow-left text-muted mr-2"></i> Datos fiscales</h1>
            </div>
        </div>
        <!--END Header section-->
         <!-- Content section-->
        <div class="perfil-tax row mx-1.5 lg:mx-0 mt-8">
            <form @submit.prevent="submitProfile" class="col-12 col-md-9">
                <ValidationAlert
                    :errors="errorsKey"
                />
                <div class="row">
                    <div class="col-12 col-md-6 my-1.5 pl-0 pr-0 pr-lg-2">
                        <label class="font-bold">Documento de identificación <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="NIF..."
                            v-model="form.nif" 
                            :class="{'error-input': errorsKey.includes('nif')}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 my-1.5 pl-0 pr-0 pr-lg-2">
                        <label class="font-bold">Razón social <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Razón social..."
                            v-model="form.razon" 
                            :class="{'error-input': errorsKey.includes('razon')}"
                        >
                    </div>
                    <div class="col-12 col-md-6 my-1.5 pl-0 pl-lg-2 pr-0">
                        <label class="font-bold">Persona de contacto <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="N° Id Fiscal..."
                            v-model="form.identifier" 
                            :class="{'error-input': errorsKey.includes('identifier')}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 my-1.5 pl-0 pr-0 pr-lg-2">
                        <label class="font-bold">Teléfono <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Teléfono..."
                            v-model="form.phone" 
                            :class="{'error-input': errorsKey.includes('phone')}"
                        >
                    </div>
                    <div class="col-12  col-md-6 my-1.5 pl-0 pl-lg-2 pr-0">
                        <label class="font-bold">Correo eléctronico <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Correo eléctronico..."
                            v-model="form.email" 
                            :class="{'error-input': errorsKey.includes('email')}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 my-1.5 pl-0 pr-0 pr-lg-2">
                        <label class="font-bold">Domicilio de facturación <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Domicilio de facturación..."
                            v-model="form.address"
                            :class="{'error-input': errorsKey.includes('address')}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 my-1.5 pl-0 pr-0 pr-lg-2">
                        <label class="font-bold">Código postal <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Código postal..."
                            v-model="form.cp"
                            :class="{'error-input': errorsKey.includes('cp')}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 my-1.5 pl-0 pr-0 pr-lg-2">
                        <label class="font-bold">Provincia <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Provincia...">
                    </div>
                    <div class="col-12 col-md-6 my-1.5 pl-0 pl-lg-2 pr-0">
                        <label class="font-bold">Ciudad <span class="text-orangec">*</span></label>
                        <input type="text" class="w-100 rounded col-form-input py-1.5" placeholder="Ciudad..."
                            v-model="form.city" 
                            :class="{'error-input': errorsKey.includes('cp')}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-11 px-0 text-center text-lg-left">
                        <button type="submit" class="btn rounded text-white bg-collaborator-orange py-1 px-6" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"><i class="fas fa-save mr-2 text-white"></i>Guardar cambios</button>
                    </div>
                </div>
            </form>
            
        </div>
        <!-- END Content section-->
    </section>
</template>
<script>
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/inertia-vue3';
import ValidationAlert from '@/Pages/Collaborator/components/ValidationAlert'
export default {
    layout:TemplateApp,
    components:{
        Link,
        ValidationAlert
    },
    data(){
        return{
            form: this.$inertia.form({
            	_method: "PUT",
                name: this.$page.props.auth.profile.firstname,
                email: this.$page.props.auth.user.email,
                phone: this.$page.props.auth.profile.phone,
                razon: this.$page.props.auth.profile.razon,
				nif: this.$page.props.auth.profile.nif,
				identifier: this.$page.props.auth.profile.identify,
				city: this.$page.props.auth.profile.city,
				cp: this.$page.props.auth.profile.cp,
				address: this.$page.props.auth.profile.address,
            }),
        }
    },
    methods: {
        submitProfile() {
        this.form.put(route('collaborator.fiscal.update'), {
                preserveScroll: true,
            })
        },    
        showPass: function (id){
            let x = document.getElementById(id);
            x.type = x.type == 'password' ? 'text' : 'password';            
        },
    },
    updated(){
console.log(this.$page.props.errors)
    },
    computed: {
        errorsKey () {
            var err = this.$page.props.errors ? Object.keys(this.$page.props.errors) : []
            return err
        },
    }
}
</script>
<style scoped>
</style>