@if(!empty($list_users))
    @foreach($list_users as $list_user)
        <div class="list-group">
            <a href="/link/{{$list_user->link}}"
               class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$list_user->title}}</h5>
                    <small>{{$list_user->expiration}}</small>
                </div>
                <p class="mb-1">{{$list_user->name}}</p>
                <small>che to</small>
            </a>
        </div>
    @endforeach
@endif
