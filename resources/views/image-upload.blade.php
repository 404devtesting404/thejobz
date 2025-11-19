<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Watermark Text on Images - Laravel 8</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h4 style="text-align: center;">Add Watermark Text on Images - Laravel 8</h4>
        <div class="panel panel-primary">
            <div class="panel-heading">Add Watermark Text on Images - Laravel 8</div>
            <div class="panel-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    Error occured.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
                @endif

                <form action="{{ route('add-watermark') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="file" name="image" class="form-control" class="image">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
