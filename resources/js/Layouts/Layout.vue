<template>

	<Menu />

	<slot></slot>

</template>

<script>

import Menu from '@/Layouts/Menu.vue'

export default {
    components: {
        Menu,
	},
}

</script>
