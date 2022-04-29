<template>
    <form @submit.prevent="submit">
	<div class="row">
        <div class="col-12 text-center">
                <DatePicker mode="date" v-model="form.date" 
                :available-dates="this.dias_disponibles" 
                :attributes="attributes" />
                <div class="">
                    
                    <!-- <BreezeButton id="submit" type="submit" class="view-cart bg-info" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Agregar al carrito
                    </BreezeButton>
                    <BreezeValidationErrors class="my-3" />
                    <div class="login-footer text-center">
                        <div v-if="status" class="mb-4 font-medium text-sm text-danger">
                            {{ status }}
                        </div>
                    </div> -->
                    <!-- <div align="center" class="col-md-6 mt-4">
                        <div class="d-single-info text-lg-center">
                            <BreezeButton type="button" class="view-cart bg-info" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="reserve">Reservar directo</BreezeButton>
                        </div>
                    </div> -->
                </div>
            <div class="border mt-2 section-horarios d-inline-flex p-1 mb-1 w-3/4 md:w-1/4">
                <div class="icon text-center">
                    <i class="far fa-clock text-xl text-grayc pl-1 pr-2"></i>
                </div>
                <div class="lista-horarios">
                    <div class="d-inline mr-2">
                        <input type="radio" name="hora">
                        <p class="hora d-inline pl-1 pt-1 text-base">11:00</p>
                    </div>
                    <div class="d-inline mr-2">
                        <input type="radio" name="hora">
                        <p class="hora d-inline pl-1 pt-1 text-base">11:00</p>
                    </div>
                    <div class="d-inline mr-2">
                        <input type="radio" name="hora">
                        <p class="hora d-inline pl-1 pt-1 text-base">11:00</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 py-2" style="background-color:#e6e6e6d4">
            <div class="row pb-2 justify-content-md-center">
                <template v-if="this.precios.length == 0">
                    <div class="col-12 text-center my-2 text-danger">
                        No hay precios establecidos para esta actividad
                    </div>
                </template>
                <div class="col-5 col-md-3 pt-1 pl-4">
                    <p class="text-2xl d-inline mr-4">Adulto</p>
                </div>
                <div class="col-3 col-md-1 px-0 pt-2 text-center">
                    <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline">
                        <template v-if="this.precios[0]">
                            {{precios[0]}}€
                        </template> 
                        <template v-else>
                            -
                        </template>
                    </h5>
                </div>
                <div class="col-4 col-md-1 px-0 pt-2">
                    <button type="button" @click="form.adult > 0 ? --form.adult : ''" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-minus"></i></button>
                    <input type="text" v-model="form.adult" class="border-0 w-10 font-weight-bolder p-0 px-2 text-center" style="background-color:#e6e6e6d4">
                    <button type="button" @click="++form.adult" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="row pb-2 justify-content-md-center">
                <div class="col-5 col-md-3 pt-1 pl-4">
                    <p class="text-2xl d-inline mr-4">Niño</p>
                </div>
                <div class="col-3 col-md-1 px-0 pt-2 text-center">
                    <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline">
                        <template v-if="this.precios[1]">
                            {{precios[1]}}€
                        </template> 
                        <template v-else>
                            -
                        </template>
                    </h5>
                </div>
                <div class="col-4 col-md-1 px-0 pt-2">
                    <button type="button" @click="form.children > 0 ? --form.children : ''" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-minus"></i></button>
                    <input type="text" v-model="form.children" class="border-0 w-10 font-weight-bolder p-0 px-2 text-center" style="background-color:#e6e6e6d4">
                    <button type="button" @click="++form.children" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="row pb-2 justify-content-md-center">
                <div class="col-5 col-md-3 pt-1 pl-4">
                    <p class="text-2xl d-inline mr-4">Estudiantes</p>
                </div>
                <div class="col-3 col-md-1 px-0 pt-2 text-center">
                    <h5 class="rounded-circle bg-white p-2 font-weight-bolder text-base d-inline">
                        <template v-if="this.precios[2]">
                            {{precios[2]}}€
                        </template> 
                        <template v-else>
                            -
                        </template>
                    </h5>
                </div>
                <div class="col-4 col-md-1 px-0 pt-2">
                    <button type="button" @click="form.student > 0 ? --form.student : ''" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-minus"></i></button>
                    <input type="text" v-model="form.student" class="border-0 w-10 font-weight-bolder p-0 px-2 text-center" style="background-color:#e6e6e6d4">
                    <button type="button" @click="++form.student" class="rounded-circle bg-info text-white d-inline text-xs px-1"><i class="fas fa-plus"></i></button>
                </div>
            </div>
        </div>
        
        <div class="col-12 text-center px-0 mb-2 py-1" style="background-color:#bedfef;">
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
                modal: false,
                status: null,
                random: 1,
            	form: this.$inertia.form({
                    product_id: this.product.id,
                	adult: 0,
                	children: 0,
                    student:0,
                    date:null,
                    priceAdult:0,
                    priceChildren:0,
                    priceStudent:0
            	}),
                attributes: [
                    {
                        highlight: true,
                        dates: []
                    }
                ]
            }
        },
        props: {
            product: Object,
            eventos: Object,
            precios: Object
        },
        methods: {
            fechas(){
                if(this.eventos !== undefined){
                    let newevents = this.eventos.map((el)=> el.time*1000)
                    let valor = ""
                    for(let val of newevents){
                        valor = new Date(val)
                        this.attributes[0].dates.push(valor.getFullYear()+'-'+valor.getMonth()+'-'+valor.getDate())
                    }
                    console.log(this.attributes[0].dates)
                }
            },
            submit(){
                var total = parseInt(this.form.adult) + parseInt(this.form.children);

                if (total == 0 || this.guardarFecha == null) {
                    let text=""
                    if(total == 0) text = "Error, No hay nadie por registrar"
                    if(this.guardarFecha == null) text = "No ha seleccionado ninguna fecha"
                 
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
                }
                if(total > 0 && this.guardarFecha !== null){
                    console.log(this.form)
                    this.form.date = this.guardarFecha;
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
            }
    	},
        computed: {
            guardarFecha(){
                return this.form.date;
            },
            dias_disponibles(){
                let newevents = this.eventos.map((el)=> el.time*1000)
                let valor='';
                
                return newevents.map((el) => {
                    valor = new Date(el);
                    return { 
                        start:valor.getFullYear()+'-'+valor.getMonth()+'-'+valor.getDate(),
                        end:valor.getFullYear()+'-'+valor.getMonth()+'-'+valor.getDate()
                    }
                })
            },
        },
        created(){
            this.fechas()
        },
        mounted(){
            console.log(this.dias_disponibles)
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