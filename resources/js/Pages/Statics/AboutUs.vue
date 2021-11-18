<template>
    <Head title="Quiénes Somos"/>
<Layout>
    <Breadcrumb title="Quiénes Somos"/>
    <!-- About Us Area Start -->
    <div class="skill-area white-bg ptb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-content mb-all-40">
                       <!-- Section Title Start -->
                        <div class="section-title section-heading">
                            <h2 class="text-info">Hicitty</h2>
                        </div>
                        <!-- Section Title End -->
                        <p class="mb-20">Rian must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure</p>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia sequuntur magni dolores eos qui ratione em </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="/vendor_asset/img/team/Quienes-somos.jpg" />
                </div>
            </div>
        </div>
    </div>
</Layout>
</template>

<script>
    import { Link, Head } from '@inertiajs/inertia-vue3'
    import Layout from '@/Layouts/Layout.vue' 
    import Breadcrumb from '@/Layouts/Components/Breadcrumb.vue'  
    export default {
        components: {
            Link,
            Head,
            Layout,
            Breadcrumb,
        },
    }
</script>