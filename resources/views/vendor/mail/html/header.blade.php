<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img style="width:210px" src="{{ env('APP_URL') }}/vendor_asset/img/logo/hilogo.png" class="logo" alt="HiCitty Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>