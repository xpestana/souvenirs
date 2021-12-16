<template>
    <Head title="Actividades"/>
    <Layout>
    <Breadcrumb title="Actividades"/>
    <!-- Shop Page Start -->
    <div class="main-shop-page white-bg ptb-80">
        <div class="container">
            <!-- Row End -->
            <div class="row">
                <!-- Sidebar Shopping Option Start -->
                <div class="col-lg-3 col-md-4">
                    <div class="sidebar">
                        <form @submit.prevent="submit">
                        <!-- Price Filter Options Start -->
                        <div class="search-filter mb-30">
                            <h3 class="sidebar-title">Filtrar por precio</h3>
                            <div class="product-price mt-1 mb-4">
                                <h6 class="filter-heading  text-center text-md-left mb-5">Price</h6>
                                <Slider 
                                    v-model="form.price"
                                    :max="max"
                                />
                            </div>
                        </div>
                        <!-- Price Filter Options End -->

                        <!-- Sidebar Categorie Start -->
                        <div class="row">
                            <div align="center" class="col-md-12 mb-3">
                                <button type="submit" class="view-cart bg-info" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Filtrar</button>
                            </div> 
                        </div>
                    </form>
                    </div>
                </div>
                <!-- Sidebar Shopping Option End -->
                <!-- Product Categorie List Start -->
                <div class="col-lg-9 col-md-8">
                    <!-- Grid & List View Start -->
                    <div class="grid-list-top border-default universal-padding d-lg-flex justify-content-md-between align-items-center mb-30">
                        <div class="grid-list-view d-flex align-items-center  mb-sm-15">
                        </div>
                        <!-- Toolbar Short Area Start -->
                        <div class="main-toolbar-sorter clearfix">
                            <form @submit.prevent="submit">
                            <div class="toolbar-sorter d-md-flex align-items-center">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="submit"><i class="icon-search" aria-hidden="true"></i></button>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" aria-describedby="basic-addon1" v-model="form.search">
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- Toolbar Short Area End -->
                    </div>
                    <!-- Grid & List View End -->
                    <div class="shop-area mb-all-40">
                        <!-- Grid & List Main Area End -->
                        <div class="tab-content Products-area">
                            <div id="grid-view" class="tab-pane fade  show active">
                                <div class="row">
                                    <div v-for="product in products.data" :key="product.id" class="col-md-6 col-sm-6">
                                        <!-- Single Product Start -->
                                        <div class="single-aboss-product mb-3">
                                            <div class="pro-img">
                                                <Link :href="route('product.activities.show',{product : product.id})">
                                                    <div :style="'background:url(/storage/souvenirs/'+product.images[0].url+')'" class="img-prod"></div>
                                                </Link>
                                                <div class="pro-actions">
                                                    <Link class="quick-view" :href="route('product.activities.show',{product : product.id})"><i class="icon-zoom"></i></Link>
                                                </div>
                                            </div>
                                            <div class="pro-content">
                                                <h4><Link :href="route('product.activities.show',{product : product.id})">{{ product.title }}</Link></h4>
                                                <div class="col-12 mb-3">
                                                        <template v-if="product.activities.end">
                                                            De {{ moment(product.activities.init).format('DD/MM/YYYY') }} a {{ moment(product.activities.end).format('DD/MM/YYYY') }}
                                                        </template>
                                                        <template v-else>
                                                            El {{ moment(product.activities.init).format('DD/MM/YYYY')}}
                                                        </template>
                                                    </div>
                                                <div class="pro-price-cart">
                                                    
                                                    <div class="pro-home-price">
                                                        <span>
                                                            <template v-if="product.activities.priceN">
                                                                Adulto: {{ product.activities.priceA }} € / Niño: {{ product.activities.priceN }} €
                                                            </template>
                                                            <template v-else>
                                                                Precio: {{ product.activities.priceA }} €
                                                            </template>
                                                        </span>
                                                    </div>
                                                    <div class="pro-cart">
                                                        <a title="Añadir Al Carrito" href="#" hidden><i class="icon-cart"></i></a>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                </div>
                                <!-- Row End -->
                            </div>
                        </div>
                        <!-- Grid & List Main Area End -->
                    </div>
                    <!-- Shop Breadcrumb Area Start -->
                    <div class="shop-breadcrumb-area border-default mt-40">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-md-6 col-sm-7">
                                <paginator :paginator="products"/>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Breadcrumb Area End -->
                </div>
                <!-- product Categorie List End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Shop Page End -->
</Layout>
<QuickView /> <!--Sidebar-->
</template>

<script>

    import { Inertia } from '@inertiajs/inertia';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Layout from '@/Layouts/Layout.vue'        
    import QuickView from '@/Components/QuickView.vue';
    import Breadcrumb from '@/Layouts/Components/Breadcrumb.vue'     
    import Paginator from '@/Components/Paginator.vue'   
    import Moment from 'moment'
    import Slider from '@vueform/slider'

    export default {
        components: {
            Head,
            Link,
            Layout,
            QuickView,
            Breadcrumb,
            Slider,
            Paginator
        },
        props: {
            products: Object,
            max: Number,
            search: String,
        },
        created () {
            this.moment=Moment;
        },
        data(){
            return {
                moment:null,
                max: this.max,
                form: this.$inertia.form({
                    search: this.search,
                    price: [20,150],
                }),
            }
        },
        methods: {

            submit() {
                this.form.get(route('activities'),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'submit',
                    preserveScroll: true,
                    
                })
            },
        }
}

</script>
<style src="@vueform/slider/themes/default.css"></style>
<style scope>
    .img-prod{
        width: 100%;
        height: 250px;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
    }
</style>
