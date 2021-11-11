<template>
    <Head title="Actividades" />
	<Layout>
    <!-- Main Wrapper Start Here -->
    <div class="wrapper">
        <div class="breadcrumb-area pt-65 pb-70 bg-img" style="background-image:url(img/bg-image/hop-brech-bg.jpg);">
            <div class="container">
                <div class="breadcrumb-wrap text-center">
                    <h3>Actividades</h3>
                    <ol class="breadcrumb breadcrumb-list">
                        <li class="breadcrumb-item"><Link :href="route('home')">Inicio</Link></li>
                        <li class="breadcrumb-item active">Actividades</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End Here -->
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
                                <h3 class="sidebar-title">categories</h3>
                                <ul class="sidbar-style">
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" id="camera" type="checkbox">
                                        <label class="form-check-label" for="camera">Cameras (8)</label>
                                    </li>
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" id="GamePad" type="checkbox">
                                        <label class="form-check-label" for="GamePad">GamePad (8)</label>
                                    </li>
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" id="Digital" type="checkbox">
                                        <label class="form-check-label" for="Digital">Digital Cameras (8)</label>
                                    </li>
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" id="Virtual" type="checkbox">
                                        <label class="form-check-label" for="Virtual"> Virtual Reality (8) </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="color mb-30">
                                <h3 class="sidebar-title">color</h3>
                                <ul class="color-option sidbar-style">
                                    <li>
                                        <span class="white"></span>
                                        <a href="#">white (4)</a>
                                    </li>
                                    <li>
                                        <span class="orange"></span>
                                        <a href="#">Orange (2)</a>
                                    </li>
                                    <li>
                                        <span class="blue"></span>
                                        <a href="#">Blue (6)</a>
                                    </li>
                                    <li>
                                        <span class="yellow"></span>
                                        <a href="#">Yellow (8)</a>
                                    </li>
                                    <li>
                                        <span class="black"></span>
                                        <a href="#">black (6)</a>
                                    </li>
                                    <li>
                                        <span class="biege"></span>
                                        <a href="#">biege (2)</a>
                                    </li>
                                    <li>
                                        <span class="green"></span>
                                        <a href="#">green (11)</a>
                                    </li>
                                    <li>
                                        <span class="pink"></span>
                                        <a href="#">pink (8)</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Product Color End -->
                            <!-- Sidebar Categorie Start -->
                            <div class="sidebar-categorie mb-30">
                                <h3 class="sidebar-title">Components</h3>
                                <ul class="sidbar-style">
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" type="checkbox">
                                        <label class="form-check-label">cotton (4)</label>
                                    </li>
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" type="checkbox">
                                        <label class="form-check-label">polyester (4)</label>
                                    </li>
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" type="checkbox">
                                        <label class="form-check-label">Viscose (5)</label>
                                    </li>
                                </ul>
                            </div>
                            <!-- Sidebar Categorie Start -->
                            <!-- Sidebar Categorie Start -->
                            <div class="sidebar-categorie mb-30">
                                <h3 class="sidebar-title">Styles</h3>
                                <ul class="sidbar-style">
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" type="checkbox">
                                        <label class="form-check-label">casual (5)</label>
                                    </li>
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" type="checkbox">
                                        <label class="form-check-label">dressy (2)</label>
                                    </li>
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" type="checkbox">
                                        <label class="form-check-label">girly (8)</label>
                                    </li>
                                </ul>
                            </div>
                            <!-- Sidebar Categorie Start -->
                             <!-- Sidebar Categorie Start -->
                            <div class="sidebar-categorie">
                                <h3 class="sidebar-title">Properties</h3>
                                <ul class="sidbar-style">
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" type="checkbox">
                                        <label class="form-check-label">colorful dress (2)</label>
                                    </li>
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" type="checkbox">
                                        <label class="form-check-label">maxi dress (2)</label>
                                    </li>
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" type="checkbox">
                                        <label class="form-check-label">midi dress (2)</label>
                                    </li>
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" type="checkbox">
                                        <label class="form-check-label">short dress (4) </label>
                                    </li>
                                    <li class="form-check">
                                        <input class="form-check-input" value="#" type="checkbox">
                                        <label class="form-check-label">short sleve (3) </label>
                                    </li>
                                </ul>
                            </div>
                            <!-- Sidebar Categorie Start -->
                        </div>
                        <!-- Single Banner Start -->
                        <div class="sidebar-banner mt-30">
                            <a href="shop.html"><img class="ful" src="img/banner/hop-banner-4.jpg" alt="slider-banner"></a>
                        </div>
                        <!-- Single Banner End -->
                    </div>
                    <!-- Sidebar Shopping Option End -->
                    <!-- Product Categorie List Start -->
                    <div class="col-lg-9 col-md-8">
                       <div class="shop-banner mb-40">
                           <img src="img/banner/b9.jpg" alt="banner-img">
                       </div>
                        <!-- Grid & List View Start -->
                        <div class="grid-list-top border-default universal-padding d-lg-flex justify-content-md-between align-items-center mb-30">
                            <div class="grid-list-view d-flex align-items-center  mb-sm-15">
                                <ul class="nav tabs-area d-flex align-items-center">
                                    <li><a data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                    <li><a class="active" data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
                                </ul>
                                <span class="show-items">There are 8 products.</span>
                            </div>
                            <!-- Toolbar Short Area Start -->
                            <div class="main-toolbar-sorter clearfix">
                                <div class="toolbar-sorter d-md-flex align-items-center">
                                    <label>Sort By:</label>
                                    <select class="sorter wide">
                                        <option value="Position">Relevance</option>
                                        <option value="Product Name">Neme, A to Z</option>
                                        <option value="Product Name">Neme, Z to A</option>
                                        <option value="Price">Price low to heigh</option>
                                        <option value="Price">Price heigh to low</option>
                                    </select>
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
                                                    <a href="product-details.html"><img src="img/products/p1.jpg" alt=""></a>
                                                    <div class="pro-actions">
                                                        <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                    </div>
                                                </div>
                                                <div class="pro-content">
                                                    <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                                                    <div class="pro-price-cart">
                                                        <div class="pro-home-price">
                                                            <span>$199.99</span>
                                                        </div>
                                                        <div class="pro-cart">
                                                            <a title="Add To Cart" href="#"><i class="icon-cart"></i></a>
                                                            <a title="Wishlist" href="#"><i class="icon-like"></i></a>
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
                                                    <a href="product-details.html"><img src="img/products/p2.jpg" alt=""></a>
                                                    <div class="pro-actions">
                                                        <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                    </div>
                                                </div>
                                                <div class="pro-content">
                                                    <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                                                    <div class="pro-price-cart">
                                                        <div class="pro-home-price">
                                                            <span>$199.99</span>
                                                        </div>
                                                        <div class="pro-cart">
                                                            <a title="Add To Cart" href="#"><i class="icon-cart"></i></a>
                                                            <a title="Wishlist" href="#"><i class="icon-like"></i></a>
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
                                                    <a href="product-details.html"><img src="img/products/p3.jpg" alt=""></a>
                                                    <div class="pro-actions">
                                                        <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                    </div>
                                                </div>
                                                <div class="pro-content">
                                                    <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                                                    <div class="pro-price-cart">
                                                        <div class="pro-home-price">
                                                            <span>$199.99</span>
                                                        </div>
                                                        <div class="pro-cart">
                                                            <a title="Add To Cart" href="#"><i class="icon-cart"></i></a>
                                                            <a title="Wishlist" href="#"><i class="icon-like"></i></a>
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
                                                    <a href="product-details.html"><img src="img/products/p4.jpg" alt=""></a>
                                                    <div class="pro-actions">
                                                        <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                    </div>
                                                </div>
                                                <div class="pro-content">
                                                    <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                                                    <div class="pro-price-cart">
                                                        <div class="pro-home-price">
                                                            <span>$199.99</span>
                                                        </div>
                                                        <div class="pro-cart">
                                                            <a title="Add To Cart" href="#"><i class="icon-cart"></i></a>
                                                            <a title="Wishlist" href="#"><i class="icon-like"></i></a>
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
                                                    <a href="product-details.html"><img src="img/products/p5.jpg" alt=""></a>
                                                    <div class="pro-actions">
                                                        <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                    </div>
                                                </div>
                                                <div class="pro-content">
                                                    <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                                                    <div class="pro-price-cart">
                                                        <div class="pro-home-price">
                                                            <span>$199.99</span>
                                                        </div>
                                                        <div class="pro-cart">
                                                            <a title="Add To Cart" href="#"><i class="icon-cart"></i></a>
                                                            <a title="Wishlist" href="#"><i class="icon-like"></i></a>
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
                                                    <a href="product-details.html"><img src="img/products/p6.jpg" alt=""></a>
                                                    <div class="pro-actions">
                                                        <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                    </div>
                                                </div>
                                                <div class="pro-content">
                                                    <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                                                    <div class="pro-price-cart">
                                                        <div class="pro-home-price">
                                                            <span>$199.99</span>
                                                        </div>
                                                        <div class="pro-cart">
                                                            <a title="Add To Cart" href="#"><i class="icon-cart"></i></a>
                                                            <a title="Wishlist" href="#"><i class="icon-like"></i></a>
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
                                                    <a href="product-details.html"><img src="img/products/p7.jpg" alt=""></a>
                                                    <div class="pro-actions">
                                                        <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                    </div>
                                                </div>
                                                <div class="pro-content">
                                                    <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                                                    <div class="pro-price-cart">
                                                        <div class="pro-home-price">
                                                            <span>$199.99</span>
                                                        </div>
                                                        <div class="pro-cart">
                                                            <a title="Add To Cart" href="#"><i class="icon-cart"></i></a>
                                                            <a title="Wishlist" href="#"><i class="icon-like"></i></a>
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
                                                    <a href="product-details.html"><img src="img/products/p8.jpg" alt=""></a>
                                                    <div class="pro-actions">
                                                        <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                    </div>
                                                </div>
                                                <div class="pro-content">
                                                    <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                                                    <div class="pro-price-cart">
                                                        <div class="pro-home-price">
                                                            <span>$199.99</span>
                                                        </div>
                                                        <div class="pro-cart">
                                                            <a title="Add To Cart" href="#"><i class="icon-cart"></i></a>
                                                            <a title="Wishlist" href="#"><i class="icon-like"></i></a>
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
                                                    <a href="product-details.html"><img src="img/products/p1.jpg" alt=""></a>
                                                    <div class="pro-actions">
                                                        <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                                    </div>
                                                </div>
                                                <div class="pro-content">
                                                    <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                                                    <div class="pro-price-cart">
                                                        <div class="pro-home-price">
                                                            <span>$199.99</span>
                                                        </div>
                                                        <div class="pro-cart">
                                                            <a title="Add To Cart" href="#"><i class="icon-cart"></i></a>
                                                            <a title="Wishlist" href="#"><i class="icon-like"></i></a>
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
                                            <a href="product-details.html"><img src="img/products/p1.jpg" alt=""></a>
                                            <div class="pro-actions">
                                                <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                            </div>
                                        </div>
                                        <div class="pro-content">
                                            <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                                            <div class="rating">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                            <p><span class="prev-price">$30.50</span><span class="price">$28.98</span></p>
                                            <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                            <div class="pro-cart">
                                                <a href="#" title="Add To Cart">
                                                    <i class="icon-cart"></i>
                                                </a>
                                                <a href="#" title="Wishlist">
                                                    <i class="icon-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Product End -->
                                    <!-- Single Product Start -->
                                    <div class="single-aboss-product">
                                        <div class="pro-img">
                                            <a href="product-details.html"><img src="img/products/p2.jpg" alt=""></a>
                                            <div class="pro-actions">
                                                <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                            </div>
                                        </div>
                                        <div class="pro-content">
                                            <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                                            <div class="rating">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                            <p><span class="prev-price">$25.55</span><span class="price">$28.55</span></p>
                                             <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                            <div class="pro-cart">
                                                <a href="#" title="Add To Cart">
                                                    <i class="icon-cart"></i>
                                                </a>
                                                <a href="#" title="Wishlist">
                                                    <i class="icon-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Product End -->
                                    <!-- Single Product Start -->
                                    <div class="single-aboss-product">
                                        <div class="pro-img">
                                            <a href="product-details.html"><img src="img/products/p3.jpg" alt="product-img"></a>
                                            <div class="pro-actions">
                                                <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                            </div>
                                        </div>
                                        <div class="pro-content">
                                            <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                                            <div class="rating">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                            <p><span class="prev-price">$11.14</span><span class="price">$12.33</span></p>
                                            <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                            <div class="pro-cart">
                                                <a href="#" title="Add To Cart">
                                                    <i class="icon-cart"></i>
                                                </a>
                                                <a href="#" title="Wishlist">
                                                    <i class="icon-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Product End -->
                                    <!-- Single Product Start -->
                                    <div class="single-aboss-product">
                                        <div class="pro-img">
                                            <a href="product-details.html"><img src="img/products/p4.jpg" alt=""></a>
                                            <div class="pro-actions">
                                                <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                            </div>
                                        </div>
                                        <div class="pro-content">
                                            <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
                                            <div class="rating">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                            <p><span class="prev-price">$30.50</span><span class="price">$28.98</span></p>
                                            <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                            <div class="pro-cart">
                                                <a href="#" title="Add To Cart">
                                                    <i class="icon-cart"></i>
                                                </a>
                                                <a href="#" title="Wishlist">
                                                    <i class="icon-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Product End -->
                                    <!-- Single Product Start -->
                                    <div class="single-aboss-product">
                                        <div class="pro-img">
                                            <a href="product-details.html"><img src="img/products/p5.jpg" alt=""></a>
                                            <div class="pro-actions">
                                                <a data-toggle="modal" data-target="#product-window" class="quick-view" href="#"><i class="icon-zoom"></i></a>
                                            </div>
                                        </div>
                                        <div class="pro-content">
                                            <h4><a href="product-details.html">Dorji bari East Long Style</a></h4>
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
                                                <a href="#" title="Add To Cart">
                                                    <i class="icon-cart"></i>
                                                </a>
                                                <a href="#" title="Wishlist">
                                                    <i class="icon-like"></i>
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
                                    <span class="show-items">Showing 1-12 of 13 item(s) </span>
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-7">
                                    <ul class="pfolio-breadcrumb-list text-center">
                                        <li class="float-left prev"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>Previous</a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li class="float-right next"><a href="#">Next<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
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
        <Footer />
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
                                                <a data-fancybox="images" href="img/products/p3.jpg"><img src="img/products/p3.jpg" alt="product-view"></a>
                                            </div>
                                            <div id="pro-2" class="tab-pane fade">
                                                <a data-fancybox="images" href="img/products/p5.jpg"><img src="img/products/p5.jpg" alt="product-view"></a>
                                            </div>
                                            <div id="pro-3" class="tab-pane fade">
                                                <a data-fancybox="images" href="img/products/p7.jpg"><img src="img/products/p7.jpg" alt="product-view"></a>
                                            </div>
                                            <div id="pro-4" class="tab-pane fade">
                                                <a data-fancybox="images" href="img/products/p2.jpg"><img src="img/products/p2.jpg" alt="product-view"></a>
                                            </div>
                                        </div>
                                        <!-- Thumbnail Large Image End -->
                                        <!-- Thumbnail Image End -->
                                        <div class="product-thumbnail">
                                            <div class="thumb-menu owl-carousel nav nav-style tabs-area" role="tablist">
                                                <a class="active" data-toggle="tab" href="#pro-1"><img src="img/thumbail/t1.jpg" alt="product-thumbnail"></a>
                                                <a data-toggle="tab" href="#pro-2"><img src="img/thumbail/t2.jpg" alt="product-thumbnail"></a>
                                                <a data-toggle="tab" href="#pro-3"><img src="img/thumbail/t3.jpg" alt="product-thumbnail"></a>
                                                <a data-toggle="tab" href="#pro-4"><img src="img/thumbail/t4.jpg" alt="product-thumbnail"></a>
                                            </div>
                                        </div>
                                        <!-- Thumbnail image end -->
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
                                            <p class="pro-desc-details">Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessor- ize with a straw hat and you're ready for summer!</p>
                                            <div class="product-size mtb-30 clearfix">
                                                <label>Size</label>
                                                <select class="">
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>L</option>
                                                </select>
                                            </div>
                                            <div class="color clearfix mb-30">
                                                <label>color</label>
                                                <ul class="color-list">
                                                   <li>
                                                        <a class="white" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="orange active" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="paste" href="#"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="quatity-stock">
                                               <label>Quantity</label>
                                                <ul class="d-flex flex-wrap  align-items-center">
                                                    <li class="box-quantity">
                                                        <form action="#">
                                                            <input class="quantity" type="number" min="1" value="1">
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <button class="pro-cart">add to cart</button>
                                                    </li>
                                                    <li class="pro-ref">
                                                        <p><span class="in-stock"><i class="ion-checkmark-round"></i> in stock</span></p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="social-sharing mt-30">
                                                <ul>
                                                    <li><label>share</label></li>
                                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
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
    </div>
    <!-- Main Wrapper End Here -->
    </Layout>
</template>

<script>

import { Head, Link } from '@inertiajs/inertia-vue3';
import Layout from '@/Layouts/Layout.vue';

export default {
    components: {
        Layout,
        Head,
        Link,
    },
}

</script>
