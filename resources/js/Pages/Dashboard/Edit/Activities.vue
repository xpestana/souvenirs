<template>
    <Layout>
    	<div class="tab-content mt-all-40">
   			<div id="hotels" class="tab-pane fade show active">
   				<div class="register-contact  clearfix">
                   <form @submit.prevent="submit">
                        <div class="address-wrapper row">
                            <div class="col-md-12 mb-4">
                                <h5>Datos de la actividad</h5>
                            </div>
                            <div class="col-md-12 mb-4">
                                <BreezeLabel for="title" value="Titulo" />
                                <BreezeInput id="title" type="title" class="form-control mt-1 block w-full" v-model="form.title" autocomplete="title" placeholder="Titulo" />
                            </div>
                            
                            <div class="col-md-2">
                                <BreezeLabel for="precio" value="Precio Adulto" />
                                <BreezeInput id="precio" type="number" class="form-control mt-1 block w-full" v-model="form.precioA" autocomplete="precio" step="0.01" placeholder="Precio" />
                            </div>
                            <div class="col-md-2">
                                <BreezeLabel for="precio" value="Precio Niños" />
                                <BreezeInput id="precio" type="number" class="form-control mt-1 block w-full" v-model="form.precioN" autocomplete="precio" step="0.01" placeholder="Precio" />
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Destacado</label>
                                <div class="col-lg-6 col-md-8">
                                    <span class="custom-radio">
                                        <input name="featured" v-model="form.featured" value="1" type="radio"> Sí
                                    </span> 
                                    <span class="custom-radio pl-1">
                                        <input name="featured" v-model="form.featured" value="0" type="radio"> No
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <BreezeLabel for="fechaI" value="Fecha de Inicio" />
                                <BreezeInput id="fechaI" type="date" class="form-control mt-1 block w-full" v-model="form.fechaI" autocomplete="fechaI" step="0.01" placeholder="Fecha Inicio" />
                            </div>
                            <div class="col-md-4">
                                <BreezeLabel for="fechaF" value="Fecha de Final" />
                                <BreezeInput id="fechaF" type="date" class="form-control mt-1 block w-full" v-model="form.fechaF" autocomplete="fechaF" step="0.01" placeholder="Fecha Final" />
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="col-form-label">Descripción de la actividad</label>
                                <ckeditor 
                                    :editor="editor" 
                                    v-model="form.description" 
                                    :config="editorConfig"
                                ></ckeditor>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="col-form-label">Detalles de la actividad</label>
                                <ckeditor 
                                    :editor="editor" 
                                    v-model="form.details" 
                                    :config="editorConfig"
                                ></ckeditor>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="col-form-label">Punto de encuentro <small>Copiar y pegar el iframe de Google Maps</small></label>
                                <textarea v-model="form.iframe" class="form-control mt-1 block w-full" id="map" cols="30" rows="10"></textarea>
                            </div>
                            <div align="center" class="col-12 mt-4">
                                <div v-if="$page.props.flash"> {{ $page.props.flash.message }}</div>
                                    <BreezeButton id="submit" type="submit" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Actualizar actividad
                                    </BreezeButton>
                                    <BreezeValidationErrors class="my-3" />
                                    <div class="login-footer text-center">
                                        <div v-if="status" class="mb-4 font-medium text-sm text-danger">
                                            {{ status }}
                                        </div>
                                    </div>
                            </div>
                            
                        </div>
                    </form>
                            <div class="col-md-12 mt-4">
                                <label class="col-form-label">Imagenes del producto  <small>Las imagenes que se anexen reemplazaran las existentes</small></label>
                                <div id="dropRef" class="dropzone custom-dropzone">
                                </div>
                            </div>
                            <div align="center" class="col-12 mt-4">
                                <div v-if="$page.props.flash"> {{ $page.props.flash.message }}</div>
                                <BreezeButton id="submit_image" type="button" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Actualizar imagenes
                                </BreezeButton>
                                <div class="login-footer text-center">
                                    <div v-if="status" class="mb-4 font-medium text-sm text-danger">
                                        {{ status }}
                                    </div>
                                </div>
                            </div>
   				</div>
   			</div>
   		</div>
    </Layout>
</template>
<script>

    import { Head, Link } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
    import BreezeButton from '@/Components/Button.vue'
    import BreezeInput from '@/Components/Input.vue'
    import BreezeLabel from '@/Components/Label.vue'
    import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
    import Dropzone from 'dropzone'
    import Layout from '@/Layouts/LayoutProfile.vue'  
    import Multiselect from '@vueform/multiselect'

    export default {
        components: {
            BreezeButton,
            BreezeInput,
            BreezeLabel,
            BreezeValidationErrors,
            Dropzone,
            Layout,
            Head,
            Link,
            Multiselect,
        },
       async mounted() {
            const product_id = this.product.id;
            const toast = this.$toast;

            const dropzone = new Dropzone("div#dropRef", { 
                url: route('activities.update.image'),
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 5,
                maxFiles: 5,
                acceptedFiles: 'image/*',
                resizeQuality: 0.8,
                init: function() {
                   const myDropzone = this;
                    document.getElementById("submit_image").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                      myDropzone.on("sending", function(file, xhr, formData) {
                        formData.append("id", product_id);
                    });
                    myDropzone.on("complete", function(file) {
                       toast.show("Actualizado exitosamente", {
                            type: "success",
                            position : "top-right",
                            pauseOnHover: "true",
                        });
                    });
                }
            });
            this.dropzone = dropzone;
        },
         
        created(){
            if(this.$page.props.flash.code == 200){
                this.form.reset();
            }
        },
        props: {
            product: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    details: this.product.activities.details,
                    title: this.product.title,
                    precioA: this.product.activities.priceA,
                    precioN: this.product.activities.priceN,
                    description: this.product.description,
                    fechaF: this.product.activities.end,
                    fechaI: this.product.activities.init,
                    featured: this.product.featured,
                    iframe: this.product.activities.iframe
                }),
                id: this.$page.props.flash.id,
                status: null,
                dropzone:null,
                editor: ClassicEditor,
                editorData: '',
                editorConfig:{
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                },
            }
        },
        methods: {
            submit() {
                this.form.post(route('update.activities',{activities: this.product.id}),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'submit',
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: (result) => {
                        //this.dropzone.processQueue();
                    }
                    
                })
            },
        }
    }
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
<style>
    .ck-content{
        height: 200px;
    }
    .custom-dropzone{
        border-style: dashed;
        border-width: 3px;
        padding: 20px;
    }
</style>