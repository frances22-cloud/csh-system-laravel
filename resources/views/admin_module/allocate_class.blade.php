<?php $title = "Allocate Class";
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

    <title>Allocate Class</title>
</head>

<body>
    @include("admin_module.sidebar");
    <div class="main-content">
        @include("admin_module.top_header");
        <div class="nav">
            <ul class="snip1168">
                <li class="current"><a href="{{ route('allocate_class') }}" data-hover="Allocate Class">Allocate Class</a></li>
                <li><a href="{{ route('view_allocated_classes') }}" data-hover="View Allocated Classes">View Allocated Classes</a></li>
            </ul>
        </div>

        <div class="formB">
            <form method="post" action="{{ route('allocate_classes') }}"class="formA">
                @csrf            
                <label for="unit">Unit</label>
                <select class="input" id="unit" name="unit" required>
                        <option value=""></option>
                        @foreach ($data as $data)
                        <option value="{{$data->id}}">{{$data->unit_name}}</option>
                        @endforeach
                    </select>             
                
                <label for="venue">Venue</label>                
                <input class="input" type="venue" id="venue" name="venue" required>

                <label for="date">Date and Time</label>                
                <input class="input" type="datetime-local" id="datetime" name="datetime" required>

                <button type="submit" id="create-btn" name="submit">ALLOCATE</button>

            </form>
        </div>


</body>

</html>