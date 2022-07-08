
<template>
    <!-- Modal Request -->
    <div class="modal modal-create fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabelCreate"
    aria-hidden="true">
    <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content modal-create-lodging modal mx-auto px-2">
                <div class="modal-body p-0">
                    <h2 class="text-lg md:text-xl text-center mt-3.5 font-bold">¿Que tipo de inmueble vas a registrar?</h2>
                    <div class="row justify-content-center my-3">
                        <div class="col-12 col-md-3 md:mr-1">
                            <div
                                class="border-collaborator text-center p-1 text-center cursor-pointer"
                                @click.prevent="saveType('hotel')"
                            >
                                <img class="block w-12" style=""
                                    src="/vendor_asset/img/collaborator/dashboard/icons/lodging/HotelAzul.svg"
                                >
                                <span class="inline-block mt-1 text-xs text-collaborator">Hotel</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 md:mr-1">
                            <div
                                class=" border-collaborator text-center p-1 text-center cursor-pointer"
                                @click.prevent="saveType('apartamento')"
                            >
                                <img class="block w-12" style=""
                                    src="/vendor_asset/img/collaborator/dashboard/icons/lodging/ApartamentoAzul.svg"
                                >
                                <span class="inline-block mt-1 text-xs text-collaborator">Apartamento</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div
                                class="border-collaborator p-1 text-center cursor-pointer"
                                @click.prevent="saveType('complejo')"
                            >
                                <img class="block w-12" style=""
                                    src="/vendor_asset/img/collaborator/dashboard/icons/lodging/ComplejoTurAzul.svg"
                                >
                                <span class="inline-block mt-1 text-xs text-collaborator">Complejo turístico</span>
                            </div>
                        </div>
                    </div>
                    <div class="my-2.5 flex justify-content-between">
                        <button class="btn px-3.5 py-1 text-xs font-bold" data-dismiss="modal"  aria-label="Close"><i class="fas fa-reply"></i>
                            Volver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Request  -->
</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
    import TemplateApp from '@/Pages/Collaborator/Layouts/Layout.vue'
    export default {
        layout:TemplateApp,
        components:{
            Head,
            Link,
        },
        props: ['form'],
        data () {
        },
        computed: {
            formComputed: {
                get () {
                    return this.form
                },
                set () {
                    this.$emit('update:form', this.form)
                }
            }
        },
        mounted () {
            this.emitter.on('openModalCreateType', this.open)
        },
        methods: {
            openModal () {
                $('#create').modal('show')
            },
            saveType (value) {
                $('#create').modal('hide')
                this.formComputed.tipo = value
                this.$emit('clickOpenForm')
            },
            open () {
                console.log('open type dede form')
                $('#create').modal('show')
            },
        },
    }
</script>
<style lag="scss" scoped>
    .border-collaborator{
        border-color: #86bcd9;
        border-width: 6px;
        border-radius: 6px;
        width: 7rem;
        height: 7rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .text-collaborator{
        color: #86bcd9;
    }
    .modal-dialog{
        max-width: 40% !important;
    }
    @media (max-width:767px) {
        .modal-dialog{
            max-width: 90% !important;
        }
    }
</style>