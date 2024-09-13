<link rel="stylesheet" href="{{ asset('css/contactus.css') }}">
{{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
@vite(['resources/js/app.js'])

{{-- inquiry modal --}}
<div class="modal fade" id="ContactUs">
    <div class="modal-dialog modal-lg inquiry-modal">
        <div class="modal-content shadow px-5 py-3">
            
                <div class="modal-header mt-3 mb-4">
                    <h1 class="modal-title">
                            Contact Us
                    </h1>
                </div>

                <div class="modal-body mx-3">
                    <form action="{{ route('inquiry.store') }}" id="inquiry-form" name="inquiry-form">
                    @csrf
                        

                        <div class="mb-4 row">
                            <label for="staticname" class="col-sm-2 col-form-label text-end">Username</label>
                            
                            <div class="col-sm-9 ps-5">
                              <input type="text" readonly class="form-control-plaintext inquiry-modaltext ps-3" id="staticname" value="{{ Auth::user()->name }}">

                              @error('staticname')
                            <div class="text-danger small">{{ $message }}</div>  
                            @enderror
                            </div>
                          </div>

                        <div class="mb-4 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label text-end">Email</label>

                            <div class="col-sm-9 ps-5">
                              <input type="text" readonly class="form-control-plaintext inquiry-modaltext ps-3" id="staticEmail" value="{{ Auth::user()->email }}">

                              @error('staticemail')
                            <div class="text-danger small">{{ $message }}</div>  
                            @enderror
                            </div>
                          </div>

                          <div class="mb-4 row">

                                <label for="staticinquiry" class="col-sm-2 col-form-label text-end">Inquiry</label>
                            
                                <textarea class="col-sm-9 ms-5 form-control-lg border-0 inquiry-frame1 w-75" placeholder="Please Comment here...." name="inquiry" id="inquiry"></textarea>
                                
                                @error('inquiry')
                                <div class="text-danger small">{{ $message }}</div>  
                                @enderror

                            </div>

                        
                        </div>

                        <div class="modal-footer border-0 mx-auto">     
                           
                            <div class="mx-auto">
                                <button type="button" class="btn-cancel me-4" data-bs-dismiss="modal">Cancel</button>
                                
                                <button type="submit" class="btn btn-save" id="contactus-submit-button" ><i class="fa-solid fa-circle-check"></i> Submit</button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
 </div>
 <script src="{{ asset('js/contactus-button.js') }}"></script>

 {{-- <script src="{{ asset('js/inquiry.js') }}"></script> --}}



 



















    