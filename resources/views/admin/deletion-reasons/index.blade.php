<link rel="stylesheet" href="{{ asset('css/deletion-reason.css') }}">
<script src="{{ asset('js/deletion-reason.js') }}"></script>

@extends('layouts.app')
@extends('components.navbar-each')

@section('title', 'Admin: Deletion Reasons')

@section('content')
    @include('components.sidebar')

    <div class="container-deletion-reasons my-5">
        <div class="row justify-content-center">

            <div class="col-10 py-4 quote-body-size">
                <div class="row">
                    <div class="col-1"></div>

                    <div class="col-1">
                        <p class="text-primary text-end mt-1">Sort</p>
                    </div>

                    <div class="col-3">
                        <form method="get" action="{{ route('deletion-reasons.index') }}">
                            <div class="form-group">
                                <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                                    <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest
                                    </option>
                                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest
                                    </option>
                                </select>
                            </div>
                            {{-- <button
                            class="btn dropdown-toggle btn-link text-decoration-none text-muted quote-other-btn w-75 bg-white shadow"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownMenuButton">Latest
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-item" href="#">Oldest</li>
                            <li class="dropdown-item" href="#">Latest</li>
                        </ul> --}}
                    </div>

                    <div class="col-1">
                        <p class="text-primary mt-1">Search</p>
                    </div>

                    <div class="col-3">
                        @auth
                            <form action="{{ route('deletion-reasons.index') }}" method="get">
                                <input type="text" name="search" placeholder="keyword" class="form-control form-inline w-75 shadow" value="{{ $search }}">
                        @endauth

                            @if ($search)
                                <p class="text-muted mb-4 small">Search results for '<span
                                        class="fw-bold">{{ $search }}</span>'</p>
                            @endif
                        </form>

                    </div>
                </div>

                <div>
                    <p class="pb-0 mb-0 ms-4">
                        Total :
                        {{ $deletion_reason->count() }}
                        messages
                    </p>
                </div>

                <table class="table align-middle bg-white mt-0 table-bordered table-hover">
                    <thead class="small table-secondary border">
                        <tr class="">
                            <th class="text-center col-date">Date</th>
                            <th class="text-center col-reason">Deletion Reasons</th>
                        </tr>
                    </thead>

                    <tbody class="border deletion-reasons-table">
                        @forelse($all_deletion_reasons as $deletion_reason)
                            <tr>
                                <td class="text-center">
                                    {{ $deletion_reason->created_at }}
                                </td>

                                <td class="">
                                    <div class="text-container">

                                        <div class="row justify-content-center">
                                            <div class="col-10 align-self-center text-truncate ps-5">
                                                <div class="text-container">
                                                    <div class="text-content">
                                                        {{ $deletion_reason->reason }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <button type="button"
                                                    class="btn btn-border-none text-decoration-underline more-details btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deletionReasonDetail{{ $deletion_reason->id }}">more
                                                    details
                                                </button>
                                            </div>
                                            {{-- Modal for more details --}}
                                            <div class="modal fade" id="deletionReasonDetail{{ $deletion_reason->id }}">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content shadow px-5 py-3">
                                                        <div class="modal-header justify-content-between">

                                                            <p class="mb-0">
                                                                {{ $deletion_reason->created_at }}
                                                            </p>

                                                            <button type="modal" data-bs-dismiss="modal"
                                                                class="border-0 bg-white">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>

                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                {{ $deletion_reason->reason }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="2" class="lead text-muted text-center">No deletion reasons yet.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

                <div class="d-flex justify-content-center">
                    {{ $all_deletion_reasons->links() }}
                </div>

            </div>
        </div>
    </div>

@endsection
