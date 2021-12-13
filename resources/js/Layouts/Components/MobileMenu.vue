<template>
	<!-- Mobile Menu Start -->
    <div class="mobile-menu d-block d-lg-none">
    	<nav>
        	<ul>
            	<li><Link :href="route('home')">Inicio</Link></li>
            	<li><Link :href="route('souvenirs')">Souvenirs</Link></li>
            	<li><Link :href="route('activities')">Actividades</Link></li>
            	<li><Link :href="route('contact')">Contacto</Link></li>
            	<template v-if="this.$page.props.auth.user">
                	<li v-if="$page.props.auth.role != 'Client'"><Link :href="route('profile.index')">Mi cuenta</Link></li>
                    <li><Link :href="route('cart.index')">Carrito</Link></li>
                    <li><a href="javascript:void(0);" @click.prevent="logout">Cerrar sesión</a></li>
                </template>
                <template v-else>
                	<li><Link :href="route('login')">Iniciar Sesión</Link></li>
                	<li><Link :href="route('cart.index')">Carrito</Link></li>
                    <li><Link :href="route('contact')">Contacto</Link></li>
                </template>
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
        methods: {
            logout(){
                this.$inertia.post(route('logout'), {
                    _token: this.$page.props.csrf_token,
                })
            },
        }
	}
</script>