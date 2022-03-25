<template>
	
</template>
<script>
	export default {
		props: {
			collaborator: Object
		},
		created(){
			console.log("perfil", this.collaborator.profile);
			console.log("alojamientos", this.collaborator.hotel);
			console.log("ventas por hotel", this.collaborator.hotel.orders.length);
			console.log("Beneficio total es la suma de los totales, quizas sacandole el porcentaje, es algo que hay que preguntarle a los clientes");
		}
	}
</script>