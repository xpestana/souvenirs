<template>
	<form @submit.prevent="updt_current" @change="updt_current">
		<select id="current" v-model="form.current">
			<option v-for="setting in settings" :key="setting.id" :value="setting.id">{{ setting.shippings }}</option>
		</select>
	</form>
	<br>
	<form @submit.prevent="submit">
		<label for="settings">Monto de envio</label>
		<input type="text" id="shippings" class="form-control mt-1 block w-full" v-model="form.shippings" autocomplete="settings" placeholder="Monto de envio">

        <button type="submit" class="btn btn-primary-c rounded-pill py-0 px-3 mt-3">Guardar</button>
	</form>
</template>
<script>
import Layout from '@/Pages/Admin/Layouts/Layout'
export default{
	layout:Layout,
	props: {
		settings: Object
	},
	created(){
		console.log(this.settings);
	},
	computed:{
            settings(){
            	const obj = this.settings.map((col)=>{
	         	if(col.active == 1){
	         		this.form.current = col.id;
	         	}
            	return {
                	id : col.id,
                	shippings: col.shippings,
                	active: col.active,
            	}
            });
            return obj;
        },

        },
	data() {
            return {
                form: this.$inertia.form({
                    shippings: null,
                    current: null,
                })
            }
        },
    methods: {
       submit() {
            var shippings = document.getElementById('shippings').value;
        this.form.shippings = shippings;
            this.form.post(route('settings.shippings.create'),{
                _token: this.$page.props.csrf_token,
                errorBag: 'submit',
                preserveScroll: true,
            })
        },
        updt_current() {
            var current = document.getElementById('current').value;
        this.form.current = current;
            this.form.post(route('settings.shippings.update', {id:current}),{
                _token: this.$page.props.csrf_token,
                errorBag: 'updt_current',
                preserveScroll: true,
            })
        },
    }
}
</script>