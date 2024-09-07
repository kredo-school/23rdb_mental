<link rel="stylesheet" href="{{ asset('css/chats.css') }}">
<link rel="stylesheet" href="{{ asset('css/chatroom.css') }}">

@extends('layouts.app')
@extends('components.navbar-each')
@section('title', 'Journal')

@section('content')
@if(Auth::user()->role_id == 1)
    @include('components.sidebar-admin')
@else
    @include('components.sidebar')
@endif
{{--@extends('layouts.app')--}}

@section('title', 'Admin: Chats')

@section('content')

<body class="">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-10 py-4 chats-body-size w-75" style="margin-left:200px;">

                <div class="row px-5 mb-5">
                    {{-- Chat Rooms --}}
                    <div class="col-2 p-1">
                        <a href="#" class="btn btn-relationship w-100">Relationship</a>
                    </div>
                    <div class="col-2 p-1">
                        <a href="#" class="btn btn-career w-100">Career</a>
                    </div>
                    <div class="col-2 p-1">
                        <a href="#" class="btn btn-family w-100">Family</a>
                    </div>
                    <div class="col-2 p-1">
                        <a href="#" class="btn btn-health w-100">Health</a>
                    </div>
                    <div class="col-2 p-1">
                        <a href="#" class="btn btn-finance w-100">Finance</a>
                    </div>
                    <div class="col-2 p-1">
                        <a href="#" class="btn btn-others w-100">Others</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-1"></div>
                    
                    <div class="col-1">
                    <p class="text-primary text-end mt-1">Sort</p>
                    </div>

                    <div class="col-3">
                            <button class="btn dropdown-toggle btn-link text-decoration-none text-muted chats-other-btn w-75 shadow" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownMenuButton">Latest
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <li class="dropdown-item" href="#">Oldest</li>
                              <li class="dropdown-item" href="#">Hidden</li>
                            </ul>
                    </div>

                    <div class="col-1">
                        <p class="text-primary mt-1">Search</p>
                    </div>

                    <div class="col-3">
                        <form action="{{ route('admin.chats.index') }}" method="get" class="input-group">
                            <input type="text" class="form-control form-inline chats-other-btn w-75 shadow" name="search" placeholder="keywords"> 
                            <span class="input-group-text chats-other-btn"><i class="fa-solid fa-magnifying-glass"></i></span>
                        {{-- value="{{ $search}}" --}}
                            {{-- @if($search)
                            @endif --}}
                        </form>
                          
                    </div>

                </div>
                <div>
                    <p class="pb-0 mb-0 ms-4">
                        Total : 
                        <span>{{ $chats_count->count() }}</span>
                        Chats
                    </p>
                </div>

                <table class="table align-middle bg-white chats-table mt-0">
                    <thead class="small table-secondary border">
                        <tr class="">
                            <th class="text-center">Chats</th>
                            <th class="text-center">Users</th>
                            <th class="text-center">Display</th>
                        </tr>

                    </thead>

                    <tbody class="border chats-table">
                        @forelse($all_chats as $chat)
                        <tr>
                            <td class="text-center w-50">
                                {{ $chat->body }}
                            </td>
                            <td class="text-center">
                                {{ $chat->user_id }}
                            </td>
                            <td class="text-center">
                                {{-- edit icon --}}
                                <div class='chats-switch'>
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-chats">
                                        <i class="fa-regular fa-pen-to-square pe-3 chats-edit-icon"></i>
                                    </button>
                                </div>
                                @include('admin.chats.modals.action')
                                
                                <div class="form-check form-switch form-check-inline chats-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">hide</label>
                                </div>

                                <div class="chats-switch">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-chats">
                                        <i class="fa-solid fa-trash chats-delete-icon"></i>
                                    </button>
                                </div>
                                @include('admin.chats.modals.action')
        
                            </td>    

                        </tr>

                        @empty
                            <tr>
                                <td colspan="3" class="lead text-muted text-center">No Chats yet.</td>
                            </tr>

                        @endforelse
                    </tbody>

                </table>

                <div class="d-flex justify-content-center">
                    {{ $all_chats->links() }}
                </div>    

            </div>
        </div>
    </div>



    
</body>



@endsection