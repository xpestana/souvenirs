<template>
    <Head title="Producto"/>
    <Menu />
    <div class="breadcrumb-area pt-65 pb-70 bg-img" style="background-image:url(/vendor_asset/img/bg-image/hop-brech-bg.jpg);">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h3>Detalles del producto</h3>
                <ol class="breadcrumb breadcrumb-list">
                    <li class="breadcrumb-item"><Link :href="route('home')">Inicio</Link></li>
                    <li class="breadcrumb-item active">Detalles del Producto</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Product Thumbnail Start -->
    <div class="main-product-thumbnail white-bg pt-90 pb-90">
        <div class="container">
            <div class="row">
                <!-- Main Thumbnail Image Start -->
                <div class="col-lg-5 col-md-6 mb-all-40">
                    <!-- Thumbnail Large Image start -->
                    <div class="tab-content">
                        <div id="thumb1" class="tab-pane fade show active">
                            <a data-fancybox="images" href="/vendor_asset/img/products/p1.png"><img src="/vendor_asset/img/products/p1.png" alt="product-view"></a>
                        </div>
                        <div id="thumb2" class="tab-pane fade">
                            <a data-fancybox="images" href="/vendor_asset/img/products/p1.png"><img src="/vendor_asset/img/products/p1.png" alt="product-view"></a>
                        </div>
                        <div id="thumb3" class="tab-pane fade">
                            <a data-fancybox="images" href="/vendor_asset/img/products/p1.png"><img src="/vendor_asset/img/products/p1.png" alt="product-view"></a>
                        </div>
                        <div id="thumb4" class="tab-pane fade">
                            <a data-fancybox="images" href="/vendor_asset/img/products/p1.png"><img src="/vendor_asset/img/products/p1.png" alt="product-view"></a>
                        </div>
                    </div>
                    <!-- Thumbnail Large Image End -->
                    <!-- Thumbnail Image End -->
                    <div class="product-thumbnail">
                        <div class="thumb-menu owl-carousel nav tabs-area nav-style" role="tablist">
                            <a class="active" data-toggle="tab" href="#thumb1"><img src="/vendor_asset/img/products/p1.png" alt="product-thumbnail"></a>
                            <a data-toggle="tab" href="#thumb2"><img src="/vendor_asset/img/products/p1.png" alt="product-thumbnail"></a>
                            <a data-toggle="tab" href="#thumb3"><img src="/vendor_asset/img/products/p1.png" alt="product-thumbnail"></a>
                            <a data-toggle="tab" href="#thumb4"><img src="/vendor_asset/img/products/p1.png" alt="product-thumbnail"></a>
                        </div>
                    </div>
                    <!-- Thumbnail image end -->
                </div>
                <!-- Main Thumbnail Image End -->
                <!-- Thumbnail Description Start -->
                <div class="col-lg-7 col-md-6">
                    <div class="thubnail-desc fix">
                        <h3 class="product-header">Dorji bari East Long Style</h3>
                        <ul class="rating-summary">
                            <li class="rating-pro">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                            <li class="read-review"><a href="#">Lee los reviews (1)</a></li>
                            <li class="write-review"><a href="#">Escribe un review</a></li>
                        </ul>
                        <div class="pro-price mt-10">
                            <p class="d-flex align-items-center"><span class="prev-price">16.51</span><span class="price">$15.19</span><span class="saving-price">-5%</span></p>
                        </div>
                        <p class=" pro-desc-details">Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                        <div class="pt-30 quatity-stock">
                           <label>Quantity</label>
                            <ul class="d-flex flex-wrap  align-items-center">
                                <li class="box-quantity">
                                    <form action="#">
                                        <input class="quantity" type="number" min="1" value="1">
                                    </form>
                                </li>
                                <li>
                                    <button class="pro-cart">Añadir Al Carrito</button>
                                </li>
                                <li class="pro-ref">
                                    <p><span class="in-stock"><i class="ion-checkmark-round"></i> in stock</span></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Thumbnail Description End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Product Thumbnail End -->
    <!-- Product Thumbnail Description Start -->
    <div class="thumnail-desc white-bg">
        <div class="container">
            <div id="thumb-desc-inner" class="thumb-desc-inner">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="main-thumb-desc nav tabs-area" role="tablist">
                            <li><a class="active" data-toggle="tab" href="#dtail">Descripción</a></li>
                        </ul>
                        <!-- Product Thumbnail Tab Content Start -->
                        <div class="tab-content thumb-content">
                            <div id="dtail" class="tab-pane fade show active">
                                <p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>
                            </div>
                        </div>
                        <!-- Product Thumbnail Tab Content End -->
                    </div>
                </div>
                <!-- Row End -->
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Product Thumbnail Description End -->
    <div class="best-seller-area pt-60 pb-50">
        <div class="container">
            <div class="section-title text-center mb-45">
                <h2>Souvenirs</h2>
                <p>Voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
            <div class="best-seller-active owl-carousel">
                <div class="single-aboss-product">
                    <div class="pro-img">
                        <a href="product-details.html"><img src="/vendor_asset/img/products/p1.png" alt="product-img"></a>
                        <div class="pro-actions">
                            <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-search"></i></a>
                        </div>
                    </div>
                    <div class="pro-content">
                        <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                        <div class="pro-price-cart">
                            <div class="pro-home-price">
                                <span>$199.99</span>
                            </div>
                            <div class="pro-cart">
                                <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                <a title="Wishlist" href="#"><i class="icon-like"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-aboss-product">
                    <div class="pro-img">
                        <a href="product-details.html"><img src="/vendor_asset/img/products/p1.png" alt="product-img"></a>
                        <div class="pro-actions">
                            <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-search"></i></a>
                        </div>
                    </div>
                    <div class="pro-content">
                        <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                        <div class="pro-price-cart">
                            <div class="pro-home-price">
                                <span>$199.99</span>
                            </div>
                            <div class="pro-cart">
                                <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                <a title="Wishlist" href="#"><i class="icon-like"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-aboss-product">
                    <div class="pro-img">
                        <a href="product-details.html"><img src="/vendor_asset/img/products/p1.png" alt="product-img"></a>
                        <div class="pro-actions">
                            <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-search"></i></a>
                        </div>
                    </div>
                    <div class="pro-content">
                        <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                        <div class="pro-price-cart">
                            <div class="pro-home-price">
                                <span>$199.99</span>
                            </div>
                            <div class="pro-cart">
                                <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                <a title="Wishlist" href="#"><i class="icon-like"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-aboss-product">
                    <div class="pro-img">
                        <a href="product-details.html"><img src="/vendor_asset/img/products/p1.png" alt="product-img"></a>
                        <div class="pro-actions">
                            <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-search"></i></a>
                        </div>
                    </div>
                    <div class="pro-content">
                        <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                        <div class="pro-price-cart">
                            <div class="pro-home-price">
                                <span>$199.99</span>
                            </div>
                            <div class="pro-cart">
                                <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                <a title="Wishlist" href="#"><i class="icon-like"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-aboss-product">
                    <div class="pro-img">
                        <a href="product-details.html"><img src="/vendor_asset/img/products/p1.png" alt="product-img"></a>
                        <div class="pro-actions">
                            <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-search"></i></a>
                        </div>
                    </div>
                    <div class="pro-content">
                        <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                        <div class="pro-price-cart">
                            <div class="pro-home-price">
                                <span>$199.99</span>
                            </div>
                            <div class="pro-cart">
                                <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                <a title="Wishlist" href="#"><i class="icon-like"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-aboss-product">
                    <div class="pro-img">
                        <a href="product-details.html"><img src="/vendor_asset/img/products/p1.png" alt="product-img"></a>
                        <div class="pro-actions">
                            <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-search"></i></a>
                        </div>
                    </div>
                    <div class="pro-content">
                        <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                        <div class="pro-price-cart">
                            <div class="pro-home-price">
                                <span>$199.99</span>
                            </div>
                            <div class="pro-cart">
                                <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                <a title="Wishlist" href="#"><i class="icon-like"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Content Start -->
    <div class="main-product-thumbnail quick-thumb-content">
        <div class="container">
            <!-- The Modal -->
            <div class="modal fade" id="product-window">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <!-- Main Thumbnail Image Start -->
                                <div class="col-lg-6 col-md-6 mb-all-40">
                                    <!-- Thumbnail Large Image start -->
                                    <div class="tab-content">
                                        <div id="pro-1" class="tab-pane fade show active">
                                            <a data-fancybox="images" href="/vendor_asset/img/products/p1.png"><img src="/vendor_asset/img/products/p1.png" alt="product-view"></a>
                                        </div>
                                        <div id="pro-2" class="tab-pane fade">
                                            <a data-fancybox="images" href="/vendor_asset/img/products/p1.png"><img src="/vendor_asset/img/products/p1.png" alt="product-view"></a>
                                        </div>
                                        <div id="pro-3" class="tab-pane fade">
                                            <a data-fancybox="images" href="/vendor_asset/img/products/p1.png"><img src="/vendor_asset/img/products/p1.png" alt="product-view"></a>
                                        </div>
                                        <div id="pro-4" class="tab-pane fade">
                                            <a data-fancybox="images" href="/vendor_asset/img/products/p1.png"><img src="/vendor_asset/img/products/p1.png" alt="product-view"></a>
                                        </div>
                                    </div>
                                    <!-- Thumbnail Large Image End -->
                                </div>
                                <!-- Main Thumbnail Image End -->
                                <!-- Thumbnail Description Start -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="thubnail-desc fix">
                                        <h3 class="product-header">Faded Short Sleeves T-shirt</h3>
                                        <ul class="rating-summary">
                                            <li class="rating-pro">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </li>
                                            <li class="read-review"><a href="#">read reviews (1)</a></li>
                                            <li class="write-review"><a href="#">write review</a></li>
                                        </ul>
                                        <div class="pro-price mt-10">
                                            <p class="d-flex align-items-center"><span class="prev-price">16.51</span><span class="price">$15.19</span><span class="saving-price">-5%</span></p>
                                        </div>
                                        <p class="pro-desc-details">Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                        <div class="quatity-stock">
                                           <label>Cantidad</label>
                                            <ul class="d-flex flex-wrap  align-items-center">
                                                <li class="box-quantity">
                                                    <form action="#">
                                                        <input class="quantity" type="number" min="1" value="1">
                                                    </form>
                                                </li>
                                                <li>
                                                    <button class="pro-cart">Añadir Al Carrito</button>
                                                </li>
                                                <li class="pro-ref">
                                                    <p><span class="in-stock"><i class="ion-checkmark-round"></i> in stock</span></p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Thumbnail Description End -->
                            </div>
                        </div>
                        <!-- Modal footer -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Content End -->
    <Footer/>
</template>

<script>
    import { Link, Head } from '@inertiajs/inertia-vue3'

    import Menu from '@/Layouts/Menu.vue'
    import Footer from '@/Layouts/Footer.vue'

    export default {
        components: {
            Menu,
            Footer,
            Link,
            Head,
        },
    }
</script>