<template>
    <div class="pantalla">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-2 p-0" id="sidebar">
                    <SideBar/>
                    <MenuMobile/>
                </div>
                <div class="col-12 col-md-10 pt-100 p-md-2" id="contenido">
                    <notify v-if="$page.props.flash" :key="$page.props.flash.id"/>
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SideBar from '@/Pages/Admin/Layouts/SideBar'
import MenuMobile from '@/Pages/Admin/Layouts/MenuMobile'
import Notify from '@/Layouts/Components/Toast.vue'
export default {
    components:{
        SideBar,
        MenuMobile,
        Notify
    },
}
</script>

<style scoped>
#contenido{
    overflow-wrap: break-word;
}
@media (min-width: 768px){
    #contenido{
        flex: 0 0 83.33333333%;
        max-width: 82.8%;
    }
}

</style>