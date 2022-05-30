<template>
	<section class="bg-register" style="background-image: url('/vendor_asset/img/skyline.png');">
		<div class="degradado">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-6 card  tab-content dashboard-content shadow-lg my-5">
						<form @submit.prevent="submit" class="mt -4">
							<notify v-if="$page.props.flash" :key="$page.props.flash.id"/>
							<div class="row">
								<div class="col-md-7">
									<h3>Personal information</h3>
									<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.name" autocomplete="name" placeholder="Contact person *" required/>
									<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.phone" autocomplete="phone" placeholder="Phone number *" required/>
								</div>
								<div class="col-md-5 d-flex">
									<img src="/vendor_asset/img/logo/hilogo.png" class="my-2 my-md-auto mx-auto w-40 md:w-56">
								</div>
								<div class="col-md-12">
									<h3>Tax data</h3>
									<div class="row justify-content-between">
										<div class="col-md-6">
											<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.razon" autocomplete="razon" placeholder="Business name *" required/>
										</div>
										<div class="col-md-6">
											<select name="nif" id="nif" v-model="form.nif" class="form-control w-100 select" required>
												<option value="NIF Español">NIF Spanish</option>
												<option value="Intracommunity VAT number">Intracommunity VAT number</option>
												<option value="Passport">Passport</option>
												<option value="Official document country of residence">Official document country of residence</option>
												<option value="Residence certificate">Residence certificate</option>
												<option value="Other supporting document">Other supporting document</option>
												<option value="Not registered">Not registered</option>
											</select>
										</div>
										<div class="col-md-6">
											<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.id" autocomplete="id" placeholder="Fiscal Identifier Number *" required/>
										</div>
										<div class="col-md-6">
											<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.country" autocomplete="country" placeholder="Country *" value="Spain" readonly="" required/>
										</div>
										<div class="col-md-6">
											<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.city" autocomplete="city" placeholder="Town *" required/>
										</div>
										<div class="col-md-6">
											<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.cp" autocomplete="cp" placeholder="Postal Code *" required/>
										</div>
										<div class="col-md-6">
											<BreezeInput  type="text" class="form-control w-100 mb-2 py-3" v-model="form.address" autocomplete="address" placeholder="Fiscal address *" required/>
										</div>
										<div class="w-100">
											<ValidationErrors class="my-3" />
										</div>
										<div align="center" class="col-12 mt-3 text-center">
											<button type="submit" class="btn btn-primary  rounded-pill  w-50 py-1 mt-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
												Create Account
											</button>
											<div v-if="status" class="mb-4 font-medium text-sm text-danger mt-4">
												{{ status }}
											</div>	
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
	import BreezeInput from '@/Components/Input.vue'
	import BreezeButton from '@/Components/Button.vue'
	import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors.vue'
	import Notify from '@/Layouts/Components/Toast.vue'

	export default {
		components:{
			BreezeInput,
			BreezeButton,
			ValidationErrors,
			Notify,
		},
		data(){
			return {
				form: this.$inertia.form({
					name: null,
					phone: null,
					gestor: "0",
					razon: null,
					nif: 'NIF Español',
					id: null,
					city: null,
					cp: null,
					address: null,
				})
			}
		},
		methods: {
			submit() {
				this.form.post(route('collaborator.register.data'),{
					_token: this.$page.props.csrf_token,
					errorBag: 'submit',
					preserveScroll: true,
				})
			},
			logout(){
                this.$inertia.post(route('logout'), {
                    _token: this.$page.props.csrf_token,
                })
            },
		}
	}
</script>
<style scope>
	.degradado {
		background: linear-gradient(180deg, rgb(255 255 255 / 88%) 0%, rgb(0 212 255 / 0%) 30%);
		display:flex;
	}
	form .select{
		font-size: 1.1em;
		color: #6c757d;
		padding-top: 0px;
		padding-left: 10px;
	}
	body{
		background-color: #6fb2c6;
	}
	.bg-register{
		width: 100%;
		background-position: bottom left;
		background-size: contain;
		background-repeat: no-repeat;
	}
</style>