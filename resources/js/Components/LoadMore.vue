<template>
  <div class="row justify-content-center mb-5">
      <div class="col-6 text-center">
          <Link href="#" class="btn btn-outline-primary rounded-pill px-4 py-1">Ver más</Link>
      </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components:{
        Link
        },
    props: {
        paginator: {
            current_page: Number,
            data: Array,
            first_page_url: String,
            from: Number,
            last_page: Number,
            last_page_url: String,
            links: Array,
            next_page_url: String,
            path: String,
            per_page: Number,
            prev_page_url: String,
            to: Number,
            total: Number,
        }
    },
    created(){
        console.log(this.paginator)
    }
}
</script>

<style>

</style>