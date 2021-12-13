<template>
	<div align="center">
  			<DatePicker v-model="form.range" :min-date='product.activities.init' :max-date='product.activities.end' is-range/>
  			<div class="form-group row mt-4">
  				<div class="col-md-6">
  					<label for="adult">Número de adultos</label>
  					<input type="number" class="form-control mt-1 block w-full" min="0" v-model="form.adult">
                </div>
                <div class="col-md-6">
                	<label for="adult">Número de niños</label>
  					<input type="number" class="form-control mt-1 block w-full" min="0" v-model="form.children">
                </div>
                <div align="center" class="col-md-12 mt-4">
                	<div class="d-single-info text-lg-center">
                    	<button class="view-cart bg-info" @click="OpenModal()">Reservar</button>
                    </div>
                </div>
  			</div>
        <dialog-modal :show="modal">
            <template v-slot:title>
                <h1>Reservar: {{ product.title }}</h1>
            </template>
            <template v-slot:content>
                <checkout :form="this.form" :product="product" :key="random"/>
            </template>
            <template v-slot:footer>
                <a href="javascript:void(0)" class="btn btn-danger ml-auto" @click="CloseModal()">CLOSE</a>
            </template>
        </dialog-modal>
  	</div>
</template>
<script>
	import { Calendar, DatePicker } from 'v-calendar'
	import { Head, Link } from '@inertiajs/inertia-vue3'
    import DialogModal from '@/Components/DialogModal.vue'
    import Checkout from '@/Pages/Checkout_activities.vue'

	export default {
        components: {
        	Calendar,
            DatePicker,
            Head,
            DialogModal,
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
        created(){
            console.log(this.product)
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