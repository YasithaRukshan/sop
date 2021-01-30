@if (count($data)>0)
@foreach ($data as $item)
<tr >
    <td><strong>{{$item['first_name']}} {{$item['last_name']}}</strong></td>
    <td class="text-center">{!!$tc->countUsers(count($item->referrals))!!}</td>
    <td>{{ $tc->dayName($item['created_at'])}}</td>
    <td>
        {!!$tc->viewLink(($item))!!}
        
    </td>
</tr>
@endforeach
@endif
