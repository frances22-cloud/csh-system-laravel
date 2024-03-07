<?php $title = session('unit_name');
$link = "{{route('Lec_Results_Selelct')}}";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .credentials {
            margin-left: auto;
            margin-right: 0;
            display: flex;
            flex-direction: row;
            text-align: center;
            justify-content: center;
        }

        .credentials h3 {
            margin-top: 20px;
            margin-right: 5px;
            font-size: 20px;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



    <link rel="stylesheet" href="{{ URL::asset('css/results.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/sidebar_main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/top_header.css') }}">
    <title>View Results</title>
</head>

<body>
    @include("Lecturer_Student_Module.Lecturer.sidebar_main");
    <div class="main-content">
        @include("Lecturer_Student_Module.Lecturer.top_header");
        <div class="nav">
            <ul class="snip1168">
                <li><a href="{{route('update_results')}}" data-hover="Update Results">Update Results</a></li>
                <li class="current"><a href="#" data-hover="View Class Results">View Class Results</a></li>
            </ul>
        </div>
        <div class="record-marks">
            <h2>Student Results</h2>
            <hr>
            <table>
                <thead>
                    <tr>
                        <th>Adm No</th>
                        <th>Name</th>
                        <?php
                        $examsCount = count($data6);
                        ?>
                        @foreach($data6 as $data6)
                        <th>{{$data6->exam_name}}</th>
                        @endforeach
                        <th>Total</th>
                        
                    </tr>
                </thead>

                @foreach($data4 as $data4)
                <?php
                $data5 = DB::table('student_results')
                    ->join('exams', 'student_results.exam_id', '=', 'exams.exam_id')
                    ->where('student_id', '=', $data4->id)
                    ->where('exams.unit_code', '=', session('unit_id'))
                    ->select('student_results.value', 'exams.maximum', 'exams.weight')->get();
                ?>
                <tr>
                    <td>{{$data4->id}}</td>
                    <td>{{$data4->name}}</td>
                    <?php
                        $resultCount = count($data5);
                        $total=0;
                        ?>
                    @foreach($data5 as $data5)
                    <td>{{$data5->value}} / {{$data5->maximum}}</td>
                    <?php
                    $total2=($data5->value * $data5->weight)/$data5->maximum;
                    $total=number_format($total2,2);
                    ?>
                    @endforeach
                    @while($resultCount<$examsCount)
                    <td>Not Updated</td>
                    <?php $resultCount++?>
                    @endwhile
                    <td>{{$total}} / 100</td>
                    <td>
                        <form action="{{ route('edit_student_results')}}" method="POST">
                            @csrf
                            <button name="Edit">Edit</button>
                            <input type="hidden" name="student_id" value="{{$data4->id}}">
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>

        </div>
</body>

</html>