<template>
	<!--<template v-if="order.returned == 1">
                                            <select name="returned" id="returned" @change="returned(order.id)">
                                                <option value="1" selected>Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </template>
                                        <template v-else>
                                            <select name="returned" id="returned" @change="returned(order.id)">
                                                <option value="1">Si</option>
                                                <option value="0" selected>No</option>
                                            </select>
                                        </template>-->
</template>
<script>
	export default {
    	layout:Layout,
    	props:{
        	order:Object,
    	},
		methods:{
	        returned(id){
    	        Inertia.post(route('admin.shipping.returned'), {
                id: id,
        	    })
        	},
    	},
    }
</script>