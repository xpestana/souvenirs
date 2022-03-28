<template>
	<form @submit.prevent="submit">
		<input type="text" name="search" v-model="form.search">
		<button class="btn btn-primary rounded-pill py-0 px-3 mt-3">Buscar</button>
	</form>
</template>
<script>
import Paginator from '@/Components/Paginator.vue'
import { Link } from '@inertiajs/inertia-vue3'
export default {
	components: {
		Paginator,
		Link
	},
	props: {
		admins: Object
	},
	created(){
		console.log("usuarios administradores: ",this.admins.data);
		//console.log("datos de perfil administradores: ",this.admins.data[0].profile);
	},
	data(){
		return{
			form: this.$inertia.form({
				search: null,
			})
		}
	},
	methods: {
        submit() {
            this.form.get(this.route('admin.administradores'), {
                preserveScroll: true,
            });
        }
    }
	
}
</script>