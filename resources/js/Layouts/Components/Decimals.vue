<template>
    {{filtrarDecimales()}}
</template>

<script>
export default {
    props:{
        precio:Number
    },
    methods:{
        filtrarDecimales(){
            
            let index = this.precio.toLocaleString('de-DE').indexOf(",");
            if(index == "-1") return this.precio.toLocaleString('de-DE')+',00';
            let partes = this.precio.toLocaleString('de-DE').split(",");
            if(partes[1].length > 1) return this.precio.toLocaleString('de-DE')
            
            return partes[0]+','+partes[1]+'0';    
        }
    }
}
</script>

<style>

</style>