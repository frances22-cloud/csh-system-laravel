<?php $title = "Register Staff";
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

    <title>Register Staff</title>
</head>

<body>
    @include("admin_module.sidebar");
    <div class="main-content">
        @include("admin_module.top_header");
        <div class="nav">
            <ul class="snip1168">
                <li class="current"><a href="#" data-hover="Register Staff">Register Staff</a></li>
                <li><a href="{{ route('staff_members') }}" data-hover="View Staff">View Staff</a></li>
            </ul>
        </div>

        <div class="formB">
            <form action="{{route('staffregister')}}" method="POST" class="formA">
                @csrf
                <label for="fname">Name</label>
                <input type="text" name="name" id="name" class="input">

                <label for="lname">Email</label>
                <input type="text" name="email" id="email" class="input">

                <label for="lname">Department</label>
                <input type="text" name="department" id="department" class="input">

                <input type="hidden" name="role" id="role" value="3" readonly>

                <label for="pname">Password</label>
                <input type="password" name="password" id="pname" class="input">



                <button class="button">Create Staff</button>

            </form>
        </div>

    </div>


</body>

</html>