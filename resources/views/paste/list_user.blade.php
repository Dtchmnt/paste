@foreach($list_users as $list_users)
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$list_users->title}}</h5>
                <small>{{$list_users->expiration}}</small>
            </div>
            <p class="mb-1">{{$list_users->name}}</p>
            <small>che to</small>
        </a>
    </div>
@endforeach
