<link rel="stylesheet" href="{{ asset('css/contactus.css') }}">

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
                <div class="row mt-3">
                    <div class="col-7"></div>
                    
                    {{-- search bar --}}
                    <div class="col-1">
               
                        <p class="text-primary mt-1 ">Search</p>
                        </div>

                        
                    <div class="col-3">
                        <form action="{{ route('admin.inquiries') }}" method="get" class="form-inline">
                            @csrf
                            <input type="search" name="keyword" placeholder="keyword....." class="form-control quote-other-btn shadow">
                          
                        </form>
                              
                    </div>


                </div>
                <div>

                    @if ((!empty($keyword)))
                    <span class="pb-0 mb-0 ms-4 me-5 pe-5">Result for : {{ $keyword }}</span>    
                    @endif
                    <p class="pb-0 mb-0 ms-4 me-5 pe-5 mt-0 pt-0">
                        
                        Total : 
                        <span>{{ $inquiries_count->total() }}</span>
                         Inquiries
                    </p>

                    
                    
                </div>

                <table class="table align-middle bg-white quote-table mt-0 table-responsive">
                    <thead class="small table-secondary border">
                        <tr class="">
                            <th class="text-center th-wssmall">#</th>
                            <th class="text-center th-wsmall">Avatar</th>
                            <th class="text-center th-wsmedium">Username</th>
                            {{-- <th class="text-center th-wmedium">Email</th> --}}
                            <th class="text-center th-wlarge">Inquiry</th>
                            <th class="text-center th-wsmedium">Date</th>

                        </tr>

                    </thead>

                    <tbody class="border quote-table">
                        @forelse($all_inquiries as $inquiry)
                        <tr>
                            <td class="th-wssmall text-center">
                                {{ $inquiry->id }}
                            </td>
                            <td class="th-wsmall">
                                @if ($inquiry->user->avatar)
                                <img src="{{ $user->avatar }}" alt="" class="rounded-circle d-block avatar-lg">
                            @else
                            <i class="fa-solid fa-circle-user d-block text-center avatar-lg"></i>
                            @endif
                            </td>
            
                            <td class="text-center th-wsmedium">
                                {{ $inquiry->user->name }}
                            </td>

                            {{-- <td class="text-center">
                                {{ $inquiry->user->email }}
                            </td> --}}

                            <td class="ps-5 text-truncate me-0">
                                <div class="row">
                                    <div class="col-11 w-75 align-items-center text-truncate inquiry-detail-a">
                                    {{ $inquiry->body}}
                                    </div>
                                    <div class="col-2 d-md-flex justify-content-md-end ms-4 ps-4 pe-0 me-0">
                                        <button type="button" class="btn btn-border-none text-decoration-underline td-details" data-bs-toggle="modal" data-bs-target="#inquiryDetail" data-id="{{ $inquiry->id }}" data-username="{{ $inquiry->user->name }}" data-email="{{ $inquiry->user->email }}" data-body="{{ $inquiry->body }}">more <br>details</button>
                                    </div>
                                </div>
                             </td>

                             <td class="text-center td-date">
                                <p class="mb-0 px-0">
                                {{ $inquiry->created_at }}</p>
                             </td>
                             
                             @include('admin.contactus.modals.details')

                        </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="lead text-muted text-center">No Inquiry yet.</td>
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