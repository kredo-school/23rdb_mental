<link rel="stylesheet" href="{{ asset('css/quote_style.css') }}">


{{-- delete --}}

<div class="modal fade" id="delete-quote{{ $quote->id }}">
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

                            
                            <p class="h2 text-center" value="">{{ $quote->quote}}</p>
                            
                            
                            
                            @error('quote')
                            <div class="text-danger small">{{ $message }}</div>  
                            @enderror

                            <hr>

                            <p class="text-end me-5" value="quote text">---- <span>{{ $quote->author }}</span></p>
                            
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