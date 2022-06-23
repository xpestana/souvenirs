<template>
	<div
        v-if="close"
        class="validator-alert pt-4 pb-4 px-4 w-250"
    >
        <div class="row">
            <div class="col-10">
                <p class="text-xl orange font-bold">The following changes are required</p>
            </div>
            <div class="col-2">
                <button
                    class="btn text-xl"
                    type="button"
                    @click.prevent="closeAlertValidation()"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
         <ul class="mt-4 ml-2 list-disc list-inside text-xl">
            <li
                v-for="(error, key) in errors"
                :key="key"
                class="mb-1"
            >
                {{ error }}
            </li>
        </ul>
    </div>
</template>

<script>
	import { Link } from '@inertiajs/inertia-vue3';
	export default {
		components:{
	        Link
	    },
	    props: {
	    	errors: {
	    		type: Object,
	    		default: () => ([]),
	    	},
	    },
	    data () {
	    	return {
	    		close: false,
	    	}
	    },
	    computed: {
	        hasErrors() {
	            return this.errors.length > 0
	        },
	    }, 
        watch: {
            hasErrors (val) {
                console.log(val,'valudate')
                this.close = val ? true : false
            },
        },
	    methods: {
	    	closeAlertValidation () {
	            this.close = false
	        },
	    },
	}
</script>

<style lang="scss">
	.validator-alert{
        border-radius: 6px;
        box-shadow: 7px 7px 15px 0 rgba(0, 0, 0, 0.25);
        background-color: #fff;
        position: absolute;
        top: 0;
        right: 0;
        z-index: 999;
    }
    .orange {
        color: #ff9c06;
    }
</style>