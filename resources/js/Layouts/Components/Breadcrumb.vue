<template>
	<!-- Breadcrumb Area Start Here -->
    <div class="breadcrumb-area pt-65 pb-70 bg-img h-52" :class="{'opacity-50':this.title=='Souvenirs'}" :style="'background-image:url(/vendor_asset/img/bg-image/'+img+');'">
        <div class="container">
            <div class="breadcrumb-wrap text-center hidden md:block">
                <h3 :class="{'hidden':this.title=='Souvenirs'}">{{ this.title }}</h3>
                <ol class="breadcrumb breadcrumb-list" hidden>
                    <li class="breadcrumb-item"><Link :href="route('home')">Inicio</Link></li>
                    <li class="breadcrumb-item active">{{ this.title }}</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="absolute top-20 left-0 right-0 text-center">
        <h3 class="text-3xl font-bold md:mt-3" :class="{'text-white': this.title !== 'Souvenirs'}">{{ this.title }}</h3>
        <h5 v-if="this.title == 'Souvenirs'" class="text-sm font-bold mt-24 md:text-lg">
            Recibe tu souvenir en menos de 30 minutos <br>
            Envío gratuito en pedidos superiores de X
        </h5>
    </div>
    <!-- Breadcrumb Area End Here -->
</template>
<script>
	import { Link } from '@inertiajs/inertia-vue3'
	export default {
        components: {
            Link,
        },
        props: {
        	title: String,
    	},
        computed:{
            img(){
                if(this.title == 'Souvenirs'){
                    return 'souvenirs.png';
                }
                return 'hop-brech-bg.jpg';
            }
        }
    }
</script>