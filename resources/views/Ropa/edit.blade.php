@extends('layouts.app')

@section('title', 'Edit')

@section('content')
	{!! Form::model($ropa, ['route' => ['Ropa.update', $ropa], 'method' => 'PUT', 'files' => true]) !!}
		@include('Ropa.form')

		{!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@endsection