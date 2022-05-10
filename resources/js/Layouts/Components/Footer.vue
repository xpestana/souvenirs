<template>
        <!-- Footer Area Start Here -->
        <footer class="mt-5 pt-3 bg-light">
            <div class="footer-body">
                <div class="container">
                    <div class="row justify-content-around">
                        <div class="col-12 col-md-2">
                            <img class="mx-auto w-28 md:w-56" src="/vendor_asset/img/logo/logo.png" alt="logo">
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="footer-widget mb-40">
                                <div class="footer-content pt-2 text-center">
                                    <div class="">
                                    <Link :href="route('about.us')" class="text-lg">¿Quiénes somos?</Link>
                                    </div>
                                    <div class="">
                                        <Link :href="route('contact')" class="text-lg">Contáctanos</Link>
                                    </div>
                                    <div class="">
                                        <a href="#" class="text-lg">Blog</a>
                                    </div>
                                    <div class="">
                                        <a href="#" class="text-lg">Trabaja con nosotros</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="footer-widget mb-40">
                                <div class="footer-content text-center pt-2">
                                    <div><Link href="#" class="text-lg text-azulc font-weight-bolder">Servicios</Link></div>
                                    <div><Link class="text-lg" :href="route('activities')">Actividades</Link></div>
                                    <div><Link class="text-lg" :href="route('souvenirs')">Souvenirs</Link></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="footer-widget mb-40">
                                <div class="footer-content text-center pt-2">
                                    <div><Link href="#" class="text-lg text-azulc font-weight-bolder">Políticas</Link></div>
                                    <div>
                                        <Link class="text-lg" :href="route('privacidad')">Políticas de privacidad</Link>
                                    </div>
                                    <div>
                                        <Link class="text-lg" :href="route('terminosycondiciones')">Términos y condiciones</Link>
                                    </div>
                                    <div>
                                        <Link class="text-lg" :href="route('entregas')">Políticas de entrega</Link>
                                    </div>
                                    <div>
                                        <Link class="text-lg" :href="route('devolucion')">Políticas de devolución</Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copryright">
                <div class="container-fluid px-0 py-3 position-relative" style="background-color:#ededed">
                    <p class="text-center text-secondary">Copyright ©<a href="#">HiCitty</a>. Todos los derechos reservados.</p>
                    <div class="footer-social md:absolute right-0 top-1 text-center ">
                        <div class="d-inline-flex">
                            <a target="_blank" href="https://api.whatsapp.com/send/?phone=34722193903">
                                <img src="/vendor_asset/img/social/wt.png" class="w-16 h-12">
                            </a>
                            <a target="_blank" href="https://www.instagram.com/hicitty_/" class="">
                                <img src="/vendor_asset/img/social/inst.png" class="px-2 w-16 h-12">
                            </a>
                            <a target="_blank" href="https://twitter.com/hicitty_" class="">
                                <img src="/vendor_asset/img/social/tw.png" class="px-2 w-16 h-12">
                            </a>
                        </div>
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
        },
        created(){
            $(function () {
                $('[data-toggle="popover"]').popover()
            })
        }
    }
</script>
<style type="text/css">

</style>