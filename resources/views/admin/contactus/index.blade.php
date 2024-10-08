<link rel="stylesheet" href="{{ asset('css/contactus.css') }}">

@admin
@extends('layouts.app')

@extends('components.navbar-each')

@section('title', 'Admin: Inquiry')

@section('content')

@if(Auth::user()->role_id == 1)
   @include('components.sidebar-admin')
@else
    @include('components.sidebar')
@endif





    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-2">
                <p></p>

            </div>


            <div class="col-10 py-4 inquiry-body-size">
                {{-- head search section --}}
                <div class="row mt-3  my-4">
                    <div class="col-6"></div>
                    <div class="col-6 px-5">
                        <div class="row bg-white rounded">
                             {{-- search bar --}}
                            <div class="col-auto ps-5">
                                <p class="text-primary mt-1 pt-3">Search</p>   
                            </div>

           
                            <div class="col-auto inquiry-search_box pt-3">
                                        <form action="{{ route('admin.inquiries') }}" method="get" class="form-inline d-flex align-items-center">
                                            @csrf
                                            <input type="text" name="keyword" placeholder="keyword....." class="form-control me-2 shadow" aria-label="Search keyword" aria-describedby="search-button" value="{{ old('keyword', $keyword) }}">

                                            @if (!empty($keyword))
                                            <a href="{{ route('admin.inquiries') }}" class="text-secondary ms-2" title="クリア">
                                                <i class="fa-solid fa-circle-xmark"></i>
                                            </a>
                                        @endif
                                        </form>

                            </div>

                        </div>
                    </div>

                </div>
                <div>

                    @if ((!empty($keyword)))
                    <span class="pb-0 mb-0 ms-4 me-5 pe-5 inquiry-subtextcolor">Result for : {{ $keyword }}</span>
                    @endif
                    <p class="pb-0 mb-0 ms-4 me-5 pe-5 mt-0 pt-0 inquiry-subtextcolor">

                        Total :
                        <span>{{ $inquiries_count->total() }}</span>
                        {{ $inquiries_count->total()<=1 ? ' Inquiry' : ' Inquiries' }}
                    </p>



                </div>

                <table class="table align-middle bg-white quote-table mt-0 table-responsive shadow" id="table1">
                    <thead class="small table-secondary border">
                        <tr class="">
                            <th class="text-center th-wssmall">#</th>
                            <th class="text-center th-wsmall">Avatar</th>
                            <th class="text-center th-wsmedium w-25">Username</th>
                            {{-- <th class="text-center th-wmedium">Email</th> --}}
                            <th class="col text-center th-wlarge w-50">Inquiry</th>
                            <th class="text-center th-wsmedium">Date</th>

                        </tr>

                    </thead>

                    <tbody class="border quote-table">
                        @forelse($all_inquiries as $inquiry)
                        <tr>
                            <td class="th-wssmall text-center py-3">
                                {{ $inquiry->id }}
                            </td>
                            <td class="text-center th-wsmall py-3">
                                @if ($inquiry->user->avatar)
                                <img src="{{ $inquiry->user->avatar }}" alt="" class="rounded-circle d-block inquiries-avatar-sm text-center">
                                @else
                                <i class="fa-solid fa-circle-user d-block text-center inquiries-icon-sm"></i>
                                @endif
                            </td>

                            <td class="text-center th-wsmedium py-3">
                                {{ $inquiry->user->name }}
                            </td>

                            {{-- <td class="text-center">
                                {{ $inquiry->user->email }}
                            </td> --}}

                            <td class="ps-5 text-truncate me-0 py-3">
                                <div class="row">
                                    <div class="col-11 w-75 align-items-center text-truncate inquiry-detail-a">
                                    {{ $inquiry->body}}
                                    </div>
                                    <div class="col-2 d-md-flex justify-content-md-end ms-4 ps-4 pe-0 me-0">
                                        <button type="button" class="btn btn-border-none text-decoration-underline td-details" data-bs-toggle="modal" data-bs-target="#inquiryDetail" data-id="{{ $inquiry->id }}" data-username="{{ $inquiry->user->name }}" data-email="{{ $inquiry->user->email }}" data-body="{{ $inquiry->body }}">more <br>details</button>
                                    </div>
                                </div>
                             </td>

                             <td class="text-center td-date py-3">
                                <p class="mb-0 px-0">
                                {{ $inquiry->created_at }}</p>
                             </td>

                             @include('admin.contactus.modals.details')

                        </tr>

                        @empty
                            <tr>
                                <td colspan="12" class="lead text-muted text-center py-3">No Inquiry yet.</td>
                            </tr>

                        @endforelse
                    </tbody>

                </table>

                <div class="d-flex justify-content-center">
                    {{ $all_inquiries->links() }}
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('js/inquiry-modal.js') }}"></script>




@endsection
@endadmin
