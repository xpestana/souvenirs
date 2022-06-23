<template>
    <section id="dashboard-perfil-infor" class="container py-8 ml-2 md:ml-0 md:px-24">
        <!-- Header section-->
        <div class="header row mx-1.5 lg:mx-0 justify-content-start shadow p-2 rounded-xl bg-header-collaborator py-3">
            <div class="col-12 col-md-8 text-left">
                <h1 class="font-bold text-lg md:text-3xl text-muted"><i class="fas fa-arrow-left text-muted mr-2"></i> Información del perfil</h1>
            </div>
        </div>
        <!--END Header section-->
         <!-- Content section-->
        <div class="perfil-infor row mx-1.5 lg:mx-0 mt-8 justify-content-start">
            <div class="col-12 col-md-6">
                <form @submit.prevent="submitProfile" class="row">
                    <div class="col-12 my-1.5 px-0">
                        <label class="font-bold"><i class="fas fa-user mr-1"></i>Nombre</label>
                        <input type="text" v-model="form.name" class="w-100 rounded col-form-input py-1.5" placeholder="Nombre...">
                    </div>
                    <div class="col-12 my-1.5 px-0">
                        <label  class="font-bold"><i class="fas fa-envelope mr-1"></i>Correo eléctronico</label>
                        <input type="text" v-model="form.email" class="w-100 rounded col-form-input py-1.5" placeholder="Correo eléctronico...">
                    </div>
                    <div class="col-12 my-1.5 px-0">
                        <label  class="font-bold"><i class="fas fa-phone-alt mr-1"></i>Número de telefono</label>
                        <input type="text"  v-model="form.phone" class="w-100 rounded col-form-input py-1.5" placeholder="Número de telefono...">
                    </div>
                    <div class="col-12 my-1.5 px-0">
                        <label class="font-bold"><i class="fas fa-key mr-1"></i>Contraseña</label>
                        <div class="relative w-100">
                            <i class="far fa-eye cursor-pointer absolute left-0 inset-y-1/3 my-auto px-2.5" v-on:click="showPass('password')"></i>
                            <input type="password" class="col-form-input w-100 rounded pl-8 py-1.5" id="password" placeholder="********">
                        </div>
                    </div>
                    <div class="col-12 mt-11 px-0 text-center text-lg-left">
                        <button type="submit" class="btn rounded text-white bg-collaborator-orange py-1 px-6" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"><i class="fas fa-save mr-2 text-white"></i>Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Content section-->
    </section>
</template>
<script>
import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/inertia-vue3';
export default {
    layout:TemplateApp,
    components:{
        Link
    },
    data(){
        return{
            form: this.$inertia.form({
                _method: "PUT",
                name: this.$page.props.auth.profile.firstname,
                email: this.$page.props.auth.user.email,
                phone: this.$page.props.auth.profile.phone,
                password: null,
            }),
        }
    },
    methods: {
        submitProfile() {
        this.form.put(route('collaborator.profile.update'), {
                preserveScroll: true,
            })
        },    
        showPass: function (id){
            let x = document.getElementById(id);
            x.type = x.type == 'password' ? 'text' : 'password';            
        },
    }
}
</script>
<style scoped>
</style>