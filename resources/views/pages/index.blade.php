@extends('layout/template')

@section('contend')
<div class="container">
    <div class="mt-5">
        <h1>Subida de archivos</h1>
    </div>
    <form class="mt-3" action="{{ route('upload.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control border border-dark" id="name" name="name">
            </div>
            <div class="col-md-4">
                <label for="file" class="form-label">Subir archivo</label>
                <input class="form-control border border-dark" id="file" name="file" type="file">
            </div>
            <div class="col-md-4 mt-2">
                <button class="btn btn-primary mt-4" type="submit">Enviar</button>
            </div>
        </div>
    </form>
    <div class="row mt-5">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Archivo</th>
                <th scope="col">Tipo</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($request as $item)
                    <tr>
                        <th>{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>
                            @if ($item->type == 'png' || $item->type == 'jpg' || $item->type == 'jpeg')
                                <img src="{{ asset('archivos/'.$item->file) }}" alt=""  style="width: 50px;">
                            @else
                                <img src="{{ asset('img/file.png') }}" alt="" style="width: 50px;">
                            @endif


                            <a href="{{ asset('archivos/'. $item->file) }}" target="_blank" {{ $item->type == 'pdf' ? '' : 'download' }}>{{ $item->file }}
                            </a>
                        </td>
                        <td>{{ $item->type }}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
    @include('sweetalert::alert')
</div>

@endsection
