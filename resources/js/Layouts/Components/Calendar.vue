<template>
    <form @submit.prevent="submit">
	<div class="row">
        <div class="col-12 text-center" v-if="this.eventos.length > 0">
                <DatePicker mode="date" v-model="form.date" 
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
            Esta actividad no esta disponible
        </div>
        <template v-if="this.preciosLista.length == 0 && this.eventos.length > 0">
            <div class="col-12 my-2 text-center text-azulc">
                Seleccione una fecha para poder ver los precios!
            </div>
        </template>
        <template v-if="this.spinner">
            <div class="col-12 my-1 text-center">
                <div class="spinner-border text-azulc" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </template>
        
            <div  class="col-12 py-2 mt-1" style="background-color:#e6e6e6d4" v-if="this.preciosLista.length !== 0 && this.eventos !== null">
                <div class="row pb-2 justify-content-md-center" v-if="this.preciosLista[0] !== undefined">
                    <div class="col-5 col-md-3 pt-1 pl-4" >
                        <p class="text-lg d-inline mr-4">Adultos</p>
                    </div>
                    <div class="col-3 col-md-1 px-0 pt-2 text-center">
                        <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline">
                            {{preciosLista[0]}}€
                        </h5>
                    </div>
                    <div class="col-4 col-md-1 px-0 pt-2" v-if="this.preciosLista.length > 0">
                        <button type="button" @click="form.adult > 0 ? --form.adult : ''" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-minus"></i></button>
                        <input type="text" v-model="form.adult" class="border-0 w-10 font-weight-bolder p-0 px-2 text-center" style="background-color:#e6e6e6d4">
                        <button type="button" @click="++form.adult" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="row pb-2 justify-content-md-center" v-if="this.preciosLista[1] !== undefined">
                    <div class="col-5 col-md-3 pt-1 pl-4">
                        <p class="text-lg d-inline mr-4">Niños</p>
                    </div>
                    <div class="col-3 col-md-1 px-0 pt-2 text-center">
                        <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline">
                            {{preciosLista[1]}}€
                        </h5>
                    </div>
                    <div class="col-4 col-md-1 px-0 pt-2">
                        <button type="button" @click="form.children > 0 ? --form.children : ''" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-minus"></i></button>
                        <input type="text" v-model="form.children" class="border-0 w-10 font-weight-bolder p-0 px-2 text-center" style="background-color:#e6e6e6d4">
                        <button type="button" @click="++form.children" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="row pb-2 justify-content-md-center" v-if="this.preciosLista[2] !== undefined">
                    <div class="col-5 col-md-3 pt-1 pl-4">
                        <p class="text-lg d-inline mr-4">Estudiantes</p>
                    </div>
                    <div class="col-3 col-md-1 px-0 pt-2 text-center">
                        <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline">
                            {{preciosLista[2]}}€
                        </h5>
                    </div>
                    <div class="col-4 col-md-1 px-0 pt-2">
                        <button type="button" @click="form.student > 0 ? --form.student : ''" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-minus"></i></button>
                        <input type="text" v-model="form.student" class="border-0 w-10 font-weight-bolder p-0 px-2 text-center" style="background-color:#e6e6e6d4">
                        <button type="button" @click="++form.student" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="row pb-2 justify-content-md-center" v-if="this.preciosLista[3] !== undefined">
                    <div class="col-5 col-md-3 pt-1 pl-4">
                        <p class="text-lg d-inline mr-4">Bebés</p>
                    </div>
                    <div class="col-3 col-md-1 px-0 pt-2 text-center">
                        <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline">
                            {{preciosLista[3]}}€
                        </h5>
                    </div>
                    <div class="col-4 col-md-1 px-0 pt-2">
                        <button type="button" @click="form.baby > 0 ? --form.baby : ''" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-minus"></i></button>
                        <input type="text" v-model="form.baby" class="border-0 w-10 font-weight-bolder p-0 px-2 text-center" style="background-color:#e6e6e6d4">
                        <button type="button" @click="++form.baby" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center px-0 mb-2 py-1" style="background-color:#bedfef;" v-if="this.guardarFecha !== null || this.preciosLista[0] !== undefined">
                <button class="btn shadow-city bg-white py-1 px-5 my-2 font-weight-bolder text-center text-base" id="submit" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reservar
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
    import { Inertia } from '@inertiajs/inertia'

	export default {
        components: {
        	Calendar,
            DatePicker,
            Head,
            Checkout,
            Link,
            BreezeButton,
            BreezeValidationErrors
        },
        data() {
            return {
            	form: this.$inertia.form({
                    product_id: this.product.id,
                	adult: 0,
                	children: 0,
                    student:0,
                    baby:0,
                    date:null,
                    priceAdult:0,
                    priceChildren:0,
                    priceStudent:0,
                    priceBaby:0,
                    codes:0,
                    fecha:null,
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
            prices:Object
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
                let total = parseInt(this.form.adult) + parseInt(this.form.children) + parseInt(this.form.student) + parseInt(this.form.baby);
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
                    this.form.priceAdult = this.preciosLista[0] !== undefined ? this.preciosLista[0] : 0
                    this.form.priceChildren = this.preciosLista[1] !== undefined ? this.preciosLista[1] : 0
                    this.form.priceStudent = this.preciosLista[2] !== undefined ? this.preciosLista[2] : 0
                    this.form.priceBaby = this.preciosLista[3] !== undefined ? this.preciosLista[3] : 0

                    this.form.codes = this.codeLista[0] !== undefined ? this.codeLista[0] : 0


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
                    let arr =[];console.log(this.preciosFecha.prices_per_ticket)
                    for(let val in this.preciosFecha.prices_per_ticket){
                        arr.push(this.preciosFecha.prices_per_ticket);
                    }
                    
                    return arr;
                }else{
                    return 0
                }
            }
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
                this.preciosLista = [];
                for(let val in this.prices.prices_per_ticket){
                    this.preciosLista.push(this.prices.prices_per_ticket[val]);
                }
            }
            console.log(this.preciosLista)
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