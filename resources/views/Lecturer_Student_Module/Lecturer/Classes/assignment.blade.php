<? use Illuminate\Support\Facades\Session;
session_start()?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=Cl, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/classes.css') }}">
    <title>Assignments</title>
</head>

<body>
<div class="pic-area">
        <div class="top-menu">
            <a href="{{route('Lec_Classes_Select')}}">
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
            <li><a href="{{route('Lec_Class')}}" data-hover="Class">Class</a></li>
            <li><a href="{{route('Lec_Students')}}" data-hover="Students">Students</a></li>
            <li><a href="{{route('Lec_Material')}}" data-hover="Material">Material</a></li>
            <li class="current"><a href="#" data-hover="Assignments">Assignments</a></li>
        </ul>
    </div>

    <div class="materialbox">
        <a href="#divOne">
            <button>+ CREATE ASSIGNMENT</button>
        </a>
        <h2 id="Ass-head">Assignments</h2>
        <hr />
        @foreach ($data as $data)
        <div class="assgn">
            <a href="{{route('Lec_view_submissions',$data->lec_ass_id)}}"><i class="las la-link"></i>{{$data->assignment_name}}</a>
            <form action="{{ route('lec_delete_assignment') }}" method="post">
                @csrf
                <input type="hidden" name="lec_ass_id" value="{{$data->lec_ass_id}}">
            <button type="submit" name="delete" class="del pull-right"><i class="las la-trash-alt"></i></button>
            </form>
        </div>
        @endforeach

    </div>
    <div class="overlay" id="divOne">
        <div class="wrapper">
            <a id="close" href="#"><i class="las la-times"></i></a>
            <div class="content">
                <div class="container">
                    <form method="post" action="{{ route('create_assignment') }}" enctype="multipart/form-data">
                        @csrf                       
                        <label for="AssignmentName">Assignment Name</label>
                        <input class="input" type="text" id="AssignmentName" name="AssignmentName">

                        <label for="deadline">deadline</label>
                        <input class="input" type="date" id="deadline" name="deadline">

                        <label for="description">Description</label>
                        <textarea class="input" id="descripition" name="description"></textarea>

                        <label for="file">Upload File</label>
                        <div class="file">
                            <input class="file-input" type="file" id="file" name="file">
                        </div>

                        <input type="hidden" name="unit_code" value="1">

                        <button id="create-btn" name="create">CREATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>