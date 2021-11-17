<template>

	<Header />

	<slot></slot>

	<Footer />

</template>

<script>

import Header from '@/Layouts/Header.vue'
import Footer from '@/Layouts/Footer.vue'

export default {
    components: {
        Header,
        Footer,
	},
}

</script>
