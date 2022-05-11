<template>
    <a href="javascript:void(0);" @click="back" class="mb-3"><h6><i class="fas fa-chevron-left"></i> Atrás</h6></a>
</template>
<script>
export default {
    methods: {
        back() {
            window.history.back();
        },
    }
}
</script>