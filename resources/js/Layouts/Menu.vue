<template>
        <!-- Main Header Area Start Here -->
        <header class="header-sticky">
            <div class="coustom-container">
                <div class="main-header">
                    <div class="row">
                       <!-- Logo Start Here -->
                        <div class="col-xl-2 col-lg-3 col-md-5 col-sm-6 col-5">
                            <div class="logo">
                                <a href="index.html"><img src="img/logo/logo.png" alt="logo"></a>
                            </div>
                        </div>
                        <!-- Logo End Here -->
                        <!-- Header Menu & Cart Area Start Here -->
                        <div class="col-xl-7 col-lg-6 d-none d-lg-block">
                            <div class="maain-menu-area maain-menu-area-three  position-relative pl-155">
                                <!-- Primary Menu Start -->
                                <div class="primary-menu">
                                    <nav>
                                        <ul class="primary-menu-list d-flex justify-content-center">
                                            <li><Link :href="route('souvenirs')">Souvenirs</Link></li>
                                            <li><Link :href="route('actividades')">Actividades</Link></li>
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
                                    <li class="header-search"><Link :href="route('login')"><i class="fa fa-user" style="font-size:24px"></i></Link></li>
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
                                                    <a href="#"><img src="img/products/p1.jpg" alt="cart-image"></a>
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
                                                    <a href="#"><img src="img/products/p2.jpg" alt="cart-image"></a>
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
                    </div>
                    <!-- Mobile Menu Start -->
                    <div class="mobile-menu d-block d-lg-none">
                        <nav>
                            <ul>
                                <li><Link :href="route('souvenirs')">Souvenirs</Link></li>
                                <li><Link :href="route('actividades')">Actividades</Link></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Mobile Menu End -->
                </div>
            </div>
            <!-- Container End -->
        </header>
        <!-- Main Header Area End Here -->
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default{
    components: {
        Link,
    },
}
</script>