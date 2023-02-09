@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mis archivos</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Nombre del archivo</th>
                                  <th scope="col">ID Usuario</th>
                                  <th scope="col">Ver</th>
                                  <th scope="col">Eliminar</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($files as $file)
                                <tr>
                                    <th scope="row">{{ $file->id }}</th>
                                    <td>{{ $file->name }}</td>
                                    <td>{{ $file->user_id }}</td>
                                    <td>
                                        {{-- <a target="_blank" href="storage/{{ Auth::id() }}/{{ $file->name }}" class="btn btn-small btn-outline-secondary">Ver</a> --}}
                                        <a target="_blank" href="{{ route('user.files.show', $file->id) }}" class="btn btn-small btn-outline-secondary">
                                            {{-- enlace a localhost:8000/files/id_archivo --}}
                                            Ver
                                        </a>
                                    </td>
                                   
                                    <td>
                                        <a href="#" class="btn btn-small btn-outline-danger">Eliminar</a>
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
</div>
@endsection
