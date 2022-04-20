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
                  <div class="col-12 my-2">
                      <label class="text-base">Precio</label>
                      <input type="text" class="ml-2 border-0 rounded w-24 h-8" placeholder="..." style="background-color:#e4e4e4" v-model="form.precio">
                  </div>
                  <div class="col-12 col-md-6 my-4">
                      <label class="text-base">Imagen del producto</label> <button 
                                    type="button"
                                    size="sm"
                                    style="background-color:#e4e4e4"
                                    class="btn py-0" 
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
                  <div class="col-12 col-md-4 my-2 my-md-4">
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
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Pages/Admin/Layouts/Layout'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
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

</style>