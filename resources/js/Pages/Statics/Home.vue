<template>
  <Header/>
    <div id="main-inicio">
      <div id="carousel">
        <Carousel :autoplay="6000" :wrap-around="true" :transition="600">
            <Slide :key="0">
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
            </Slide>
        </Carousel>
      </div>
      <section id="categorias">
        <div class="container">
          <div class="row my-2 my-md-5 px-md-5">
            <div class="col-12 d-inline-flex justify-center px-1 px-md-5">
              <div class="mx-2 categoria-img text-center position-relative" style="background:url(/vendor_asset/img/home/s2home1.png);" @click="actividades">
                <p class="bg-light px-1 mx-1 mx-md-5 position-absolute mb-0 fixed-bottom mb-2" style="z-index:60">Actividades</p>
              </div>
              <div class="mx-2 categoria-img text-center position-relative" style="background:url(/vendor_asset/img/home/s2home2.png);" @click="souvenirs">
                <p class="bg-light px-1 mx-1 mx-md-5 position-absolute mb-0 fixed-bottom mb-2" style="z-index:60">Souvenirs</p>
              </div>
              <div class="mx-2 categoria-img text-center position-relative" style="background:url(/vendor_asset/img/home/s2home3.png);">
                <p class="bg-light px-1 mx-1 mx-md-5 position-absolute mb-0 fixed-bottom mb-2" style="z-index:60">Gastronomia</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="actividades">
        <div class="container">
          <div class="row mt-3 mb-2 my-md-5 px-md-5">
            <div class="col-12 text-left px-md-5">
              <h2 class="h2 font-weight-bolder"> Conoce Sevilla con HiCitty</h2>
            </div>
            <div class="col-12 px-md-5">
              <Carousel :settings="settings" :breakpoints="breakpoints" :wrap-around="true" :autoplay="12000">
                <Slide v-for=" product in $page.props.activities" :key="product.id">
                  <div class="tarjeta bg-light">
                    <div class="tarjeta-img d-block">
                      <Link :href="route('product.activities.show',{product : product.id})">
                          <template v-if="product.images.length != 0">
                              <img :src="'/storage/souvenirs/'+product.images[0].url" class="w-100">
                          </template>
                      </Link>
                    </div>
                    <div class="tarjeta-cuerpo py-2 px-1">
                        <Link :href="route('product.activities.show',{product : product.id})" >
                          <p class="font-weight-bolder text-center mb-2 text-wrap px-1">{{ product.title }}</p>
                        </Link>
                        <p class="text-left"><i class="far fa-clock"></i> Duración: 2horas</p>
                        <h3 class="font-weight-bolder d-block text-left">
                          <template v-if="product.activities.priceN">
                                Desde: {{ product.activities.priceN }} €
                            </template>
                            <template v-else>
                                Desde {{ product.activities.priceA }} €
                            </template>
                        </h3>
                    </div>
                  </div>
                </Slide>
              </Carousel>
            </div>
            <div class="col-12 px-md-5 mt-2">
              <Link :href="route('activities')" class="text-azulc">Ver todas las actividades</Link>
            </div>
          </div>
        </div>
      </section>
      <section id="souvenirs">
        <div class="container mb-5">
          <div class="row my-md-5 px-md-5">
            <div class="col-12 text-left px-md-5">
              <h2 class="h2 font-weight-bolder"> ¡Llevate el mejor recuerdo de Sevilla!</h2>
              <hr>
            </div>
            <div class="col-12 images">
              <div class="row px-2 px-md-5">
                  <div class="col-4 col-md-2 mt-3 px-2 px" v-for=" product in $page.props.souvenirs" :key="product.id">
                    <Link :href="route('product.souvenir.show',{product : product.id})">
                    <div class="rounded image text-center position-relative w-100" :style="'background:url(/storage/souvenirs/'+product.images[0].url+')'">
                      <p class="bg-light position-absolute fixed-bottom text-right py-2 px-1 font-weight-bolder text-muted" style="opacity:0.6;z-index:37">{{ product.price }}€</p>
                    </div>
                    </Link>
                  </div>
              </div>
            </div>
            <div class="col-12 px-md-5 mt-2">
              <Link :href="route('souvenirs')" class="text-azulc">Ver todos los souvenirs</Link>
            </div>
          </div>
        </div>
      </section>
      <section id="hicitty">

      </section>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';
    import { Carousel, Pagination, Slide } from 'vue3-carousel';
    import Header from '@/Layouts/Components/Header';
    import 'vue3-carousel/dist/carousel.css';

    export default{
        components: {
            Link,
            Carousel,
            Slide,
            Pagination,
            Header
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
          this.hiCitty()
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
            hiCitty(){
              
                // document.body.classList.add('city');
            }
        },
    }
</script>
<style scope>
    #hicitty {
      background: linear-gradient(rgba(255,255,255,.5), rgba(255,255,255,.5)),url('/vendor_asset/img/skyline.png');
      background-position: bottom center;
      background-size: cover;
      background-repeat: no-repeat;
      padding: 135px 0;
    }
    .h2{
      font-size:2em
    }
    #carousel .welcome img{
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        min-width: 100%!important;
        height: 40em;
    }
    #carousel .welcome{
        min-width: 100%!important;
    }
    #categorias .categoria-img{
      height: 12em;
      width: 100%;
      background-size: cover !important;
      background-position: center center;
      cursor:pointer;
    }
    #actividades .tarjeta{
      height: 19em;
      width: 19em;
      box-shadow: 0px 0px 4px 1px rgba(0 0 0 / 20%);
    }
    #actividades .tarjeta img{
      height: 10em;
    }
    #souvenirs .images .image{
      height: 8em;
      width: 100%;
      background-position: center center !important;
      background-size: cover !important;
      cursor:pointer;
    }
    @media (max-width: 800px){
        #carousel .welcome img{
          background-position: center center;
          background-repeat: no-repeat;
          background-size: cover;
          height: 38vh;
        }
        #carousel .welcome{
            min-width: 100%!important;
        }
        #actividades .tarjeta{
          height: 17em;
          width: 14em;
        }
        #hicitty {
          background-size: contain;
          padding: 5em 0;
        }
    }
    @media (max-width: 530px){
      #carousel .welcome img{
          height: 25vh;
        }
        .h2{
          font-size:1.1em
        }
        .carousel{
            max-height: 240px;
        }
        #categorias .categoria-img{
          height: 9em;
          width: 100%;
          background-size: cover !important;
        }
        #carousel .welcome{
            background-size: contain;
        }
        #actividades .tarjeta{
          height: 13em;
          width: 11em;
        }
        #actividades .tarjeta img{
          height: 5em;
        }
        #actividades .tarjeta-cuerpo p {
            font-size: 13px;
            line-height: 1.5;
        }
        
    }
    @media (max-width: 380px){
      #actividades .tarjeta{
          height: 13em;
          width: 8.8em;
        }
    }
</style>