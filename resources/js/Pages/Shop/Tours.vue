<template>
    <Head title="Activities"/>
    <Layout>
    <Breadcrumb title="Activities"/>
    <ModalCookies/>
    <!-- Shop Page Start -->
    <div class="main-shop-activies py-3">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h5 class="text-muted md:text-lg">{{count}} excursions and activities in Seville</h5>  
                </div>  
            </div>
        </div>

        <div class="container px-4">
            <div class="row shadow-md activity-card my-3 h-28 md:h-32" v-for="product in actList" :key="product.id">
                <div class="col-4 col-md-2 px-0 p-2">
                    <template v-if="product.images.length > 0">
                        <Link :href="route('product.activities.show',{product : product.id})">
                            <img :src="'/storage/souvenirs/'+product.images[0].name" :onerror="product.images[0].name" alt="Actividad" class="h-24 md:h-28 w-100">
                        </Link>
                    </template>
                    <template v-else>
                        <Link :href="route('product.activities.show',{product : product.id})">
                            <template v-if="product.short_id !== null">
                                <img src="/vendor_asset/img/bg-image/act-default.jpg" alt="Actividad" class="h-24 md:h-28 w-100">    
                            </template>
                        </Link>
                    </template>
                </div>
                <div class="col-8 col-md-10 d-flex flex-column justify-between px-0 py-1 pr-1">
                    <div class="header-card-act">
                        <div class="title">
                            <Link :href="route('product.activities.show',{product : product.id})">
                                <p class="font-weight-bolder text-azulc md:text-2xl fuente">{{ truncateTitle(product.title) }}</p>
                            </Link>
                        </div>
                    </div>
                    <!-- <div class="views">
                        <p class="text-azulc d-inline text-base md:text-xl">9,1/10</p>
                        <p class="ml-2 text-grayc d-inline md:text-base">120 opiniones</p>
                    </div> -->
                    <div class="footer-card-act d-flex flex-row justify-between align-items-end">
                        <div class="time">
                            <i class="far fa-hourglass mr-1 text-grayc md:text-base"></i>
                            <p class="text-grayc d-inline md:text-base" v-if="product.duration"><ConvertirMinutos :minutos="product.duration" /></p>
                        </div>
                        <div class="lenguage">
                            <i class="far fa-comment-alt mr-2 text-grayc md:text-base"></i>
                            <p class="text-grayc d-inline md:text-base">{{ product.language }}</p>
                        </div>
                        <div class="price">
                            <p class="font-weight-bolder text-azulc md:text-2xl pr-md-2">
                                <template v-if="product.precios.lenght !== 0">
                                    <template v-if="product.precios[0] !== undefined && product.precios[0] !== null">
                                        <Decimals :precio="product.precios[0]"/>€
                                    </template>
                                    <template v-if="product.precios[1] !== undefined && product.precios[1] !== null && product.precios[0] == undefined">
                                        <Decimals :precio="product.precios[1]"/>€
                                    </template>
                                    <template v-else-if="product.precios[2] !== undefined && product.precios[2] !== null && product.precios[1] == undefined">
                                        <Decimals :precio="product.precios[2]"/>€
                                    </template>
                                    <template v-else-if="product.precios[3] !== undefined && product.precios[3] !== null && product.precios[2] == undefined">
                                        <Decimals :precio="product.precios[3]"/>€
                                    </template>
                                </template>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div v-if="show.show != 1" class="col-12">
                    <div class="row justify-content-center mb-5">
                        <div class="col-6 text-center">
                            <a href="javascript:void(0)" class="btn btn-outline-primary rounded-pill px-4 py-1" @click="load_more()">See more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Page End -->
</Layout>
</template>

<script>

    import { Inertia } from '@inertiajs/inertia';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Layout from '@/Layouts/Layout.vue'        
    import Breadcrumb from '@/Layouts/Components/Breadcrumb.vue'     
    import Moment from 'moment'
    import Slider from '@vueform/slider'
    import Decimals from '@/Layouts/Components/Decimals.vue'
    import ConvertirMinutos from '@/Layouts/Components/ConvertirMinutos.vue'
    import ModalCookies from '@/Pages/Collaborator/components/ModalCookies'
    export default {
        components: {
            Head,
            Link,
            Layout,
            Breadcrumb,
            Slider,
            Decimals,
            ConvertirMinutos,
            ModalCookies
        },
        props: {
            products: Object,
            max: Number,
            min_r:Number,
            max_r:Number,
            search: String,
            count: Number,
            showr: Number,
        },
        created () {
            this.moment=Moment;
            console.log(this.products)
        },
        data(){
            return {
                data: (this.products.data) ? this.products.data : this.products,
                moment:null,
                max: this.max,
                form: this.$inertia.form({
                    search: this.search,
                    price: [this.min_r,this.max_r],
                }),
                show: this.$inertia.form({
                    show: this.showr,
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
            cart(id){
                this.$inertia.post(route('cart.activity',{checkout: id}),{
                    preserveScroll: true
                })
            },
            load_more(){
                this.show.show = 1;
                this.show.get(route('activities'),{
                    _token: this.$page.props.csrf_token,
                    errorBag: 'submit',
                    preserveScroll: true,
                    
                })
            },
            truncateTitle(title){
                title.length > 65 ? title = title.slice(0,65 - Number(title.length))+'...'  : ''
                return title;
            },
        },
         computed:{
          actList(){
            return this.data.map((el)=>{
              let precios = JSON.parse(el.activities.price_en);
              let arr = [];
              if(precios !== null){
                  for(let val in precios.prices_per_ticket){
                      if(precios.prices_per_ticket[val] !== null){
                        arr.push(Number(precios.prices_per_ticket[val]))
                      }
                  }
              }else{
                let arr = null;
              }
              return {
                id:el.id,
                precios:arr,
                language:el.activities.language,
                images:el.images,
                title:el.title_en,
                duration:el.activities.duration,
              }
            })
          }
        }
}

</script>
<style src="@vueform/slider/themes/default.css"></style>
<style scope>
    .activity-card{
        background-color: #ededed;
    }
    .fuente{
        font-family: Montserrat Bold !important;
    }
</style>
