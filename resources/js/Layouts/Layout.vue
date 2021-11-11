<template>

	<Menu />

	<slot></slot>

</template>


<script>

import Menu from '@/Layouts/Menu.vue'

import '/vendor_asset/jquery.countdown.min.js'
import '/vendor_asset/jquery.meanmenu.min.js'
import '/vendor_asset/jquery.scrollUp.js'
import '/vendor_asset/jquery.fancybox.min.js'
import '/vendor_asset/jquery.nice-select.min.js'
import '/vendor_asset/jquery-ui.min.js'
import '/vendor_asset/owl.carousel.min.js'
import '/vendor_asset/popper.min.js'
import '/vendor_asset/plugins.js'
import '/vendor_asset/main.js'

export default {
    components: {
        Menu,
	},
}

</script>
