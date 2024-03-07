<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/classes.css') }}">
    <title>Class Platform</title>
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
        <li class="current"><a href="#" data-hover="Class">Class</a></li>
            <li><a href="{{route('Stud_Students')}}" data-hover="Students">Students</a></li>
            <li><a href="{{route('Stud_Assignment')}}" data-hover="Assignments">Assignments</a></li>
        </ul>
    </div>

    <div class="materialbox">

    @foreach($data as $data)
        <div class="material">
            <div class="title">
                <h4>{{$data->topic_name}}</h4>
            </div>
            <hr />

            <div class="mat-content">
                <a href="{{route('viewMatierial',$data->lec_mat_id)}}"><i class="las la-link"></i>
                    {{$data->material_name}}
                </a>
            </div>
        </div>
    @endforeach

    </div>
</body>

</html>