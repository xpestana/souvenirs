<template>
    <div class="container cabeza-souvenirs px-md-2 px-lg-5 pt-md-3">
        <div class="row my-2 my-md-5 px-md-5">
            <div class="col-12 text-center">
                <h1 class="text-azulc text-2xl md:text-5xl font-weight-bolder">Editar actividad</h1>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <h1 class="text-lg md:text-2xl font-weight-bolder">Datos de la actividad</h1>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h1 class="text-lg md:text-lg text-azulc font-weight-bolder">Datos en español</h1>
            </div>
        </div>
        <hr>
        <form @submit.prevent="submit">
        <div class="row mt-2">
            <div class="col-12 mb-2">
                <span class="d-block font-weight-bolder mb-2 text-muted">Título de la actividad</span>
                <input type="text" v-model="form.title" class="border rounded w-100" placeholder="Título">
            </div>
            <div class="col-12 mb-2">
                <span class="d-block font-weight-bolder mb-1  text-muted">Descripción</span>
                <ckeditor 
                    :editor="editor" 
                    :config="editorConfig"
                    v-model="form.description"
                ></ckeditor>
            </div>
            <div class="col-12  my-md-2">
                <span class="d-block font-weight-bolder mb-2  text-muted">Cancelaciones</span>
                <ckeditor 
                    :editor="editor" 
                    :config="editorConfig"
                    v-model="form.price_notes"
                ></ckeditor>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h1 class="text-lg md:text-lg text-azulc font-weight-bolder">Datos en ingles</h1>
            </div>
        </div>
        <hr>
        <div class="row mt-1">
            <div class="col-12 mb-2 mt-2">
                <span class="d-block font-weight-bolder mb-2  text-muted">Titulo de la actividad en ingles</span>
                <input type="text" v-model="form.titleEn" class="border rounded w-100" placeholder="Título">
            </div>
            <div class="col-12 mb-2">
                <span class="d-block font-weight-bolder mb-1  text-muted">Descripción en ingles</span>
                <ckeditor 
                    :editor="editor" 
                    :config="editorConfig"
                    v-model="form.descriptionEn"
                ></ckeditor>
            </div>
            <div class="col-12  my-md-2">
                <span class="d-block font-weight-bolder mb-2  text-muted">Cancelaciones en ingles</span>
                <ckeditor 
                    :editor="editor" 
                    :config="editorConfig"
                    v-model="form.prices_notesEn"
                ></ckeditor>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h1 class="text-lg md:text-lg text-azulc font-weight-bolder">Datos generales</h1>
            </div>
        </div>
        <hr>
        <div class="row mt-3">
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12 my-1">
                        <select name="" id="idioma" v-model="form.language" class="border rounded w-100 mt-4">
                            <option value="null">Idioma</option>
                            <option value="Español">Español</option>
                            <option value="Inglés">Inglés</option>
                            <option value="Italiano">Italiano</option>
                            <option value="Francés">Francés</option>
                            <option value="Alemán">Alemán</option>
                        </select>
                    </div>
                    <div class="col-12 mt-3 mb-1">
                        <span class="d-block font-weight-bolder mb-2  text-muted">Coordenadas para punto de encuentro</span>
                        <input type="text" v-model="form.coordinates" class="border rounded w-100" placeholder="Formato ej: 37.3890942,-5.992468">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <span class="d-block font-weight-bolder mb-1 mt-2 mt-md-0 text-muted">Precio base</span>
                <div class="mt-1 d-flex pr-md-5 mr-md-5">
                    <label class="pt-2 py-2 px-2 font-weight-bolder">Adulto</label>
                    <input type="text" placeholder="Precio" v-model="priceAdult" class="border rounded ml-auto mr-2 mr-md-5">
                </div>
                <div class="mt-1 d-flex pr-md-5 mr-md-5">
                    <label class="pt-2 py-2 px-2 font-weight-bolder">Niño</label>
                    <input type="text" placeholder="Precio" v-model="priceChildren" class="border rounded ml-auto mr-2 mr-md-5">
                </div>
                <div class="mt-1 d-flex pr-md-5 mr-md-5">
                    <label class="pt-2 py-2 px-2 font-weight-bolder">Estudiante</label>
                    <input type="text" placeholder="Precio" v-model="priceStudent" class="border rounded ml-auto mr-2 mr-md-5">
                </div>
                <div class="mt-1 d-flex pr-md-5 mr-md-5">
                    <label class="pt-2 py-2 px-2 font-weight-bolder">Bebe</label>
                    <input type="text" placeholder="Precio" v-model="priceBaby" class="border rounded ml-auto mr-2 mr-md-5">
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label class="text-base">Imagenes subidas previamente</label>
            </div>
            <div class="col-12 my-1 py-2 border rounded">
                <div v-for="img in product.images" :key="img.id" class="w-16 md:w-40 h-12 md:h-24 d-inline-block mx-1.5 md:mx-3 my-2 overflow-hidden">
                    <img :src="'/storage/souvenirs'+img.url" class="d-inline rounded bg-cover">
                </div>
                <div class="text-center p-2" v-if="product.images.length == 0"><p class="text-danger">No se han subido imagenes aún</p></div>
            </div>
            <div class="col-12 my-4">
                <label class="text-base">Imagenes de la actividad</label>
                <p class="text-danger">Las imagenes introducidas aqui sustituiran las ya existentes</p>
                <div id="dropRef" class="dropzone">
                </div>
                <button class="btn btn-success text-center mt-2" id="submit_image" type="button" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Actualizar imagenes
                </button>
            </div>
        </div>
        <div class="row justify-content-center justify-content-md-between my-5">
            <div class="col-8 col-md-6 text-center text-md-left">
                <Link :href="route('admin.activities')" class="btn btn-primary-c rounded-pill py-0 px-5">Volver</Link>
            </div>
            <div class="col-8 col-md-6 text-center text-md-right">
                <button type="submit" class="btn btn-primary-c rounded-pill py-0 mt-2 mt-md-0">Guardar cambios</button>
            </div>
        </div>
        </form>
    </div>
</template>
<script>
import Dropzone from 'dropzone'
import Layout from '@/Pages/Admin/Layouts/Layout'
import { Link } from '@inertiajs/inertia-vue3'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
export default {
    layout:Layout,
    components:{
        Link
    },
    data(){
        return {
            form: this.$inertia.form({
                title: this.product.title,
                titleEn: this.product.title_en,
                description: this.product.description,
                descriptionEn: this.product.description_en,
                price_notes: this.product.activities.price_notes,
                prices_notesEn: this.product.activities.price_notes_en,
                coordinates: this.product.activities.coordinates,
                coordinatesEn: this.product.activities.coordinates_en,
                priceUnique:this.product.price,
                language:this.product.activities.language,
                pricesArr:[],
                featured:0,
                page:this.page
            }),
            priceAdult:null,
            priceChildren:null,
            priceStudent:null,
            priceBaby:null,
            editor: ClassicEditor,
            editorData: '',
            editorConfig:{
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
            },
            dropzone:null
        }
    },
    props:{
        product:Object,
        page:Number
    },
         mounted() {
            const product_id = this.product.id;
            const toast = this.$toast;

            const dropzone = new Dropzone("div#dropRef", { 
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 20,
                acceptedFiles: 'image/*',
                maxFilesize:10,
                init: function() {
                   const myDropzone = this;
                   // First change the button to actually tell Dropzone to process the queue.
                        document.getElementById("submit_image").addEventListener("click", function(e) {
                        // Make sure that the form isn't actually being sent.
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
        this.precios()
        console.log(this.product)
    },
    methods:{
        precios(){
            if(this.product.activities.priceA !== "null"){
                let lista = JSON.parse(this.product.activities.priceA);
                if(lista.error_code == undefined){
                    let arr = [];
                    for(let val in lista.prices_per_ticket){
                        arr.push(lista.prices_per_ticket[val])
                    }
                    if(arr[0]!== undefined) this.priceAdult = arr[0]
                    if(arr[1]!== undefined) this.priceChildren = arr[1]
                    if(arr[2]!== undefined) this.priceStudent = arr[2]
                    if(arr[3]!== undefined) this.priceBaby = arr[3]
                }
            }
        },
        submit() {
            this.form.pricesArr[0] = this.priceAdult
            this.form.pricesArr[1] = this.priceChildren
            this.form.pricesArr[2] = this.priceStudent
            this.form.pricesArr[3] = this.priceBaby
            this.form.language = document.getElementById('idioma').value

             this.form.post(route('updt.activities',{activities: this.product.id}),{
                 _token: this.$page.props.csrf_token,
                 errorBag: 'submit',
                 preserveScroll: true,
                 forceFormData: true,
             })
        },
    }
    
}
</script>