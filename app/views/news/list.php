<h1>Danh sách tin tức</h1>
{{ $new_title }} <br>
{{$new_content}} <br>
{!$new_content!} <br>
{{ toSlug('hello') }}<br>

@if(!empty($new_title))
<p>Tiêu đề: {{$new_title}}</p>
@else
<p>Không có gì</p>
@endif

@php
$number = 1;
$number++;
@endphp

{{$number}} <br>
@for ($i = 1; $i <=10; $i++)
<p>{{$i}}</p>
@endfor
