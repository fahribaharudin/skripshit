@extends ('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('app.partials.sidebar-admin')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><a href="#">{{ $user->email }}</a></td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-xs">Edit</a> |
                                        <a href="#" class="btn btn-danger btn-xs">Hapus</a>
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

@endsection