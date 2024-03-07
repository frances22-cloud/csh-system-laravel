<?php $title = session('unit_name');
$link = "{{route('Lec_Results_Selelct')}}";
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

    <title>Update Results- {{session('unit_name')}}</title>
</head>

<body>
    @include("Lecturer_Student_Module.Lecturer.sidebar_main");
    <div class="main-content">
        @include("Lecturer_Student_Module.Lecturer.top_header");
        <div class="nav">
            <ul class="snip1168">
                <li class="current"><a href="#" data-hover="Update Results">Update Results</a></li>
                <li><a href="{{route('view_results')}}" data-hover="View Class Results">View Class Results</a></li>
            </ul>
        </div>

        <a href="#new-exam">
            <button id="create-exam">+ CREATE EXAM</button>
        </a>

        <div class="overlay" id="new-exam">
            <div class="wrapper">

                <a id="close" href="#"><i class="las la-times"></i></a>

                <div class="content">
                    <div class="container">
                        <form method="post" action="{{ route('create_exam') }}">
                            @csrf
                            <label for="ExamName">Exam Name</label>
                            <input class="input" type="text" name="ExamName" id="ExamName">

                            <label for="date">Date</label>
                            <input class="input" type="date" id="date" name="date">

                            <label for="MaxScore">Max Score</label>
                            <input class="input" type="number" id="MaxScore" name="MaxScore">

                            <label for="Weight">Weight (%)</label>
                            <input class="input" type="number" id="Weight" name="Weight">

                            <button type="submit" id="create-btn" name="submit">CREATE</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="choose-exam">
            <div class="col-2">
                <h2 id="choosehead1">Choose Exam</h2>
                <hr />
                <form method="post" action="{{ route('fetch_exam_details') }}" id="form1">
                    @csrf
                    <select class="input" id="ExamID" name="ExamID">
                        <option value=""></option>
                        @foreach ($data as $data)
                        <option value="{{$data->exam_id}}">{{$data->exam_name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" name="ExamChooser"><i class="las la-check"></i></button>
                </form>
            </div>
        </div>
        @if(null !== @$data2)
        @foreach($data2 as $data2)
        <?php
        $maximum = $data2->maximum;
        $exam_id = $data2->exam_id;
        $exam_name = $data2->exam_name;
        ?>
        @endforeach
        @endif

        <div class="record-marks">
            <h2>Student Results
                @if(null !== @$data2)
                - {{$exam_name}}
                @endif
            </h2>
            <hr>

            <form action="{{ route('update_student_results') }}" method="post">
                @csrf
                <table>
                    <?php
                    $count = 1;
                    $check=1;
                    ?>

                    @foreach($data4 as $data4)
                    @if(null !== @$data4->value)
                    <?php
                    $check=0;
                    ?>
                    @endif

                    <tr>
                        <td>{{$data4->id}}</td>
                        <td>{{$data4->name}}</td>
                        <input type="hidden" name="student_id[{{$count}}]" value="{{$data4->id}}">
                        @if(null !== @$data2)
                        @if($check==0)
                        <td><input class="input" type="number" name="value[{{$count}}]" value="{{$data4->value}}"></td>
                        @else
                        <td><input class="input" type="number" name="value[{{$count}}]" value=""></td>
                        @endif
                        <td>/<?php echo $maximum; ?></td>
                        <input type="hidden" name="exam_id[{{$count}}]" value="<?php echo $exam_id; ?>">
                        @endif
                    </tr>

                    <?php $count++; 
                    ?>
                    @endforeach


                </table>
                <button type="submit" id="final_submit" name="result_submit">SUBMIT</button>

            </form>
        </div>
    </div>
</body>

</html>