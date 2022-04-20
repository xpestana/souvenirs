<template>
  <div class="container px-md-5">
      <div class="row">
          <div class="col-12 my-md-5">
              <h1 class="font-weight-bolder text-azulc text-3xl md:text-5xl text-center">Agregar souvenir</h1>
          </div>
      </div>
      <form @submit.prevent="submit">
      <div class="row mt-3">
          <div class="col-12 col-md-8">
              <div class="row justify-content-between">
                  <div class="col-12 text-center text-md-left my-2">
                      <p class="text-xl">Datos del souvenir</p>
                  </div>
                  <div class="col-12 col-md-5 my-2">
                      <input type="text" class="border rounded w-100" placeholder="Título*" v-model="form.title">
                  </div>
                  <div class="col-12 col-md-5 my-2">
                    <select id="category" class="border rounded  w-100">
                          <option value="">Categoría</option>
                          <option value="Souvenirs">Souvenirs</option>
                          <option value="Gastronomia">Gastronomia</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6 my-2">
                      <label class="text-base">Precio</label>
                      <input type="text" class="ml-2 border-0 rounded w-24 h-8" placeholder="..." style="background-color:#e4e4e4" v-model="form.precio">
                  </div>
                  <div class="col-12 col-md-6 my-2">
                      <label class="text-base">Stock</label>
                      <input type="text" class="ml-2 border-0 rounded w-24 h-8" style="background-color:#e4e4e4" v-model="form.stock">
                  </div>
                  <div class="col-12 my-4">
                    <label class="text-base">Imagenes del producto</label>
                    <div id="dropRef" class="dropzone custom-dropzone">
                    </div>
                  </div>
                  <div class="col-12">
                      <label class="text-base">Descripción del producto</label>
                      <ckeditor 
                        :editor="editor" 
                        :config="editorConfig"
                        v-model="form.description"
                    ></ckeditor>
                  </div>
              </div>
          </div>
          <div class="offset-md-4"></div>
      </div>
      <div class="row">
          <div class="col-12 my-4">
              <ValidationErrors/>
          </div>
      </div>
      <div class="row justify-content-md-between mt-md-5 mb-4">
          <div class="col-12 col-md-5 my-1 my-md-0 text-center text-md-left">
              <Link :href="route('admin.souvenirs')" class="bnt btn-primary-c rounded-pill px-3 py-1 px-md-5 py-md-2">Cancelar</Link>
          </div>
          <div class="col-12 col-md-5 my-1 my-md-0 text-center text-md-right">
              <button type="submit" class="bnt btn-primary-c rounded-pill px-4 py-1 px-md-5 py-md-2">Crear</button>
          </div>
      </div>
      </form>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Pages/Admin/Layouts/Layout'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors.vue'
import Dropzone from 'dropzone'
export default {
    layout:Layout,
    components:{
        ValidationErrors,
        Link
    },
    mounted() {
        const dropzone = new Dropzone("div#dropRef", { 
            url: route('souvenirs.image'),
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 5,
            acceptedFiles: 'image/*',
            maxFilesize:2,
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
                image: null,
            }),
            id: this.$page.props.flash.id,
            status: null,
            editor: ClassicEditor,
            editorData: '',
            editorConfig:{
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
            },
            dropzone:null,
        }
    },
    methods:{
        submit() {
                this.form.category = document.getElementById('category').value
                this.form.post(route('souvenirs.store'),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'submit',
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: (result) => {
                        if(!this.dropzone.processQueue()){
                            Inertia.visit(route('admin.souvenirs'), { method: 'get' }, { preserveScroll: true });
                        }
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

<style>
.dropzone {
    padding: 10px;
    border: 1px solid rgb(186 186 186 / 30%);
    min-height: 70%;
}
.dropzone .dz-preview {
    min-height: 70px;
}
.dropzone .dz-preview .dz-image {
    width: 60%;
    height: 60%;
}
.dropzone .dz-preview .dz-progress {
    left: 40%;
    top: 40%;
    width: 60px;
}
.dropzone .dz-preview .dz-success-mark, .dropzone .dz-preview .dz-error-mark {
    left: 30%;
}
.dropzone .dz-preview .dz-details {
    left: -20px;
}
</style>