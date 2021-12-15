<template>
<Layout>
<div class="tab-content dashboard-content mt-all-40">
	<div id="orders" class="tab-pane fade show active">
        <h3>Mi codigo qr</h3>

        <div class="row mt-4 justify-content-center">
            <div align="center" class="col-md-6">
                <QRCodeVue3
                    :width="200"
                    :height="200"
                    imgclass="souvenirs_img"
                    :value="url+'?h='+client.id"
                    :qrOptions="{ typeNumber: 0, mode: 'Byte', errorCorrectionLevel: 'H' }"
                    :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
                    :dotsOptions="{
                        type: 'square',
                        color: '#31516B',
                        gradient: {
                            type: 'linear',
                            rotation: 0,
                            colorStops: [
                                { offset: 0, color: '#31516B' },
                                { offset: 1, color: '#31516B' },
                            ],
                        },
                    }"
                    fileExt="jpeg"
                    :backgroundOptions="{ color: '#ffffff' }"
                    :cornersSquareOptions="{ type: 'dot', color: '#6cb2eb' }"
                    :cornersDotOptions="{ type: undefined, color: '#6cb2eb' }"
                    :download="false"
                    downloadButton="view-cart bg-info mt-3 souvenirs_btn"
                    :downloadOptions="{ name: 'souvenirs', extension: 'jpeg' }"
                    crossOrigin="anonymous"
                />
                <a class="view-cart bg-info mt-3" href="javascript:void(0)" @click="souvenirs_btn">Descargar</a>
            </div>
        </div>
    </div>
</div>
</Layout>
</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Layout from '@/Layouts/LayoutProfile.vue' 
    import QRCodeVue3 from "qrcode-vue3";
        
    export default {
        components: {
            Head,
            Link,
            Layout,
            QRCodeVue3
        },
        props: {
            url: String,
            client: String,
        },
        data(){
            return {
                options: ''
            }
      },
      methods: {
            souvenirs_btn(){
                var urlItem = $('.souvenirs_img').attr('src');
                axios({
                        url: urlItem,
                        method: 'GET',
                        responseType: 'blob'
                  })
                        .then((response) => {
                              const url = window.URL
                                    .createObjectURL(new Blob([response.data]));
                              const link = document.createElement('a');
                              link.href = url;
                              link.setAttribute('download', 'souvenirs.jpg');
                              document.body.appendChild(link);
                              link.click();
                              document.body.removeChild(link);
                        })                
            },
            activities_btn(){
                var urlItem = $('.activities_img').attr('src');
                axios({
                        url: urlItem,
                        method: 'GET',
                        responseType: 'blob'
                  })
                        .then((response) => {
                              const url = window.URL
                                    .createObjectURL(new Blob([response.data]));
                              const link = document.createElement('a');
                              link.href = url;
                              link.setAttribute('download', 'activities.jpg');
                              document.body.appendChild(link);
                              link.click();
                              document.body.removeChild(link);
                        }) 
            }
        }
    }
</script>