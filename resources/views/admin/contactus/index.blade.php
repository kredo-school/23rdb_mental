<link rel="stylesheet" href="{{ asset('css/contactus.css') }}">

@extends('layouts.app')

@section('title', 'Admin: Inquiry')

@section('content')



<body class="">

    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-2 bg-warning">
                <p></p>
                
            </div>


            <div class="col-10 py-4 inquiry-body-size">
                <div class="row mt-3">
                    <div class="col-7"></div>
                    

                    <div class="col-1">
                        <p class="text-primary mt-1">Search</p>
                        </div>

                    <div class="col-3">
                        <form action="" method="get" class="input-group">
                            <input type="text" class="form-control form-inline quote-other-btn w-75 shadow" name="search" placeholder="keywords"> 
                            <span class="input-group-text quote-other-btn"><i class="fa-solid fa-magnifying-glass"></i></span>
                        {{-- value="{{ $search}}" --}}
                            {{-- @if($search)
                            @endif --}}
                        </form>
                          
                    </div>


                </div>
                <div>
                    <p class="pb-0 mb-0 ms-4">
                        Total : 
                        <span>{{ $inquiries_count->count() }}</span>
                         Inquiries
                    </p>
                </div>

                <table class="table align-middle bg-white quote-table mt-0">
                    <thead class="small table-secondary border">
                        <tr class="">
                            <th class="text-center th-wssmall">#</th>
                            <th class="text-center th-wsmall">Avatar</th>
                            <th class="text-center th-wsmedium">Username</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Inquiry</th>
                            <th class="text-center">Date</th>
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
                                <img src="{{ $user->avatar }}" alt="" class="rounded-circle d-block mx-auto avatar-lg">
                            @else
                                <i class="fa-solid fa-circle-user d-block text-center icon-md"></i>
                            @endif
                            </td>
            
                            <td class="text-center th-wsmedium">
                                {{ $inquiry->user->name }}
                            </td>

                            <td class="text-center">
                                {{ $inquiry->user->email }}
                            </td>

                            <td class="w-100 px-2">
                                <a href="" class="text-decoration-none inquiry-detail-a text-truncate" data-bs-toggle="modal" data-bs-target="#inquiryDetail">{{ $inquiry->body }}</a>
                             </td>

                             <td class="text-center">
                                {{ $inquiry->created_at }}
                             </td>

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

    @include('admin.contactus.modals.details')




    
</body>



@endsection