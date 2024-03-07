<?php $title = "Change Password";
$link = '#';
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

    <title>Change Password</title>
</head>

<body>
    @include("Lecturer_Student_Module.Student.sidebar_main");
    <div class="main-content">
        @include("Lecturer_Student_Module.Student.top_header");

        <div class="formB">
            <form method="post" action="{{ route('update-password') }}" class="formA">
                @csrf
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @elseif (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif

                <label for="oldPasswordInput">Old Password</label>
                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror input" id="oldPasswordInput" >
                @error('old_password')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <label for="newPasswordInput">New Password</label>
                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror input" id="newPasswordInput" >
                @error('new_password')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <label for="confirmNewPasswordInput">Confirm New Password</label>
                <input name="new_password_confirmation" type="password" class="form-control input" id="confirmNewPasswordInput" >
               

                <button type="submit" id="create-btn" name="submit">CHANGE</button>

            </form>
        </div>


</body>

</html>