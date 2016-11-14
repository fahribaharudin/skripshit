@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include ('app.partials.sidebar-admin')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin Dashboard</div>
                    <div class="panel-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus beatae enim, ipsum minus modi mollitia nihil placeat quis ratione sit. Amet assumenda culpa doloremque expedita nihil officiis perferendis quaerat voluptatibus?
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection