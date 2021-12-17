<template>
	<div align="center">
  			<DatePicker v-model="form.range" :min-date='product.activities.init' :max-date='product.activities.end'/>
  			<div class="form-group row mt-4">
  				<div class="col-8">
  					<label class="mt-2" for="adult">Número de adultos</label>
                </div>
                <div class="col-3">
                    <input type="number" class="form-control mt-1 block w-full" min="0" v-model="form.adult">
                </div>
                <div class="col-8">
                	<label class="mt-2" for="adult">Número de niños</label>
                </div>
                <div class="col-3">
                    <input type="number" class="form-control mt-1 block w-full" min="0" v-model="form.children">
                </div>
                <div align="center" class="col-md-12 mt-4">
                	<div class="d-single-info text-lg-center">
                    	<button class="view-cart bg-info" >Agregar al carrito</button>
                    </div>
                </div>
  			</div>
  	</div>
</template>
<script>
	import { Calendar, DatePicker } from 'v-calendar'
	import { Head, Link } from '@inertiajs/inertia-vue3'
    import Checkout from '@/Pages/Checkout_activities.vue'

	export default {
        components: {
        	Calendar,
            DatePicker,
            Head,
            Checkout,
            Link
        },
        data() {
            return {
                modal: false,
                random: 1,
            	form: this.$inertia.form({
                	adult: 0,
                	children: 0,
                    range: {
                       start: this.product.activities.init,
                        end: this.product.activities.end
                    }
            	}),
            	 
            }
        },
        props: {
            product: Object,
        },
        methods: {
            OpenModal(){
                var random = Math.floor(Math.random() * 9999);
                this.modal=true;
            },
            CloseModal(){
                this.modal=false;
            }
    	}
    }
</script>
<style>

</style>