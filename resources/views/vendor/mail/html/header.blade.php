@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<div class="logo" alt="Laravel Logo">
    <span>ai</span>
    <p>-toolbox</p>
</div> 
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
