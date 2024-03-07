<?php $title = "Register Admin";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ URL::asset('css/results.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/sidebar_main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/top_header.css') }}">

    <title>Register Admin</title>
</head>

<body>
    @include("admin_module.sidebar");
    <div class="main-content">
        @include("admin_module.top_header");
        <div class="nav">
            <ul class="snip1168">
                <li class="current"><a href="#" data-hover="Register Admin">Register Admin</a></li>
                <li><a href="{{ route('view_admin') }}" data-hover="View Admins">View Admins</a></li>
            </ul>
        </div>

        <div class="formB">
        <form method="post" action="{{ route('create_admin') }}"class="formA">
                @csrf
                <label for="fname">First Name</label>                
                <input class="input" type="text" name="fname" id="fname" required>

                <label for="sname">Last Name</label>                
                <input class="input" type="text" name="sname" id="sname" required>            

                <label for="email">Email</label>                
                <input class="input" type="email" id="email" name="email" required>
                
                <label for="phone">Phone</label>                
                <input class="input" type="number" id="phone" name="phone" required>
                
                <label for="password">Password</label>                
                <input class="input" type="password" id="password" name="password" required>

                <button type="submit" id="create-btn" name="submit">REGISTER</button>

            </form>
        </div>


</body>

</html>