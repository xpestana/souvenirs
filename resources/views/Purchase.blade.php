<p>Please wait...</p>
<form  id="formPay" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" name="formPay">
        <input type="hidden" name="Ds_SignatureVersion" value="{{ $version }}"/>
        <input type="hidden" name="Ds_MerchantParameters" :value="{{ $params }}"/>
        <input type="hidden" name="Ds_Signature" :value="{{ $signature }}"/>
        <input type="submit" value="Realizar Pago" hidden />
</form>
<script>
        document.getElementById("formPay").submit();
        
</script>