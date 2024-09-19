<link rel="stylesheet" href="{{ asset('css/contactus.css') }}">

{{-- inquiry complete  modal --}}
<div class="modal fade" id="completeInquiry" tabindex="-1" role="dialog" aria-labelledby="thankYouModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow px-5 py-3">
            
                <div class="modal-header mt-3 mb-4 border-0 complete-modal-header"> 

                    {{-- <div class="justify-content-end w-100">
                        <button type="button" class="btn text-decoration-none complete-modal-xmark" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                    </div>  --}}
                    
                </div>

                <div class="modal-body mx-3">
                    <div class="text-center mb-5">
                        <img src="{{ asset('images/main/remichan.png') }}" style="width: 300px" alt="logo">
                    </div>

                    <div class="text-center lh-sm">
                        <h2 class="mb-4">Your inquiry has been submitted !</h2>
                        <p>Inquiry received. We will process it promptly as soon as possible.</p>
                        <p>and we'll contact you for further details.</p>

                    </div>
                </div>

                <div class="modal-footer border-0 mx-auto mt-5">     
                           
                            <div class="mx-auto">
                                
                                <button class="btn-home" data-bs-dismiss="modal">Close</button>
                            </div>
                </div>
            
        </div>
    </div>
 </div>




    