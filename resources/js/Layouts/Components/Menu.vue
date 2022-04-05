<template>
<nav class="navbar navbar-light bg-light">
  
    <div class="row justify-content-between w-100">
        <div class="col-lg-3 col-2">
                <img src="/vendor_asset/img/logo/logo.png" alt="logo" height="80" width="80">
        </div>
        <div class="enlaces col-4 col-lg-4 d-flex align-items-center">
            <Link class="d-inline px-4" :href="route('souvenirs')">Souvenirs</Link>
            <Link class="d-inline px-4" :href="route('activities')">Actividades</Link>
            <Link class="d-inline px-4" :href="route('contact')">Contacto</Link>
        </div>
              <!-- Cart Box Start Here -->
        <div class="col-lg-3 col-5">
            <div class="search-cart-area text-right">
            <ul class="d-inline-flex">
                <Cart :key="$page.props.flash.id"/>
                <li class="icon-login pt-3 pb-0 mb-0 mt-1">
                    <div class="dropdown dropleft">
					<button class="btn dropdown-toggle dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
						<img class="d-inline" src="/vendor_asset/img/spanish.png" alt="logo" height="70" width="70">
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="#">Spanish <img class="d-inline" src="/vendor_asset/img/spanish.png" alt="logo" height="30" width="30"></a>
					</div>
				</div>
                </li>
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
nav .enlaces{
    font-size: 20px;
}
</style>