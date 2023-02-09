@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Subir archivos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.files.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input class="form-control" type="file" name="files[]" multiple required>
                        <button type="submit" class="mt-4 btn btn-primary float-right">
                            Subir
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
