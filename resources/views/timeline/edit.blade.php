@extends('templates.default')

@section('title')

Timeline | {{ Auth::user()->getNameOrUsername() }}

@stop

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="block-background">
			<form action="{{ route('status.edit', ['statusId' => $status->id]) }}" method="post">
				<h1 style="font-weight:300;">Edit Your Post:</h1><hr>
				<div class="form-group {{ $errors->has("edit-{$status->id}") ? 'has-error' : '' }}"">
					<textarea class="form-control" name="edit-{{ $status->id }}" cols="30" rows="10">{{ $status->body }}</textarea>
					@if($errors->has("edit-{$status->id}"))
						<span class="help-block">{{ $errors->first() }}</span>
					@endif
				</div>
				<button type="submit" class="btn btn-default">Update</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
	</div>
</div>

@stop