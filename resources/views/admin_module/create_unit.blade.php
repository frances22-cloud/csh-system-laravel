<?php $title = "Create Unit";
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

    <title>Create Unit</title>
</head>

<body>
    @include("admin_module.sidebar");
    <div class="main-content">
        @include("admin_module.top_header");
        <div class="nav">
            <ul class="snip1168">
                <li class="current"><a href="#" data-hover="Create Unit">Create Unit</a></li>
                <li><a href="{{ route('view_units') }}" data-hover="View Units">View Units</a></li>
            </ul>
        </div>

        <div class="formB">
            <form method="post" action="{{ route('create_unit2') }}" class="formA">
                @csrf
                <label for="unit_name">Unit Name</label>
                <input class="input" type="text" name="unit_name" id="unit_name" required>

                <label for="capacity">Capacity</label>
                <input class="input" type="number" id="capacity" name="capacity" required>

                <label for="lec">Lecturer</label>
                <select class="input" id="lec" name="lec">
                    <option value=""></option>
                    @foreach ($data as $data)
                    <option value="{{$data->id}}">{{$data->fname}} {{$data->sname}}</option>
                    @endforeach
                </select>

                <button type="submit" id="create-btn" name="submit">CREATE</button>

            </form>
        </div>


</body>

</html>