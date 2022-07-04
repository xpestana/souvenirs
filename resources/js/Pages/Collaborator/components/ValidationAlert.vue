<template>
	<div
        v-if="close"
        class="validator-alert pt-4 pb-4 px-4 w-250"
    >
        <div class="row">
            <div class="col-10">
                <p class="text-md orange font-bold">Los siguientes campos son obligatorios</p>
            </div>
            <div class="col-2 pt-0">
                <button
                    class="btn text-xl pt-0"
                    type="button"
                    @click.prevent="closeAlertValidation()"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
         <ul class="mt-1.5 ml-2 list-disc list-inside text-md">
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
        mounted () {
            this.emitter.on('errors',this.openAlertValidation)
        },
	    methods: {
            openAlertValidation () {
                this.close = true
            },
	    	closeAlertValidation () {
	            this.close = false
	        },
	    },
	}
</script>

<style lang="scss" scoped>
	.validator-alert{
        border-radius: 6px;
        box-shadow: 7px 7px 15px 0 rgba(0, 0, 0, 0.25);
        background-color: #fff;
        z-index: 999;
        position: absolute;
        right: 0;
        top: 0;
    }
    .orange {
        color: #ff9c06;
    }
</style>