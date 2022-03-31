<template>
    <div class="bg-footer col-12 p-20 my-10"></div>
        <!-- Footer Area Start Here -->
        <footer class="footer-area bg-img">
            <div class="footer-top bg-img">
                <div class="container">
                    <div class="row justify-content-around">
                        <div class="col-12 col-md-3">
                            <div class="footer-widget mb-40">
                                <div class="footer-title mb-55">
                                    <h4>HiCitty</h4>
                                </div>
                                <div class="footer-content">
                                    <ul>
                                        <li class="pb-2"><Link :href="route('about.us')">¿Quiénes somos?</Link></li>
                                        <li class="pb-2"><Link :href="route('contact')">Contáctanos</Link></li>
                                        <li class="pb-2"><a href="#">Blog</a></li>
                                        <li class="pb-2"><a href="#">Trabaja con nosotros</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="footer-widget mb-40">
                                <div class="footer-title mb-55">
                                    <h4>Servicios</h4>
                                </div>
                                <div class="footer-content">
                                    <ul>
                                        <li class="pb-2"><Link :href="route('activities')">Actividades</Link></li>
                                        <li class="pb-2"><Link :href="route('souvenirs')">Souvenirs</Link></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="footer-widget mb-40">
                                <div class="footer-title mb-55">
                                    <h4>Políticas</h4>
                                </div>
                                <div class="footer-content">
                                    <ul>
                                        <li class="pb-2"><a target="_blank" href="/tablero/alojamientos/politicas/privacidad">Políticas de privacidad</a></li>
                                        <li class="pb-2"><a target="_blank" href="/tablero/alojamientos/politicas/terminosycondiciones">Términos y condiciones</a></li>
                                        <li class="pb-2"><a target="_blank" href="/tablero/alojamientos/politicas/entregas">Políticas de envío</a></li>
                                        <li class="pb-2"><a target="_blank" href="/tablero/alojamientos/politicas/reembolso">Políticas de reembolso</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-social">
                        <div class="row justify-content-center pb-3">
                            <div class="col-8 col-md-3 text-center d-inline-flex">
                                <a href="#" class="">
                                <!-- <a href="#" class="my-auto mx-3"> -->
                                    <!-- <i class="fab fa-whatsapp text-white rounded-circle bg-success p-2"></i> -->
                                    <img src="/vendor_asset/img/social/wt.png" class="">
                                </a>
                                <a href="#" class="">
                                    <img src="/vendor_asset/img/social/inst.png" class="px-2">
                                </a>
                                <a href="#" class="">
                                    <img src="/vendor_asset/img/social/tw.png" class="px-2">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="copyright text-center">
                        <p>Copyright ©<a href="#">HiCity</a>. Todos los derechos reservados.</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End Here -->

</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'

    export default {
        components: {
            Link,
        }
    }
</script>
<style type="text/css">
.bg-footer{
    background-color: #31516B;
}
.footer-social .fa-whatsapp{
    font-size: 2em;
    padding: 4px 6px;
}
.footer-social img{
    height: 4em;
    width: 5em;
}
@media (max-width:767px){
    .footer-social .fa-whatsapp{
        font-size: 1.6em;
        padding: 4px 6px;
    }
}

</style>