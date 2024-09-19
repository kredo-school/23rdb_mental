<div class="modal fade" id="add-post">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header border-0">
                <h3 class="h1 modal-title">
                    Add Journaling
                </h3>
            </div>
            <form action="{{ route('journal.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mt-3">
                        {{-- <input type="text" name="journal_body" id="journal_body_add" class="form-control rounded-3" placeholder="What's on your mind?" value=""> --}}
                        <textarea name="journal_body" id="journal_body_add" class="form-control rounded-3" placeholder="What's on your mind?" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-save ms-2">
                        <i class="fa-solid fa-circle-check"></i> Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>