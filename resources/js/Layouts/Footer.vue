<template>
    <div class="bg-info col-12 p-20 m-10"></div>
        <!-- Footer Area Start Here -->
        <footer class="footer-area bg-img">
            <div class="footer-top bg-img pt-82 pb-50" style="background-image:url(img/bg-image/footer-bg.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 d-md-block d-lg-none">
                            <div class="footer-widget mb-40">
                                <div class="footer-title mb-55">
                                    <h4>Language</h4>
                                </div>
                                <div class="footer-content">
                                    <ul>
                                        <li><a href="#">English</a></li>
                                        <li><a href="#">اللغة العربية</a></li>
                                        <li><a href="#">Bangla </a></li>
                                        <li><a href="#">Hindi </a></li>
                                        <li><a href="#">Spanish </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
			<div class="col-lg-3 col-sm-6 col-md-4">
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
                        <div class="col-sm-6 col-md-4 d-md-block d-lg-none">
                            <div class="footer-widget mb-40">
                                <div class="footer-title mb-55">
                                    <h4>Currency</h4>
                                </div>
                                <div class="footer-content">
                                    <ul>
                                        <li><a href="#">€ Euro</a></li>
                                        <li><a href="#">$ US dollar</a></li>
                                        <li><a href="#">$ SAR Riyal</a></li>
                                        <li><a href="#">$ INR Rupee</a></li>
                                        <li><a href="#">$ AED Dirham </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-md-4">
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
                        <div class="col-lg-3 col-sm-6 col-md-4">
                            <div class="footer-widget mb-40">
                                <div class="footer-title mb-55">
                                    <h4>Servicios</h4>
                                </div>
                                <div class="footer-content">
                                    <ul>
                                        <li><Link :href="route('quienes-somos')">¿Quiénes somos?</Link></li>
                                        <li><Link :href="route('contactanos')">Contáctanos</Link></li>
                                        <li><a href="#">Blog</a></li>
                                        <li><a href="#">Soporte</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-md-4">
                            <div class="footer-widget mb-40">
                                <div class="footer-title mb-55">
                                    <h4>Políticas</h4>
                                </div>
                                <div class="footer-content">
                                    <ul>
                                        <li><a href="#">Políticas de privacidad</a></li>
                                        <li><a href="#">Términos y condiciones</a></li>
                                        <li><a href="#">Políticas de envío</a></li>
                                        <li><a href="#">Políticas de reembolso</a></li>
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