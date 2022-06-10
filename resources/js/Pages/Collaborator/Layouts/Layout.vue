<template>
	<div>
		<Header />
		<notify v-if="$page.props.flash" :key="$page.props.flash.id"/>
		<slot>
		</slot>
		<Footer />
	</div>
</template>
<script>
	import Header from '@/Pages/Collaborator/Layouts/Header.vue'
	import Notify from '@/Layouts/Components/Toast.vue'
	import Footer from '@/Layouts/Components/Footer.vue'

export default {
    components: {
        Header,
        Notify,
		Footer
	},
}
</script>