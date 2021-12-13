<template>
<Layout>
<div class="tab-content dashboard-content mt-all-40">
	<div id="orders" class="tab-pane fade show active">
        <h3>Mis ventas</h3>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;">1</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('cart')">Ver</Link></td>
                    </tr>
                    <tr>
                        <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;">1</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('cart')">Ver</Link></td>
                    </tr>
                    <tr>
                        <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;">1</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('cart')">Ver</Link></td>
                    </tr>
                    <tr>
                        <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;">1</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('cart')">Ver</Link></td>
                    </tr>
                    <tr>
                        <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;">1</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('cart')">Ver</Link></td>
                    </tr>
                    <tr>
                        <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;">1</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('cart')">Ver</Link></td>
                    </tr>
                    <tr>
                        <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;">1</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('cart')">Ver</Link></td>
                    </tr>
                    <tr>
                        <td class ="text-orders" style="font-size: 15px;">Summer Dress</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;">1</td>
                        <td style="font-size: 15px;">165 €</td>
                        <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('cart')">Ver</Link></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</Layout>
</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Layout from '@/Layouts/LayoutProfile.vue'      
    export default {
        components: {
            Head,
            Link,
            Layout,
        },
        created(){
        },
    }
</script>