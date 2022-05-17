<template>
<nav class="navbar fixed-top navbar-light bg-light shadow-md">
  
    <div class="row justify-content-between w-100">
        <div class="col-3 col-lg-3 enlaces mt-3">
            <div class="dropdown">
            <button class="btn burger pb-0 pt-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <Link class="dropdown-item" :href="route('souvenirs')"><h3 class="font-weight-bolder">Souvenirs</h3></Link>
                <Link class="dropdown-item" :href="route('activities')"><h3 class="font-weight-bolder">Actividades</h3></Link>
                <Link class="dropdown-item" :href="route('contact')"><h3 class="font-weight-bolder">Contacto</h3></Link>
                <Link class="dropdown-item" href="#"><h3 class="font-weight-bolder">Ayuda</h3></Link>
            </div>
            </div>
        </div>
              <!-- Cart Box Start Here -->
        <div class="col-lg-3 col-3">
            <img class="mx-auto" src="/vendor_asset/img/logo/logo.png" alt="logo" width="65" @click="home" style="cursor: pointer;">
        </div>
        <div class="col-lg-3 col-3">
            <div class="search-cart-area text-right">
            <ul class="d-inline-flex">
                <li class="icon-login pt-2 mt-1 pb-0">
                    <div class="dropdown">
					<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
						<img class="d-inline" src="/vendor_asset/img/espana.png" alt="logo" width="40">
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="#">Spanish <img class="d-inline" src="/vendor_asset/img/espana.png" alt="logo" width="30"></a>
					</div>
				</div>
                </li>
                <Cart :key="$page.props.flash.id"/>
            </ul>
        </div>    
        </div>
<!-- Cart Box End Here -->
    </div>
</nav>
</template>
<script>
    import { Link } from '@inertiajs/inertia-vue3';
    import Cart from '@/Layouts/Components/Cart.vue' 

    export default{
        components: {
            Link,
            Cart,
        },
        created(){
        },
        methods: {
            logout(){
                this.$inertia.post(route('logout'), {
                    _token: this.$page.props.csrf_token,
                })
            },
            home(){
              this.$inertia.get(route('home'),{}, {
                    preserveScroll: true
                })
            },
        }
    }
</script>
<style scope>
nav .enlaces i{
    font-size: 1.5em;
}
</style>