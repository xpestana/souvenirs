<template>
    <Layout>
    	<div class="tab-content mt-all-40">
   			<div id="hotels" class="tab-pane fade show active">
   				<div class="register-contact  clearfix">
                    <form @submit.prevent="submit">
                        <div class="address-wrapper row">
                            <div class="col-md-12 mb-4">
                                <h5>Datos del souvenir</h5>
                            </div>
                            <div class="col-md-12 mb-4">
                                <BreezeLabel for="title" value="Titulo" />
                                <BreezeInput id="title" type="title" class="form-control mt-1 block w-full" v-model="form.title" autocomplete="title" placeholder="Titulo" />
                            </div>
                            <div class="col-md-4">
                                <BreezeLabel for="precio" value="Precio" />
                                <BreezeInput id="precio" type="number" class="form-control mt-1 block w-full" v-model="form.precio" autocomplete="precio" step="any" placeholder="Precio" />
                            </div>
                            <div class="col-md-4">
                                <BreezeLabel for="stock" value="Stock" />
                                <BreezeInput id="stock" type="number" class="form-control mt-1 block w-full" v-model="form.stock" autocomplete="stock" step="any" placeholder="Stock" />
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Destacado</label>
                                <div class="col-lg-6 col-md-8">
                                    <span class="custom-radio">
                                        <input name="featured" v-model="form.featured" value="1" type="radio"> Sí
                                    </span> 
                                    <span class="custom-radio pl-1">
                                        <input name="featured" v-model="form.featured" value="0" type="radio"> No
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="col-form-label">Descripción del producto</label>
                                <textarea class="form-control mt-1 block w-full"></textarea>
                            </div>
                        </div>
                    </form>
   				</div>
   			</div>
   		</div>
    </Layout>
</template>
<script>

	import Layout from '@/Layouts/LayoutProfile.vue'  
	import BreezeButton from '@/Components/Button.vue'
	import BreezeInput from '@/Components/Input.vue'
	import BreezeLabel from '@/Components/Label.vue'
	import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
	import { Head, Link } from '@inertiajs/inertia-vue3'

	export default {
    	components: {
        	BreezeButton,
        	BreezeInput,
        	BreezeLabel,
        	BreezeValidationErrors,
        	Head,
        	Link,
        	Layout,
	   	},
	   	data() {
        	return {
        		showF: 0,
            	form: this.$inertia.form({
                	title: null,
                	precio: null,
                    stock: null,
                    featured: 0,
            	})
        	}
    	},
    	methods: {
        	submit() {
            	this.form.post(route('souvenirs.store'),{
                	_token: this.$page.props.csrf_token,
                	errorBag: 'submit',
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: (result) => {
                        if(this.$page.props.flash.code == 200){
                            this.form.reset();
                            this.eraseFeatured();
                        };
                    }
                	
            	})
        	},
        	selectFeatured(){
                this.$refs.featured.click()
            },
            onFeaturedChange(){
                var filename = $('#featured').val().split('\\').pop();
                $('#fileFeatured').html(filename);
                this.showF=1
            },
            eraseFeatured(){
                this.form.reset('featured');
                $('#fileFeatured').html('');
                this.showF=0;
            },
    	}
	}
</script>