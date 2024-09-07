<link rel="stylesheet" href="{{ asset('css/footer.css') }}">

<footer class="bg-footer fixed-bottom">
    <div class="footer-content"> 
        <div class="d-md-flex justify-content-end align-items-md-end p-3">
            <div class="fs-6 text-dark me-4">MEntal copyright 2024 Designed and built by Kred 23rd Batch B</div>
            <button class="btn-contact" data-bs-toggle="modal" data-bs-target="#ContactUs">Contact Us</button>
        </div>
    </div>
</footer>

@include('contactus.modals.inquiry')
@include('contactus.modals.submitcomplete')
