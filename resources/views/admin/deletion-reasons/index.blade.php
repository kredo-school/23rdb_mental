<link rel="stylesheet" href="{{ asset('css/deletion-reason.css') }}">
@extends('layouts.app')

@section('title', 'Admin: Deletion Reasons')

@section('content')

    <div class="container-fluid my-5">
        <div class="row justify-content-center">

            <div class="col-10 py-4 quote-body-size">
                <div class="row">
                    <div class="col-1"></div>

                    <div class="col-1">
                        <p class="text-primary text-end mt-1">Sort</p>
                    </div>

                    <div class="col-3">
                        <button
                            class="btn dropdown-toggle btn-link text-decoration-none text-muted quote-other-btn w-75 shadow"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownMenuButton">Latest
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-item" href="#">Oldest</li>
                            <li class="dropdown-item" href="#">Latest</li>
                        </ul>
                    </div>

                    <div class="col-1">
                        <p class="text-primary mt-1">Search</p>
                    </div>

                    <div class="col-3">
                        <form action="#" method="get" class="input-group">
                            <input type="text" class="form-control form-inline quote-other-btn w-75 shadow"
                                name="search" placeholder="keywords">
                            <span class="input-group-text quote-other-btn"><i
                                    class="fa-solid fa-magnifying-glass"></i></span>
                            {{-- value="{{ $search}}" --}}
                            {{-- @if ($search)
                            @endif --}}
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
                                    <div class="row justify-content-center">
                                        <div class="col-10 align-self-center text-truncate ps-5">
                                            <div class="text-container">
                                                <div class="text-content">
                                                    {{ $deletion_reason->reason }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 justify-content-end">
                                            <button type="button" class="btn btn-border-none text-decoration-underline more-details"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deletionReasonDetail{{ $deletion_reason->id }}"
                                                data-body="{{ $deletion_reason->reason }}">more details</button>
                                        </div>
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

@section('scripts')
    <script src="{{ asset('js/deletion-reason.js') }}"></script>
@endsection

