<template>
    <Layout>
    	<div class="tab-content mt-all-40">
   			<div id="hotels" class="tab-pane fade show active">
   				<div class="register-contact  clearfix">
                   <form @submit.prevent="submit">
                        <div class="address-wrapper row">
                            <div class="col-md-12 mb-4">
                                <h5>Datos del souvenir</h5>
                            </div>
                            <div class="col-md-12 mb-4">
                                <BreezeLabel for="title" value="Titulo" />
                                <BreezeInput id="title" type="title" class="form-control mt-1 block w-full" v-model="form.title" autocomplete="title" placeholder="Titulo" />
                            </div>
                            
                            <div class="col-md-2">
                                <BreezeLabel for="precio" value="Precio" />
                                <BreezeInput id="precio" type="number" class="form-control mt-1 block w-full" v-model="form.precio" autocomplete="precio" step="0.01" placeholder="Precio" />
                            </div>
                            <div class="col-md-2" >
                                <BreezeLabel for="stock" value="Stock" />
                                <BreezeInput id="stock" type="number" class="form-control mt-1 block w-full" v-model="form.stock" autocomplete="stock"  min="0" placeholder="Stock" />
                            </div>
                            <div class="col-md-3">
                                <BreezeLabel for="precio" value="Precio Oferta" />
                                <BreezeInput id="offer" type="number" class="form-control mt-1 block w-full" v-model="form.offer" autocomplete="offer" step="0.01" placeholder="Precio Oferta" />
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
                            <div class="col-md-5">
                                <label class="col-form-label">Categoria</label>
                                <div class="col-lg-6 col-md-8">
                                    <div class="custom-radio">
                                        <input name="category" v-model="form.category" value="Souvenir" type="radio"> Souvenir
                                    </div> 
                                    <div class="custom-radio pl-1">
                                        <input name="category" v-model="form.category" value="Gastronomia" type="radio"> Gastronomia
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="col-form-label">Descripción del producto</label>
                                <ckeditor 
                                    :editor="editor" 
                                    v-model="form.description" 
                                    :config="editorConfig"
                                ></ckeditor>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="col-form-label">Imagenes del producto</label>
                                <div id="dropRef" class="dropzone custom-dropzone">
                                </div>
                            </div>
                            <div align="center" class="col-12 mt-4">
                                <div v-if="$page.props.flash"> {{ $page.props.flash.message }}</div>
                                    <BreezeButton id="submit" type="submit" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Registrar
                                    </BreezeButton>
                                    <BreezeValidationErrors class="my-3" />
                                    <div class="login-footer text-center">
                                        <div v-if="status" class="mb-4 font-medium text-sm text-danger">
                                            {{ status }}
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <input type="hidden" :value="id" id="product_id">
                    </form>
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
        },
        mounted() {
            const dropzone = new Dropzone("div#dropRef", { 
                url: route('souvenirs.image'),
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 5,
                maxFiles: 5,
                acceptedFiles: 'image/*',
                resizeQuality: 0.8,
                init: function() {
                   const myDropzone = this;
                    myDropzone.on("complete", function(file) {
                        myDropzone.removeFile(file);
                        Inertia.visit(route('souvenirs.index'), { method: 'get' }, { preserveScroll: true });
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
        data() {
            return {
                form: this.$inertia.form({
                    title: null,
                    precio: null,
                    offer: null,
                    description: null,
                    stock: null,
                    category: null,
                    featured: 0,
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
                this.form.post(route('souvenirs.store'),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'submit',
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: (result) => {
                        if(!this.dropzone.processQueue()){
                            Inertia.visit(route('souvenirs.index'), { method: 'get' }, { preserveScroll: true });
                        }
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