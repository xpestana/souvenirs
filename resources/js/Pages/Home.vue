<template>
    <!-- Main Wrapper Start Here -->
    <div id="welcome" class="bg-image">
        <div class="row m-0 pt-50 justify-content-center w-100">
            <img id="logo-welcome" src="vendor_asset/img/logo/logo.png">
        </div>
        <div class="row m-0 justify-content-center w-100">
            <div class="col-8 col-md-10 p-5">
                <p id="welcome-text" class="text-center">Un viaje lleno de experiencias y recuerdos</p>
            </div>
        </div>
        <div class="container">
            <div class="row m-0 w-100 justify-content-center">
                <div class="col-4 d-flex justify-content-center pr-1 pt-10 discount">
                    <Link
                        id="button-souvernirs"
                        class="bg-info"
                        :href="route('souvenirs')">
                            Souvenirs
                    </Link>
                </div>
                <div class="col-4 d-flex justify-content-center pl-1 pt-10 discount">
                    <Link
                        id="button-activities"
                        class="bg-info"
                        :href="route('actividades')">
                        Actividades
                    </Link>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Wrapper End Here -->
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';
    
    export default{
        components: {
            Link,
        },
    }
</script>
