<link rel="stylesheet" href="{{ asset('css/quote_style.css') }}">

@extends('layouts.app')

@extends('components.navbar-each')

@section('title', 'Admin: Quotes')

@section('content')
@if(Auth::user()->role_id == 1)
    @include('components.sidebar-admin')
@else
    @include('components.sidebar')
@endif



<body class="">

    <div class="container-fluid">
        <div class="row justify-content-center">
{{-- side bar space --}}
            <div class="col-2">
            
            </div>

{{-- body space --}}
            <div class="col-10 mt-5 quote-body-size">
                {{-- div for head space --}}
                <div class="row mx-5 my-4"> 
                  
                    <div class="col-9">
                        {{-- div for sort and search section --}}
                        <div class="row bg-white rounded ps-5">
                         
                                
                                {{-- sort area --}}
                                <div class="col-1 pt-3 ms-3">
                                    <p class="text-primary text-end mt-1">Sort</p>
                                </div>


                                <div class="col-4 pt-3">
                                    
                                            <form method="get" action="{{ route('quote.index') }}">
                                                <div class="form-group">
                                                    <select name="sort" id="sort" class="form-select text-decoration-none text-muted quote-other-btn pb-1 shadow" onchange="this.form.submit()">
                                                        <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest
                                                        </option>
                                                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest
                                                        </option>
                                                    </select>
                                                </div>
                                            </form>


                                </div>

                                <div class="col-auto pt-3">
                                    <p class="text-primary mt-1 pe-0">Search</p>
                                </div>
                                <div class="col-auto search_box pt-3">
                                    <form action="{{ route('quote.index') }}" method="get" class="form-inline">
                                        @csrf
                                        {{-- <input type="search" name="search" placeholder="&#xf002; search..." class="form-control shadow quote-other-btn search_box" value="{{ $search }}"> --}}
                                        <input type="search" name="search" placeholder="search..." class="form-control shadow quote-other-btn" value="{{ $search }}">
                                    </form>
                                </div> 
                            </div>
                        </div>
                          

                    <div class="col-3">

                        <div class="row px-5">
                        {{-- create a new quote button --}}
                                <div class="col-2  pt-3  ps-0" style="padding-right: 20px">
                                    <button type="button" class="btn-submit" data-bs-toggle="modal" data-bs-target="#create-quote">
                                        <i class="fa-solid fa-circle-check"></i> Add quote
                                    </button>
            
                                </div>

                        @include('admin.quotes.modals.action')

                        </div>
                    </div>

                </div>
                <div>
        
                    @if($search)
                    <span class="pb-0 mb-0 ms-4 me-5 pe-5">Result for : {{ $search }}</span>    
                    @endif
                    <p class="pb-0 mb-0 ms-4 me-5 pe-5 mt-0 pt-0">
                        
                        Total : 
                        <span>{{ $quotes_count->total() }}</span>
                         Quotes
                    </p>
                </div>

                <table class="table align-middle bg-white quote-table mt-0 shadow">
                    <thead class="small table-secondary border">
                        <tr class="">
                            
                            <th colspan=6 class="text-center">Quote</th>
                            <th colspan=3 class="text-center">Auther</th>
                            <th colspan=3 class="text-center">Display</th>
                        </tr>

                    </thead>
                {{-- body --}}
                    <tbody class="border quote-table">
                        @forelse($all_quotes as $quote)
                        <tr>
   
                            <td colspan=6 class="h3 text-center px-5" value="showquote-quote">
                               " {{ $quote->quote }} " 
                            </td>

                            <td colspan=3 class="text-center px-3">
                                {{ $quote->author }}
                            </td>

                            <td colspan=3 class="text-center pt-2 ps-4 pe-0">
                                <div class="row">
                                {{-- cancel the bookmark --}}
                                {{-- <div class="col-2 quote-switch text-center form-group mt-3">
                                    @if ($quote->isBookmarked())
                                    <form action="{{ route('bookmark.destroy', $quote->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn px-0 pt-0">
                                            <i class="fa-solid fa-bookmark quote-bookmark-store"></i></button> 
                                    </form>
                                        
                                    @else

                                    <form action="{{ route('bookmark.store', $quote->id) }}" method="post">
                                        @csrf
                                            <button type="submit" class="btn px-0 pt-0"><i class="fa-regular fa-bookmark quote-bookmark-cancel"></i></button>
                                    </form>
                                        
                                    @endif
                                </div> --}}

                                {{-- edit icon --}}
                                <div class='quote-switch col-2 mt-2 pt-1 ms-4 mb-2'>
                                    
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-quote-{{ $quote->id }}">
                                        <i class="fa-regular fa-pen-to-square quote-edit-icon"></i>
                                    </button>
                                    
                                </div>
                                @include('admin.quotes.modals.edit')

                                  

                                {{-- status --}}

                                <div class="quote-switch col-5 mx-0 mt-3 pt-2">
                                    {{-- <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Hide</label> --}}

                                    {{-- <div class="dropdown"> --}}

                                        {{-- <button class="btn btn-sm" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button> --}}
            
                                        @if ($quote -> trashed())
                                        
                                            <form action="{{ route('quote.unhide', $quote->id) }}" method="post" class="switch_label">
                                                @csrf
                                                @method('PATCH')
                                                
                                                <button type="submit" class="btn btn-sm switch base unhide-switch">
                                                    <span class="circle"></span>
                                                    Unhide
                                                </button>
                                            </form>
                                        @else
                                
                                            <form action="{{ route('quote.hide', $quote->id) }}" method="post" class="switch_label">
                                                @csrf
                                                @method('DELETE')
                                                
                                                <button type="submit" class="btn btn-sm switch base hide-switch">
                                                    {{-- <span class="base"></span> --}}
                                                    <span class="circle circle-move px-2"></span>
                                                     Hide 
                                                </button>
                                            </form>
                                            
                                        @endif



                                        {{-- <div class="form-check form-switch form-check-inline quote-switch">
                                        @if ($quote->trashed())
                                        
                                        <form action="{{ route('quote.unhide', $quote->id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="checkbox" class="btn btn-secondary btn-sm form-check-input" style="width:100px" role="switch">Unhide</input>
                                            
                                        </form>
                                    @else
                                    

                                        <form action="{{ route('quote.hide', $quote->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="checkbox" class="btn btn-primary btn-sm form-check-input" style="width:100px;" role="switch" checked>Hide</input>
                                        </form>
                                        
                                    @endif
                                         --}}
                            
                                    


                                </div>

                                {{-- delete  --}}

                                <div class="quote-switch col-1 mt-2 pt-1 me-0 mb-2">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-quote{{ $quote->id }}">
                                        <i class="fa-solid fa-trash quote-delete-icon"></i>
                                    </button>
                                </div>
                                
                               
                                 </div>
                                 @include('admin.quotes.modals.delete')
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
                @include('admin.quotes.modals.action')
            </div>
        </div>
    </div>


    <script src="{{ asset('js/quote-editmodal.js') }}"></script>
    
</body>



@endsection