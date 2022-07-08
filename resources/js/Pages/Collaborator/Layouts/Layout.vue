<template>
	<div class="wrapper flex" >
        <!-- Sidebar  -->
		<template v-if="this.$page.props.auth.role == 'Associate'">
			<SideBarAssociate/>
		</template>
		<template v-else>
        	<SideBar/>
		</template>
        <!-- Page Content  -->
        <div id="content" class="ml-auto">
			<div class="bg-collaborator row lg:hidden sidebarCollapse">
				<div class="col-1">
					<i class="fas fa-bars text-white p-3 cursor-pointe"></i>
				</div>
				<div class="col-10">
					<img class="w-24 mx-auto py-2" src="/vendor_asset/img/collaborator/logocompleto.svg" alt="">
				</div>
			</div>    
			<slot>
			</slot>
			<div id="layout-collaborator-dashboard"></div>
        </div>
		<Notify v-if="$page.props.flash.id" :key="$page.props.flash.id"/>
    </div>
</template>
<script>
import Notify from '@/Pages/Collaborator/Layouts/Notify.vue'
import SideBar from '@/Pages/Collaborator/Layouts/SideBar.vue'
import SideBarAssociate from '@/Pages/Associates/Layouts/SideBar.vue'
export default {
    components: {
        Notify,
		SideBar,
		SideBarAssociate
	},
	created(){
	}
}
</script>
<style scoped>
.wrapper{
	width: 98.86%;
}
#content {
    width:80%;
    transition: all 0.3s;
}
@media (max-width: 1024px) {
	#content {
		width:100%;
	}
}
@media (max-width: 767px) {
	.wrapper{
		width: 96%;
	}
}
</style>