@component('mail::message')
Hi, {{ $save->username }} . Please new account Password set
<p> It happens, Click the link below..</p>
    @component('mail::button', ['url' => url('password/reset', $save->email_token)])
        Set Your Password
    @endcomponent
    Thank you
@endcomponent