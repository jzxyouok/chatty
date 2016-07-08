<div class="result-user">
    <div class="media">
        <a class="pull-left" href="{{ route('profile.index',['username' => $user->username]) }}">
            <img class="img-responsive" alt="{{ $user->getNameOrUsername() }}" src="{{ route('display.dp', ['filename' => $user->displayPicture->filename]) }}">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><a href="{{ route('profile.index',['username' => $user->username]) }}">{{ $user->getNameOrUsername() }}</a></h4>
            <p>{{ $user->location }}</p>
        </div>
    </div>
</div>
