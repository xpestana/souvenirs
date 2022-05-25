<template>
    <div class="container">
        <div class="cuerpo">
            <div class="titulo">
                <div class="row">
                    <div class="col-5 col-md-2">
                        <a :href="'/'">
                            <img src="/vendor_asset/img/logo/logopequeño.png">
                        </a>
                    </div>
                    <div class="col-7 col-md-10 pt-5">
                        <h1 class="pt-5 pb-2"><strong>LEGAL WARNING</strong></h1>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="parrafo">
                <div class="row">
                    <div class="col-12 text-justify">
                        <p>HiCitty, provided with NIF/CIF B16895708, address Av. De la Buhaira, 17, cannot assume
                        no responsibility derived from the incorrect, inappropriate or illegal use of the information
                        appeared on the website of www.hicitty.com </p><br>

                        <p>Within the limits established by law, HiCitty assumes no liability arising from
                        the lack of veracity, integrity, updating and precision of the data or information
                        that are contained in its Internet pages. </p><br>

                        <p>The contents and information do not bind HiCitty and do not constitute opinions, advice or
                        legal advice of any kind as it is merely a service offered on a
                        informative and informative.</p><br>
                        
                        <p>The website of www.hicitty.com may contain links (links) to other pages of
                        third parties that HiCitty cannot control. Therefore, HiCitty cannot assume responsibility
                        for the content that may appear on third-party pages. </p><br>
                        
                        <p>The texts, images, sounds, animations, software and other content included in this website
                        are the exclusive property of HiCitty or its licensors. Any act of transmission, distribution, assignment,
                        reproduction, storage or public communication in whole or in part, must have the express consent
                        of the company. </p><br>
                        
                        <p>Likewise, to access some of the services that HiCitty offers through the website, you must provide
                        some personal data. In compliance with the provisions of Regulation (EU) 2016/679 of the Parliament
                        European and Council, of April 27, 2016, on the protection of natural persons with regard to
                        treatment of personal data and the free circulation of these data we inform you that, by completing the
                        these forms, your personal data will be incorporated and will be treated in the HiCitty files with the
                        in order to be able to provide and offer our services as well as to inform you of improvements to the website. Likewise, he
                        We inform you of the possibility of exercising your rights of access, rectification, cancellation and opposition of your personal data.
                        personal character, free of charge by email to info@hicitty.</p><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { Link, Head } from '@inertiajs/inertia-vue3'
    export default {
        components: {
            Link,
            Head,
        },
    }
</script>
<style scoped>
.cuerpo .titulo h1{
    font-size: 1.5em;
}
.cuerpo .titulo img{
    height: 10em;
    width: 10em;
}
.cuerpo {
    background-color: #f3f3f3;
    padding: 20px;
    margin: 10px 0;
}
</style>