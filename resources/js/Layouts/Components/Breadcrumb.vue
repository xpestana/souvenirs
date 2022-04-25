<template>
	<!-- Breadcrumb Area Start Here -->
    <div class="breadcrumb-area pt-65 pb-70 bg-img h-52" :class="{'opacity-50':this.title == 'Souvenirs' || this.title == 'Actividades'}" :style="'background-image:url(/vendor_asset/img/bg-image/'+img+');'">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h3 :class="{'hidden': this.title == 'Souvenirs' || this.title == 'Actividades'}">{{ this.title }}</h3>
                <ol class="breadcrumb breadcrumb-list" hidden>
                    <li class="breadcrumb-item"><Link :href="route('home')">Inicio</Link></li>
                    <li class="breadcrumb-item active">{{ this.title }}</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="absolute top-20 left-0 right-0 text-center">
        <h3 v-if="this.title == 'Souvenirs' || this.title == 'Actividades'" class="text-3xl font-bold md:mt-3" :class="{'text-white': this.title == 'Contáctanos'}">{{ this.title }}</h3>
        <h5 v-if="this.title == 'Souvenirs'" class="text-sm font-bold mt-24 md:text-lg">
            Recibe tu souvenir en menos de 30 minutos <br>
            Envío gratuito en pedidos superiores de <Decimals :precio="Number(this.$page.props.settings.shippings)"/>€
        </h5>
    </div>
    <!-- Breadcrumb Area End Here -->
</template>
<script>
    import Decimals from '@/Layouts/Components/Decimals.vue'
	import { Link } from '@inertiajs/inertia-vue3'
	export default {
        components: {
            Link,
            Decimals
        },
        props: {
        	title: String,
    	},
        computed:{
            img(){
                if(this.title == 'Souvenirs'){
                    return 'souvenirs.png';
                }
                if(this.title == 'Actividades'){
                    return 'activities.png';
                }
                return 'hop-brech-bg.jpg';
            }
        }
    }
</script>