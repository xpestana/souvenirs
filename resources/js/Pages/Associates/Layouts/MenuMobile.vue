<template>

    <nav class="navbar fixed-top navbar-light bg-light d-block d-md-none" id="menu-mobile">
                            <!-- Navbar brand -->
        <div class="row justify-content-between">
          <div class="col-4">
            <img class="ml-4 pt-4" src="/vendor_asset/img/logo/hilogo.png" alt="logo">
          </div>
          <div class="col-4 text-right">
            <button class="navbar-toggler first-button m-3 p-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent20"
                aria-controls="navbarSupportedContent20" aria-expanded="false" aria-label="Toggle navigation" @click="navIcon">
                <div class="animated-icon1"><span></span><span></span><span></span></div>
            </button>
          </div>
        </div>

        <!-- Collapse button -->
        

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent20">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <Link :href="route('associates.collaborations')" class="nav-link py-0">
                        <div class="d-inline-flex">
                            <i class="fas fa-mobile-alt my-auto pr-1"></i>
                            <p class="p-2 font-weight-bolder">Colaboración</p>
                        </div>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link :href="route('associates.index')" class="nav-link py-0">
                        <div class="d-inline-flex">
                            <i class="fas fa-biking my-auto pr-1"></i>
                            <p class="p-2 font-weight-bolder">Servicios prestados</p>
                        </div>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link :href="route('associates.settings')" class="nav-link py-0">
                        <div class="d-inline-flex">
                            <i class="fas fa-cog my-auto pr-1"></i>
                            <p class="p-2 font-weight-bolder">Ajustes</p>
                        </div>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link :href="route('logout')" class="nav-link py-0">
                        <div class="d-inline-flex">
                            <i class="fas fa-power-off my-auto pr-1"></i>
                            <p class="p-2 font-weight-bolder">Cerrar sesión</p>
                        </div>
                    </Link>
                </li>
            </ul>
            <!-- Links -->

        </div>
        <!-- Collapsible content -->

    </nav>

</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components:{
        Link,
    },
    methods:{
        navIcon(){
            $('.animated-icon1').toggleClass('open');
        }
    }
}
</script>

<style scoped>


</style>