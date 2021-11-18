<template>

	<Header />

	<slot></slot>

	<Footer />

</template>

<script>

import Header from '@/Layouts/Components/Header.vue'
import Footer from '@/Layouts/Components/Footer.vue'

export default {
    components: {
        Header,
        Footer,
	},
}

</script>
