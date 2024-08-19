<link rel="stylesheet" href="{{ asset('css/contactus.css') }}">
{{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
@vite(['resources/js/app.js'])

{{-- inquiry modal --}}
<div class="modal fade" id="ContactUs">
    <div class="modal-dialog modal-lg bg-info inquiry-modal">
        <div class="modal-content shadow px-5 py-3">
            
                <div class="modal-header mt-3 mb-4">
                    <h1 class="modal-title">
                            Contact Us
                    </h1>
                </div>

                <div class="modal-body mx-3">
                    <form action="#" id="inquiry-form" name="inquiry-form">
                    @csrf
                        

                        <div class="mb-3 row">
                            <label for="staticname" class="col-sm-2 col-form-label text-end">Username</label>
                            
                            <div class="col-sm-10 ps-5">
                              <input type="text" readonly class="form-control-plaintext" id="staticname" value="">

                              @error('staticname')
                            <div class="text-danger small">{{ $message }}</div>  
                            @enderror
                            </div>
                          </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label text-end">Email</label>

                            <div class="col-sm-10 ps-5">
                              <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="">

                              @error('staticemail')
                            <div class="text-danger small">{{ $message }}</div>  
                            @enderror
                            </div>
                          </div>

                          <div class="mb-3 row">

                                <label for="staticinquiry" class="col-sm-2 col-form-label text-end">Inquiry</label>
                            
                                <textarea class="col-sm-10 ms-5 form-control-lg border-0 inquiry-frame1 w-75" placeholder="Comments here...." name="inquiry" id="inquiry"></textarea>
                                
                                @error('inquiry')
                                <div class="text-danger small">{{ $message }}</div>  
                                @enderror

                            </div>

                        
                        </div>

                        <div class="modal-footer border-0 mx-auto">     
                           
                            <div class="mx-auto">
                                <button type="button" class="btn-cancel me-4" data-bs-dismiss="modal">Cancel</button>
                                
                                <button type="submit" class="btn btn-save"><i class="fa-solid fa-circle-check"></i> Submit</button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
 </div>



 

 <!-- Thank You Modal -->
 {{-- <div class="modal fade" id="thankYouModal" tabindex="-1" role="dialog" aria-labelledby="thankYouModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="thankYouModalLabel">Thank You!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <p>Thank you for submitting the form.</p>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- jQuery and Bootstrap JS -->
{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
<!-- JavaScript for handling form submission and modal -->
{{-- <script> $(document).ready(function() { $('#modalForm').on('submit', function(event) { event.preventDefault();  --}}
{{-- // Prevent the default form submission $.ajax({ url: $(this).attr('action'), method: 'POST', data: $(this).serialize(), success: function(response) { if (response.success) { $('#exampleModal').modal('hide'); 
// Hide the form modal $('#thankYouModal').modal('show'); 
// Show the thank you modal } }, error: function(xhr) { 
// Handle errors if necessary console.error('Form submission failed.'); } }); }); });  --}}
{{-- // </script> --}}


















    