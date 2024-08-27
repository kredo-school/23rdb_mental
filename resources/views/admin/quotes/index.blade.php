<link rel="stylesheet" href="{{ asset('css/quote_style.css') }}">

@extends('layouts.app')

@section('title', 'Admin: Quotes')

@section('content')



<body class="">

    <div class="container-fluid">
        <div class="row justify-content-center">


            <div class="col-2 bg-warning">
                <p></p>

            </div>



            <div class="col-10 py-4 quote-body-size">
                <div class="row">
                    <div class="col-1"></div>

                    <div class="col-1">
                    <p class="text-primary text-end mt-1">Sort</p>
                    </div>

                    <div class="col-3">
                            <button class="btn dropdown-toggle btn-link text-decoration-none text-muted quote-other-btn w-75 shadow" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownMenuButton">Latest
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              {{-- <a class="dropdown-item" href="#">latest</a> --}}
                              <li class="dropdown-item" href="#">Oldest</li>
                              <li class="dropdown-item" href="#">Bookmarked</li>
                              <li class="dropdown-item" href="#">Hidden</li>
                            </ul>


                    </div>

                    <div class="col-1">
                        <p class="text-primary mt-1">Search</p>
                        </div>

                    <div class="col-3">
                        <form action="{{ route('quote.index') }}" method="get" class="input-group">
                            <input type="text" class="form-control form-inline quote-other-btn w-75 shadow" name="search" placeholder="keywords">
                            <span class="input-group-text quote-other-btn"><i class="fa-solid fa-magnifying-glass"></i></span>
                        {{-- value="{{ $search}}" --}}
                            {{-- @if($search)
                            @endif --}}
                        </form>

                    </div>

                    {{-- create a new quote button --}}
                    <div class="col-2 ms-5">
                        <button type="button" class="btn-submit" data-bs-toggle="modal" data-bs-target="#create-quote">
                            <i class="fa-solid fa-circle-check"></i> Add quote
                        </button>

                    </div>

                    @include('admin.quotes.modals.action')


                </div>
                <div>
                    <p class="pb-0 mb-0 ms-4">
                        Total :
                        <span>{{ $quotes_count->count() }}</span>
                         Quotes
                    </p>
                </div>

                <table class="table align-middle bg-white quote-table mt-0">
                    <thead class="small table-secondary border">
                        <tr class="">
                            <th></th>
                            <th class="text-center">Quote</th>
                            <th></th>
                            <th class="text-center">Auther</th>
                            <th class="text-center">Display</th>
                        </tr>

                    </thead>

                    <tbody class="border quote-table">
                        @forelse($all_quotes as $quote)
                        <tr>
                            <td class="py-0 pe-0">
                                <h2 class="text-end">
                                    "
                                </h2>

                            </td>
                            <td class="h2 text-center w-50">
                                {{ $quote->quote }}
                            </td>

                            <td class="py-0 pe-0">
                                <h2 class="text-start">
                                    "
                                </h2>

                            </td>

                            <td class="text-center">
                                {{ $quote->author }}
                            </td>

                            <td class="text-center pt-4">
                                {{-- cancel the bookmark --}}
                                <div class="quote-switch text-center">
                                    @if ($quote->isBookmarked())
                                    <form action="{{ route('bookmark.destroy', $quote->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn pe-3">
                                            <i class="fa-solid fa-bookmark text-warning quote-bookmark-store"></i></button>

                                    @else

                                    <form action="{{ route('bookmark.store', $quote->id) }}" method="post">
                                        @csrf
                                            <button type="submit" class="btn pe-3"><i class="fa-regular fa-bookmark quote-bookmark-cancel"></i></button>
                                    </form>

                                    @endif
                                </div>

                                {{-- edit icon --}}
                                <div class='quote-switch'>
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-quote">
                                        <i class="fa-regular fa-pen-to-square pe-3 quote-edit-icon"></i>
                                    </button>
                                </div>

                                <div class="form-check form-switch form-check-inline quote-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">display</label>
                                </div>

                                <div class="quote-switch">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-quote">
                                        {{-- -{{ $quote->id }} --}}
                                        <i class="fa-solid fa-trash quote-delete-icon"></i>
                                    </button>
                                </div>

                            </td>

                        </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="lead text-muted text-center">No Quote yet.</td>
                            </tr>

                        @endforelse
                    </tbody>

                </table>

                <div class="d-flex justify-content-center">
                    {{ $all_quotes->links() }}
                </div>

            </div>
        </div>
    </div>




</body>



@endsection
