<template>
    <nav class="navbar fixed-top navbar-light bg-white bg-trans py-0 xl:px-16 2xl:px-28" id="navbar">

        <div class="row justify-content-between w-100">
            <div class="col-6 d-md-none">
                <div class="dropdown">
                <button class="btn burger pb-0 pt-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <Link class="dropdown-item" :href="route('souvenirs')"><h3 class="font-weight-bolder">Souvenirs</h3></Link>
                    <Link class="dropdown-item" :href="route('activities')"><h3 class="font-weight-bolder">Activities</h3></Link>
                    <Link class="dropdown-item" :href="route('contact')"><h3 class="font-weight-bolder">Contact</h3></Link>
                    <Link class="dropdown-item" href="#"><h3 class="font-weight-bolder">Help</h3></Link>
                </div>
                </div>
            </div>

            <div class="col-6">
                <img class="mx-auto w-96 pt-3.5 cursor-pointer" src="/vendor_asset/img/logo/hilogo.png" alt="logo" id="logo" @click="redirect()">
            </div>
            <div class="col-md-6 text-right pt-3.5">
                <Link :href="route('collaborator.register')" class="btn btn-collaborator w-48 text-xl mr-4">
                <p class="text-xl font-weight-bolder">Sign up</p>
                </Link>
                <Link :href="route('login')" class="btn btn-outline-collaborator w-48 text-xl">Log in</Link>
            </div>
        </div>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components:{
        Link
    },
    created () {
        window.addEventListener('scroll', this.handleScroll);
    },
    destroyed () {
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
        handleScroll (event) {
            let posicion = document.documentElement.scrollTop;
            if(posicion > 30){
                document.getElementById('logo').classList.remove('w-96');
                document.getElementById('logo').classList.add('w-48');
                document.getElementById('navbar').classList.remove('bg-trans');
                document.getElementById('navbar').classList.add('shadow-md');
            }else{
                document.getElementById('logo').classList.remove('w-48');
                document.getElementById('logo').classList.add('w-96');
                document.getElementById('navbar').classList.add('bg-trans');
                document.getElementById('navbar').classList.remove('shadow-md');
            }
        },
        redirect(){
            this.$inertia.get(route('home'))
        }
    }
}
</script>

<style>
</style>