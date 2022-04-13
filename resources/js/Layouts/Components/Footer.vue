<template>
    <div class="bg-footer col-12 p-20 my-10"></div>
        <!-- Footer Area Start Here -->
        <footer class="footer-area bg-img">
            <div class="footer-top bg-img pt-82 pb-50">
                <div class="container">
                    <div class="row">
                        
			            <div class="col-lg-3 col-sm-3 col-md-3">
                            <div class="footer-widget">
                                <div class="footer-logo mb-43">
                                    <Link :href="route('home')">
                                        <img id="logo-footer" alt="brand-image" src="/vendor_asset/img/logo/logo.png">
                                    </Link>
                                </div>
                                <div class="footer-addres">
                                    <p>Dirección</p>
                                    <div class="footer-phn-email">
                                        <a href="#">+34 555 5555 55</a>
                                        <a href="#">+34 555 5555 55</a>
                                    </div>
                                    <div class="footer-phn-email">
                                        <a href="#">correo1@mail.com</a>
                                        <a href="#">correo2@support.info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-sm-3 col-md-3">
                            <div class="footer-widget mb-40">
                                <div class="footer-title mb-55">
                                    <h4>¿Ya nos sigues?</h4>
                                </div>
                                <div class="footer-content">
                                    <ul>
                                        <li><a href="#">Instagram</a></li>
                                        <li><a href="#">Twitter</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-md-3">
                            <div class="footer-widget mb-40">
                                <div class="footer-title mb-55">
                                    <h4>Servicios</h4>
                                </div>
                                <div class="footer-content">
                                    <ul>
                                        <li><Link :href="route('about.us')">¿Quiénes somos?</Link></li>
                                        <li><Link :href="route('contact')">Contáctanos</Link></li>
                                        <li><a href="#">Blog</a></li>
                                        <li><a href="#">Soporte</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-md-3">
                            <div class="footer-widget mb-40">
                                <div class="footer-title mb-55">
                                    <h4>Políticas</h4>
                                </div>
                                <div class="footer-content">
                                    <ul>
                                        <li><a target="_blank" href="/tablero/alojamientos/politicas/privacidad">Políticas de privacidad</a></li>
                                        <li><a target="_blank" href="politicas/terminosycondiciones">Términos y condiciones</a></li>
                                        <li><a target="_blank" href="/tablero/alojamientos/politicas/entregas">Políticas de entrega</a></li>
                                        <li><a target="_blank" href="/tablero/alojamientos/politicas/devolucion">Políticas de devolución</a></li>
                                    </ul>
                                </div>
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
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        components: {
            Link,
        },
    }
</script>
<style type="text/css">
    .bg-footer{
        background-color: #31516B;
    }
</style>