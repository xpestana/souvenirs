<template>
    <div class="container px-lg-5 mt-3">	
		<section id="colaborador">
			<div class="row">
				<div class="col-3 ">
					<Link :href="route('admin.collaborator.show',collaborator.id)"><i class="fas fa-angle-left bg-info text-white px-2 py-1"></i></Link>	
				</div>
			</div>
			<div class="row ficha mx-lg-4 my-4 p-2 bg-light border">
				<div class="col-12">
					<div class="d-flex flex-column flex-md-row justify-content-md-between">
						<h1 class="pt-1 pb-2 font-weight-bolder text-center text-md-left">{{collaborator.profile.firstname}}</h1>
						<p class="font-weight-bolder text-muted mt-md-3 mr-3 text-center text-md-left">{{collaborator.email}}</p>
					</div>
					<div class="d-md-inline-flex mt-1">
                        <div class="pr-md-4 text-md-center">
                            <p class="font-weight-bolder text-muted d-inline d-md-block">Benefecio total</p> 
                            <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{ total }}€</p>
                        </div>
						<div class="pr-md-4 text-md-center"> 
                            <p class="font-weight-bolder text-muted d-inline d-md-block">Pedidos totales:</p>
                            <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{ pedidos }}</p>
                        </div>
                        <div class="pr-md-4 text-md-center"> 
                            <p class="font-weight-bolder text-muted d-inline d-md-block">Alojamientos registrados:</p>
                            <p class="font-weight-bolder text-muted d-inline d-md-block pl-2 pl-md-0">{{collaborator.hotel.length}}</p>
                        </div>
					</div>
				</div>
			</div>
		</section>
        <section id="alojamiento">
            <form @submit.prevent="submit">
            <div class="row mx-lg-4 mt-5 mb-3 justify-content-start">
                <div class="col-12 col-md-6">
                    <h2>Registra tu alojamiento</h2>
                </div>
            </div>
            <div class="row mx-lg-4 my-3 justify-content-start">
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <input type="text" class="form-input w-100" placeholder="Calle*" v-model="form.calle" required>
                </div>
                <div class="col-12 col-md-3 pl-md-0">
                    <input type="text" class="form-input w-100" placeholder="N°-Letra-Planta*" v-model="form.planta" required>
                </div>
            </div>
            <div class="row mx-lg-4 my-3 justify-content-start">
                <div class="col-12 col-md-6">
                    <input type="text" class="form-input w-100" placeholder="Otras indicaciones"  v-model="form.address">
                </div>
            </div>
            <div class="row mx-lg-4 my-3 justify-content-start">
                <div class="col-12 col-md-3  mb-2 mb-md-0">
                    <input type="text" class="form-input w-100" placeholder="Ciudad"  v-model="form.city">
                </div>
                <div class="col-12 col-md-3 pl-md-0">
                    <input type="text" class="form-input w-100" placeholder="CP*"  v-model="form.cp" required>
                </div>
            </div>
            <div class="row mx-lg-4 my-3 justify-content-start">
                <div class="col-12 col-md-6">
                    <input type="text" class="form-input w-100" placeholder="Link-web"  v-model="form.url">
                </div>
            </div>
            <div class="row mx-lg-4 my-3 justify-content-start">
                <div class="col-12 col-md-6">
                    <input type="text" class="form-input w-100" v-model="form.code" placeholder="N° de licencia VFT/SE/12345">
                </div>
            </div>
            <div class="row mx-lg-4 my-3 justify-content-start">
                <div class="col-md-6">
                    Actualizar imagen <button 
                        type="button"
                        style="border-radius: 5px;background-color:#e8e8e8"
                        size="sm"
                        class="btn btn-examinar py-1" 
                        variant="info" 
                        @click="selectFeatured()"
                    >
                        Examinar
                    </button>
                    <i v-if="showF==1"
                        id="eraseFile" 
                        style="cursor:pointer" 
                        class="fas fa-trash-alt text-danger ml-2"
                        @click="eraseFeatured()"
                    ></i>
                    <input 
                        ref="image" 
                        id="image" 
                        type="file" 
                        @input="form.image = $event.target.files[0]"
                        style="display:none"
                        @change="onFeaturedChange" 
                    >
                    <span id="fileFeatured" class="text-success"></span>
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>
                </div>
            </div>
            <div class="row mx-lg-4 my-3 justify-content-start">
                <div class="col-12 col-md-6">
                    <textarea class="form-control w-100" placeholder="Otros datos de interés" v-model="form.area"></textarea>
                </div>
            </div>
            <div class="row mx-lg-4 mt-3 justify-content-start">
                <div class="col-12 col-md-6">
                    <ValidationErrors class="my-3" />
                </div>
            </div>
            <div class="row mx-lg-4 my-3 justify-content-center justify-content-md-between">
				<div class="col-8 col-sm-4 col-md-4 text-center text-md-left">
                    <Link :href="route('admin.collaborator.show',collaborator.id)" class="btn btn-primary-c rounded-pill px-3 px-md-5 py-0">Volver</Link>
                </div>
                <div class="col-8 col-sm-4 col-md-4 text-center text-md-right">
                    <button class="btn btn-primary-c rounded-pill px-3 px-md-5 py-0 mt-2 mt-sm-0" type="submit">Siguiente</button>
                </div>
            </div>
            </form>
        </section>
    </div>
</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors'
import { Link } from '@inertiajs/inertia-vue3'
export default {
    layout:Layout,
    components:{
        ValidationErrors,
        Link
    },
    props: {
        collaborator: Object,
    },
    created(){
		console.log(this.collaborator);

        const obj = this.collaborator.hotel.map((col)=>{
            var total_orders = 0;
            var total_benefits = 0;
            total_orders = total_orders + col.orders.length;
            col.orders.forEach(function(order) {
                total_benefits = parseInt(total_benefits)  + parseInt(order.total);
            });
            return {
                total_orders,
                total_benefits: (total_benefits/100)
            }
        });
        if(obj.length > 0){
            for(let val in obj){
                this.total = this.total + Number(obj[val].total_benefits);
                this.pedidos = this.pedidos + Number(obj[val].total_orders);
            }
        }
    },
    data(){
        return{
            showF: 0,
			gestor:'TIpo',
            form: this.$inertia.form({
                calle: null,
                planta: null,
                address: null,
                city: 'Sevilla',
                cp: null,
                code: null,
                url: null,
                area: null,
                image: null,
				collaborator: this.collaborator.id,
            }),
            pedidos:0,
            total:0
        }
    },
    methods: {
        submit() {
			this.form.post(route('admin.lodging.store'),{
				_token: this.$page.props.csrf_token,
				errorBag: 'submit',
				preserveScroll: true,
				forceFormData: true,
				onSuccess: (result) => {
					if(this.$page.props.flash.code == 200){
						this.form.reset();
						this.eraseFeatured();
					};
				}
				
			})
		},
		selectFeatured(){
			this.$refs.image.click()
		},
		onFeaturedChange(){
			var filename = $('#image').val().split('\\').pop();
			$('#fileFeatured').html(filename);
			this.showF=1
		},
		eraseFeatured(){
			this.form.reset('image');
			$('#fileFeatured').html('');
			this.showF=0;
            },
    }
}
</script>
<style scoped>
h1{
	font-size: 30px;
}
h2{
	font-size: 22px;
}
#colaborador .ficha{
	border: 1px solid #d5d5d5;
}
#alojamiento form .form-input{
    color: #495057;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
#alojamiento form .select{
    border:1px solid #d1d2d3;
    border-radius: 5px;
}
</style>