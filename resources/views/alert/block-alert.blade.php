<div class="container-fluid">
    @if(session()->has('error'))
        @include('alert/alert', ['type' => 'danger', 'message' => session('error')])
    @endif

    @if(session()->has('success'))
        @include('alert/alert', ['type' => 'success', 'message' => session('success')])
    @endif

    @if(session()->has('warning'))
        @include('alert/alert', ['type' => 'warning', 'message' => session('warning')])
    @endif
    @if ($errors->any())
 
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>


