<template>
    {{ codificarMinutos(minutos) }}
</template>

<script>
export default {
    props:{
        minutos:String
    },
    methods:{
        codificarMinutos(minutos){
            minutos= parseInt(minutos);
            let horas=Math.floor(minutos/60)
            let min = minutos % 60
            horas == 0 ? horas='' : horas=horas+'h ';
            min == 0 ? min='' : min=min+'min';
            return horas+min
        }
    }
}
</script>

<style>

</style>