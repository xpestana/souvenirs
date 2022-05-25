<template>
    <div id="main-inicio">
      <div id="carrosel">
        <Carousel :autoplay="6000" :wrap-around="true" :transition="600">
            <Slide :key="0">
              <div class="bg-image welcome" style="background:url(/vendor_asset/img/home/home1.png)">
              </div>
            </Slide>
            <Slide :key="1">
              <div class="bg-image welcome" style="background:url(/vendor_asset/img/home/home2.png)">
              </div>
            </Slide>
            <Slide :key="2">
              <div class="bg-image welcome" style="background:url(/vendor_asset/img/home/home3.png)">
              </div>
            </Slide>
            <!-- <Slide :key="0">
              <div class="bg-image welcome">
                  <img src="/vendor_asset/img/home/home1.png" alt="">
              </div>
            </Slide>
            <Slide :key="1">
              <div class="bg-image welcome">
                <img src="/vendor_asset/img/home/home2.png" alt="">
              </div>
            </Slide>
            <Slide :key="2">
              <div class="bg-image welcome">
              <img src="/vendor_asset/img/home/home3.png" alt=""></div>
            </Slide> -->
            <template #addons>
              <Navigation />
            </template>
        </Carousel>
      </div>
      <section id="categorias">
        <div class="container">
          <div class="row my-2 my-md-5 px-md-5">
            <div class="col-12 d-inline-flex justify-center px-1 px-md-5">
              <div class="mx-2 categoria-img text-center position-relative" style="background:url(/vendor_asset/img/home/s2home1.png);" @click="actividades">
                <p class="bg-light px-1 mx-1 mx-md-5 position-absolute mb-0 fixed-bottom mb-2" style="z-index:60">Activities</p>
              </div>
              <div class="mx-2 categoria-img text-center position-relative" style="background:url(/vendor_asset/img/home/s2home2.png);" @click="souvenirs">
                <p class="bg-light px-1 mx-1 mx-md-5 position-absolute mb-0 fixed-bottom mb-2" style="z-index:60">Souvenirs</p>
              </div>
              <div class="mx-2 categoria-img text-center position-relative" style="background:url(/vendor_asset/img/home/s2home3.png);">
                <p class="bg-light px-1 mx-1 mx-md-5 position-absolute mb-0 fixed-bottom mb-2" style="z-index:60">Gastronomy</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="actividades">
        <div class="container">
          <div class="row mt-3 mb-2 my-md-5 px-md-5">
            <div class="col-12 text-left px-md-5">
              <h2 class="h2 font-weight-bolder"> Get to know Seville with HiCitty</h2>
            </div>
            <div class="col-12 px-md-5">
              <Carousel :settings="settings" :breakpoints="breakpoints" :wrap-around="true" :autoplay="5000">
                <Slide v-for=" product in actList" :key="product.id">
                  <div class="tarjeta bg-light h-36 w-40 md:h-60 md:w-60 mr-2 ml-0.5 my-2">
                    <div class="tarjeta-img d-block">
                      <Link :href="route('product.activities.show',{product : product.id})">
                          <template v-if="product.images.length !== 0">
                              <img :src="product.images[0].name" class="w-100">
                          </template>
                          <template v-else>
                              <img src="/vendor_asset/img/bg-image/act-default.jpg" class="w-100">
                          </template>
                      </Link>
                    </div>
                    <div class="tarjeta-cuerpo py-2 px-1 d-flex flex-column">
                        <div class="mb-auto h-6 md:h-16 overflow-hidden">
                          <Link :href="route('product.activities.show',{product : product.id})" >
                            <p class="font-weight-bolder text-center mb-1 text-wrap px-1">{{ product.title }}</p>
                          </Link>
                        </div>
                        <div class="">
                          <p class="text-left"><i class="far fa-clock"></i> <ConvertirMinutos :minutos="product.duration" /> </p>
                          <h3 class="font-weight-bolder d-block text-left mt-2">
                              <template v-if="product.precios.lenght !== null">
                                <template v-if="product.precios[2]">
                                    Desde: {{product.precios[2]}}€
                                </template>
                                <template v-else-if="product.precios[1]">
                                    Desde: {{product.precios[1]}}€
                                </template>
                                <template v-else-if="product.precios[0]">
                                    Desde {{product.precios[0]}}€
                                </template>
                              </template>
                          </h3>
                        </div>
                    </div>
                  </div>
                </Slide>
              </Carousel>
            </div>
            <div class="col-12 px-md-5 mt-2">
              <Link :href="route('activities')" class="text-azulc">See all activities</Link>
            </div>
          </div>
        </div>
      </section>
      <section id="souvenirs">
        <div class="container mb-5">
          <div class="row my-md-5 px-md-5">
            <div class="col-12 text-left px-md-5">
              <h2 class="h2 font-weight-bolder"> ¡Take the best memory of Seville!</h2>
              <hr>
            </div>
            <div class="col-12 images">
              <div class="row px-2 px-md-5">
                  <div class="col-4 col-md-2 mt-3 px-2 px" v-for=" product in $page.props.souvenirs" :key="product.id">
                    <Link :href="route('product.souvenir.show',{product : product.id})">
                    <div class="rounded image text-center position-relative w-100" :style="'background:url(/storage/souvenirs/'+product.images[0].url+')'">
                      <p class="bg-light position-absolute fixed-bottom text-right py-2 px-1 font-weight-bolder text-muted" style="opacity:0.6;z-index:37"><Decimals :precio="product.price"/>€</p>
                    </div>
                    </Link>
                  </div>
              </div>
            </div>
            <div class="col-12 px-md-5 mt-2">
              <Link :href="route('souvenirs')" class="text-azulc">See all souvenirs</Link>
            </div>
          </div>
        </div>
      </section>
      <section id="hicitty"></section>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';
    import { Carousel, Pagination, Slide,Navigation } from 'vue3-carousel';
    import Header from '@/Layouts/Components/Header';
    import 'vue3-carousel/dist/carousel.css';
    import Layout from '@/Layouts/Layout.vue'
    import Decimals from '@/Layouts/Components/Decimals.vue'
    import ConvertirMinutos from '@/Layouts/Components/ConvertirMinutos.vue'

    export default{
      layout:Layout,
        components: {
            Link,
            Carousel,
            Slide,
            Navigation,
            Header,
            Layout,
            Decimals,
            ConvertirMinutos
        },
        data: () => {
            return {
            settings: {
                itemsToShow: 2.2,
                snapAlign: 'start',
                },
            breakpoints: {
              900: {
                itemsToShow: 3.3,
                snapAlign: 'start',
                },
                },
            }
            
        },
        created(){
          console.log(this.$page.props.activities)
        },
        methods:{
          souvenirs(){
              this.$inertia.get(route('souvenirs'),{}, {
                    preserveScroll: true
                })
            },
            actividades(){
              this.$inertia.get(route('activities'),{}, {
                    preserveScroll: true
                })
            },
        },
        computed:{
          actList(){
            return this.$page.props.activities.map((el)=>{
              let precios = JSON.parse(el.activities.priceA);
              let arr = [];
              if(precios !== null){
                  for(let val in precios.prices_per_ticket){
                      arr.push(precios.prices_per_ticket[val])
                  }
              }else{
                let arr = null;
              }
              return {
                id:el.id,
                precios:arr,
                images:el.images,
                title:el.title,
                duration:el.activities.duration,
              }
            })
          }
        }
    }
</script>
<style scoped>
    .bg-image{
      background-size: cover !important;
      background-position:center !important;
      height: 45em;
    }
    #hicitty {
      background: linear-gradient(rgba(255,255,255,.5), rgba(255,255,255,.5)),url('/vendor_asset/img/hicity.png');
      background-position: bottom center;
      background-size: cover;
      background-repeat: no-repeat;
      padding: 135px 0;
      margin-bottom: -3em;
    }
    .h2{
      font-size:2em
    }
    #categorias .categoria-img{
      height: 12em;
      width: 100%;
      background-size: cover !important;
      background-position: center center;
      cursor:pointer;
    }
    #actividades .tarjeta{
      box-shadow: 0px 0px 4px 1px rgba(0 0 0 / 20%);
    }
    #actividades .tarjeta img{
      height: 8em;
    }
    #souvenirs .images .image{
      height: 6em;
      width: 100%;
      background-position: center center !important;
      background-size: cover !important;
      cursor:pointer;
    }
    @media (max-width: 850px){
      .bg-image{
        background-size: contain !important;
        background-position:center !important;
        background-repeat: no-repeat !important;
        height: 24em;
        margin-top:-64px;
        margin-bottom:-30px;
      }
        #carrosel .welcome img{
          background-position: center center;
          background-repeat: no-repeat;
          background-size: cover;
          height: 38vh;
        }
        #carrosel .welcome{
            min-width: 100%!important;
        }
        #hicitty {
          background-size: contain;
          padding: 3.5em 0;
          margin-bottom: -3em;
        }
    }
    @media (max-width: 530px){
      #carrosel{
          margin-top: -1em;
      }
      #carrosel .welcome img{
          height: 25vh;
        }
        .h2{
          font-size:1.1em
        }
        .carrosel{
            max-height: 240px;
        }
        #categorias .categoria-img{
          height: 7em;
          width: 100%;
          background-size: cover !important;
        }
        #carrosel .welcome{
            background-size: contain;
        }
        #actividades .tarjeta img{
          height: 4.5em;
        }
        #actividades .tarjeta-cuerpo p {
            font-size: 13px;
            line-height: 1.5;
        }
        
    }
    
</style>