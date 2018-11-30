Hi!
<br/>
You are receiving this email because we received a password reset request from you. If you requested this, please click here to reset your password: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a><br/>
<br/>
If you did not request a password reset, you can ignore this email. Your password will not change and your account is safe.
<br/>
Thanks!
