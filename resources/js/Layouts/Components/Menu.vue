<template>
    <!-- Header Menu & Cart Area Start Here -->
    <div class="col-xl-7 col-lg-6 d-none d-lg-block">
        <div class="maain-menu-area maain-menu-area-three  position-relative pl-155">
            <!-- Primary Menu Start -->
            <div class="primary-menu">
                <nav>
                    <ul class="primary-menu-list d-flex">
                        <li class="active"><Link :href="route('home')">Inicio</Link></li>
                        <li class="position-static"><Link :href="route('souvenirs')">Souvenirs</Link></li>
                        <li><Link :href="route('activities')">Actividades</Link></li>
                        <li><Link :href="route('contact')">Contacto</Link></li>
                    </ul>
                </nav>
            </div>
            <!-- Primary Menu End -->
        </div>
    </div>
    <!-- Header Menu & Cart Area End Here -->
    <!-- Cart Box Start Here -->
    <div class="col-xl-3 col-lg-3 col-md-7 col-sm-6 col-7">
        <!-- Cart & Search Area Start -->
        <div class="search-cart-area pr-all-50 float-right">
            <ul class="d-flex">
                <li><i class="header-menu icon-menu"></i>
                <!-- Currency & Language Selection Start -->
                <ul class="ht-dropdown cart-box-width currency-selector" >
                    <li id="cart-area">
                        <ul>
                            <template v-if="this.$page.props.auth.user">
                                <li><Link :href="route('profile.index')">Mi cuenta</Link></li>
                                <li><Link :href="route('cart')">Carrito</Link></li>
                                <li><a href="javascript:void(0);" @click.prevent="logout">Cerrar sesión</a></li>
                            </template>
                            <template v-else>
                                <li><Link :href="route('login')">Iniciar Sesión</Link></li>
                                <li><Link :href="route('contact')">Contacto</Link></li>
                            </template>
                        </ul>
                    </li>
                </ul>
                <!-- Currency & Language Selection End -->
                </li>
                <li class="search-mrg"><i class="header-search icon-search"></i>
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
                <li><a href="#"><i class="header-cart icon-cart"></i><span>02</span></a>
                <!-- Cart Box Start -->
                <ul class="ht-dropdown cart-box-width">
                    <!-- Single Cart Box Start -->
                    <li class="single-cart-box">
                        <div class="cart-img">
                            <a href="#"><img src="/vendor_asset/img/products/p1.png" alt="cart-image"></a>
                            <span class="pro-quantity">1X</span>
                        </div>
                        <div class="cart-content">
                            <h6><a href="product-details.html">Printed Summer Red </a></h6>
                            <span class="cart-price">27.45</span>
                            <span>Size: S</span>
                            <span>Color: Yellow</span>
                        </div>
                        <a class="del-icone" href="#"><i class="ion-close"></i></a>
                    </li>
                    <!-- Single Cart Box End -->
                    <!-- Single Cart Box Start -->
                    <li class="single-cart-box">
                        <div class="cart-img">
                            <a href="#"><img src="/vendor_asset/img/products/p1.png" alt="cart-image"></a>
                            <span class="pro-quantity">1X</span>
                        </div>
                        <div class="cart-content">
                            <h6><a href="product-details.html">Printed Round Neck</a></h6>
                            <span class="cart-price">45.00</span>
                            <span>Size: XL</span>
                            <span>Color: Green</span>
                        </div>
                        <a class="del-icone" href="#"><i class="ion-close"></i></a>
                    </li>
                    <!-- Single Cart Box End -->
                    <!-- Cart Footer Inner Start -->
                    <li class="cart-footer">
                        <ul class="price-content">
                            <li>Subtotal <span>$57.95</span></li>
                            <li>Shipping <span>Free</span></li>
                            <li>Taxes <span>$0.00</span></li>
                            <li>Total <span>$64.95</span></li>
                        </ul>
                        <div class="cart-actions text-center">
                            <a class="cart-checkout" href="checkout.html">Checkout</a>
                        </div>
                    </li>
                    <!-- Cart Footer Inner End -->
                </ul>
                <!-- Cart Box End -->
            </li>
        </ul>
    </div>
    <!-- Cart & Search Area End -->
</div>
<!-- Cart Box End Here -->
</template>
<script>
    import { Link } from '@inertiajs/inertia-vue3';
    
    export default{
        components: {
            Link,
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
    #cart-area{
        width: 180px !important;
        padding: 10px !important;
    }
    .search-cart-area > ul > li:first-child{
        padding: 43px 0 0px 0px;
    }
    .search-cart-area > ul > li.search-mrg{
        padding: 43px 0 0px 39px;
    }
    .search-cart-area > ul > li{
        padding: 43px 0 0px 47px;
    }
    .search-cart-area > ul > li ul.currency-selector{
        width: 180px;
    }
    .primary-menu-list > li > a{
        line-height:  110px;
    }
    @media (max-width: 767px){
        .search-cart-area > ul > li > a > span{
            font-size: 9px;
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
</style>