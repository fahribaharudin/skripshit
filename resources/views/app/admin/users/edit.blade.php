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
                        <div class="page-header">
                            <h2>Edi data user</h2>
                        </div>
                        <form action="">
                            <div class="form-group">
                                <label for="" >Nama:</label>
                                <input type="text" class="form-control" value="{{ $user->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="" >Email:</label>
                                <input type="text" class="form-control" value="{{ $user->email }}">
                            </div>
                            <hr>
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection