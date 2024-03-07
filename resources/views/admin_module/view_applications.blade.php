<?php $title = "View Applications";
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

    <style>
        table {
            width: 90%;
            border-collapse: collapse;
            background-color: white;
            overflow: hidden;
            font-weight: bolder;
            margin: 10px auto;
        }

        table th {
            text-align: left;
        }

        table td {
            padding-top: 5px;
            padding:  0;
            align-items: left;
            border-bottom: 1.1px solid rgb(163, 8, 8);
        }

        table tbody td {
            padding-left: 0px;
        }

        table tbody tr:hover {
            /* background-color: #8c66534d; */
            color: rgb(163, 8, 8);
            /* border-radius: 50px; */
            transition: 0.2s;
        }

        table td img {
            width: 30px;
            height: 30px;
            object-fit: cover;
            border-radius: 100px;
        }

        table input {
            width: 80px;
            padding: 5px;
        }
    </style>

    <title>View Applications</title>
</head>

<body>
    @include("admin_module.sidebar");
    <div class="main-content">
        @include("admin_module.top_header");


        <table class="styled-table">
            <thead>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Course</th>
                <th>Year</th>
                <th>Address</th>
                <th>Message</th>
            </thead>
            <tbody>
                @foreach($data as $data)
                <tr class="active-row">
                    <td>{{$data->name}}</td>
                    <td>{{$data->number}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->course}}</td>
                    <td>{{$data->year}}</td>
                    <td>{{$data->address}}</td>
                    <td>{{$data->message}}</td>
                    <td>
                        <form action="{{ route('accept_app') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <input type="hidden" name="name" value="{{$data->name}}">
                            <input type="hidden" name="number" value="{{$data->number}}">
                            <input type="hidden" name="email" value="{{$data->email}}">
                            <input type="hidden" name="course" value="{{$data->course}}">
                            <input type="hidden" name="year" value="{{$data->year}}">
                            <input type="hidden" name="address" value="{{$data->address}}">
                            <button type="submit" name="accept" class="del pull-right"><i class="fa fa-check"></i></button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('decline_app') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <button type="submit" name="decline" class="del pull-right"><i class="fa fa-times"></i></button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>


</body>

</html>