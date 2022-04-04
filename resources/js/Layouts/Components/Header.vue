<template>
    <!-- Main Header Area Start Here -->
        <header class="header-sticky">
            <div class="coustom-container">
                <div class="main-header">
                    <div class="row">
                         <div class="col-4 sm">
                            <div class="cart-area float-left">
                                <ul class="d-flex">
                                    <Cart :key="$page.props.flash.id"/>
                                </ul>
                            </div>
                         </div>
                       <!-- Logo Start Here -->
                        <div class="col-xl-2 col-lg-3 col-md-5 col-sm-6 col-5">
                            <div class="logo">
                                <Link :href="route('home')"><img id="logo-menu" src="/vendor_asset/img/logo/logo.png" alt="logo"></Link>
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
    import Menu from '@/Layouts/Components/Menu.vue';
    import MobileMenu from '@/Layouts/Components/MobileMenu.vue';
    import '/vendor_asset/js/jquery.meanmenu.min.js';
    import Cart from '@/Layouts/Components/Cart.vue' ;

    export default{
        components: {
            Link,
            Menu,
            MobileMenu,
            Cart
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
               /* $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        $('.header-sticky').addClass("sticky");
                    } else {
                        $('.header-sticky').removeClass("sticky");
                    }
                });*/
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
    .cart-area > ul > li > a > span{
            font-size: 11px;
            height: 16px;
            line-height: 17px;
            right: -16px;
            top: 3px;
            width: 17px;
        }
    .cart-area > ul > li > i.header-search{
            font-size: 28px;
        }
        .cart-area > ul > li > a i.header-cart{
            font-size: 28px;
        }
        .cart-area > ul > li{
            padding: 43px 0 0px 0px;
        }

        .cart-area > ul > li > a > span {
            background: #4a4a4a none repeat scroll 0 0;
            border-radius: 100%;
            color: #fff;
            display: inline-block;
            font-size: 12px;
            font-weight: 500;
            height: 20px;
            line-height: 20px;
            position: absolute;
            text-align: center;
            width: 20px;
        }
        .cart-area > ul > li > a > span {
            top: 56px !important;
            left: 40px !important;
        }
    }
</style>