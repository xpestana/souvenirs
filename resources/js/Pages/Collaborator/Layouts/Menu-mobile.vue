<template>
	<!-- Mobile Menu Start -->
    <div class="mobile-menu col-12 d-lg-none">
        <nav class="navbar navbar-light light-blue lighten-4 pt-1">

            <!-- Navbar brand -->
            <Link :href="route('collaborator.index')"><img class="w-32 pt-2.5" src="/vendor_asset/img/logo/hilogo.png" alt="logo"></Link>
            <!-- Collapse button -->
            <button class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
                aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="dark-blue-text"><i class="fas fa-bars fa-1x"></i></span>
            </button>

            <!-- Collapsible content -->
            <div class="collapse navbar-collapse row" id="navbarSupportedContent1">

                <!-- Links -->
                <div class="col-7 offset-5 col-md-5 col-offset-7 offset-5 shadow-md p-3">
                    <ul class="navbar-nav">
                        <li class="py-1">
                            <Link :href="route('collaborator.index')"><i class="fas fa-user iconNav"></i> 
                                My lodgings
                            </Link>
                        </li>
                        <li class="py-1"><Link :href="route('collaborator.ajustes.index')" ><i class="fas fa-wrench iconNav"></i>Settings</Link></li>
                        <template v-if="!this.$page.props.auth.user">
                            <li class="py-1"><Link :href="route('login')">Log in</Link></li>
                        </template>
                    </ul>
                </div>
                
                <!-- Links -->

            </div>
            <!-- Collapsible content -->

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
        },
        computed:{
            gestorDe(){
                if(this.$page.props.auth.user.profile == undefined){
                    return this.$page.props.auth.profile.gestor
                }
                return this.$page.props.auth.user.profile.gestor;
            }
        }
	}
</script>