<div class="modal fade" id="edit-post-{{ $journal->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="h5 modal-title">
                    Edit Journaling
                </h3>
            </div>
            <form action="{{ route('journal.update', $journal->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mt-3">
                        <input type="text" name="journal_body" id="journal_body_edit_{{ $journal->id }}" class="form-control rounded-3" placeholder="What's on your mind?" value="{{ $journal->body }}">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-save">
                        <i class="fa-solid fa-circle-check"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>