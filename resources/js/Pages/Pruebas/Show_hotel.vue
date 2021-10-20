<template>
    <Head title="Register" />

    <BreezeValidationErrors class="mb-4" />
    <div>
        <p>Lista de hoteles</p>
        <p>Ruta route('hotels.index') / URL: /hotel / method GET</p>
        <p>Controlador: HotelController</p>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>nombre</th>
                    <th>email</th>
                    <th>Direccion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
             <tr v-for="hotel in hotels">
                <td>{{ hotel.user.name }}</td>
                <td>{{ hotel.user.email }}</td>
                <td>{{ hotel.address }}</td>
                <td>
                    <Link :href="route('hotels.edit',{hotel : hotel.id})" title="editar hotel">
                        Editar
                    </Link>
                    <Link href="javascript:void(0)" title="eliminar hotel" @click="deleteHotel(hotel.id)">
                        Eliminar
                    </Link>
                </td>
            </tr>
            </tbody>
        </table>
        <p>la ruta hotels.edit se llama para ir a la vista que edita el hotel, se les pasa como parametro el id del hotel</p>
        <p>la ruta hotels.destroy se llama para eliminar el hotel, se les pasa como parametro el id del hotel</p>
    </div>
</template>

<script>
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeValidationErrors,
        Head,
        Link,
    },
    props: {
        hotels: Object,
        
    },
    created(){//muestra la salida de la busqueda del hotel
        console.log('Hotel',this.hotels)
    },
    data() {
    },

    methods: {
        deleteHotel(hotel){
            this.$inertia.delete(route('hotels.destroy',{hotel : hotel}))
        }
    }
}
</script>
