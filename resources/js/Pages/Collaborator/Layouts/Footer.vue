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
                                    <h4>HiCity</h4>
                                </div>
                                <div class="footer-content">
                                    <ul>
                                        <li class="pb-4"><Link :href="route('about.us')">¿Quiénes somos?</Link></li>
                                        <li class="pb-4"><Link :href="route('contact')">Contáctanos</Link></li>
                                        <li class="pb-4"><a href="#">Blog</a></li>
                                        <li class="pb-4"><a href="#">Trabaja con nosotros</a></li>
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
                                        <li class="pb-4"><Link :href="route('activities')">Actividades</Link></li>
                                        <li class="pb-4"><Link :href="route('souvenirs')">Souvenirs</Link></li>
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
                                        <li><a href="#">Políticas de privacidad</a></li>
                                        <li><a href="#">Términos y condiciones</a></li>
                                        <li><a href="#">Políticas de envío</a></li>
                                        <li><a href="#">Políticas de reembolso</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-social">
                        <div class="row justify-content-center pb-3">
                            <div class="col-12 col-md-6 text-center">
                                <a href="#" class="btn btn-success mx-3 px-2 py-1">
                                    <i class="fab fa-whatsapp p-1"></i>
                                </a>
                                <a href="#" class="btn mx-3 px-2 py-1 text-white" style="background-color: #3b5998;">
                                    <i class="fab fa-facebook p-1"></i>
                                </a>
                                <a href="#" class="btn mx-3 px-2 py-1 text-white btn-danger">
                                    <i class="fab fa-instagram p-1"></i>
                                </a>
                                <a href="#" class="btn btn-info text-white mx-3 px-2 py-1">
                                    <i class="fab fa-twitter p-1"></i>
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
.footer-social i{
    font-size:20px;
}
.footer-top .footer-whatsapp i{
    font-size: 1.8em;
}
.footer-top .footer-whatsapp p{
    /* font-family: 'Work Sans', sans-serif; */
    font-family: 'Futur';
    font-weight: 400;
    font-size: 16px;
}
</style>