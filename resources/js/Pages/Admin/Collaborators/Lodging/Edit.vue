<template>
    <div class="container px-lg-5 mt-3">	
		<section id="colaborador">
			<div class="row mx-lg-4">
				<div class="col-3 ">
					<Link :href="route('admin.collaborator.show',collaborator.id)"><i class="fas fa-angle-left bg-info text-white px-2 py-1"></i></Link>	
				</div>
			</div>
			<div class="row ficha mx-lg-4 my-4 p-2 bg-light border">
				<div class="col-12">
					<div class="d-flex flex-column flex-md-row justify-content-md-between">
						<h1 class="pt-1 pb-2 font-weight-bolder text-center text-md-left">{{collaborator.profile.firstname}}</h1>
						<p class="font-weight-bolder text-muted mt-md-3 mr-3 text-center text-md-right">{{collaborator.email}}</p>
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
            <div class="row mx-lg-4 mb-2 detalles justify-content-start">
                <div class="col-10 col-6">
                    <p class="text-muted text-uppercase">{{lodging.type}}</p>
                    <h1 class="font-weight-bolder">{{lodging.calle}} {{lodging.planta}}</h1>
                </div>
            </div>
            <form @submit.prevent="submit">
            <div class="row mx-lg-4 mt-5 mb-3 justify-content-start">
                <div class="col-12 col-md-6">
                    <h2>Modifica tu alojamiento</h2>
                </div>
            </div>
            <div class="row mx-lg-4 my-3 justify-content-start">
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <input type="text" class="form-input w-100" placeholder="Calle" v-model="form.calle">
                </div>
                <div class="col-12 col-md-3 pl-md-0">
                    <input type="text" class="form-input w-100" placeholder="N°-Letra-Planta" v-model="form.planta">
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
                    <input type="text" class="form-input w-100" placeholder="CP"  v-model="form.cp">
                </div>
            </div>
            <div class="row mx-lg-4 my-3 justify-content-start">
                <div class="col-12 col-md-6">
                    <input type="text" class="form-input w-100" placeholder="Link-web"  v-model="form.url">
                </div>
            </div>
            <div class="row mx-lg-4 my-3 justify-content-start">
                <div class="col-12 col-md-6">
                    <input type="text" class="form-input w-100" v-model="form.code" placeholder="N° de licencia VFT/SE/12345" >
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
                        class="fas fa-trash-alt text-danger ml-5"
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
            <div class="row mx-lg-4 my-3 justify-content-center justify-content-md-end">
                <div class="col-8 col-sm-4 col-md-8 text-center text-md-right">
                    <button class="btn btn-primary-c rounded-pill px-4 py-0" type="submit">Guardar cambios</button>
                </div>
                <div class="col-8 col-sm-4 col-md-8 text-center text-md-right">
                    <button class="btn btn-danger-c rounded-pill py-0 mt-1 mt-sm-0 mt-md-2" type="button" @click="eliminar">Eliminar apartamento</button>
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
        lodging: Object,
        collaborator: Object,
    },
    mounted(){
    	console.log(this.lodging);
        console.log(this.collaborator);
        this.collaborator.hotel.forEach((col)=>{    
            col.orders.forEach((order)=>{    
                this.pedidos++;
                if(order.status == "complete" && order.returned == 0){
                    this.total += Number(order.total);
                }
            });
        });
        this.total = this.total*0.20;

    },
    data(){
        return{
            showF: 0,
            total:0,
            pedidos:0,
            form: this.$inertia.form({
                calle: this.lodging.calle,
                planta: this.lodging.planta,
                address: this.lodging.address,
                city: this.lodging.zone,
                cp: this.lodging.cp,
                code: this.lodging.code,
                url: this.lodging.url,
                area: this.lodging.area,
                image: null,
                idCol:this.collaborator.id
            }),
        }
    },
    methods: {
        submit() {
            this.form.post(route('admin.lodging.update',{id:this.lodging.id}),{
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
        eliminar(){
			this.$swal({
                title: '¿Esta seguro de eliminar este alojamiento?',
                icon: 'warning',
                showCloseButton: false,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
            }).then((res)=>{
                if(res.isConfirmed)
                {
                    this.form.delete(route('admin.lodging.delete',{hotel: this.lodging.id, collaborator: this.collaborator.id}),{
                        _token: this.$page.props.csrf_token,
                        errorBag: 'submit',
                        preserveScroll: true,
                    })
                }
            })
		}
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
</style>