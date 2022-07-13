<template>
<!-- Modal Notification -->
    <div class="modal modal-notification fade" id="notify" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel"
        aria-hidden="true">
    <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-sales mx-auto px-2">
                <div class="modal-body p-0 relative">
                    <div>
                        <i class="fas fa-times text-muted absolute right-1 md:right-2 top-3 cursor-pointer" data-dismiss="modal" aria-label="Close"></i>
                    </div>
                    <div class="my-2.5 text-center">
                        <template v-if="status == 'success'">
                            <i class="far fa-check-circle text-orangec text-4xl"></i>
                        </template>
                        <template v-if="status == 'error'">
                            <i class="far fa-times-circle text-danger text-4xl"></i>    
                        </template>
                    </div>
                    <h2 class="text-base text-center font-bold">
                        {{message}}
                    </h2>
                    <div class="my-3.5 text-center">
                        <button class="btn rounded text-white px-3.5 py-1 text-xs"  
                                :class="{
                                    'bg-collaborator-orange':status!=='error',
                                    'btn-danger':status=='error'
                                }"
                                data-dismiss="modal" aria-label="Close"
                        >
                            Cerrar mensaje
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Notification  -->  
</template>
<script>  
export default {
  data() {
      return {
        message: this.$page.props.flash.message,
        code: this.$page.props.flash.code,
        status: this.$page.props.flash.status,
      }
  },
  mounted(){
    if(this.message){
        $('#notify').modal('show');
    }
  },

}
</script>
