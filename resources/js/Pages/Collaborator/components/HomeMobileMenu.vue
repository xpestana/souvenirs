<template>

    <nav class="navbar fixed-top navbar-light bg-white py-0" id="menu-mobile">
                            <!-- Navbar brand -->
        <div class="row">
            <div class="col-3">
                <button class="navbar-toggler first-button m-3 p-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent20"
                    aria-controls="navbarSupportedContent20" aria-expanded="false" aria-label="Toggle navigation" @click="navIcon">
                    <div class="animated-icon1"><span></span><span></span><span></span></div>
                </button>
            </div>
            <div class="col-9">
                <img class="w-36 ml-6 mt-3" src="/vendor_asset/img/logo/hilogo.png" alt="logo" @click="redirect()">
            </div>
        </div>

        <!-- Collapse button -->


        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent20">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
              <Link :href="route('souvenirs')" class="nav-link py-0">
                  <div class="d-inline-flex">
                      <p class="p-2 font-weight-bolder">Souvenirs</p>
                  </div>
              </Link>
              </li>
               <li class="nav-item">
              <Link :href="route('activities')" class="nav-link py-0">
                  <div class="d-inline-flex">
                      <p class="p-2 font-weight-bolder">Actividades</p>
                  </div>
              </Link>
              </li>
              <li class="nav-item">
              <Link :href="route('contact')" class="nav-link py-0">
                  <div class="d-inline-flex">
                      <p class="p-2 font-weight-bolder">Contacto</p>
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
        },
        redirect(){
            this.$inertia.get(route('home'))
        }
    }
}
</script>

<style scoped>
.animated-icon1 {
    width: 20px;
}
.animated-icon1 span:nth-child(2) {
    top: 8px;
}
.animated-icon1 span:nth-child(3) {
    top: 16px;
}
.animated-icon1.open span:nth-child(3) {
    top: 12px !important;
}
</style>