<template>

	<Header />

	<notify v-if="$page.props.flash" :key="$page.props.flash.id"/>
	
	<div id="main-viejo">
		<slot></slot>
	</div>

	<Footer />

</template>

<script>

import Header from '@/Layouts/Components/Header.vue'
import Footer from '@/Layouts/Components/Footer.vue'
import Notify from '@/Layouts/Components/Toast.vue'

export default {
    components: {
        Header,
        Footer,
        Notify,
	},
}

</script>
