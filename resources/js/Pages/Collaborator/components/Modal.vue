<template>
<div class="modal modal-notice fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
<!-- Change class .modal-sm to change the size of the modal -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-sales mx-auto px-2">
            <div class="modal-body p-0 relative">
                <slot></slot>
            </div>
        </div>
    </div>
</div>  
</template>

<script>
export default {
    props:{
        id:String
    }
}
</script>

<style>

</style>