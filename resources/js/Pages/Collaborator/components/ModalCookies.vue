<template>
    <!-- Modal -->
    <div class="modal" id="modalcookies" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-12 text-center mb-4">
                            <h1><strong>Valoramos tu privacidad</strong></h1>
                        </div>
                        <div class="col-12 text-center">
                            <p class="text-justify  mb-4">
                                Utilizamos cookies para mejorar la experiencia de navegación en nuestro sitio,
                                le informamos la normativa vigente en materia de protección de datos de carácter personal,
                                por lo tanto para continuar navegando en el sitio debe aceptar el uso de Cookies y nuestra política
                                de privacidad.
                            </p>
                            <div class="text-left">
                                <a class="text-info" target="_blank" :href="route('avisolegal')">Aviso legal</a><br>
                                <a class="text-info" target="_blank" :href="route('privacidad')">Política de privacidad</a><br>
                                <a class="text-info" target="_blank"  :href="route('cookies')">Política de Cookies</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="saveCookie">Acepto</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components:{
        Link
    },
    mounted(){
        if(!document.cookie.includes('cookiesaceptadas=true'))
        {
            $('#modalcookies').modal('show')
        }
    },
    methods: {
        saveCookie(){
            document.cookie = "cookiesaceptadas=true;path=/;expires=Mon, 01 Jan 2025 00:00:00 UTC";
            $('#modalcookies').modal('hide')
        }
    }
}
</script>
<style scoped>
.modal-content {
    width: 100% !important;
}
.modal-body h1{
    font-size: 1.5em;
}
.modal-body p{
    line-height: 1.5em;
}
</style>