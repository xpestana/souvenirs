<template>
    <form @submit.prevent="submit">
	<div class="row">
        <div class="col-12 text-center" v-if="this.eventos.length > 0">
                <DatePicker locale="en" mode="date" v-model="form.date" 
                :available-dates="this.dias_disponibles" 
                :attributes="attributes" />
        </div>
        <div class="col-12 py-0 my-0 text-center" v-if="this.preciosLista.length > 0">
            <div class="border mt-2 section-horarios d-inline-flex p-1 mb-1 w-3/4 md:w-1/4">
                <div class="icon text-center">
                    <i class="far fa-clock text-xl text-grayc pl-1 pr-2"></i>
                </div>
                <div class="lista-horarios">
                    <div class="d-inline mr-2">
                        <input type="radio" name="hora" class="mb-2">
                        <p class="hora d-inline pl-1 pt-1 text-base">{{ hora }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 my-2 text-center text-danger" v-if="this.eventos.length == 0">
            This activity is not available
        </div>
        <template v-if="this.preciosLista.length == 0 && this.eventos.length > 0">
            <div class="col-12 my-2 text-center text-azulc">
                Select a date to see the prices!
            </div>
        </template>
        <template v-if="this.spinner">
            <div class="col-12 my-1 text-center">
                <div class="spinner-border text-azulc" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </template>
        
            <div  class="col-12 py-2 mt-1 precios" style="background-color:#e6e6e6d4" v-if="recorrerPrecios().length > 0">
                <div class="row pb-2 pt-1 justify-content-md-center" v-for="(precio, index) in recorrerPrecios()" :key="precio.name">
                    <div class="col-5 col-md-3 pt-1 pl-4" >
                        <p class="text-lg d-inline mr-4"><CodificarTilde :string="precio.name"/></p>
                    </div>
                    <div class="col-3 col-md-1 px-0 pt-2 text-center">
                        <h5 class="rounded-circle bg-white px-1 py-3.5 font-weight-bolder text-sm d-inline">
                            {{ precio.price }}€
                        </h5>
                    </div>
                    <div class="col-4 col-md-1 px-0 pt-1">
                        <select class="rounded border py-1" :id="'select'+index">
                            <option :value="0+':'+precio.price+':'+precio.name.split(' ')[0]">0</option>
                            <option :value="1+':'+precio.price+':'+precio.name.split(' ')[0]">1</option>
                            <option :value="2+':'+precio.price+':'+precio.name.split(' ')[0]">2</option>
                            <option :value="3+':'+precio.price+':'+precio.name.split(' ')[0]">3</option>
                            <option :value="4+':'+precio.price+':'+precio.name.split(' ')[0]">4</option>
                            <option :value="5+':'+precio.price+':'+precio.name.split(' ')[0]">5</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="col-12 text-center px-0 mb-2 py-1" style="background-color:#bedfef;" v-if="this.guardarFecha !== null || this.preciosLista[0] !== undefined">
                <button class="btn shadow-city bg-white py-1 px-5 my-2 font-weight-bolder text-center text-base" id="submit" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reserve
                </button>
            </div>
  	</div>
    </form>
</template>
<script>
	import { Calendar, DatePicker } from 'v-calendar'
	import { Head, Link } from '@inertiajs/inertia-vue3'
    import Checkout from '@/Pages/Checkout_activities.vue'
    import BreezeButton from '@/Components/Button.vue'
    import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
    import CodificarTilde from '@/Layouts/Components/CodificarTilde.vue'
    import { Inertia } from '@inertiajs/inertia'

	export default {
        components: {
        	Calendar,
            DatePicker,
            Head,
            Checkout,
            Link,
            BreezeButton,
            BreezeValidationErrors,
            CodificarTilde
        },
        data() {
            return {
            	form: this.$inertia.form({
                    product_id: this.product.id,
                    codes:0,
                    fecha:null,
                    date:null,
                    pedido:[],
                    short_id:this.product.short_id
            	}),
                spinner:false,
                formApi: this.$inertia.form({
                    short_id: 0,
                    event_time: 0
            	}),
                attributes: [
                    {
                        highlight: true,
                        dates: []
                    },
                    {
                        key: 'today',
                        highlight: 'red',
                        dates:'asdasd'
                    },
                ],
                preciosFecha:{},
                fechasObjeto:[],
                preciosLista:0,
                getDate:null,
                hora:0,
            }
        },
        props: {
            product: Object,
            eventos: Object,
            precios: Object,
            prices:Object,
            ticket:Object,
        },
        methods: {
            fechas(){
                if(this.eventos !== undefined){
                    let newevents = this.eventos.map((el)=> el.time*1000)
                    let valor = ""
                    for(let val of newevents){
                        valor = new Date(val)
                        this.attributes[0].dates.push(valor)
                    }
                }
            },
            submit(){
                // let total = parseInt(this.form.adult) + parseInt(this.form.children) + parseInt(this.form.student) + parseInt(this.form.baby);
                this.form.codes = this.codeLista[0] !== undefined ? this.codeLista[0] : 0
                let total = 0;
                for (let index = 0; index < this.recorrerPrecios().length; index++) {
                    let obj = document.getElementById('select'+index).value
                    let numPer = Number(obj.split(':')[0]);
                    total += numPer;
                    this.form.pedido.push(obj);
                }
                this.form.date = this.guardarFecha;
                let url = this.$page.url;
                this.form.fecha = url.split('event_time=')[1].split('&')[0];
                if (total == 0) {
                    let text=""
                    if(total == 0) text = "Indica cuántas personas acudirán a esta actividad"
                    if(this.form.fecha == null) text = "No ha seleccionado ninguna fecha"
                 
                    this.$swal({
                        title: text,
                        icon: 'info',
                        showCloseButton: false,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText:
                            '<i class="fa fa-thumbs-up"></i> Aceptar!',
                        confirmButtonAriaLabel: 'Aceptar!',
                    })
                }else{
                    console.log(this.form)
                    this.form.post(route('cart.activity'),{
                        _token: this.$page.props.csrf_token,
                        errorBag: 'submit',
                        preserveScroll: true,
                        forceFormData: true,
                    })
                }
            },
            reserve(){
                var total = parseInt(this.form.adult) + parseInt(this.form.children);

                if (total == 0) {
                    this.status = "Error, No hay nadie por registrar";
                return;
                }
                this.form.date = this.guardarFecha;
                this.form.post(route('cart.activity'),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'submit',
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: (result) => {
                        Inertia.visit(route('checkout.souvenirs'), { method: 'get' }, { preserveScroll: true });
                    }
                })
            },
            recorrerPrecios(){
                let arr = []
                
                for(let key in this.prices.prices_per_ticket)
                {
                    arr.push(this.ticket[key])
                }
                return arr
            }
    	},
        computed: {
            guardarFecha(){
                if(this.form.date !== null){
                this.spinner=true;
                let arr = String(this.form.date).split(new Date().getFullYear())
                const result = this.fechasObjeto.filter(el => String(el.fecha).includes(arr[0]))

                this.formApi.short_id = this.product.short_id;
                this.formApi.event_time = result[0].codigo;
                this.preciosFecha = {};
                this.$inertia.get(route('product.activities.show',this.product.id),
                this.formApi,
                { 
                    preserveScroll: true 
                })
            }
                return this.form.date;
            },
            dias_disponibles(){
                let newevents = this.eventos.map((el)=> el.time*1000)
                let valor='';
                
                return newevents.map((el) => {
                    valor = new Date(el);
                    return { 
                        start:valor.getFullYear()+'-'+(valor.getMonth()+1)+'-'+valor.getDate(),
                        end:valor.getFullYear()+'-'+(valor.getMonth()+1)+'-'+valor.getDate()
                    }
                })
            },
            codeLista(){
                if(this.preciosFecha !== {}){
                    let arr =[];
                    for(let val in this.preciosFecha.prices_per_ticket){
                        arr.push(this.preciosFecha.prices_per_ticket);
                    }
                    
                    return arr;
                }else{
                    return 0
                }
            },
        },
        created(){
            let url = this.$page.url;
            if(url.length > 20){
                this.getDate = url.split('event_time=')[1].split('&')[0];
                let date = new Date (this.getDate*1000);
                this.hora = String(date).split(String(date.getFullYear()))[1].split('GMT')[0];
                this.attributes[1].dates = new Date(date.getFullYear(),date.getMonth(),date.getDate());
            }else{
                this.attributes[1].dates = null;
            }
            

            if(this.prices.prices_per_ticket !== undefined){
                this.recorrerPrecios()
                this.preciosLista = [];
                for(let val in this.prices.prices_per_ticket){
                    this.preciosLista.push(this.prices.prices_per_ticket[val]);
                }
            }
            this.fechas()
                if(this.eventos !== undefined){
                this.fechasObjeto = this.eventos.map((el)=>{ 
                    return { 
                        codigo : el.time,
                        fecha  : new Date(el.time*1000)
                    }
                })
            }
        },
        mounted(){
           
            /*console.log(this.fechasObjeto)*/
        }

    }
</script>
<style scoped>
.vc-container {
    border: 2px solid #7ecedf;
    border-radius: 0;
}
.vc-weeks {
    padding: 0px 12px;
}
</style>