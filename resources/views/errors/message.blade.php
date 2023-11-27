@if(session('failed'))
    <div class="alert alert-danger">{{ session('failed') }}</div>
@endif

@if(session('success'))
    <div class="alert alert-success" style="text-align: right">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="text-align: right">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
