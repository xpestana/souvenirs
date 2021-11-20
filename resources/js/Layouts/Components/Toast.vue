<template></template>
<script>
  
export default {
  data() {
      return {
        message: this.$page.props.flash.message,
        code: this.$page.props.flash.code,
        status: this.$page.props.flash.status,
      }
  },
  created(){
      this.$toast.show(this.message, {
        type: this.status,
        position : "top-right",
        pauseOnHover: "true",
      });
  },

}
</script>