<link rel="stylesheet" href="{{ asset('css/users.css') }}">
<script src="{{ asset('js/deletion-reason.js') }}"></script>

@extends('layouts.app')
@extends('components.navbar-each')

@section('title', 'Admin: User List')

@section('content')
    @include('components.sidebar')

    <div class="container-users my-5">
        <div class="row justify-content-center">

            <div class="row my-3">
                <div class="col-4"></div>

                <div class="col-3">
                    <form method="get" action="{{ route('users.index') }}">
                        <div class="form-group">
                            <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                                <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Sorted by Name
                                </option>
                                <option value="id" {{ request('sort') === 'id' ? 'selected' : '' }}>Sorted by ID
                                </option>
                            </select>
                        </div>
                </div>

                <div class="col-3">
                    @auth
                        <form action="{{ route('users.index') }}" method="get">
                            <input type="text" name="search" placeholder="search..."
                                class="form-control w-100 shadow value="{{ $search }}">
                        @endauth

                        @if ($search)
                            <p class="text-muted mb-4 small">Search results for '<span
                                    class="fw-bold">{{ $search }}</span>'</p>
                        @endif
                    </form>

                </div>
            </div>

            <table class="table align-middle bg-white mt-0 table-hover table-bordered table-users">
                <thead class="small table-secondary border">
                    <tr>
                        <th class="text-center col-id">ID</th>
                        <th class="col-avatar"></th> {{-- avatar/icon --}}
                        <th class="col-name">Username <span class="small text-muted total-number">
                                (Total: {{ $user->count() }})
                            </span></th>
                        <th class="text-center col-email">Email</th>
                        <th class="text-center col-activate">Status</th>
                    </tr>
                </thead>

                <tbody class="users-table">
                    @forelse($all_users as $user)
                        <tr>
                            <td class="text-center">
                                {{ $user->id }}
                            </td>

                            <td class="text-center">
                                @if ($user->avatar)
                                    <img src="{{ $user->avatar }}" alt="avatar" class="avatar-sm rounded-circle">
                                @else
                                    <i class="fa-solid fa-circle-user icon-sm"></i>
                                @endif
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td class="text-center">
                                @if ($user->id != Auth::user()->id)
                                    <form action="{{ route('users.status', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <label class="switch">
                                            <input type="checkbox" name="status" {{ $user->deleted_at ? '' : 'checked' }} onchange="this.form.submit()">
                                            <span class="slider"></span>
                                        </label>
                                    </form>
                                @endif
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="lead text-muted text-center">No users yet.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

            <div class="d-flex justify-content-center">
                {{ $all_users->links() }}
            </div>

        </div>
    </div>

@endsection
