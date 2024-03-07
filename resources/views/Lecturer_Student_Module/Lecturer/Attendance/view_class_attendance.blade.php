<?php $title = "View Class Attendance";
$link = "{{route('Lec_Attendance_Select')}}";
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



    <title>View Class Attendance</title>
</head>

<body>
    @include("Lecturer_Student_Module.Lecturer.sidebar_main");
    <div class="main-content">
        @include("Lecturer_Student_Module.Lecturer.top_header");
        <div class="nav">
            <ul class="snip1168">
                <li><a href="{{route('update_attendance')}}" data-hover="Update Attendance">Update Attendance</a></li>
                <li class="current"><a href="#" data-hover="View Class Attendance">View Class Attendance</a>
                </li>
            </ul>
        </div>

        <div class="choose-exam">
            <div class="col-2">
                <h2 id="choosehead1">Choose Date</h2>
                <hr />
                <form method="post" action="{{ route('choose_view_date') }}" id="form1">
                    @csrf
                    <select class="input" id="date" name="date">
                        <option value=""></option>
                        @foreach ($data as $data)
                        <option value="{{$data->date}}">{{$data->date}}</option>
                        @endforeach
                    </select>
                    <button type="submit" name="ExamChooser"><i class="las la-check"></i></button>
                </form>
            </div>



            <div class="record-marks">
            @if(null !== @$data2)
            <?php
            $date = $data2['date'];
            ?>
            @endif
                <h2>View Attendance
                @if(null !== @$data2)
                - {{$date}}
                @endif
                </h2>
                <hr>
                <table>
                    @foreach($data4 as $data4)
                    <tr>
                        <td>{{$data4->id}}</td>
                        <td>{{$data4->name}}</td>
                        @if(null !== @$data4->status)
                        @if($data4->status==1)
                        <td><i class="fa fa-check" aria-hidden="true" style="color: green; font-size: 18pt;"></i></td>
                        @elseif($data4->status==0)
                        <td><i class="fa fa-times" aria-hidden="true" style="color: red; font-size: 18pt"></i></td>
                        @endif
                        @endif
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</body>

</html>