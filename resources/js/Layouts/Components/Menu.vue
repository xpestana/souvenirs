<template>
<nav class="navbar fixed-top navbar-light bg-light">
  
    <div class="row justify-content-between w-100">
        <div class="col-4 col-lg-4 enlaces mt-4">
            <div class="dropdown">
            <button class="btn border rounded pb-0 pt-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <Link class="dropdown-item" :href="route('souvenirs')">Souvenirs</Link>
                <Link class="dropdown-item" :href="route('activities')">Actividades</Link>
                <Link class="dropdown-item" :href="route('contact')">Contacto</Link>
                <Link class="dropdown-item" href="#">Ayuda</Link>
            </div>
            </div>
        </div>
              <!-- Cart Box Start Here -->
        <div class="col-lg-3 col-2">
            <img src="/vendor_asset/img/logo/logo.png" alt="logo" height="80" width="80">
        </div>
        <div class="col-lg-3 col-5">
            <div class="search-cart-area text-right">
            <ul class="d-inline-flex">
                <li class="icon-login pt-3 pb-0 mb-0">
                    <div class="dropdown">
					<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
						<img class="d-inline" src="/vendor_asset/img/spanish.png" alt="logo" height="50" width="50">
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="#">Spanish <img class="d-inline" src="/vendor_asset/img/spanish.png" alt="logo" height="30" width="30"></a>
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
        }
    }
</script>
<style scope>
nav .enlaces i{
    font-size: 1.5em;
}
</style>