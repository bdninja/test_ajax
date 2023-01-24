<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/proper.js/1.16.0/umd/proper.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.5.1/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">

            <div class="card">
                <div class="card-header">
                    <h3>Add User</h3>
                </div>
                <div class="card-body">
                    {{--                    <form action="{{route('add.ajax')}}" method="post" enctype="multipart/form-data">--}}
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="image">image:</label>
                            <span class="badge bade-secondary" onclick="add_more()"><i class="fa fa-plus"></i></span>
                            <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                            @if(isset($row[0]))
                                @if($row[0]->images != '')
                                    @php
                                        $imageArr =explode(',',$row[0]->images);
                                    @endphp

                                    <div class="p-4">
                                        @foreach($imageArr as $image)
                                            <span class="p-2">
                                        <img src="{{asset('storage/media/'.$image)}}" width="100px">
                                    </span>
                                        @endforeach
                                    </div>
                                @endif
                            @endif
                        </div>
                        @if(isset($row[0]))
                            <a href="/" class="btn btn-secondary">back</a>
                            <input type="hidden" id="id" name="id" value="{{$row[0]->id}}">
                            <button type="submit" class="btn btn-primary form-control" id="submit">Update</button>
                        @else
                            <button type="submit" class="btn btn-primary form-control" id="submit">Submit</button>
                        @endif

                    </form>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <td>ID</td>
                        <td>Email</td>
                        <td>Password</td>
                        <td>Images</td>
                        <td>Action</td>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->password}}</td>
                                @php
                                    $imageArr = explode(',',$row->images);
                                @endphp
                                <td>
                                    @foreach($imageArr as $image)

                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{url('/edit/'.$row->id)}}" class="btn btn-secondary">Edit</a>
                                    <a href="{{url('/delete/'.$row->id)}}" class="btn btn-danger" onclick="remove_more('+count+')">Delete</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var count = 0;

    function add_more() {
        count++;
        $html = '<div class="form-group" id="image_box_'+count+'"><div class="row"><div class="col-md-6"><input type="file" id="image" name="image"></div><div class="col-md-4"><span class="btn btn-danger"><i class="fa fa-minus"></i> Remove</span></div></div></div>'
        $('.image_box').after($html);
    }
    function remove_more(count){
        $('#image_box_'+count).remove();
    }
    $(document).ready(function () {
        $('form').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '/add',
                data: formData,
                type: 'post',
                success: function (result) {
                    alert(result);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        })
    })
</script>
</body>
</html>
