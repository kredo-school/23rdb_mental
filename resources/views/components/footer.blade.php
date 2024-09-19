<link rel="stylesheet" href="{{ asset('css/footer.css') }}">

{{-- <footer>
        <div class="d-md-flex justify-content-md-end align-items-center p-3">
                <p class="copyright me-4 mt-3">MEntal copyright 2024 Designed and built by Kred 23rd Batch B</p>
                <a href="#" class="faq me-4">FAQ</a>
                <button class="btn-contact me-2" data-bs-toggle="modal" data-bs-target="#ContactUs">Contact Us</button>
        </div>    
</footer> --}}

<footer class="footer d-flex justify-content-md-end align-items-center p-3">
    <div class="footer_container">
      <a href="{{ url('faq') }}" class="faq me-4">FAQ</a>
      <button class="btn-contact me-2" data-bs-toggle="modal" data-bs-target="#ContactUs">Contact Us</button>
    </div>
</footer>

    @include('contactus.modals.inquiry')
    @include('contactus.modals.submitcomplete')
