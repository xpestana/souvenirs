<template>
	<nav class="navbar fixed-top navbar-light bg-white d-block p-0 shadow-md" id="mobile">
                            <!-- Navbar brand -->
        <div class="row justify-content-between">
          <div class="col-4">
			  <button class="burger p-3" type="button" data-toggle="collapse" data-target="#collapseb" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation" @click="atenuar">
				<i class="fas fa-bars"></i>
				</button>
          </div>
		  <div class="col-4">
			  <img class="mx-auto" src="/vendor_asset/img/logo/logo.png" alt="logo" width="55" @click="home">
		  </div>
		  <div class="col-4 d-flex justify-end pr-4">
				<div class="dropdown mt-2">
					<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
						<img class="d-inline" src="/vendor_asset/img/spain.png" alt="logo" width="20">
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="#">Spanish <img class="d-inline" src="/vendor_asset/img/spain.png" alt="logo" width="20"></a>
					</div>
				</div>
				<Link :href="route('cart.index')">
					<img class="d-inline pt-3" src="/vendor_asset/img/cart.png" alt="logo" width="20">
				</Link>
          </div>
        </div>

        <!-- Collapse button -->
        

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="collapseb">

            <!-- Links -->
			<div class="row border-bottom titulo-nav mt-2">
				<div class="col-12">
					<ul class="navbar-nav">
						<li class="nav-item d-flex justify-between px-3">
							<h3 class="font-weight-bolder">Menú</h3>
							<button type="button" data-toggle="collapse" data-target="#collapseb"
								aria-controls="navbarSupportedContent20" aria-expanded="false" aria-label="Toggle navigation" @click="atenuar">
								<i class="fas fa-times font-weight-bolder"></i>
							</button>
							
						</li>
					</ul>
				</div>
			</div>
			<div class="row border-bottom items">
				<div class="col-6 p-4 border-right text-center">
					<ul class="navbar-nav">
						<li class="nav-item">
						<Link :href="route('activities')" class="nav-link py-0">
							<div class="">
								<i class="fas fa-biking text-azulc"></i>
								<p class="font-weight-bolder">Actividades</p>
							</div>
						</Link>
						</li>
					</ul>
				</div>
				<div class="col-6 p-4 text-center">
					<ul class="navbar-nav">
						<li class="nav-item">
						<Link :href="route('souvenirs')" class="nav-link py-0">
							<div class="">
								<i class="fas fa-gift text-azulc"></i>
								<p class="font-weight-bolder">Souvenirs</p>
							</div>
						</Link>
						</li>
					</ul>
				</div>
			</div>
			<div class="row items">
				<div class="col-6 p-4 border-right text-center">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
						<Link :href="route('contact')" class="nav-link py-0">
							<div class="">
								<i class="fas fa-comment text-azulc"></i>
								<p class="p-2 font-weight-bolder">Contacto</p>
							</div>
						</Link>
						</li>
					</ul>
				</div>
				<div class="col-6 p-4 text-center">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
						<Link href="#" class="nav-link py-0">
							<div class="">
								<i class="fas fa-question-circle text-azulc"></i>
								<p class="p-2 font-weight-bolder">Ayuda</p>
							</div>
						</Link>
						</li>
					</ul>
				</div>
			</div>
        </div>
        <!-- Collapsible content -->

    </nav>
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
			home(){
              this.$inertia.get(route('home'),{}, {
                    preserveScroll: true
                })
            },
			atenuar(){
				let inicio = document.getElementById('main-inicio');
				let viejo = document.getElementById('main-viejo');
				inicio != null ? inicio.classList.toggle('opacidad') : viejo.classList.toggle('opacidad')
			}
        }
	}
</script>
<style scoped>
#mobile .dropdown-menu.show {
    left: -80px !important;
}
#mobile .titulo-nav{
	font-size: 25px;
}
#mobile .items i{
	font-size: 35px;
}
#mobile  i{
	font-size:22px;
	opacity: 0.4;
}

  
  
  

</style>