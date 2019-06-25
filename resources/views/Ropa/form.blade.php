<div class="form-group">
	{!! Form::label('name', 'Name') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
@if(Auth::user()->hasAnyRole("admin, user"))
<div class="form-group">
	{!! Form::label('slug', 'Slug') !!}
	{!! Form::text('slug', 'name', ['class' => 'form-control']) !!}
</div>
@endif

<div class="form-group">
	{!! Form::label('picture', 'Picture') !!}
	{!! Form::file('picture')!!}
</div>