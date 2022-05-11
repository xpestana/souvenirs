<template>
    <!-- Main Header Area Start Here -->
        <header id="header">
            <div class="container-fluid">
                <div class="row ptop-6 p-0">
                    <div class="col-12 d-md-none shadow-md">
                        <mobile-menu />    
                    </div> 
                    <div class="col-md-12 d-none d-md-block shadow-md px-0">
                        <Menu />
                    </div>
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
           
        },
        methods: {
        },
    }
</script>
<style>
.ptop-6{
        padding-top: 5.8em !important;
    }
#header h3,p{
	font-family:Montserrat Bold;
}
#header .burger{
	color: #cacaca;
}
@media(max-width:900px){
    .ptop-6{
        padding-top: 4em !important;
    }
}
</style>