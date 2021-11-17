<template>
    <Head title="Carrito" />
    <Layout>

    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumb-area pt-65 pb-70 bg-img" style="background-image:url(/vendor_asset/img/bg-image/hop-brech-bg.jpg);">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h3>Carrito</h3>
                <ol class="breadcrumb breadcrumb-list">
                    <li class="breadcrumb-item"><Link :href="route('home')">Inicio</Link></li>
                    <li class="breadcrumb-item active">Carrito</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->

    <!-- Cart Main Area Start -->
    <div class="cart-main-area white-bg ptb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!-- Form Start -->
                    <form action="#">
                        <!-- Table Content Start -->
                        <div class="table-content table-responsive mb-45">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Imagen</th>
                                        <th class="product-name">Producto</th>
                                        <th class="product-price">Precio</th>
                                        <th class="product-quantity">Cantidad</th>
                                        <th class="product-subtotal">Total</th>
                                        <th class="product-remove">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img src="/vendor_asset/img/products/p1.png" alt="cart-image" /></a>
                                        </td>
                                        <td class="product-name"><Link href="route('producto')">summer dress</Link></td>
                                        <td class="product-price"><span class="amount">£165.00</span></td>
                                        <td class="product-quantity"><input type="number" value="1" /></td>
                                        <td class="product-subtotal">£165.00</td>
                                        <td class="product-remove"> <a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img src="/vendor_asset/img/products/p1.png" alt="cart-image" /></a>
                                        </td>
                                        <td class="product-name"><Link href="route('producto')">Printed Winter collection</Link></td>
                                        <td class="product-price"><span class="amount">£50.00</span></td>
                                        <td class="product-quantity"><input type="number" value="1" /></td>
                                        <td class="product-subtotal">£50.00</td>
                                        <td class="product-remove"> <a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img src="/vendor_asset/img/products/p1.png" alt="cart-image" /></a>
                                        </td>
                                        <td class="product-name"><Link href="route('producto')">awesome bag</Link></td>
                                        <td class="product-price"><span class="amount">£165.00</span></td>
                                        <td class="product-quantity"><input type="number" value="1" /></td>
                                        <td class="product-subtotal">£165.00</td>
                                        <td class="product-remove"> <a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img src="/vendor_asset/img/products/p1.png" alt="cart-image" /></a>
                                        </td>
                                        <td class="product-name"><Link :href="route('producto')">trolley bags</Link></td>
                                        <td class="product-price"><span class="amount">£50.00</span></td>
                                        <td class="product-quantity"><input type="number" value="1" /></td>
                                        <td class="product-subtotal">£50.00</td>
                                        <td class="product-remove"> <a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Table Content Start -->
                        <div class="row">
                           <!-- Cart Button Start -->
                            <div class="col-md-8 col-sm-12">
                                <div class="buttons-cart">
                                    <input class="bg-info" type="submit" value="Actualizar" />
                                    <Link class="bg-secondary" :href="route('souvenirs')">Continuar Comprando</Link>
                                </div>
                            </div>
                            <!-- Cart Button Start -->
                            <!-- Cart Totals Start -->
                            <div class="col-md-4 col-sm-12">
                                <div class="cart_totals float-md-right text-md-right">
                                    <h2>Total carrito</h2>
                                    <br />
                                    <table class="float-md-right">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Subtotal</th>
                                                <td><span class="amount">$215.00</span></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td>
                                                    <strong><span class="amount">$215.00</span></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="wc-proceed-to-checkout">
                                        <Link class="bg-info" :href="route('checkout')">Checkout</Link>
                                    </div>
                                </div>
                            </div>
                            <!-- Cart Totals End -->
                        </div>
                        <!-- Row End -->
                    </form>
                    <!-- Form End -->
                </div>
            </div>
             <!-- Row End -->
        </div>
    </div>
    <!-- Cart Main Area End -->
    
    </Layout>
</template>

<script>
    import { Link, Head } from '@inertiajs/inertia-vue3'
    import Layout from '@/Layouts/Layout.vue'        

    export default {
        components: {
            Link,
            Head,
            Layout,
        },
    }
</script>