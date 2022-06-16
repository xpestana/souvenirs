<template>

	<Header />

	<notify v-if="$page.props.flash" :key="$page.props.flash.id"/>
	
	<div id="main-viejo">
		<slot></slot>
		<div class="">
			<a class="fixed bottom-4 md:bottom-16 right-0 z-50" target="_blank" href="https://api.whatsapp.com/send/?phone=34722193903">
			<img src="/vendor_asset/img/icons/wsicon.png" class="mx-1 mx-md-2 w-10 h-10 md:w-10 md:h-10">
			</a>
			<!-- <a class="fixed bottom-16 right-0 z-50" target="_blank" href="https://www.instagram.com/hicitty_/">
				<img src="/vendor_asset/img/icons/igicon.png" class="px-1 px-md-2 w-12 h-10 md:w-14 md:h-10">
			</a>
			<a class="fixed bottom-4 right-0 z-50" target="_blank" href="https://www.linkedin.com/company/kognos-vb/">
				<img src="/vendor_asset/img/icons/inicon.png" class="px-1 px-md-2 w-12 h-10 md:w-14 md:h-10">
			</a> -->
		</div>
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
