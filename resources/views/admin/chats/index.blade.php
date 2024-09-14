<link rel="stylesheet" href="{{ asset('css/chats.css') }}">
<link rel="stylesheet" href="{{ asset('css/chatroom.css') }}">

@extends('layouts.app')
@extends('components.navbar-each')
@section('title', 'Admin: Chats')

@section('content')
@if(Auth::user()->role_id == 1)
    @include('components.sidebar-admin')
@else
    @include('components.sidebar')
@endif

<body class="">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="chats-body col-10 py-4 w-75">

                {{-- Search Section --}}
                <div class="card input-group mb-3 p-2 shadow">
                    <form class="chats-form" action="{{ route('admin.chats.index') }}" method="get">
                        {{-- Sort --}}
                        <span class="text-primary">Sort</span>
                        <select name="sort" id="sort" class="chats-search-component form-control" onchange="this.form.submit()">
                            <option value="Latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest
                            </option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest
                            </option>
                            <option value="hidden" {{ request('sort') === 'hidden' ? 'selected' : '' }}>Hidden
                            </option>
                        </select>
                        {{-- Search date --}}
                        <span class="chats-search-component text-primary m-1">Search</span>
                        <input type="date" name="search_date_start" class="chats-search-component form-control search-date" value="{{ $search_date_start }}">
                        ～
                        <input type="date" name="search_date_end" class="chats-search-component form-control search-date" value="{{ $search_date_end }}">
                        {{-- Search chatroom --}}
                        <select name="chatroom" id="chatroom" class="chats-search-component form-control" onchange="this.form.submit()">
                            <option value="all" {{ request('chatroom') === 'all' ? 'selected' : '' }}>ChatRoom
                            </option>
                            <option value="1" {{ request('chatroom') === '1' ? 'selected' : '' }}>Relateionship
                            </option>
                            <option value="2" {{ request('chatroom') === '2' ? 'selected' : '' }}>Career
                            </option>
                            <option value="3" {{ request('chatroom') === '3' ? 'selected' : '' }}>Family
                            </option>
                            <option value="4" {{ request('chatroom') === '4' ? 'selected' : '' }}>Health
                            </option>
                            <option value="5" {{ request('chatroom') === '5' ? 'selected' : '' }}>Finance
                            </option>
                            <option value="6" {{ request('chatroom') === '6' ? 'selected' : '' }}>Others
                            </option>
                        </select>
                        {{-- Search keyword --}}
                        <input type="text" name="search" placeholder="search..." class="chats-search-component form-control" value="{{ $search }}">
                        {{-- @if ($search)
                            <p class="text-muted mb-4 small">Search results for '<span class="fw-bold">{{ $search }}</span>'</p>
                        @endif --}}
                        <button type="submit" class="btn bg-none btn-outline-secondary btn-lg">
                            <i class="fa-solid fa-search"></i>
                        </button>
                    </form>
                </div>
                <div>
                    <p class="pb-0 mb-0 ms-4">
                        Total : 
                        <span>{{ $chats_count }}</span>
                        Chats
                    </p>
                </div>
                <table class="table align-middle bg-white chats-table mt-0">
                    <thead class="small table-secondary border">
                        <tr class="">
                            <th class="text-center">ChatRoom</th>
                            <th class="text-center">Chats</th>
                            <th class="text-center">Users</th>
                            <th class="text-center">DateTime</th>
                            <th class="text-center">Display</th>
                        </tr>

                    </thead>

                    <tbody class="border chats-table">
                        @forelse($all_chats as $chat)
                        <tr>
                            <td class="text-center w-50">
                                {{ $chat->chatroom->name }}
                            </td>
                            <td class="text-center w-50">
                                {{ $chat->body }}
                            </td>
                            <td class="text-center">
                                {{ $chat->user->name }}
                            </td>
                            <td class="text-center">
                                {{ $chat->created_at }}
                            </td>
                            <td class="text-center">
                                {{-- Edit --}}
                                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#edit-post-{{ $chat->id }}">
                                    <i class="fa-regular fa-pen-to-square pe-3 chats-edit-icon"></i>
                                </a>
                                @include('chat.contents.modals.edit')
                                {{-- Hide of Unhide --}}
                                <div class="hide-body">
                                        @if ($chat -> trashed())
                                            <form action="{{ route('admin.chats.unhide', $chat->id) }}" method="post" class="switch_label">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm switch base unhide-switch">
                                                    <span class="circle"></span>
                                                    Unhide
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.chats.hide', $chat->id) }}" method="post" class="switch_label">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm switch base hide-switch">
                                                    <span class="circle circle-move px-2"></span>
                                                        Hide 
                                                </button>
                                            </form>
                                        @endif
                                </div>
                                {{-- Detele --}}
                                {{-- <div class="chats-switch">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-chat-{{ $chat->id }}">
                                        <i class="fa-solid fa-trash chats-delete-icon"></i>
                                    </button>
                                </div>
                                @include('admin.chats.modals.delete') --}}
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