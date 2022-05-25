<template>
	<!-- Breadcrumb Area Start Here -->
    <div class="breadcrumb-area pt-65 pb-70 bg-img h-52" :class="{'opacity-50':this.title == 'Souvenirs' || this.title == 'Activities'}" :style="'background-image:url(/vendor_asset/img/bg-image/'+img+');'">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h3 :class="{'hidden': this.title == 'Souvenirs' || this.title == 'Activities'}">{{ this.title }}</h3>
                <ol class="breadcrumb breadcrumb-list" hidden>
                    <li class="breadcrumb-item"><Link :href="route('home')">Home</Link></li>
                    <li class="breadcrumb-item active">{{ this.title }}</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="absolute top-20 left-0 right-0 text-center">
        <h3 v-if="this.title == 'Souvenirs' || this.title == 'Activities'" class="text-3xl font-bold md:mt-10" :class="{'text-white': this.title == 'Contáctanos'}">{{ this.title }}</h3>
        <h5 v-if="this.title == 'Souvenirs'" class="text-sm font-bold mt-12 pt-4 md:text-lg">
            Receive your souvenir in less than 30 minutes <br>
            Free shipping on orders over <Decimals :precio="Number(this.$page.props.settings.shippings)"/>€
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
                if(this.title == 'Activities'){
                    return 'activities.png';
                }
                return 'hop-brech-bg.jpg';
            }
        }
    }
</script>