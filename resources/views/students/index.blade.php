<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                @if (session('status'))
                <h6 class="alert alert-success">{{session('status')}}</h6>
                @endif
                
                    <div class="card-header ">
                        <h4>Laravel 8 IMAGE CRUD
                            <a href="{{url('add-student')}}" class="btn btn-primary float-end m-0">Add Student</a>
                        </h4>
                    </div>
                 
                    <div class="card-body">
                        <table class="table tble-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->course}}</td>
                                    <td>
                                        <img src="{{asset('uploads/student/'.$item->image)}}" width="100px" height="70px">
                                    </td>
                                    <td><a href="{{ url('edit-student/'.$item->id) }}" class="btn btn-warning">Edit</a></td>
                                    <td><a href="{{ url('delete-student/'.$item->id) }}" class="btn btn-danger">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>