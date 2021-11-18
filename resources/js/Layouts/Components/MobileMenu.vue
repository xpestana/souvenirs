<template>
	<!-- Mobile Menu Start -->
    <div class="mobile-menu d-block d-lg-none">
    	<nav>
        	<ul>
            	<li><Link :href="route('home')">Inicio</Link></li>
            	<li><Link :href="route('souvenirs')">Souvenirs</Link></li>
            	<li><Link :href="route('activities')">Actividades</Link></li>
            	<li><Link :href="route('contact')">Contacto</Link></li>
        	</ul>
    	</nav>
	</div>
	<!-- Mobile Menu End -->
</template>
<script>
	import { Link } from '@inertiajs/inertia-vue3';
	export default{
		components: {
            Link,
        },
	}
</script>