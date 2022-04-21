<template>
    <div class="container  px-0 px-md-2 px-lg-5">
        <div class="row my-2 my-md-5 px-md-5">
            <div class="col-12 text-center">
                <h1 class="text-azulc text-2xl md:text-5xl font-weight-bolder">Gestión de Actividades</h1>
            </div>
        </div>
        <div class="row mt-5 px-md-5">
            <div class="col-12">
                <div class="alto table-responsive-md bg-white">
                    <table class="table table-striped table-borderless">
                        <thead class="table-active text-center">
                            <tr>
                                <th scope="col">Título</th>
                                <th scope="col">Flow</th>
                                <th scope="col">Localidad</th>
                                <th scope="col">Type</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"> 
                            <tr v-for="product in products" :key="product.id">
                                <td class="text-center">{{ product.name }}</td>
                                <td class="text-center">{{ product.flow }}</td>
                                <td class="text-center">{{ product.location_name }}</td>
                                <td class="text-center">{{ product.type['name'] }}</td>
                                <td class="text-center">
                                    <input type="checkbox" :value="product.short_id" @change="update(product.short_id)"
                                    :checked="checkId(product.short_id)"
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
export default {
    layout:Layout,
    props:{
        products:Object,
        actList:Object
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
        }
    },
    created(){
        console.log("todos", this.products);
        // this.moment=Moment;
    },
    methods: {
        update(product){
            this.product(product);
            this.form.post(route('update.activities',{activities : product}),
                {
                    preserveScroll: true,
                })
        },
        product(short_id){
            var product = this.products.filter(product => product.short_id == short_id)[0];
            this.form.name = product.name;
            this.form.duration = product.duration;
            this.form.description = product.description;
            this.form.flow = product.flow;
            this.form.short_id = product.short_id;
            this.form.summary = product.summary;
            this.form.coordinates = product.coordinates;
            this.form.type = product.type.name;
            this.form.location_name = product.location_name;
            this.form.images = product.images;
            this.form.pricing_notes = product.pricing_notes;
        },
        checkId(id){
            return this.idActList.includes(id);
        }
    },
    computed:{
        idActList(){
            return this.actList.reduce((acc, el) => ([
            ...acc,
            el.short_id
            ]),[]);
        }
    }
}
</script>

<style>
.alto{
    max-height: 30em;
    overflow: auto;
}

</style>