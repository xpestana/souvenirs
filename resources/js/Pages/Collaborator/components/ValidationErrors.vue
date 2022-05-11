<template>
    <div v-if="hasErrors">
        <div class="font-medium text-danger">Whoops! Algo salió mal.</div>

        <ul class="mt-3 list-disc list-inside text-sm text-danger">
            <li v-for="(error, key) in errors.submit" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    computed: {
        errors() {
            return this.$page.props.errors
        },
        hasErrors() {
            return Object.keys(this.errors).length > 0
        },
    }
}
</script>