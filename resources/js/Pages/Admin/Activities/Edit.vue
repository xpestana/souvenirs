<template>
    <div class="container cabeza-souvenirs px-md-2 px-lg-5 pt-md-3">
        <div class="row my-2 my-md-5 px-md-5">
            <div class="col-12 text-center">
                <h1 class="text-azulc text-2xl md:text-5xl font-weight-bolder">Editar actividad</h1>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <h1 class="text-lg md:text-2xl font-weight-bolder">Datos de la actividad</h1>
            </div>
        </div>
        <form @submit.prevent="submit">
        <div class="row mt-5">
            <div class="col-12 col-md-6 px-md-0">
                <span class="d-block font-weight-bolder mb-2">Título de la actividad</span>
                <input type="text" v-model="form.title" class="border rounded w-72 md:w-96" placeholder="Título">
            </div>
            <div class="col-12 col-md-6">
                <select name="" id="idioma" class="border rounded w-72 md:w-96 mt-4">
                    <option value="">Idioma</option>
                    <option value="Español">Español</option>
                    <option value="Inglés">Inglés</option>
                    <option value="Italiano">Italiano</option>
                    <option value="Francés">Francés</option>
                    <option value="Alemán">Alemán</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-6 px-md-0">
                <span class="d-block font-weight-bolder mb-1">Descripción</span>
                <ckeditor 
                    :editor="editor" 
                    :config="editorConfig"
                    v-model="form.description"
                ></ckeditor>
            </div>
            <div class="col-12 col-md-6">
                <span class="d-block font-weight-bolder mb-1 mt-2 mt-md-0">Precio base</span>
                <div class="mt-1 d-flex pr-md-5 mr-md-5">
                    <label class="pt-2 py-2 px-2 font-weight-bolder">Único</label>
                    <input type="text" placeholder="Precio" v-model="form.priceUnique" class="border rounded ml-auto mr-2 mr-md-5">
                </div>
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
import Layout from '@/Pages/Admin/Layouts/Layout'
import { Link } from '@inertiajs/inertia-vue3'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
export default {
    layout:Layout,
    components:{
        Link
    },
    props:{
        product:Object
    },
    data(){
        return {
            form: this.$inertia.form({
				title: this.product.title,
                description: this.product.description,
                priceUnique:this.product.price,
                pricesArr:[],
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
        }
    },
    created(){
        this.precios()
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
            this.form.pricesArr.push(this.priceAdult) 
            this.form.pricesArr.push(this.priceChildren) 
            this.form.pricesArr.push(this.priceStudent) 
            this.form.pricesArr.push(this.priceBaby) 
            this.form.lenguage = document.getElementById('idioma').value
            // this.form.post(route('activities.update',{id: this.product.id}),{
            //     _token: this.$page.props.csrf_token,
            //     errorBag: 'submit',
            //     preserveScroll: true,
            //     forceFormData: true,
            // })
        },
    }
    
}
</script>