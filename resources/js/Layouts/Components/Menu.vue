<template>
    <!-- Header Menu & Cart Area Start Here -->
    <div class="col-xl-7 col-lg-6 d-none d-lg-block">
        <div class="maain-menu-area maain-menu-area-three  position-relative pl-155">
            <!-- Primary Menu Start -->
            <div class="primary-menu">
                <nav>
                    <ul class="primary-menu-list d-flex">
                        <li class="active" hidden><Link :href="route('home')">Inicio</Link></li>
                        <li class="position-static"><Link :href="route('souvenirs')">Souvenirs</Link></li>
                        <li><Link :href="route('activities')">Actividades</Link></li>
                        <li hidden><Link :href="route('contact')">Contacto</Link></li>
                    </ul>
                </nav>
            </div>
            <!-- Primary Menu End -->
        </div>
    </div>
    <!-- Header Menu & Cart Area End Here -->

    <!-- Cart Box Start Here -->
       <div class="col-xl-3 col-lg-3 col-md-7 col-sm-6 col-7  d-lg-block lg">
        <!-- Cart & Search Area Start -->
        <div class="search-cart-area pr-all-50 float-right">
            <ul class="d-flex">
                <li  hidden=""><i class="header-menu icon-menu"></i>
                <!-- Currency & Language Selection Start -->
                <ul class="ht-dropdown cart-box-width currency-selector" >
                    <li >
                        <ul>
                            <template v-if="this.$page.props.auth.user">
                                <li v-if="$page.props.auth.role != 'Client'"><Link :href="route('profile.index')">Mi cuenta</Link></li>
                                <li><Link :href="route('cart.index')">Carrito</Link></li>
                                <li hidden><Link :href="route('contact')">Contacto</Link></li>
                                <li><a href="javascript:void(0);" @click.prevent="logout">Cerrar sesión</a></li>
                            </template>
                            <template v-else>
                                <li><Link :href="route('login')">Iniciar Sesión</Link></li>
                                <li><Link :href="route('cart.index')">Carrito</Link></li>
                                <li hidden><Link :href="route('contact')">Contacto</Link></li>
                            </template>
                        </ul>
                    </li>
                </ul>
                <!-- Currency & Language Selection End -->
                </li>
                <li class="search-mrg"  hidden=""><i class="header-search icon-search"></i>
                    <!-- Search Area Start -->
                    <ul class="ht-dropdown search-box-view">
                        <li>
                            <form action="#" class="position-relative">
                                <input class="email" placeholder="Search our catalog" name="email" type="text">
                                <button type="submit" class="submit"><i class="icon-search" aria-hidden="true"></i></button>
                            </form>
                        </li>
                    </ul>
                    <!-- Search Area End -->
                </li>
                <Cart :key="$page.props.flash.id"/>
                <li>
                    <a href="javascript:void(0)"><i class="fas fa-globe lang"></i></a>
                </li>
                <li class="icon-login " v-if="this.$page.props.auth.user && $page.props.auth.role != 'Client'">
                    <Link :href="route('profile.index')"><i style="font-size: 23px; margin-top: 0.1rem !important;" class="far fa-user-circle"></i></Link>
                    <ul class="ht-dropdown cart-box-width currency-selector" >
                        <li><a href="javascript:void(0);" @click.prevent="logout">Cerrar sesión</a></li>
                    </ul>
                </li>
                <li class="icon-login " v-if="this.$page.props.auth.user && $page.props.auth.role == 'Client'">
                    <a href="javascript:void(0)"><i style="font-size: 23px; margin-top: 0.1rem !important;" class="far fa-user-circle"></i></a>
                    <ul class="ht-dropdown cart-box-width currency-selector" >
                        <li><a href="javascript:void(0);" @click.prevent="logout">Cerrar sesión</a></li>
                    </ul>
                </li>
                <li class="icon-login" v-if="this.$page.props.auth.user == null">
                    <Link :href="route('login')"><i style="font-size: 23px; margin-top: 0.1rem !important;" class="fas fa-sign-in-alt mt-1 "></i></Link>
                </li>
            </ul>
    </div>
    <!-- Cart & Search Area End -->
</div>
<!-- Cart Box End Here -->
    
</template>
<script>
    import { Link } from '@inertiajs/inertia-vue3';
    import Cart from '@/Layouts/Components/Cart.vue' 

    export default{
        components: {
            Link,
            Cart,
        },
        created(){
        },
        methods: {
            logout(){
                this.$inertia.post(route('logout'), {
                    _token: this.$page.props.csrf_token,
                })
            },
        }
    }
</script>
<style scope>
    .lang{
        background-color: #000;
        color: #fff !important;
        border-radius: 100%;
        padding: 5px;
        font-size: 18px;
    }

    #cart-area{
        width: 180px !important;
        padding: 10px !important;
    }
    .search-cart-area > ul > li:first-child{
        padding: 43px 0 0px 0px;
    }
    .search-cart-area > ul > li.search-mrg{
        padding: 43px 0 0px 20px;
    }
    .search-cart-area > ul > li{
        padding: 43px 0 0px 35px;
    }
    .search-cart-area > ul > li ul.currency-selector{
        width: 180px;
    }
    .primary-menu-list > li > a{
        line-height:  110px;
    }
    @media (max-width: 767px){
        .lg{
            display: none !important;
        }
        .icon-login{
            display: none !important;
        }
        .search-cart-area > ul > li > a > span{
            font-size: 11px;
            height: 16px;
            line-height: 17px;
            right: -16px;
            top: 3px;
            width: 17px;
        }
        .search-cart-area > ul > li > i.header-search{
            font-size: 28px;
        }
        .search-cart-area > ul > li > a i.header-cart{
            font-size: 28px;
        }
        .search-cart-area > ul > li{
            padding: 43px 0 0px 15px;
        }

    }
    .pl-155{
        padding-left: 245px !important;
    }
.search-cart-area > ul > li > a > span{
    top: -2px !important;
    right: -4px !important;
}
[class^="icon-"]:before, [class*=" icon-"]:before{
    font-size: 120% !important;
}
</style>