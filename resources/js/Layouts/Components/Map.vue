<template>
	<div id="map"></div>
</template>
<script>
	export default {
		mounted() {

			this.initMap();
			
		},
		methods: {
			initMap() {
				var map = L.map('map', {
    					center: [51.505, -0.09],
    					zoom: 13
					});
				var marker = L.marker([51.5, -0.09]).addTo(map);
			},	
		}
	}
</script>
<style scope>
	#map { height: 350px !important; }
	.my-leaflet-map-container img {
    	max-height: none;
    	max-width: none;
	}
</style>