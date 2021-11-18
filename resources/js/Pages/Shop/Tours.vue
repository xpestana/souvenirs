<template>
    <Head title="Actividades"/>
<Layout>
    <Breadcrumb title="Actividades"/>
    <!-- Shop Page Start -->
    <div class="main-shop-page white-bg ptb-80">
        <div class="container">
            <!-- Row End -->
            <div class="row">
                <!-- Sidebar Shopping Option Start -->
                <div class="col-lg-3 col-md-4">
                    <div class="sidebar">
                        <!-- Price Filter Options Start -->
                        <div class="search-filter mb-30">
                            <h3 class="sidebar-title">Filtrar por precio</h3>
                            <form action="#" class="sidbar-style">
                                <div id="slider-range"></div>
                                <input type="text" id="amount" class="amount-range" readonly>
                            </form>
                        </div>
                        <!-- Price Filter Options End -->
                        <!-- Sidebar Categorie Start -->
                        <div class="sidebar-categorie mb-30">
                            <h3 class="sidebar-title">Categorias</h3>
                            <ul class="sidbar-style">
                                <li class="form-check">
                                    <input class="form-check-input" value="#" id="camera" type="checkbox">
                                    <label class="form-check-label" for="camera">Aventura (10)</label>
                                </li>
                                <li class="form-check">
                                    <input class="form-check-input" value="#" id="GamePad" type="checkbox">
                                    <label class="form-check-label" for="GamePad">Historia (3)</label>
                                </li>
                                <li class="form-check">
                                    <input class="form-check-input" value="#" id="Digital" type="checkbox">
                                    <label class="form-check-label" for="Digital">Cultura (5)</label>
                                </li>
                                <li class="form-check">
                                    <input class="form-check-input" value="#" id="Virtual" type="checkbox">
                                    <label class="form-check-label" for="Virtual"> Arte (2) </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Shopping Option End -->
                <!-- Product Categorie List Start -->
                <div class="col-lg-9 col-md-8">
                    <!-- Grid & List View Start -->
                    <div class="grid-list-top border-default universal-padding d-lg-flex justify-content-md-between align-items-center mb-30">
                        <div class="grid-list-view d-flex align-items-center  mb-sm-15">
                            <ul class="nav tabs-area d-flex align-items-center">
                                <li><a data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                <li><a class="active" data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
                            </ul>
                        </div>
                        <!-- Toolbar Short Area Start -->
                        <div class="main-toolbar-sorter clearfix">
                            <div class="toolbar-sorter d-md-flex align-items-center">
                                <!--<label>Buscar</label>
                                <form action="#" class="position-relative">
                                    <input class="email" name="search_inp" type="text"><i class="icon-search" aria-hidden="true"></i></input>
                                </form>-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button"><i class="icon-search" aria-hidden="true"></i></button>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <!-- Toolbar Short Area End -->
                    </div>
                    <!-- Grid & List View End -->
                    <div class="shop-area mb-all-40">
                        <!-- Grid & List Main Area End -->
                        <div class="tab-content Products-area">
                            <div id="grid-view" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <!-- Single Product Start -->
                                        <div class="single-aboss-product mb-3">
                                            <div class="pro-img">
                                                <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                                <div class="pro-actions">
                                                    <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                </div>
                                            </div>
                                            <div class="pro-content">
                                                <h4><Link :href="route('producto')">Dorji bari East Long Style</Link></h4>
                                                <div class="pro-price-cart">
                                                    <div class="pro-home-price">
                                                        <span>$199.99</span>
                                                    </div>
                                                    <div class="pro-cart">
                                                        <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <!-- Single Product Start -->
                                        <div class="single-aboss-product mb-3">
                                            <div class="pro-img">
                                                <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                                <div class="pro-actions">
                                                    <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                </div>
                                            </div>
                                            <div class="pro-content">
                                                <h4><Link :href="route('producto')">Dorji bari East Long Style</Link></h4>
                                                <div class="pro-price-cart">
                                                    <div class="pro-home-price">
                                                        <span>$199.99</span>
                                                    </div>
                                                    <div class="pro-cart">
                                                        <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <!-- Single Product Start -->
                                        <div class="single-aboss-product mb-3">
                                            <div class="pro-img">
                                                <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                                <div class="pro-actions">
                                                    <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                </div>
                                            </div>
                                            <div class="pro-content">
                                                <h4><Link :href="route('producto')">Dorji bari East Long Style</Link></h4>
                                                <div class="pro-price-cart">
                                                    <div class="pro-home-price">
                                                        <span>$199.99</span>
                                                    </div>
                                                    <div class="pro-cart">
                                                        <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <!-- Single Product Start -->
                                        <div class="single-aboss-product mb-3">
                                            <div class="pro-img">
                                                <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                                <div class="pro-actions">
                                                    <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                </div>
                                            </div>
                                            <div class="pro-content">
                                                <h4><Link :href="route('producto')">Dorji bari East Long Style</Link></h4>
                                                <div class="pro-price-cart">
                                                    <div class="pro-home-price">
                                                        <span>$199.99</span>
                                                    </div>
                                                    <div class="pro-cart">
                                                        <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <!-- Single Product Start -->
                                        <div class="single-aboss-product mb-3">
                                            <div class="pro-img">
                                                <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                                <div class="pro-actions">
                                                    <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                </div>
                                            </div>
                                            <div class="pro-content">
                                                <h4><Link :href="route('producto')">Dorji bari East Long Style</Link></h4>
                                                <div class="pro-price-cart">
                                                    <div class="pro-home-price">
                                                        <span>$199.99</span>
                                                    </div>
                                                    <div class="pro-cart">
                                                        <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <!-- Single Product Start -->
                                        <div class="single-aboss-product mb-3">
                                            <div class="pro-img">
                                                <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                                <div class="pro-actions">
                                                    <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                </div>
                                            </div>
                                            <div class="pro-content">
                                                <h4><Link :href="route('producto')">Dorji bari East Long Style</Link></h4>
                                                <div class="pro-price-cart">
                                                    <div class="pro-home-price">
                                                        <span>$199.99</span>
                                                    </div>
                                                    <div class="pro-cart">
                                                        <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <!-- Single Product Start -->
                                        <div class="single-aboss-product mb-3">
                                            <div class="pro-img">
                                                <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                                <div class="pro-actions">
                                                    <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                </div>
                                            </div>
                                            <div class="pro-content">
                                                <h4><Link :href="route('producto')">Dorji bari East Long Style</Link></h4>
                                                <div class="pro-price-cart">
                                                    <div class="pro-home-price">
                                                        <span>$199.99</span>
                                                    </div>
                                                    <div class="pro-cart">
                                                        <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <!-- Single Product Start -->
                                        <div class="single-aboss-product mb-3">
                                            <div class="pro-img">
                                                <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                                <div class="pro-actions">
                                                    <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                </div>
                                            </div>
                                            <div class="pro-content">
                                                <h4><Link :href="route('producto')">Dorji bari East Long Style</Link></h4>
                                                <div class="pro-price-cart">
                                                    <div class="pro-home-price">
                                                        <span>$199.99</span>
                                                    </div>
                                                    <div class="pro-cart">
                                                        <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <!-- Single Product Start -->
                                        <div class="single-aboss-product mb-3">
                                            <div class="pro-img">
                                                <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                                <div class="pro-actions">
                                                    <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                </div>
                                            </div>
                                            <div class="pro-content">
                                                <h4><Link :href="route('producto')">Dorji bari East Long Style</Link></h4>
                                                <div class="pro-price-cart">
                                                    <div class="pro-home-price">
                                                        <span>$199.99</span>
                                                    </div>
                                                    <div class="pro-cart">
                                                        <a title="Añadir Al Carrito" href="#"><i class="icon-cart"></i></a>
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                </div>
                                <!-- Row End -->
                            </div>
                            <!-- #grid view End -->
                            <div id="list-view" class="tab-pane fade show active">
                                <!-- Single Product Start -->
                                <div class="single-aboss-product">
                                    <div class="pro-img">
                                        <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                        <div class="pro-actions">
                                            <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                        </div>
                                    </div>
                                    <div class="pro-content">
                                        <h4><Link :href="route('detalles-actividad')">Dorji bari East Long Style</Link></h4>
                                        <div class="rating">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        </div>
                                        <p><span class="prev-price">$14.99</span><span class="price">$18.99</span></p>
                                        <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                        <div class="pro-cart">
                                            <a href="#" title="Añadir Al Carrito">
                                                <i class="icon-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Product End -->
                                <!-- Single Product Start -->
                                <div class="single-aboss-product">
                                    <div class="pro-img">
                                        <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                        <div class="pro-actions">
                                            <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                        </div>
                                    </div>
                                    <div class="pro-content">
                                        <h4><Link :href="route('detalles-actividad')">Dorji bari East Long Style</Link></h4>
                                        <div class="rating">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        </div>
                                        <p><span class="prev-price">$14.99</span><span class="price">$18.99</span></p>
                                        <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                        <div class="pro-cart">
                                            <a href="#" title="Añadir Al Carrito">
                                                <i class="icon-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Product End -->
                                <!-- Single Product Start -->
                                <div class="single-aboss-product">
                                    <div class="pro-img">
                                        <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                        <div class="pro-actions">
                                            <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                        </div>
                                    </div>
                                    <div class="pro-content">
                                        <h4><Link :href="route('detalles-actividad')">Dorji bari East Long Style</Link></h4>
                                        <div class="rating">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        </div>
                                        <p><span class="prev-price">$14.99</span><span class="price">$18.99</span></p>
                                        <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                        <div class="pro-cart">
                                            <a href="#" title="Añadir Al Carrito">
                                                <i class="icon-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Product End -->
                                <!-- Single Product Start -->
                                <div class="single-aboss-product">
                                    <div class="pro-img">
                                        <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                        <div class="pro-actions">
                                            <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                        </div>
                                    </div>
                                    <div class="pro-content">
                                        <h4><Link :href="route('detalles-actividad')">Dorji bari East Long Style</Link></h4>
                                        <div class="rating">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        </div>
                                        <p><span class="prev-price">$14.99</span><span class="price">$18.99</span></p>
                                        <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                        <div class="pro-cart">
                                            <a href="#" title="Añadir Al Carrito">
                                                <i class="icon-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Product End -->
                                <!-- Single Product Start -->
                                <div class="single-aboss-product">
                                    <div class="pro-img">
                                        <Link :href="route('detalles-actividad')"><img src="/vendor_asset/img/products/p1.png" alt=""></Link>
                                        <div class="pro-actions">
                                            <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                        </div>
                                    </div>
                                    <div class="pro-content">
                                        <h4><Link :href="route('detalles-actividad')">Dorji bari East Long Style</Link></h4>
                                        <div class="rating">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        </div>
                                        <p><span class="prev-price">$14.99</span><span class="price">$18.99</span></p>
                                        <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                        <div class="pro-cart">
                                            <a href="#" title="Añadir Al Carrito">
                                                <i class="icon-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Product End -->
                            </div>
                            <!-- #list view End -->
                        </div>
                        <!-- Grid & List Main Area End -->
                    </div>
                    <!-- Shop Breadcrumb Area Start -->
                    <div class="shop-breadcrumb-area border-default mt-40">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-5">
                                <span class="show-items">Ver 1-12 de 13 item(s) </span>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-7">
                                <ul class="pfolio-breadcrumb-list text-center">
                                    <li class="float-left prev"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>Anterior</a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li class="float-right next"><a href="#">Siguiente<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Breadcrumb Area End -->
                </div>
                <!-- product Categorie List End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Shop Page End -->
</Layout>
    <QuickView />
</template>

<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Layout from '@/Layouts/Layout.vue'     
    import QuickView from '@/Components/QuickView.vue'
    import Breadcrumb from '@/Layouts/Components/Breadcrumb.vue'     
    export default {
        components: {
            Head,
            Link,
            Layout,
            QuickView,
            Breadcrumb,
        },
}

</script>