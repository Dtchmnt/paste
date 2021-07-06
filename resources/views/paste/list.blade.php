    @foreach($pastes as $paste)
    <div class="list-group">
        <a href="/link/{{$paste->link}}" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$paste->title}}</h5>
                <small>{{$paste->expiration}}</small>
            </div>
            <p class="mb-1">{{$paste->name}}</p>
            <small>che to</small>
        </a>
    </div>
    @endforeach
