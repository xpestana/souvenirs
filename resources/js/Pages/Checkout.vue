<template>
    <Head title="Checkout"/>
    <Menu />
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumb-area pt-65 pb-70 bg-img" style="background-image:url(/vendor_asset/img/bg-image/hop-brech-bg.jpg);">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h3>Checkout</h3>
                <ol class="breadcrumb breadcrumb-list">
                    <li class="breadcrumb-item"><Link :href="route('home')">Inicio</Link></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->

    <!-- checkout-area start -->
    <div class="checkout-area white-bg pt-60 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form mb-sm-40">
                        <h3>Detalles de Facturación</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="country-select clearfix mb-30">
                                    <label>País <span class="required">*</span></label>
                                    <select class="wide">
                                        <option value="">España</option>
                                        <option value="">Andorra</option>
                                        <option value="">Italia</option>
                                        <option value="">Francia</option>
                                        <option value="">Inglaterra</option>
                                        <option value="">Paises Bajos</option>
                                        <option value="">Venezuela</option>
                                        <option value="">Alemania</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-sm-30">
                                    <label>Nombre <span class="required">*</span></label>
                                    <input type="text" placeholder="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Apellido <span class="required">*</span></label>
                                    <input type="text" placeholder="" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label>Compañía</label>
                                    <input type="text" placeholder="" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Dirección <span class="required">*</span></label>
                                    <input type="text" placeholder="Calle" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mtb-30">
                                    <input type="text" placeholder="Apartamento, suite, unidad etc. (opcional)" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label>Poblado / Ciudad <span class="required">*</span></label>
                                    <input type="text" placeholder="Poblado / Ciudad" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Estado / Provincia <span class="required">*</span></label>
                                    <input type="text" placeholder="Estado / Provincia" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Código Postal <span class="required">*</span></label>
                                    <input type="text" placeholder="Código postal" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Correo <span class="required">*</span></label>
                                    <input type="email" placeholder="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Teléfono  <span class="required">*</span></label>
                                    <input type="text" placeholder="Teléfono" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list create-acc mb-30">
                                    <input id="cbox" type="checkbox" />
                                    <label>¿Crear una cuenta?</label>
                                </div>
                                <div id="cbox_info" class="checkout-form-list create-accounts mb-25">
                                    <p class="mb-10">Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                    <label>Clave  <span class="required">*</span></label>
                                    <input type="password" placeholder="password" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="your-order">
                        <h3>Tu orden</h3>
                        <div class="your-order-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-name">Producto</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            Vestibulum suscipit <span class="product-quantity"> × 1</span>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">£165.00</span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            Vestibulum dictum magna <span class="product-quantity"> × 1</span>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">£50.00</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal carrito</th>
                                        <td><span class="amount">£215.00</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total orden</th>
                                        <td><span class=" total amount">£215.00</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method d-flex justify-content-center">
                            <button type="submit" class="login-btn bg-secondary">Pagar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->

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