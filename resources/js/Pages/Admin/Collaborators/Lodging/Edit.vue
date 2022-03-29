<template>
                    <form @submit.prevent="submit">
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-6">
                            <h1>Modifica tu alojamiento</h1>
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-3 mb-2 mb-md-0">
                            <input type="text" class="form-control w-100" placeholder="Calle" v-model="form.calle">
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control w-100" placeholder="N°-Letra-Planta" v-model="form.planta">
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control w-100" placeholder="Otras indicaciones"  v-model="form.address">
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-3  mb-2 mb-md-0">
                            <input type="text" class="form-control w-100" placeholder="Ciudad"  v-model="form.city">
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control w-100" placeholder="CP"  v-model="form.cp">
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control w-100" v-model="form.code" placeholder="N° de licencia VFT/SE/12345">
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control w-100" placeholder="Link-web"  v-model="form.url">
                        </div>
                    </div>
                    <div class="row my-3 justify-content-start">
                        <div class="col-md-6">
                            Actualizar imagen <button 
                                type="button"
                                style="border-radius: 20px"
                                size="sm"
                                class="btn btn-examinar" 
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
                    <div class="my-3 justify-content-start">
                        <div class="col-12 col-md-6 pl-0">
                            <textarea class="form-control w-100" placeholder="Otros datos de interés" v-model="form.area"></textarea>
                        </div>
                    </div>
                    <div class="my-3 justify-content-start">
                        <div class="col-12 col-md-6">
                            <ValidationErrors class="my-3" />
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-12 text-right">
                            <button class="btn btn-primary rounded-pill" type="submit">Guardar cambios</button>
                        </div>
                    </div>
                    </form>
</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import BreezeInput from '@/Components/Input.vue'
import BreezeButton from '@/Components/Button.vue'
import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors'
import Notify from '@/Layouts/Components/Toast.vue'
import { Link } from '@inertiajs/inertia-vue3'
export default {
    layout:Layout,
    components:{
        BreezeInput,
        BreezeButton,
        ValidationErrors,
        Notify,
        Link
    },
    created(){
    	console.log(this.lodging);
    },
    props: {
        lodging: Object
    },
    data(){
            return{
                showF: 0,
                form: this.$inertia.form({
                    calle: this.lodging.calle,
                    planta: this.lodging.planta,
                    address: this.lodging.address,
                    city: this.lodging.zone,
                    cp: this.lodging.cp,
                    code: this.lodging.code,
                    url: this.lodging.url,
                    area: this.lodging.area,
                }),
            }
        },
    methods:{
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
        }
}
</script>