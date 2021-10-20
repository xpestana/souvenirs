<template>
    <Head title="Register" />

    <BreezeValidationErrors class="mb-4" />
    <div>
        <p>formulario para edicion de hotel</p>
        <p>en cada input describe el tipo de datoq que recibe</p>
        <p>ruta a utilizar para actualizar: route('hotels.update') / URL: /hotel / metodo POST</p>
        <p>Controlador: HotelController funcion update</p>
        <p>Validaciones</p>
        <p>'name' => 'required|string|max:255' - nombre del hotel o del dueño del apartamento</p>
        <p>'email' => 'required|string|email|max:255|unique:users' - email o correo del hotel o del apartamento</p>
        <p>'password' => se crea automatico</p>
        <p>'type' => string, solo admite los string apartament o hotel</p>
        <p>'address' => 'required|string|max:255 - direccion del hotel</p>
        <p>'zone' => 'required|string|max:255 - zona del hotel</p>
        <p class="text-danger">En este apartado no se guarda el numero de cuenta, si requiere guardar el numero de cuenta aqui mismo, me avisa</p>
        <p class="text-danger">necesito saber a que ruta va a reenviar el renderizado al guardar el hotel.<br>
            por ahora se devuelve a la misma prueba de la siguiente manera: <br>  return Redirect::route('register.hotel')->with(['id'=>$id, 'message' => 'Update Success', 'code' => 200, 'status' => 'success'])</p>

    </div>
    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="name" value="Nombre del hotel (string)" />
            <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="email" value="Correo del hotel (email)" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" autocomplete="username" />
            (debe ser unico para la creacion del usuario)
        </div>

        <div class="mt-4">
            La contraseña se genera de forma automatica y se envia al correo
        </div>

        <div class="mt-4">
            <select id="type" class="mt-1 block w-full" v-model="form.type">
                <option value="apartament">Apartamento de hotel</option>
                <option value="hotel">Hotel</option>
            </select>
            (para el tipo de hospedaje solo recibe esos dos valores: apartament y hotel)
        </div>

        <div>
            <BreezeLabel for="address" value="Direccion del hotel (string)" />
            <BreezeInput id="address" type="text" class="mt-1 block w-full" v-model="form.address" required autofocus autocomplete="address" />
        </div>
        <div>
            <BreezeLabel for="zone" value="Zona del hotel (string)" />
            <BreezeInput id="zone" type="text" class="mt-1 block w-full" v-model="form.zone" required autofocus autocomplete="zone" />
        </div>
        <div v-if="$page.props.flash"> {{ $page.props.flash.message }}</div>
        <div class="flex items-center justify-end mt-4">

            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Update
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },
    props: {
        hotel: Object,
        
    },
    created(){
        console.log('hotel',this.hotel)
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.hotel.user.name,
                email: this.hotel.user.email,
                type:  this.hotel.type,
                address: this.hotel.address,
                zone: this.hotel.zone,
            })
        }
    },

    methods: {
        submit() {
            this.form.put(route('hotels.update',{hotel : this.hotel.id}),{
                _token: this.$page.props.csrf_token,
                errorBag: 'submit',
                preserveScroll: false,
            })
        }
    }
}
</script>
