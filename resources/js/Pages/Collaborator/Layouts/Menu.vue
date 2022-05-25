<template>
    <!-- Header Menu & Cart Area Start Here -->
    <div class="col-lg-8 d-none d-lg-block ml-auto">
        <div class="maain-menu-area maain-menu-area-three  position-relative">
            <!-- Primary Menu Start -->
            <div class="primary-menu">
                <nav>
                    <ul class="primary-menu-list d-flex justify-content-end pr-5">
                        <li><Link :href="route('collaborator.index')" :class="{ 'border-bottom border-dark': $page.url === '/tablero/alojamientos' }"><i class="fas fa-user iconNav"></i>
                            <template v-if="gestorDe == 1">
                                My hotels
                            </template>
                            <template v-else>
                                My lodgings
                            </template>
                         </Link></li>
                        <li><Link :href="route('collaborator.ajustes.index')" :class="{ 'border-bottom border-dark': $page.url === '/tablero/ajustes' }"><i class="fas fa-wrench iconNav"></i> Settings</Link></li>
                    </ul>
                    
                </nav>
            </div>
            <!-- Primary Menu End -->
        </div>
    </div>

</template>
<script>
    import { Link } from '@inertiajs/inertia-vue3';

    export default{
        components: {
            Link,
        },
        methods: {
            logout(){
                this.$inertia.post(route('logout'), {
                    _token: this.$page.props.csrf_token,
                })
            },
        },
        computed:{
            gestorDe(){
                if(this.$page.props.auth.user.profile == undefined){
                    return this.$page.props.auth.profile.gestor
                }
                return this.$page.props.auth.user.profile.gestor;
            }
        }
    }
</script>
<style scope>
    .lang{
        background-color: #000;
        color: #fff !important;
        border-radius: 100%;
        padding: 5px;
        font-size: 18px;
    }
    .iconNav{
        color: #6fb2c6;
        font-size: 21px !important;
        margin-right: 10px;
    }   
    #cart-area{
        width: 180px !important;
        padding: 10px !important;
    }
    .search-cart-area > ul > li:first-child{
        padding: 43px 0 0px 0px;
    }
    .search-cart-area > ul > li.search-mrg{
        padding: 43px 0 0px 20px;
    }
    .search-cart-area > ul > li{
        padding: 43px 0 0px 35px;
    }
    .search-cart-area > ul > li ul.currency-selector{
        width: 180px;
    }
    .primary-menu-list > li > a{
        line-height:  110px;
    }
    @media (max-width: 767px){
        .lg{
            display: none !important;
        }
        .icon-login{
            display: none !important;
        }
        .search-cart-area > ul > li > a > span{
            font-size: 11px;
            height: 16px;
            line-height: 17px;
            right: -16px;
            top: 3px;
            width: 17px;
        }
        .search-cart-area > ul > li > i.header-search{
            font-size: 28px;
        }
        .search-cart-area > ul > li > a i.header-cart{
            font-size: 28px;
        }
        .search-cart-area > ul > li{
            padding: 43px 0 0px 15px;
        }

    }
.search-cart-area > ul > li > a > span{
    top: -2px !important;
    right: -4px !important;
}
[class^="icon-"]:before, [class*=" icon-"]:before{
    font-size: 120% !important;
}
</style>