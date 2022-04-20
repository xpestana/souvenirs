<template>
  <div class="container px-md-5">
      <div class="row">
          <div class="col-12 my-md-5">
              <h1 class="font-weight-bolder text-azulc text-3xl md:text-5xl text-center">Editar souvenir</h1>
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
                    <select class="border rounded  w-100" id="category" >
                          <option :value="form.category">{{form.category}}</option>
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
                  <div class="col-12">
                      <label class="text-base">Descripción del producto</label>
                      <ckeditor 
                        :editor="editor" 
                        :config="editorConfig"
                        v-model="form.description"
                    ></ckeditor>
                  </div>
                  <div class="col-12 my-4">
                        <label class="text-base">Imagenes del producto</label>
                        <div id="dropRef" class="dropzone">
                        </div>
                        <button class="btn btn-success text-center mt-2" id="submit_image" type="button" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Actualizar imagenes
                        </button>
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
              <button type="submit" class="bnt btn-primary-c rounded-pill px-4 py-1 px-md-5 py-md-2">Guardar</button>
          </div>
      </div>
      </form>
  </div>
</template>

<script>
import Dropzone from 'dropzone'
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Pages/Admin/Layouts/Layout'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { Carousel, Pagination, Slide,Navigation } from 'vue3-carousel';
import ValidationErrors from '@/Pages/Collaborator/components/ValidationErrors.vue'
export default {
    layout:Layout,
    components:{
        ValidationErrors,
        Link
    },
    props:{
        product:Object
    },
     mounted() {
            const product_id = this.product.id;
            const toast = this.$toast;

            const dropzone = new Dropzone("div#dropRef", { 
                url: route('souvenirs.update.image'),
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 5,
                maxFiles: 5,
                acceptedFiles: 'image/*',
                resizeQuality: 0.8,
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
    data() {
        return {
            form: this.$inertia.form({
                title: this.product.title,
                precio: this.product.price,
                offer: this.product.offer,
                description: this.product.description,
                featured:0,
                stock: this.product.stock,
                category: this.product.category,
                image: null,
            }),
            id: this.$page.props.flash.id,
            status: null,
            editor: ClassicEditor,
            editorData: '',
            editorConfig:{
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
            },
            dropzone:null
        }
    },
    methods:{
        submit() {
            this.form.category = document.getElementById('category').value
            this.form.post(route('update.souvenirs',{souvenir: this.product.id}),{
                _token: this.$page.props.csrf_token,
                errorBag: 'submit',
                preserveScroll: true,
                forceFormData: true,
                onSuccess: (result) => {
                    if(this.$page.props.flash.code == 200){
                        this.$inertia.visit(route('admin.souvenirs'), { method: 'get' }, { preserveScroll: true });
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
</style>