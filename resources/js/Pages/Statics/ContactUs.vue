<template>
    <Head title="Contáctanos"/>
    <Layout>
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumb-area pt-65 pb-70 bg-img" style="background-image:url(/vendor_asset/img/bg-image/hop-brech-bg.jpg);">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h3>Contáctanos</h3>
                <ol class="breadcrumb breadcrumb-list">
                    <li class="breadcrumb-item"><Link :href="route('home')">Inicio</Link></li>
                    <li class="breadcrumb-item active">Contáctanos</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Regester Page Start Here -->
    <div class="register-area white-bg ptb-80">
        <div class="container">
        <h3 class="login-header text-info">Contáctanos</h3>
            <div class="row">
                <div class="col-xl-12">
                    <div class="register-contact  clearfix">
                        <form id="contact-form" class="contact-form" action="mail.php" method="post">
                            <div class="address-wrapper row">
                                <div class="col-md-6">
                                    <div class="address-fname">
                                        <input class="form-control" type="text" name="firstname" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-fname">
                                        <input class="form-control" type="text" name="secondName" placeholder="Apellido">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-email">
                                        <input class="form-control" type="email" name="email" placeholder="Correo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-web">
                                        <input class="form-control" type="number" name="tlf" placeholder="Teléfono">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="address-subject">
                                        <input class="form-control" type="text" name="subject" placeholder="Asunto">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="address-textarea">
                                        <textarea name="message" class="form-control" placeholder="Escríbenos..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-content mail-content clearfix">
                                <div class="send-email float-md-right">
                                    <input value="Enviar" class="return-customer-btn bg-info" type="submit">
                                </div>
                            </div>
                            <p class="form-message"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Page End Here -->
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