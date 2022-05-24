<template>
    <!-- Main Header Area Start Here -->
        <header class="header-sticky bg-white">
            <div class="coustom-container">
                <div class="main-header">
                    <div class="row">
                        <div class="col-lg-3 d-none d-lg-block">
                            <div class="logo-container">
                                <Link :href="route('collaborator.index')"><img class="w-40 pt-9" src="/vendor_asset/img/logo/hilogo.png" alt="logo"></Link>
                            </div>
                        </div>
                        <!-- Logo End Here -->
                        <Menu />
                        <mobile-menu />
                    </div> 
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
            }
        },
    }
</script>
<style>
    header{
        position: sticky;
        top: 0;
        z-index: 100;
    }
    
    .sm{
        display: none !important;
    }
    @media (max-width: 767px){
        .sm{
            display: inherit !important;
        }   
    }
    @media (min-width:992px){
        header{
            box-shadow:0px 0px 5px 0px rgb(0 0 0 / 46%);
        }
    }
</style>