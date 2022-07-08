<template>
<!-- Modal Notification -->
    <div class="modal modal-notification fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
    <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-sales mx-auto px-2">
                <div class="modal-body p-0 relative">
                    <div>
                        <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3 cursor-pointer" data-dismiss="modal" aria-label="Close"></i>
                    </div>
                    <div class="my-2.5 text-center">
                        <slot name="header"></slot>
                    </div>
                    <h2 class="text-lg text-center font-bold">
                        <slot name="title"></slot>
                    </h2>
                    <p class="px-4 my-2 text-xs text-center">
                        <slot name="text"></slot>
                    </p>
                    <div class="my-3.5 text-center">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Notification  -->  
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