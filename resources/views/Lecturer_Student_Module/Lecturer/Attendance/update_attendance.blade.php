<?php $title = "Update Attendance";
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

    <title>Update Attendance</title>
</head>

<body>

    @include("Lecturer_Student_Module.Lecturer.sidebar_main");
    <div class="main-content">
        @include("Lecturer_Student_Module.Lecturer.top_header");
        <div class="nav">
            <ul class="snip1168">
                <li class="current"><a href="" data-hover="Update Attendance">Update Attendance</a></li>
                <li><a href="{{route('view_class_attendance')}}" data-hover="View Class Attendance">View Class Attendance</a>
                </li>
            </ul>
        </div>
        <div class="choose-exam">
            <div class="col-2">
                <h2 id="choosehead1">Choose Date</h2>
                <hr />

                <form id="form1" action="{{ route('choose_date') }}" method="post">
                    @csrf
                    <input class="input" type="date" name="date" id="date" value="" required>
                    <button name="select_date"><i class="las la-check"></i></button>
                </form>
                
            </div>
        </div>

        <div class="record-marks">
            @if(null !== @$data)

            <?php
            $date = $data['date'];
            ?>

            @endif
            <h2>Take Attendance
                @if(null !== @$data)
                - {{$date}}
                @endif
            </h2>
            <hr>
            <form action="{{ route('update_student_attendance') }}" method="post">
                @csrf
                <table>
                    <?php
                    $count = 1;
                    ?>
                    @foreach($data4 as $data4)
                    <tr>
                        <td>{{$data4->id}}</td>
                        <td>{{$data4->name}}</td>
                        @if(null !== @$data)
                        <td class="last_col">
                            @if(null !== @$data4->status)
                            @if($data4->status==1)
                            <input type="radio" id="contactChoice1" name="status[{{$count}}]" value="1" required checked />
                            <label for="contactChoice1">Present</label>
                            <input type="radio" id="contactChoice2" name="status[{{$count}}]" value="0" required />
                            <label for="contactChoice2">Absent</label>
                            @elseif($data4->status==0)
                            <input type="radio" id="contactChoice1" name="status[{{$count}}]" value="1" required />
                            <label for="contactChoice1">Present</label>
                            <input type="radio" id="contactChoice2" name="status[{{$count}}]" value="0" required checked />
                            <label for="contactChoice2">Absent</label>
                            @endif

                            @else
                            <input type="radio" id="contactChoice1" name="status[{{$count}}]" value="1" required />
                            <label for="contactChoice1">Present</label>
                            <input type="radio" id="contactChoice2" name="status[{{$count}}]" value="0" required />
                            <label for="contactChoice2">Absent</label>
                            @endif
                        </td>
                        <input type="hidden" name="date[{{$count}}]" value="{{$date}}">
                        <input type="hidden" name="student_id[{{$count}}]" value="{{$data4->id}}">
                        <input type="hidden" name="unit_id[{{$count}}]" value="{{session('unit_id')}}">
                        @endif
                    </tr>
                    <?php $count++;
                    ?>
                    @endforeach
                </table>
                <button type="submit" id="final_submit" name="take_attendance">SUBMIT</button>
            </form>
        </div>
    </div>
</body>

</html>