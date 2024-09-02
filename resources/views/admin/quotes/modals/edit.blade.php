<link rel="stylesheet" href="{{ asset('css/quote_style.css') }}">

{{-- edit modal --}}

<div class="modal fade" id="edit-quote-{{ $quote->id }}">
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
 

