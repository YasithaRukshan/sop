<!-- Two Columns -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td class="pb-10" style="padding-bottom: 10px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <th class="column-top brr-15" width="320" bgcolor="#ffffff"
                                style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top; border-radius:15px;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td class="p-10" style="padding: 10px 10px 10px 10px;">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table width="100%" border="0" cellspacing="0"
                                                                    cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="p-20"
                                                                                style="padding: 20px 20px 20px 20px;">
                                                                                <table width="100%" border="0"
                                                                                    cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="text-24 pb-15"
                                                                                                style="color:#333333; font-family:'Playfair Display', Arial, sans-serif; font-size:24px; line-height:34px; text-align:left; font-weight:normal; min-width:auto !important; padding-bottom: 15px;">
                                                                                                <b>
                                                                                                    Hi
                                                                                                    {{$user['first_name'] }}
                                                                                                    {{$user['last_name'] }} ,
                                                                                                </b>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="text-16 pb-25"
                                                                                                style="color:#666666; font-family:Arial, sans-serif; font-size:16px; line-height:30px; text-align:left; min-width:auto !important; padding-bottom: 25px;">
                                                                                                @switch($status)
                                                                                                @case(4)
                                                                                                Thank you for your
                                                                                                payment
                                                                                                <br>
                                                                                                Payemenet Information
                                                                                                <br>
                                                                                                Payemenet Status
                                                                                                <b>Paid</b>
                                                                                                <br>
                                                                                                Payemenet Amount
                                                                                                <b>{{$transaction['amount']}}</b>
                                                                                                <br>

                                                                                                Your payment will
                                                                                                confirm withing
                                                                                                {{config('prices.hours_confirm')}}h.
                                                                                                <br>
                                                                                                @break
                                                                                                @case(5)
                                                                                                Your payment according
                                                                                                to Invoice Number
                                                                                                {{$transaction['id']}}
                                                                                                is
                                                                                                confirmed.
                                                                                                one more step to
                                                                                                complete.
                                                                                                <br>
                                                                                                @break
                                                                                                @case(2)
                                                                                                Your SOAX purchase is
                                                                                                confirmed By admin.
                                                                                                <br>
                                                                                                Payemenet Information
                                                                                                <br>
                                                                                                Payemenet Amount
                                                                                                <b>{{$transaction['amount']}}</b>
                                                                                                <br>
                                                                                                Requested Amount
                                                                                                <b>{{$transaction['rq_amount']}}</b>
                                                                                                <br>
                                                                                                @break

                                                                                                @endswitch

                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<!-- END Two Columns -->
