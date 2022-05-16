<template>
    {{ codificarTilde(string) }}
</template>

<script>
export default {
    props:{
        string:String
    },
    methods:{
        codificarTilde(n){
            n.indexOf('&Aacute;') != -1 ? n = n.replaceAll('&Aacute;', 'Á'):''
            n.indexOf('&aacute;') != -1 ? n = n.replaceAll('&aacute;', 'á'):''
            n.indexOf('&Eacute;') != -1 ? n = n.replaceAll('&Eacute;', 'É'):''
            n.indexOf('&eacute;') != -1 ? n = n.replaceAll('&eacute;', 'é'):''
            n.indexOf('&Iacute;') != -1 ? n = n.replaceAll('&Iacute;', 'Í'):''
            n.indexOf('&iacute;') != -1 ? n = n.replaceAll('&iacute;', 'í'):''
            n.indexOf('&Oacute;') != -1 ? n = n.replaceAll('&Oacute;', 'Ó'):''
            n.indexOf('&oacute;') != -1 ? n = n.replaceAll('&oacute;', 'ó'):''
            n.indexOf('&Uacute;') != -1 ? n = n.replaceAll('&Uacute;', 'Ú'):''
            n.indexOf('&uacute;') != -1 ? n = n.replaceAll('&uacute;', 'ú'):''
            n.indexOf('&Uuml;') != -1 ? n = n.replaceAll('&Uuml;', 'Ü'):''
            n.indexOf('&uuml;') != -1 ? n = n.replaceAll('&uuml;', 'ü'):''
            n.indexOf('&ntilde;') != -1 ? n = n.replaceAll('&ntilde;', 'ñ'):''
            return n;
        },
    }
}
</script>

<style>

</style>