<template>
	<div align="center">
        <form @submit.prevent="submit">
  			<DatePicker v-model="form.date" :min-date='product.activities.init' :max-date='product.activities.end'/>
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
                <div align="center" class="col-md-6 mt-4">
                	<div class="d-single-info text-lg-center">
                        <BreezeButton id="submit" type="submit" class="view-cart bg-info" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Agregar al carrito
                        </BreezeButton>
                        <BreezeValidationErrors class="my-3" />
                        <div class="login-footer text-center">
                            <div v-if="status" class="mb-4 font-medium text-sm text-danger">
                                {{ status }}
                            </div>
                        </div>
                    </div>
                </div>
                <div align="center" class="col-md-6 mt-4">
                    <div class="d-single-info text-lg-center">
                        <BreezeButton type="button" class="view-cart bg-info" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="reserve">Reservar directo</BreezeButton>
                    </div>
                </div>
  			</div>
        </form>
  	</div>
</template>
<script>
	import { Calendar, DatePicker } from 'v-calendar'
	import { Head, Link } from '@inertiajs/inertia-vue3'
    import Checkout from '@/Pages/Checkout_activities.vue'
    import BreezeButton from '@/Components/Button.vue'
    import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
    import { Inertia } from '@inertiajs/inertia'

	export default {
        components: {
        	Calendar,
            DatePicker,
            Head,
            Checkout,
            Link,
            BreezeButton,
            BreezeValidationErrors
        },
        data() {
            return {
                modal: false,
                random: 1,
            	form: this.$inertia.form({
                    product_id: this.product.id,
                	adult: 0,
                	children: 0,
                    date: this.product.activities.init
            	}),
            	 
            }
        },
        props: {
            product: Object,
        },
        methods: {
            submit(){
                this.form.post(route('cart.activity'),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'submit',
                    preserveScroll: true,
                    forceFormData: true,
                })
            },
            reserve(){
                this.form.post(route('cart.activity'),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'submit',
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: (result) => {
                        Inertia.visit(route('checkout.souvenirs'), { method: 'get' }, { preserveScroll: true });
                    }
                })
            }
    	}
    }
</script>
<style>

</style>