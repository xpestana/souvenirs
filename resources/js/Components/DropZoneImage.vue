<template>
	<div
    	class=" rounded-xl bg-picker-img py-2.5 mt-4 mb-3 px-2 text-center text-muted cursor-pointer"
    	v-cloak
    	@drop.prevent="addFile"
    	@dragover.prevent
    >
    	<i class="fas fa-image inline-block text-white text-xl text-muted"></i>
    	<label class="text-center block font-bold text-muted mt-1">!No has subido una imagen todavía</label>
    	<p class="text-xs muted mt-1">Tamaño máximo  de la imagen 2MB</p>
    </div>
</template>