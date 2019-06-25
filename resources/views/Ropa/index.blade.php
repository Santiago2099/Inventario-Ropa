@extends('layouts.app')

@section('title', 'Ropa')

@section('content')
<div class="container">
	<table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>imagen</th>
                    <a href="/Ropa/create" class="btn btn-primary">Crear</a>
                </tr>
                @foreach($Ropa as $ropa)
                <tr align="center" align="left">
                	<th>{{$ropa->id}}</th>
                    <th>{{$ropa->name}}</th>
                    <th><img style="height: 50px; width: 50px; background-color: #EFEFEF; margin: 20px;" class="card-img-top rounded-circle mx-auto d-block" src="images/{{$ropa->picture}}" alt=""></th>
                    <th><a href="/Ropa/{{$ropa->slug}}/edit" class="btn btn-primary">Editar</a>
                        {!! Form::open([ 'route' => ['Ropa.destroy', $ropa->slug], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}      
                    </th>
                </tr>
                @endforeach
        </thead>
    </table>
</div>
@endsection