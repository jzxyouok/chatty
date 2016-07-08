@extends('templates.default')

@section('title')

Timeline | {{ Auth::user()->getNameOrUsername() }}

@stop

@section('content')
	<div class="row">
		<div class="col-md-6">
			<form action="{{ route('status.post') }}" method="post" role="form">
				<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
					<label for="status">Update your status</label>
					<textarea style="resize:none;" placeholder="What's up {{Auth::user()->getFirstNameOrUsername()}}?" class="form-control" id="status" name="status" rows="3" ></textarea>

					@if($errors->has('status'))
						<span class="help-block">{{ $errors->first('status') }}</span>
					@endif

					<input type="hidden" name="_token" value="{{ Session::token() }}">
				</div>
				<button type="submit" class="btn btn-primary">Update Status</button>
			</form>
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">

			@if(!$statuses->count())
				<p>There is nothing in your timeline!</p>
			@else

				<!-- statuses -->
				@foreach($statuses as $status)
					<div class="media block-background">
						<a class="pull-left" href="{{ route('profile.index',[
							'username' => $status->user->username,
						]) }}">
							<img class="media-object img-responsive" style="height: 50px; width: 50px " alt="{{ $status->user->getNameOrUsername() }}" src="{{ route('display.dp', ['filename' => $status->user->displayPicture->filename]) }}">
						</a>
						<div class="media-body">
							<h4 class="media-heading"><a href="{{ route('profile.index',[
							'username' => $status->user->username,
						]) }}">{{ $status->user->getNameOrUsername() }}</a></h4>
							<p>{{ $status->body }}</p>
							<ul class="list-inline">
								<li>{{ $status->created_at->diffForHumans() }}</li>
								@if($status->user->id !== Auth::user()->id)
									@if(Auth::user()->hasLikedStatus($status))
										<li><a href="{{ route('status.dislike', ['statusId' => $status->id]) }}">Dislike</a></li>
									@else
										<li><a href="{{ route('status.like', ['statusId' => $status->id]) }}">Like</a></li>
									@endif
								@endif
								<li>{{$status->likes->count()}} {{ str_plural('like', $status->likes->count()) }}</li>
								
								@if($status->user->id == Auth::user()->id)
									<li><a href="{{ route('status.edit', ['statusId' => $status->id]) }}">Edit</a></li>
								@endif

								@if($status->user->id == Auth::user()->id)
									<li><a href="{{ route('status.delete', ['statusId' => $status->id]) }}">Delete</a></li>
								@endif
							</ul><hr>

							<!-- replies -->
							@foreach($status->replies as $reply)
								<div class="media comment-block">
									<a class="pull-left" href="{{ route('profile.index',['username' => $reply->user->username]) }}">
										<img  style="height: 50px; width: 50px" src="{{ route('display.dp', ['filename' => $reply->user->displayPicture->filename]) }}" alt="{{ $reply->user->getNameOrUsername() }}" class="media-object">
									</a>
									<div class="media-body">
										<h5 class="media-heading"><a href="{{ route('profile.index',['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></h5>
										<p>{{ $reply->body }}</p>
										<ul class="list-inline">
											<li>{{ $reply->created_at->diffForHumans() }}</li>
											@if($reply->user->id !== Auth::user()->id)
												@if(Auth::user()->hasLikedStatus($reply))
													<li><a href="{{ route('status.dislike', ['statusId' => $reply->id]) }}">Dislike</a></li>
												@else
													<li><a href="{{ route('status.like', ['statusId' => $reply->id]) }}">Like</a></li>
												@endif
											@endif
											<li>{{$reply->likes->count()}} {{ str_plural('like', $reply->likes->count()) }}</li>
											@if($reply->user->id == Auth::user()->id)
												<li><a href="{{ route('status.edit', ['statusId' => $reply->id]) }}">Edit</a></li>
											@endif
											@if($reply->user->id == Auth::user()->id)
												<li><a href="{{ route('status.delete', ['statusId' => $reply->id]) }}">Delete</a></li>
											@endif
											
										</ul>
									</div>
								</div>
							@endforeach 
								
								<!-- reply form -->
								<form action="{{ route('status.reply', ['statusId' => $status->id]) }}" class="col-md-6" role="form" method="post">
									<div class="form-group {{ $errors->has("reply-{$status->id}") ? 'has-error' : '' }}">
										<textarea style="resize:none" name="reply-{{ $status->id }}" class="form-control" placeholder="Reply to this status.." rows="2"></textarea>
										@if($errors->has("reply-{$status->id}"))
											<span class="help-block">{{ $errors->first() }}</span>
										@endif
									</div>
									<input type="submit" value="Reply" class="btn btn-primary btn-sm">
									<input type="hidden" name="_token" value="{{ Session::token() }}">
								</form>
							
						</div>
					</div>
				@endforeach
				{!! $statuses->render() !!}
			@endif
		</div>
	</div>
@stop