@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include ('app.partials.sidebar-user')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Profil Anda
                    </div>
                    <div class="panel-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium alias animi, autem blanditiis commodi cum excepturi itaque iure mollitia nam non nulla pariatur provident quaerat quos ut veniam voluptas voluptatum!
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection