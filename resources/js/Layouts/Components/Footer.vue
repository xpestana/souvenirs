<template>
        <!-- Footer Area Start Here -->
        <footer class="mt-5 pt-4 bg-light position-relative">
            <div class="footer-body">
                <div class="container">
                    <div class="row pt-3 pt-md-0">
                        <div class="col-6 pt-2 pt-md-0">
                            <div class="row">
                                <div class="col-12 col-md-4 px-0">
                                    <img class="mx-auto w-36 md:w-56 md:mt-3 cursor-pointer" src="/vendor_asset/img/logo/hilogo.png" alt="logo" @click="redirect()">
                                </div>
                                <div class="col-12 col-md-8 px-0">
                                    <div class="footer-widget mb-40">
                                        <div class="footer-content pt-2 text-center">
                                            <div class="">
                                            <Link :href="route('about.us')" class="text-base md:text-lg">¿Quiénes somos?</Link>
                                            </div>
                                            <div class="">
                                                <Link :href="route('contact')" class="text-base md:text-lg">Contáctanos</Link>
                                            </div>
                                            <div class="">
                                                <a :href="route('collaborator.home')" class="text-base md:text-lg">Trabaja con nosotros</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 col-md-6 px-0">
                                    <div class="footer-widget mb-40">
                                        <div class="footer-content text-center pt-2">
                                            <div><Link href="#" class="text-lg text-md-info font-weight-bolder border-b-4 md:border-b-0 border-info pb-0.5  title-footer">Servicios</Link></div>
                                            <div class="mt-1"><Link class="text-base md:text-lg" :href="route('activities')">Actividades</Link></div>
                                            <div><Link class="text-base md:text-lg" :href="route('souvenirs')">Souvenirs</Link></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 px-0">
                                    <div class="footer-widget mb-40">
                                        <div class="footer-content text-center pt-2">
                                            <div><Link href="#" class="text-lg font-weight-bolder border-b-4 md:border-b-0 border-info pb-0.5 title-footer">Políticas</Link></div>
                                            <div class="mt-1">
                                                <Link class="text-base md:text-lg" :href="route('privacidad')">Políticas de privacidad</Link>
                                            </div>
                                            <div>
                                                <Link class="text-base md:text-lg" :href="route('terminosycondiciones')">Términos y condiciones</Link>
                                            </div>
                                            <div>
                                                <Link class="text-base md:text-lg" :href="route('entregas')">Políticas de entrega</Link>
                                            </div>
                                            <div>
                                                <Link class="text-base md:text-lg" :href="route('devolucion')">Políticas de devolución</Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copryright">
                <div class="container-fluid px-0 py-3" style="background-color:#ededed">
                    <div class="footer-social absolute right-0 md:bottom-0 d-md-none">
                        <div class="d-inline-flex mt-1">
                            <a target="_blank" href="https://api.whatsapp.com/send/?phone=34722193903">
                                <img src="/vendor_asset/img/icons/wsicon.png" class="mx-1 mx-md-2 w-10 h-10 md:w-10 md:h-10">
                            </a>
                            <a target="_blank" href="https://www.instagram.com/hicitty_/" class="">
                                <img src="/vendor_asset/img/icons/igicon.png" class="px-1 px-md-2 w-12 h-10 md:w-14 md:h-10">
                            </a>
                            <a target="_blank" href="https://www.linkedin.com/company/kognos-vb/" class="">
                                <img src="/vendor_asset/img/icons/inicon.png" class="px-1 px-md-2 w-12 h-10 md:w-14 md:h-10">
                            </a>
                        </div>
                    </div>
                    <p class="text-center text-secondary">Copyright ©<a href="#">HiCitty</a>. Todos los derechos reservados.</p>
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
        },
        methods:{
            redirect(){
                this.$inertia.get(route('home'))
            }
        }
    }
</script>
<style scoped>
.title-footer{
    color:#65b4ce;
}
.footer-social{
    bottom:0;
}
@media(max-width:767px){
    .title-footer{
        color:#010101;
    }
    .footer-social{
        top:0;
    }
}
</style>