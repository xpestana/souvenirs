<template>
    <div class="container mw-100">
        <div class="row">
            <div class="col-12 col-md-7 caja-logo d-flex flex-row flex-sm-column  flex-wrap justify-content-sm-center align-items-center">
                <img src="https://hicitty.com/vendor_asset/img/logo/logo.png" class="p-0 m-0">
                <p class="h3 fw-bold text-center d-none d-sm-block">Lo hacemos por ti</p>
                <div class="tarjeta-info mt-0 mt-sm-3 py-2 px-4 ">
                    <p class="card-text">
                        Lo hacemos por ti <br> Horario disponible:<br>
                        8:30-14:30 h.<br>
                        (+34)777 777 777
                    </p>
                </div>
            </div>
            
                <div class="col-12 col-md-5 formulario barra-azul">
                    <h1 class="text-white text-center pt-5 m-5 ">Crea una cuenta para registrar tu alojamiento y gestionarlo</h1>
                    <form @submit.prevent="submit" class="d-flex flex-column  justify-content-center align-items-center">
                        <BreezeInput  type="email" class="form-control w-75 mb-2 py-3" v-model="form.email" autocomplete="email" placeholder="E-mail" required/>
                        <BreezeInput  type="conf_email" class="form-control w-75 mb-2 py-3" v-model="form.email_confirmation" autocomplete="conf_email" placeholder="Confirmar E-mail" required/>
                        <BreezeInput  type="password" class="form-control w-75 mb-3 py-3" v-model="form.password" autocomplete="password" placeholder="Contraseña" required/>

                        <!-- <BreezeButton class="btn btn-primary  rounded-pill  w-75 py-2 mb-5 mt-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Regístrate ahora
                        </BreezeButton> -->
                        <button type="submit" class="btn btn-primary  rounded-pill  w-75 py-2 mb-5 mt-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Registrae
                        </button>
                    </form>
                </div>
                    
        </div>
    </div>
</template>

<script>
import BreezeInput from '@/Components/Input.vue'
import BreezeButton from '@/Components/Button.vue'
export default {
    components:{
        BreezeInput,
        BreezeButton
    },
    data(){
        return {
            form: this.$inertia.form({
                email: null,
                email_confirmation: null,
                password: '',
            })
        }
    },
    methods: {
        submit() {
            this.form.post(route('register.collaborator'),{
                _token: this.$page.props.csrf_token,
                errorBag: 'submit',
                preserveScroll: true,
            })
        },
    }
}
</script>

<style scoped>
h1{
  font-size: 2em;  
}
.formulario{
    height: 100vh;
} 

.cortina{
    background: linear-gradient(to bottom,rgba(255,255, 255, 0), rgba(255,255, 255, 0.70));
}
.barra-azul{
    background: #6fb2c6;
}
.caja-logo img{
    height: 50%;
    width: 60%;
}
.tarjeta-info{
    border: 1px solid #6fb2c6;
    border-radius: 15%;
    color: #6fb2c6;
    line-height: 1em;
}
@media screen and (max-width: 576px) {
    .formulario{
        height: 80vh;
    }
    .caja-logo{
        height: 20vh;
    }
}
    @media screen and (max-width: 1000px) {
    .caja-logo img{
        height: 40%;
        width: 55%;
    }
} 
@media screen and (max-width: 570px) {
    .caja-logo img{
        height: 50%;
        width: 40%;
    }
} 
</style>