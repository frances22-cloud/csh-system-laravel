<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/classes.css') }}">

    <title>My Classes</title>

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
            padding: 10px 0;
            align-items: center;
            border-bottom: 1.1px solid rgb(163, 8, 8);
        }

        table tbody td {
            padding-left: 10px;
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
</head>

<body>
    
    <div class="pic-area">
        <div class="top-menu">
            <a href="#">
                <h2>{{session('classes')}}</h2>
            </a>
            <!-- <i class="las la-bars" > -->
            <div class="credentials">
                <h3><?php echo Auth::user()->name; ?></h3>
            </div>
        </div>
    </div>
    <div class="box">
        <h2>Class</h2>
        <hr />
    </div>
    <table class="styled-table">
        <thead>
            <th>Venue</th>
            <th>Time</th>
            <td></td>
        </thead>
        <tbody>
            @foreach($data as $data)
            <tr class="active-row">
                <td>{{$data->venue}}</td>
                <td>{{$data->time}}</td>
                <td><a href="{{route('view_timetable',$data->timetable)}}"><button>View</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    </div>
    <a href="{{route('/view_timetable')}}"> <button class="btn" id="back_btn">BACK</button></a>

</body>
</html>