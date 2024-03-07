<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=Cl, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/classes.css') }}">
    <title>Assignments</title>
</head>

<body>
    <div class="pic-area">
        <div class="top-menu">
            <a href="{{route('Stud_Classes_Select')}}">
                <h2>{{session('unit_name')}}</h2>
            </a>
            <!-- <i class="las la-bars" > -->
            <div class="credentials">
                <h3><?php echo Auth::user()->name; ?></h3>
            </div>
        </div>
    </div>
    <div class="nav">
        <ul class="snip1168">
            <li><a href="{{route('Stud_Class')}}" data-hover="Class">Class</a></li>
            <li><a href="{{route('Stud_Students')}}" data-hover="Students">Students</a></li>
            <li class="current"><a href="#" data-hover="Assignments">Assignments</a></li>
        </ul>
    </div>

    <div class="materialbox">
        <h2 id="Ass-head">Assignments</h2>
        <hr />
        @foreach ($data as $data)
        <div class="assgn">
            <a href="{{route('viewAssFile',$data->lec_ass_id)}}"><i class="las la-link"></i>{{$data->assignment_name}}</a>
            <a href="{{route('submissionDetails',$data->lec_ass_id)}}"><button type="submit" name="delete" class="del pull-right">Submission Details</button></a>

        </div>
        @endforeach

    </div>

</body>

</html>