<template>
<notify v-if="$page.props.flash" :key="$page.props.flash.id"/>
	<section id="collaborator-data">
         <div class="container-fluid flex flex-column justify-center content-center min-h-screen bg-collaborator py-8 lg:py-4">
			<div class="row  justify-content-center mx-auto mt-auto lg:w-2/5">
				<div class="data-logo col-12 flex flex-column">
					<img class="w-48 md:w-36 mx-auto" src="/vendor_asset/img/collaborator/logocompleto.svg" alt="" @click="redirect()">
				</div>
				<div class="data-presentation col-12 text-center px-0">
					<h1 class="text-3xl md:text-4xl text-white my-2">Thank you for registering with HiCitty</h1>
					<p class="mb-4 lg:mb-0 mt-4 text-sm md:text-base text-white">
						We need the following information to set up your profile so you can start earning with us.
					</p>
				</div>
			</div>
            <div class="row justify-content-center mx-auto mb-auto lg:w-1/3 mb-8 lg:mb-0">
                <div class="data-form-collaborator col-12 bg-white shadow-lg rounded-xl">
                    <div class="form-card bg-white p-2 md:p-4 lg:p-8 rounded-xl">
                        <form @submit.prevent="submit" class=" mt-10">
                            <div class="my-2">
                                <label class="font-weight-bolder">Name</label>
                                <div class="relative w-100 collaborator-box">
                                    <i class="fas fa-user absolute inset-y-1/3 px-2"></i>
                                    <input type="text" class="collaborator-input bg-light w-100 rounded py-1 pl-8" placeholder="Name...." autocomplete="on" v-model="form.name" required>
                                </div>
                            </div>
                            <div class="my-2">
                                <label class="font-weight-bolder">Contact number</label>
                                <div class="relative w-100 collaborator-box">
									<i class="fas fa-phone-alt absolute inset-y-1/3 px-2"></i>
                                    <input type="text" class="collaborator-input bg-light w-100 rounded py-1 pl-8" placeholder="Telephone...." v-model="form.phone" required>
                                </div>
                            </div>
                            <div class="my-2">
                                <label class="font-weight-bolder">Type of collaborator</label>
								<select id="gestor" v-model="form.gestor" class="collaborator-select bg-light w-100 rounded py-1" required>
									<option value="">Type of collaborator...</option>
									<option value="1">Tourist accommodation manager</option>
									<option value="2">Activity provider</option>
								</select>
                            </div>
                            <ValidationErrors class="my-3" />
                            <div class="my-4">
                                <button type="submit" :href="route('collaborator.register')" class="btn btn-collaborator text-xl w-100" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    <p class="text-xl mb-0">To accept</p>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>   
    </section>		
</template>
<script>
	import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors.vue'
	import Notify from '@/Layouts/Components/Toast.vue'
	import { Inertia } from '@inertiajs/inertia'  
	export default {
		components:{
			ValidationErrors,
			Notify,
		},
		data(){
			return {
				form: this.$inertia.form({
					name: null,
					phone: null,
					gestor: "",
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
				let gestor = document.getElementById('gestor').value
				if(gestor !== "3"){
					this.form.gestor = gestor;
					this.form.post(route('collaborator.register.data'),{
						_token: this.$page.props.csrf_token,
						errorBag: 'submit',
						preserveScroll: true,
					})
				}else{
					this.$swal({
					text: "¿Debe seleccionar un tipo de gestor?",
					icon: 'info',
					confirmButtonColor: '#3085d6',
					confirmButtonText: 'Aceptar'
					})
				}
			},
			logout(){
                this.$inertia.post(route('logout'), {
                    _token: this.$page.props.csrf_token,
                })
            },
			deleteUser(){
				this.$swal({
					text: "¿Esta seguro de eliminar esta cuenta permanentemente?",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					cancelButtonText: 'Cancelar',
					confirmButtonText: 'Elimnarla y salir!'
				}).then((result) => {
					if(result.isConfirmed){
						Inertia.visit(route('collaborator.delete',this.$page.props.auth.user.id), {
							method: 'post',
							preserveScroll: true,
                			preserveState: true,
						})	
					}
				})
			}
		}
	}
</script>
<style scoped>

</style>