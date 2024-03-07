<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=Cl, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/classes.css') }}">
    <title>Materials</title>
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
            <li class="current"><a href="#" data-hover="Material">Material</a></li>
            <li><a href="{{route('Lec_Assignment')}}" data-hover="Assignments">Assignments</a></li>
        </ul>
    </div>
    <div class="lec-materials">

        <form action="{{ route('upload_lecturer_material') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="TopicID">Topic Name</label>
            <input class="input" type="text" id="TopicID" name="TopicID">

            <label for="MaterialName">Material Name</label>
            <input class="input" type="text" id="MaterialName" name="MaterialName">

            <label for="File">Upload File</label>
            <div class="mini-section">
                <div class="file">
                    <input class="file-input" type="file" id="file" name= "file">
                </div>
                <button id="post-btn" name="post" type="submit">POST</button>
            </div>
        </form>
    </div>

</body>

</html>