<template>
    <!-- Modal -->
    <div class="modal" id="modalcookies" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-12 text-center mb-4">
                            <h1><strong>We value your privacy</strong></h1>
                        </div>
                        <div class="col-12 text-center">
                            <p class="text-justify  mb-4">
                                We use cookies to improve the browsing experience on our site,
                                We inform you of the current regulations regarding the protection of personal data,
                                therefore to continue browsing the site you must accept the use of Cookies and our policy
                                Of privacy.
                            </p>
                            <div class="text-left">
                                <a class="text-info" target="_blank" href="/tablero/alojamientos/politicas/avisolegal">Legal warning</a><br>
                                <a class="text-info" target="_blank" href="/tablero/alojamientos/politicas/privacidad">Privacy Policy</a><br>
                                <a class="text-info" target="_blank" href="/tablero/alojamientos/politicas/cookies">Cookies policy</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="saveCookie">I agree</button>
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