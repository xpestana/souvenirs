<template>
	<layout>
		<div class="tab-content dashboard-content mt-all-40">
			 <!-- Product Thumbnail Start -->
        <div class="main-product-thumbnail white-bg pt-90 pb-90">
            <div class="container">
                <div class="row">
                    <!-- Main Thumbnail Image Start -->
                    <div class="col-lg-5 col-md-6 mb-all-40">
                        <!-- Thumbnail Large Image start -->
                        <div class="tab-content">
                            <div id="thumb1" class="tab-pane fade show active">
                                <a data-fancybox="images" :href="'/storage/hotel/'+hotel.image"><img :src="'/storage/hotel/'+hotel.image" :alt="hotel.name"></a>
                            </div>
                        </div>
                        <!-- Thumbnail Large Image End -->
                    </div>
                    <!-- Main Thumbnail Image End -->
                    <!-- Thumbnail Description Start -->
                    <div class="col-lg-7 col-md-6">
                        <div class="thubnail-desc fix">
                            <h3 class="product-header">Nombre del hotel</h3>
                            <h4 class="product-header">{{ hotel.name }}</h4>
                            <p class="pro-desc-details"><strong>Dirección:</strong> {{ hotel.address }}</p>
                            <p class="pro-desc-details"><strong>Zona:</strong> {{ hotel.zone }}</p>
                            <p class="pro-desc-details"><strong>Tipo:</strong> {{ hotel.type }}</p>
                            <h3 class="product-header mt-3">Director o Encargado</h3>
                            <h4 class="product-header mt-3">Nombre: {{ hotel.user[0].profile.firstname }} {{ hotel.user[0].profile.lastname }}</h4>
                            <p class="pro-desc-details"><strong>Genero:</strong> {{ hotel.user[0].profile.gender }}</p>
                            <p class="pro-desc-details"><strong>Correo:</strong> {{ hotel.user[0].email }}</p>
                            <div class="mt-30">
                                <ul>
                                    <li><Link class="text-info w-100" :href="route('hotels.edit',{hotel: hotel.id})">Editar Información del hotel</Link></li>
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
		</div>
	</layout>
</template>
<script>
	import { Head, Link } from '@inertiajs/inertia-vue3'
	import Layout from '@/Layouts/LayoutProfile.vue'   

	export default {
    	components: {
        	Head,
        	Link,
        	Layout,
    	},
    	props: {
        	hotel: Object,
    	},
    	methods: {
        	deleteHotel(hotel){
            	this.$inertia.delete(route('hotels.destroy',{hotel : hotel}))
        	}
    	}
	}
</script>