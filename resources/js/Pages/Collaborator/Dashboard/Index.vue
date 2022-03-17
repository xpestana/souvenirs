<template>
  	<Head title="Alojamientos"/>
     <div class="container">
        <div class="caja">
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <h1>¿Necesitas ayuda?</h1>
                    <p>Atención especializada</p>
                    <p>(+34) 777 777 777</p>
            	</div>
        	    <div class="col-12 text-center">
                    <template v-if="hotels.length == 0">
                		  <a href="javascript:void(0)" class="btn btn-outline-info boton" @click.prevent="lodging"> <i class="fas fa-plus"></i>Añadir alojamiento</a>
                    </template>
                    <template v-else>
                        Vista de alojamientos
                    </template>
                </div>
            </div>    
        </div>
    </div>  
</template>
<script>
	import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'  
	import { Head, Link } from '@inertiajs/inertia-vue3'

	export default {
		layout:TemplateApp,
		components:{
			Head,
        	Link,
		},
        props: {
            hotels: Object,
        },
		methods: {
			lodging(){
                this.$inertia.get(route('collaborator.create.hab'),{}, {
                    preserveScroll: true
                })
        	},
		}
	}
</script>
<style scope>
	body{
		background-color: transparent;
	}
	.caja h1{
    font-size: 2em;
    font-weight: bolder;
}
.caja .boton{
    padding: 10px 50px;
    font-size: 25px;
    margin-top: 50px;
    border-radius:20px;
}
.caja .boton i{
    padding-right: 20px;
}
.caja .boton:hover{
    color:#fff;
}

/* responsive */
@media (max-width:450px){
    .caja .boton{
        padding: 10px;
    }
    .caja .boton i{
        padding-right: 5px;
    }
}
</style>