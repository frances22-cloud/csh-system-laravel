<?php 
use Illuminate\Support\Facades\Auth;
?>
<h1>Staff Landing Page </h1>

<!-- possible way to implement the sessions -->

<h2> Welcome 
<?php 
echo Auth::user()->name;
?>
</h2>
<a href="{{ route('signout') }}">Sign Out</a>