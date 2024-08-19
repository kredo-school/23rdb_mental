<link rel="stylesheet" href="{{ asset('css/contactus.css') }}">


{{-- inquiry modal --}}
<div class="modal fade" id="inquiryDetail">
    <div class="modal-dialog modal-lg inquiry-modal">
        <div class="modal-content shadow px-5 py-3">
            
                <div class="modal-header mt-3 mb-4">
                    <h2 class="modal-title">
                            Details
                    </h2>
                </div>

                <div class="modal-body mx-3">
                    <form action="" method="post">
                    @csrf
                        

                        <div class="mb-3 row">
                            <label for="staticname" class="col-sm-2 col-form-label text-end">Username</label>
                            
                            <div class="col-sm-10 ps-5">
                              <input type="text" readonly class="form-control-plaintext" id="staticname" value="{{ $inquiry->user_id }}">

                              @error('staticname')
                            <div class="text-danger small">{{ $message }}</div>  
                            @enderror
                            </div>
                          </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label text-end">Email</label>

                            <div class="col-sm-10 ps-5">
                              <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $inquiry->user_id}}">

                              @error('staticemail')
                            <div class="text-danger small">{{ $message }}</div>  
                            @enderror
                            </div>
                          </div>

                          <div class="mb-3 row">

                                <label for="staticinquiry" class="col-sm-2 col-form-label text-end">Inquiry</label>
                            
                                <textarea class="col-sm-10 ms-5 form-control-lg border-0 inquiry-frame1 w-75" name="inquiry" id="inquiry">{{ $inquiry->body }}</textarea>
                                
                                @error('inquiry')
                                <div class="text-danger small">{{ $message }}</div>  
                                @enderror

                            </div>

                        
                        </div>

                        <div class="modal-footer border-0 mx-auto">     
                           
                            <div class="mx-auto">
                                <button type="button" class="btn-cancel me-4" data-bs-dismiss="modal">Go Back</button>
                                
                            
                            </div>
                        </div>
                    </form>
        </div>
    </div>
 </div>

 




    