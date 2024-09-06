<link rel="stylesheet" href="{{ asset('css/contactus.css') }}">


{{-- inquiry modal --}}
<div class="modal fade" id="inquiryDetail">
    <div class="modal-dialog modal-lg inquiry-modal">
        <div class="modal-content shadow ps-5 py-3 pe-3">
            
                <div class="modal-header mt-3 mb-4">
                    <h2 class="modal-title">
                        Details - Quote # 
                        <p id="modal-id" class="d-inline"></p>
                    </h2>
                </div>

                <div class="modal-body mx-3">
                    <form action="" method="post">
                    @csrf
                        

                        <div class="mb-3 row">
                            <label for="staticname" class="col-sm-3 col-form-label text-end">Username</label>
                            
                            <div class="col-sm-9 ps-5 mt-1">
                                <p class="ms-2 fw-bold" readonly class="form-control-plaintext" id="modal-username"></p>


                              @error('modal-username')
                            <div class="text-danger small">{{ $message }}</div>  
                            @enderror
                            </div>
                          </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label text-end">Email</label>

                            <div class="col-sm-9 ps-5 mt-1">
                                <p class="ms-2 fw-bold" readonly class="form-control-plaintext" id="modal-email"></p>
  

                              @error('modal-email')
                            <div class="text-danger small">{{ $message }}</div>  
                            @enderror
                            </div>
                          </div>

                          <div class="mb-3 row">

                                <label for="staticinquiry" class="col-sm-3 col-form-label text-end">Inquiry</label>
                                <div class="col-sm-9 ps-5">
                                <p class="ms-2 form-control-lg border-0 inquiry-frame1 w-100 form-control-plaintext td-text fw-bold" id="modal-body"></p>

                                
                                @error('modal-body')
                                <div class="text-danger small">{{ $message }}</div>  
                                @enderror
                            </div>
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

 




    