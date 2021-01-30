@if (count($data)>0)
@foreach ($data as $item)
<tr>
    <td><strong>{{$item['first_name']}} {{$item['last_name']}}</strong></td>
    @if ($item['level']==1)
    <td>{{$item['email']}}</td>
    @else
    <td>**********</td>
    @endif
    <td> <a href="{{ URL::route('referrals.logs',['fname'=>$item['first_name'],'lname'=>$item['last_name']]) }}"><strong>SOAX: {{ $item->wallet->static_amount}}</strong></a></td>
    {{-- <td> <a href="/referral-management/logs/?fname={{$item['first_name']}}&lname={{$item['last_name']}}">SOAX: {{ $item->wallet->static_amount}}</a></td> --}}





    <td class="text-center">{!!$tc->countUsers(count($item->referrals))!!}</td>
    <td> {{ $tc->getReferralsCommissions(Auth::user()->wallet->id,$item->wallet->id)}}</td>
    <td>{{ $tc->dayName($item['created_at'])}}</td>
    <td>
        {!!$tc->viewLink(($item))!!}

    </td>
</tr>
@endforeach
@endif
