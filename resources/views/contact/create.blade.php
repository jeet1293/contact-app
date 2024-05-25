<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="h4 text-center">Contact Information</div>
                        <div class="row pv-lg">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>    
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('contact.store') }}" method="post" class="form-horizontal ng-pristine ng-valid" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputContact1">Name</label>
                                        <div class="col-sm-10">
                                            <input name="name" value="{{ old('name') }}" class="form-control" id="inputContact1" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputContact3">Phone</label>
                                        <div class="col-sm-10">
                                            <input name="phone" value="{{ old('phone') }}" class="form-control" id="inputContact3" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputContact4">Tag(s)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="tags" value="{{ old('tags') }}" data-role="tagsinput" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputContact4">Photo</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="photo"  />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-info" type="submit">Add</button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript">
        console.log($("input[name='tags']").tagsinput('items'));
    </script>
</body>

</html>
