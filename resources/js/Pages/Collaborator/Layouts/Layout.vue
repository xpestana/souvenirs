<template>
	<div>
		<Header />
		<notify v-if="$page.props.flash" :key="$page.props.flash.id"/>
		<slot>
		</slot>
		
	</div>
</template>
<script>
	import Header from '@/Pages/Collaborator/Layouts/Header.vue'
	import Notify from '@/Layouts/Components/Toast.vue'

export default {
    components: {
        Header,
        Notify,
	},
}
</script>