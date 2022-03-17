<template>
    <!-- Main Header Area Start Here -->
        <header class="header-sticky">
            <div class="coustom-container">
                <div class="main-header">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-5 col-sm-6 col-5">
                            <div class="logo">
                                <Link :href="route('collaborator.index')"><img id="logo-menu" src="/vendor_asset/img/logo/logo.png" alt="logo"></Link>
                            </div>
                        </div>
                        <!-- Logo End Here -->
                        <Menu />
                    </div>
                    <mobile-menu /> 
                </div>
            </div>
            <!-- Container End -->
        </header>
    <!-- Main Header Area End Here -->
</template>
<script>
    import { Link } from '@inertiajs/inertia-vue3';
    import Menu from '@/Pages/Collaborator/Layouts/Menu.vue'
	import MobileMenu from '@/Pages/Collaborator/Layouts/Menu-mobile.vue'
    import '/vendor_asset/js/jquery.meanmenu.min.js';

    export default{
        components: {
            Link,
            Menu,
            MobileMenu,
        },
        mounted () {
            this.mobileMenu()
        },
        methods: {
            mobileMenu: function (){
                //Make responsive the menu
                jQuery('.mobile-menu nav').meanmenu({
                    meanScreenWidth: "991",
                });
                //Make sticky the menu
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 150) {
                        $('.header-sticky').addClass("sticky");
                    } else {
                        $('.header-sticky').removeClass("sticky");
                    }
                });
            }
        },
    }
</script>
<style>
    .logo {
        padding: 10px 0 !important;
    }   
    .sm{
        display: none !important;
    }
    @media (max-width: 767px){
     .sm{
        display: inherit !important;
    }   
    }
</style>