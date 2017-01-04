<div class="panel panel-default">
    <ul class="list-group">
        <li class="list-group-item"><a href="{{ url('/home') }}">Dashboard</a></li>
        {{--<li class="list-group-item"><a href="{{ route('users.profile', auth()->user()->id) }}">Setting Akun</a></li>--}}
        <li class="list-group-item"><a href="{{ route('users.kuisioner', auth()->user()->id) }}">Form Kuisioner</a></li>
        <li class="list-group-item"><a href="{{ route('users.prediksi.create', auth()->user()->id) }}">Prediksi</a></li>
    </ul>
</div>