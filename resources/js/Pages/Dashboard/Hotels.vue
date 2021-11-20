<template>
	<Layout>
		<div class="tab-content dashboard-content mt-all-40">
    		<div id="hotels" class="tab-pane fade show active">
    			<h3>Administrador de Hoteles Registrados</h3>
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