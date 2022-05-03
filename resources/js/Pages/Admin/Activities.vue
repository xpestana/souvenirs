<template>
    <div class="container  px-0 px-md-2 px-lg-5">
        <div class="row my-2 my-md-5 px-md-5">
            <div class="col-12 text-center">
                <h1 class="text-azulc text-2xl md:text-5xl font-weight-bolder">Gestión de Actividades</h1>
            </div>
        </div>
        <div class="row mt-5 px-md-5">
            <div class="col-12 text-center" v-if="desabilitar">
                <div class="spinner-border text-info" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="col-12 d-none d-md-block cabecera-escritorio">
                <div class="row px-0 alto-mobile py-3 thead d-none d-md-flex">
                    <div class="col-6 px-0 text-center">
                        <p class="font-weight-bolder">Nombre de la actividad</p>
                    </div>
                    <div class="col-1 px-0 text-center">
                        <p class="font-weight-bolder">Flow</p>
                    </div>
                    <div class="col-1 px-0 text-center">
                        <p class="font-weight-bolder">Localidad</p>
                    </div>
                    <div class="col-2 px-0 text-center">
                        <p class="font-weight-bolder">Type</p>
                    </div>
                    <div class="col-2 px-0 text-center">
                        <p class="font-weight-bolder">Activar / Desactivar</p>
                    </div>
                </div>
            </div>
            <div class="col-12 alto pr-0 overflw  d-none d-md-block tabla-escritorio">
                <div class="row px-0 py-2 tabla" :class="{'td' : transmutar()}" v-for="product in activitiesListAsc" :key="product.id">
                    <div class="col-6 px-0 text-center">
                        <p>{{  codificarTilde(product.name) }}</p>
                    </div>
                    <div class="col-1 px-0 text-center">
                        <p>{{ product.flow }}</p>
                    </div>
                    <div class="col-1 px-0 text-center">
                        <p>{{ product.location_name }}</p>
                    </div>
                    <div class="col-2 px-0 text-center">
                        <p>{{ product.type['name'] }}</p>
                    </div>
                    <div class="col-2 px-0 text-center">
                        <input type="checkbox" 
                            :value="product.short_id" 
                            @change="update(product.short_id)"
                            :checked="checkId(product.short_id)"
                            :disabled="desabilitar"
                            :class="{'text-muted':desabilitar}"
                        >   
                    </div>
                </div>
            </div>
            <div class="col-12 d-md-none tabla-movil">
                <div class="table-responsive-md bg-white alto">
                    <table class="table table-striped table-borderless" >
                        <thead class="table-active text-center">
                            <tr>
                                <th scope="col">Título</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"> 
                            <tr v-for="product in activitiesListAsc" :key="product.id">
                                <td class="text-center">{{ product.name }}</td>
                                <td class="text-center">{{ product.flow }}</td>
                                <td class="text-center">{{ product.location_name }}</td>
                                <td class="text-center">{{ product.type['name'] }}</td>
                                <td class="text-center">
                                    <input type="checkbox" 
                                        :value="product.short_id" 
                                        @change="update(product.short_id)"
                                        :checked="checkId(product.short_id)"
                                        :disabled="desabilitar"
                                        :class="{'text-muted':desabilitar}"
                                    >  
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 text-center mt-3">
                <button  class="btn btn-outline-azulc rounded-pill py-1 px-3" @click="updt()"><i class="fas fa-spinner pr-1 pr-lg-3"></i>Actualizar lista</button>
            </div>
        </div>
    </div>

    <div class="container px-0 px-md-2 px-lg-5">
        <div class="row my-4 my-md-5 px-md-5">
            <div class="col-12 text-center">
                <h1 class="text-azulc text-2xl font-weight-bolder">Actividades registradas</h1>
            </div>
        </div>
        <div class="row justify-content-center justify-content-md-between mt-3 mb-2 mt-md-5 mb-md-4 opciones px-md-5">
            <div class="col-10 col-md-5 col-lg-4 my-2 my-lg-0  text-center text-md-left">
                <a href="#" class="btn btn-primary-c py-1 px-3">Agregar Actividad <i class="fas fa-plus pr-1 pr-lg-3"></i></a>
            </div>
            <div class="col-10 col-md-5 col-lg-4 pt-md-1 pl-md-5 my-2 my-md-0 text-center text-md-right">
                <div class="input-search m-0">
                    <span class="fa fa-search text-muted position-absolute d-none d-lg-block text-md-right ml-md-2 right-0 md:mr-48 md:pt-2.5"></span>
                    <input type="text" class="rounded-sm border md:pl-8 h-9" placeholder="Search">
                </div>
            </div>
        </div>
    </div>
    <div class="container tabla-actividades-registradas px-0 px-md-2 px-lg-5 mb-4">
        <div class="row mt-2 px-md-5">
            <div class="col-12">
                <div class="table-responsive-md bg-white">
                    <table class="table table-striped table-borderless">
                        <thead class="table-active text-center">
                            <tr>
                                <th scope="col">Título</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Idioma</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"> 
                            <tr v-for="act in activities.data" :key="act.id">
                                <td class="text-center truncate">{{ act.title }}</td>
                                <td class="text-center">{{ detallarPrecios(act.activities.priceA) }}</td>
                                <td class="text-center">{{ act.activities.language }}</td>
                                <td class="text-center">
                                    <div class="d-inline-flex">
                                    <Link class="btn btn-sm py-0 px-1 py-md-1 px-md-1 text-white d-inline mx-1" :href="route('activities.edit',{id:act.id})" style="background-color: #2b59a2">Editar</Link>
                                    <button class="btn btn-sm btn-danger py-0 px-1 py-md-1 px-md-1 d-inline mx-1" @click="update(product.short_id)">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 flex justify-center mb-4">
                <paginator :paginator="activities" />
            </div>
        </div>
    </div>
</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
import { Link } from '@inertiajs/inertia-vue3'
import Paginator from '@/Components/Paginator.vue'
export default {
    layout:Layout,
    components:{
        Paginator,
        Link
    },
    props:{
        products:Object,
        actList:Object,
        activities:Object
    },
    data(){
        return {
            moment:null,
            form: this.$inertia.form({
                name: null,
                duration: null,
                description: null,
                flow: null,
                short_id: null,	
                summary: null,	
                type: null,	
                location_name: null,
                coordinates: null,	
                images: null,
                pricing_notes: null,
            }),
            zebra:false,
            desabilitar:false,
        }
    },
    created(){
        // this.moment=Moment;
        console.log(this.activities)
    },
    updated(){
        this.desabilitar = false
    },
    methods: {
        detallarPrecios(precios){
            if(precios !== "null"){
                let lista = JSON.parse(precios);
                if(lista.error_code == undefined){
                    let arr = [];
                    for(let val in lista.prices_per_ticket){
                      arr.push(lista.prices_per_ticket[val])
                    }
                    let template = ''
                    if(arr[0]) template += 'Adultos: '+arr[0]
                    if(arr[1]) template += ' - Niños: '+arr[1]
                    if(arr[2]) template += ' - Estudiantes: '+arr[2]
                    if(arr[3]) template += ' - Bebes: '+arr[3]
                    return template;
                }
                return 'sin precios'   
            }else
            {
                return 'sin precios'   
            }
        },
        updt(){
            this.$inertia.get(route('update.api'),
                {
                    preserveScroll: true,
                })
            //this.desabilitar = true
        },
        update(product){
            this.product(product);
            this.form.post(route('update.activities',{activities : product}),
            {
                preserveScroll: true,
            })
            this.desabilitar = true
        },
        product(short_id){
            var product = this.products.filter(product => product.short_id == short_id)[0];
            this.form.name = this.codificarTilde(product.name);
            this.form.duration = this.codificarMinutos(product.duration);
            this.form.description = this.codificarTilde(product.description);
            this.form.flow = product.flow;
            this.form.short_id = product.short_id;
            this.form.summary = this.codificarTilde(product.summary);
            this.form.coordinates = product.coordinates;
            this.form.type = product.type.name;
            this.form.location_name = product.location_name;
            this.form.images = product.images;
            this.form.pricing_notes = this.codificarTilde(product.pricing_notes);
        },
        checkId(id){
            return this.idActList.includes(id);
        },
        transmutar(){
            return this.zebra = !this.zebra;
        },
        codificarTilde(n){
            n.indexOf('&Aacute;') != -1 ? n = n.replaceAll('&Aacute;', 'Á'):''
            n.indexOf('&aacute;') != -1 ? n = n.replaceAll('&aacute;', 'á'):''
            n.indexOf('&Eacute;') != -1 ? n = n.replaceAll('&Eacute;', 'É'):''
            n.indexOf('&eacute;') != -1 ? n = n.replaceAll('&eacute;', 'é'):''
            n.indexOf('&Iacute;') != -1 ? n = n.replaceAll('&Iacute;', 'Í'):''
            n.indexOf('&iacute;') != -1 ? n = n.replaceAll('&iacute;', 'í'):''
            n.indexOf('&Oacute;') != -1 ? n = n.replaceAll('&Oacute;', 'Ó'):''
            n.indexOf('&oacute;') != -1 ? n = n.replaceAll('&oacute;', 'ó'):''
            n.indexOf('&Uacute;') != -1 ? n = n.replaceAll('&Uacute;', 'Ú'):''
            n.indexOf('&uacute;') != -1 ? n = n.replaceAll('&uacute;', 'ú'):''
            n.indexOf('&Uuml;') != -1 ? n = n.replaceAll('&Uuml;', 'Ü'):''
            n.indexOf('&uuml;') != -1 ? n = n.replaceAll('&uuml;', 'ü'):''
            n.indexOf('&ntilde;') != -1 ? n = n.replaceAll('&ntilde;', 'ñ'):''
            return n;
        },
        codificarMinutos(minutos){
            minutos= parseInt(minutos);
            let horas=Math.floor(minutos/60)
            let min = minutos % 60
            horas == 0 ? horas='' : horas=horas+'h ';
            min == 0 ? min='' : min=min+'min';
            return horas+min
        }
    },
    computed:{
        idActList(){
            return this.actList.reduce((acc, el) => ([
            ...acc,
            el.short_id
            ]),[]);
        },
        activitiesListAsc(){
           return  this.products.sort((p1,p2)=>{
                if(p1.name < p2.name){
                    return -1;
                }else if(p1.name < p2.name){
                    return 1;
                }else{
                    return 0;
                }
            })
        },
    }
}
</script>

<style scoped>
.thead{
    background-color: #00000013;
}
.td{
    background-color: #f2f2f2;
}
.alto{
    height: 55vh;
    overflow-y: auto;
    overflow-x: hidden;
}
@media(max-width:767px){
    .alto{
    overflow-x: auto;
}   
}

</style>