<div class="modal fade" id="delete-post-{{ $journal->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title">
                    Delete Journaling
                </h3>
            </div>
            <form action="{{ route('journal.destroy', $journal->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete this journaling?</p>
                    <div class="mt-3">
                        <input type="text" name="journal_body" id="journal_body" class="form-control-plaintext rounded-3" placeholder="What's on your mind?" value="{{ $journal->body }}">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-delete">
                        <i class="fa-solid fa-trash-can"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>