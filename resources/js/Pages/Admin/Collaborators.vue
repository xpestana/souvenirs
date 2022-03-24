<template>
	soy admin opcion colaboradores (en la consola esta la descripcion de cada uno y dividir entre 100)
</template>
<script>

	export default {
		props: {
        collaborators: Object
        },
		created(){
        	console.log("colaboradores", this.collaborators.data);
        	console.log("Hoteles Registrados", this.collaborators.data[0].hotel.length);
        	console.log("Pedidos totales", this.collaborators.data[0].hotel[0].orders.length);
        	console.log("Ventas totales", "Sumar el campo total de la tabla orders de cada alojamiento");
        },
	}
</script>