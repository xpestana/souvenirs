<template>
	<!-- Mobile Menu Start -->
    <div class="mobile-menu d-block d-lg-none">
    	<nav>
        	<ul>
            	<li><Link :href="route('souvenirs')">Souvenirs</Link></li>
            	<li><Link :href="route('activities')">Actividades</Link></li>
            	<template v-if="this.$page.props.auth.user">
                	<li v-if="$page.props.auth.role != 'Client'"><Link :href="route('profile.index')">Mi cuenta</Link></li>
                    <li><Link :href="route('logout.destroy')">Cerrar sesión</Link></li>
                    <li><a href="javascript:void(0);" ></a></li>
                </template>
                <template v-else>
                	<li><Link :href="route('login')">Iniciar Sesión</Link></li>
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
            logout(){alert('hola');
                this.$inertia.post(route('logout'), {
                    _token: this.$page.props.csrf_token,
                })
            },
        }
	}
</script>