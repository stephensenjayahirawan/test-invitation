@extends('template.email')
@section('subject')
    {{$subject}}
@endsection

@section('content')
<table class="email-body_inner" align="center" width="570px" cellpadding="0" cellspacing="0">
    <!-- Body content -->
    <tr>
        <td class="content-cell">
            <h1 class="subject-title">{{$subject}}</h1>
            <h2>Hi, <span class="text-highlighted">{{$name}}</span> </h2>
            <p>
                You are invited to join us as {{$role}}. You can register by click the button below:
            </p>
           <br>
            <a href="{{ url('join-us/'.$invitation->token) }}" target="_blank"> Click here !</a> <br>
            <br>
            
            <p>Best Regards,<br>
                <span class="text-highlighted">Invitation Team</span>
            </p>
        </td>
    </tr>
</table>
@endsection
