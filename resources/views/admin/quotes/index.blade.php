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
                    
                    {{-- sort area --}}
                    <div class="col-1">
                    <p class="text-primary text-end mt-1">Sort</p>
                    </div>


                    <div class="col-3">
                        <form method="post" action="{{ route('quote.index') }}" class="form-inline">
                            @csrf
                                <select name="sort" class="text-decoration-none text-muted quote-other-btn w-75">
                                    <option value="asc">latest</option>
                                    <option value="desc">Oldest</option>
                                    <option value="hide">Hidden</option>
                                </select>
                        </form>
{{-- 
                           <button class="btn dropdown-toggle btn-link text-decoration-none text-muted quote-other-btn w-75" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownMenuButton">Latest
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"> --}}
                              {{-- <a class="dropdown-item" href="#">latest</a> --}}
                              {{-- <li class="dropdown-item" href="#">Oldest</li>
                              <li class="dropdown-item" href="#">Bookmarked</li>
                              <li class="dropdown-item" href="#">Hidden</li>
                            </ul> --}}
                       

                    </div>

                    <div class="col-1">
                        <p class="text-primary mt-1">Search</p>
                        </div>

                    
                        <div class="col-3">
                            <form action="{{ route('quote.index') }}" method="get" class="form-inline">
                                @csrf
                                <input type="search" name="keyword" placeholder="keyword....." class="form-control quote-other-btn">
                              
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
                    @if ((!empty($keyword)))
                    <span class="pb-0 mb-0 ms-4 me-5 pe-5">Result for : {{ $keyword }}</span>    
                    @endif
                    <p class="pb-0 mb-0 ms-4 me-5 pe-5 mt-0 pt-0">
                        
                        Total : 
                        <span>{{ $quotes_count->total() }}</span>
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
                            <td class="h2 text-center w-50" value="showquote-quote">
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
                                    
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-quote{{ $quote->id }}">
                                        <i class="fa-regular fa-pen-to-square pe-3 quote-edit-icon"></i>
                                    </button>

                                </div>
                                    {{-- edit modal --}}
                                <div class="modal fade" id="edit-quote{{ $quote->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content shadow px-5 py-3">
                                            <form action="{{ route('quote.update', $quote->id) }}"  method="post" enctype="multipart/form-data">
                                                @method('PATCH')
                                                @csrf 
                                                    <div class="modal-header quote-modal border-0 mt-3 mb-4">
                                                        <h1 class="modal-title">
                                                            Edit the Quote
                                                        </h1>
                                                    </div>
                                
                                                    <div class="modal-body">
                                                      
                                
                                                        <div class="form-floating modal-framebase">
                                                           
                                
                                                            <input type="text" class="form-control-lg w-100 border-0 quote-frame1" name="quote" value="{{ $quote->quote }}" id="quote"></input>
                                                            
                                                            @error('quote')
                                                            <div class="text-danger small">{{ $message }}</div>  
                                                            @enderror
                                
                                                            <hr>
                                
                                                            <input type="text" class="form-control-lg w-100 border-0 quote-frame2" name="author" id="author" value="{{ $quote->author }}"></input>
                                                            
                                                            @error('author')
                                                            <div class="text-danger small">{{ $message }}</div>  
                                                            @enderror
                                                            {{-- <input type="text" class="form-control border-0 mt-0" id="author" placeholder="Author"> --}}
                                                            
                                                        </div>
                                                        
                                                        
                                                        
                                                    </div>
                                                    <div class="modal-footer border-0  mx-auto">
                                
                                                            <div class="mx-auto">
                                                                <button type="button" class="btn-cancel me-4" data-bs-dismiss="modal"> Cancel </button>
                                                                
                                                                <button type="submit" class="btn-save"><i class="fa-solid fa-circle-check"></i> Save</button>
                                                            </div>
                                                        
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                 </div>
                                

                                {{-- status --}}

                               
                                
                                <div class="form-check form-switch form-check-inline quote-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Hide</label>

                                    <div class="dropdown">

                                        <button class="btn btn-sm" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
            
                                    <div>
                                        @if ($quote->trashed())
                                        
                                            <form action="{{ route('quote.unhide', $quote->id) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-primary btn-sm">Unhide</button>
                                            </form>
                                        @else
                                        

                                            <form action="{{ route('quote.hide', $quote->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hide</button>
                                            </form>
                                            
                                        @endif
                                        
                                    </div>
                                    </div>


                                </div>

                                {{-- delete  --}}

                                <div class="quote-switch">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-quote{{ $quote->id }}">
                                        <i class="fa-solid fa-trash quote-delete-icon"></i>
                                    </button>
                                </div>
                                
                                {{-- delete modal --}}

                                <div class="modal fade" id="delete-quote{{ $quote->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <form action="{{ route('quote.destroy', $quote->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        <div class="modal-content shadow px-5 py-3">
                                                    <div class="modal-header quote-modal border-0 mt-3 mb-2">
                                                        <h1 class="modal-title">
                                                            Delete the Quote
                                                        </h1>
                                                    </div>
                                
                                                    <div class="modal-body">
                                                        <p class="mb-4 h3">
                                                            Are you sure you want to delete this quote ? 
                                                        </p>
                                                        
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <span class="fw-bold fs-2">"</span>
                                                            </div>
                                                            <div class="col-6 text-end">
                                                                <span class="fw-bold pe-4 fs-2">"</span>
                                                            </div>
                                                        </div>
                            
                            
                                                        
                                                        <div class="form-floating mx-5">
                            
                                                            
                                                            <p class="h2 text-center" value="">
                                                               {{ $quote->quote }}
                                                                 </p>
                                                            
                                                            
                                                            
                                                            @error('quote')
                                                            <div class="text-danger small">{{ $message }}</div>  
                                                            @enderror
                                
                                                            <hr>
                                
                                                            <p class="text-end me-5 bg-info" value="quote_author">---- <span>{{ $quote->author }}</span></p>
                                                            
                                                            @error('author')
                                                            <div class="text-danger small">{{ $message }}</div>  
                                                            @enderror
                                                            {{-- <input type="text" class="form-control border-0 mt-0" id="author" placeholder="Author"> --}}
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer border-0  mx-auto">
                                                        <form action="" method="post">
                                                            @csrf
                                                            
                                                            <div class="mb-2">
                                                                <button type="button" class="btn btn-cancel me-4" data-bs-dismiss="modal"> Cancel </button>
                                                                <button class="btn btn-delete">
                                                                    <i class="fa-solid fa-trash-can"></i> 
                                                                    Delete</button>
                                                                
                                                            </div>
                                                        </form>
                                                    </div>
                                        </div>
                                        </form>
                                    </div>
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


    <script src="{{ asset('js/quote-editmodal.js') }}"></script>
    
</body>



@endsection