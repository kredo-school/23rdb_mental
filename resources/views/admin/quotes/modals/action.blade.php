<link rel="stylesheet" href="{{ asset('css/quote_style.css') }}">


{{-- create new quote --}}
<div class="modal fade" id="create-quote">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow px-5 py-3">
            
                    <div class="modal-header quote-modal border-0 mt-3 mb-4">
                        <h1 class="modal-title">
                            Create New Quote
                        </h1>
                    </div>

                    <div class="modal-body">
                        <p class="h3">
                            Type a quote

                            {{-- picture --}}
                            <i class="fa-regular fa-image quote-box-icon"></i>
                          
                        </p>

                        <form action="{{ route('quote.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="form-floating modal-framebase">
                           

                            <textarea class="form-control-lg w-100 border-0 quote-frame1" placeholder="Quote here...." name="quote" id="quote" value="{{ old('quote') }}"></textarea>
                            
                            @error('quote')
                            <div class="text-danger small">{{ $message }}</div>  
                            @enderror

                            <hr>

                            <textarea class="form-control-lg w-100 border-0 quote-frame2" placeholder="Author (*optional)"
                             name="author" id="author" value="{{ old('author') }}"></textarea>
                            
                            @error('author')
                            <div class="text-danger small">{{ $message }}</div>  
                            @enderror
                            {{-- <input type="text" class="form-control border-0 mt-0" id="author" placeholder="Author"> --}}
                            
                        </div>
                        
                    </div>

                    <div class="modal-footer border-0 mx-auto">     
                           
                            <div class="mx-auto">
                                <button type="button" class="btn-cancel me-4" data-bs-dismiss="modal">Cancel</button>
                                
                                <button type="submit" class="btn-save"><i class="fa-solid fa-circle-check"></i> Save</button>
                            </div>
                    </div>
            </form>
        </div>
    </div>
 </div>

{{-- edit modal --}}

 <div class="modal fade" id="edit-quote">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow px-5 py-3">
                    <div class="modal-header quote-modal border-0 mt-3 mb-4">
                        <h1 class="modal-title">
                            Edit the Quote
                        </h1>
                    </div>

                    <div class="modal-body">
                        <p class="h3">
                            Edit
                        
                            <i class="fa-regular fa-image quote-box-icon"></i>
                          
                        </p>

                        <div class="form-floating modal-framebase">
                           

                            <input type="text" class="form-control-lg w-100 border-0 quote-frame1" name="edit_quotebody" value="{{ old('quote') }}" id="modal-quote"></input>
                            
                            @error('quote')
                            <div class="text-danger small">{{ $message }}</div>  
                            @enderror

                            <hr>

                            <textarea class="form-control-lg w-100 border-0 quote-frame2" name="author" id="author" value="{{ old('author') }}"></textarea>
                            
                            @error('author')
                            <div class="text-danger small">{{ $message }}</div>  
                            @enderror
                            {{-- <input type="text" class="form-control border-0 mt-0" id="author" placeholder="Author"> --}}
                            
                        </div>
                        
                        
                        
                        
                        
                    </div>
                    <div class="modal-footer border-0  mx-auto">
                        <form action=""  method="post" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf


                            <div class="mx-auto">
                                <button type="button" class="btn-cancel me-4" data-bs-dismiss="modal"> Cancel </button>
                                
                                <button type="submit" class="btn-save"><i class="fa-solid fa-circle-check"></i> Save</button>
                            </div>
                         
                        </form>
                    </div>
        </div>
    </div>
 </div>


{{-- delete --}}

    <div class="modal fade" id="delete-quote">
        <div class="modal-dialog modal-lg">
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
                                    <span class="fw-bold ps-4 pe-0 fs-2">"</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="fw-bold pe-4 fs-2">"</span>
                                </div>
                            </div>


                            
                            <div class="form-floating mx-5">

                                
                                <p class="h2 text-center" value="{{ old('quote') }}">
                                   
                                    quote </p>
                                
                                
                                
                                @error('quote')
                                <div class="text-danger small">{{ $message }}</div>  
                                @enderror
    
                                <hr>
    
                                <p class="text-end me-5 bg-info" value="quote text">---- <span>Author</span></p>
                                
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
        </div>
     </div>
    