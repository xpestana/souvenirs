<template>
<Layout>
<div class="tab-content dashboard-content mt-all-40">
	<div id="orders" class="tab-pane fade show active">
        <h3>Mis ventas</h3>
        <div class="table-responsive">
            <table id="orders_table" class="table datatable">
                <thead>
                    <tr>
                        <th>ID de transaccion</th>
                        <th>Correo del cliente</th>
                        <th>Telefono del cliente</th>
                        <th v-if="$page.props.auth.role == 'Admin'">Hotel</th>
                        <th v-if="$page.props.auth.role == 'Hotel'">Ganancias</th>
                        <th v-if="$page.props.auth.role == 'Admin'">Monto</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orders" :key="order.id">
                        <td class ="text-orders" style="font-size: 15px;">{{ order.transaction_id }}</td>
                        <td class ="text-orders" style="font-size: 15px;"> {{ order.shippings[0].email }}</td>
                        <td class ="text-orders" style="font-size: 15px;"> {{ order.shippings[0].phone }}</td>
                        <td class ="text-orders" style="font-size: 15px;" v-if="$page.props.auth.role == 'Admin'">
                            {{ order.user.hotel[0].name }}
                        </td>
                        <td style="font-size: 15px;" v-if="$page.props.auth.role == 'Hotel'">{{ (order.total/100)*0.2 }} €
                        </td>
                        <td style="font-size: 15px;" v-if="$page.props.auth.role == 'Admin'">{{ order.total/100 }} €</td>
                        <td style="font-size: 15px;">{{ moment(order.created_at).format('DD/MM/YYYY')}}</td>
                        <td style="font-size: 15px;"><Link class="text-info links-orders" :href="route('purchase.show', {order:order.id})">Ver compra</Link></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</Layout>
</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Layout from '@/Layouts/LayoutProfile.vue'   
    import Moment from 'moment'
    import DialogModal from '@/Components/DialogModal.vue'
    import Struct from '@/Pages/Dashboard/Component/Modal.vue'

    export default {
        components: {
            Head,
            Link,
            Layout,
            DialogModal,
            Struct
        },
        props: {
            orders: Object,
        },
        created(){
            this.moment=Moment;
        },
        data() {
            return {
                moment:null,
                random: 1,
                modal: false,
                order: null
            }
        },
        methods: {
            OpenModal(order){
                this.order = order;
                this.modal=true;
            },
            CloseModal(){
                this.modal=false;
            },
        }
    }
</script>