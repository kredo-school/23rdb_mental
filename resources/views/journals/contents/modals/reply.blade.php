<div class="modal fade" id="reply-post-{{ $journal->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="h5 modal-title">
                    Reply Journaling
                </h3>
            </div>
            <form action="{{ route('journal.reply', $journal->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mt-3">
                        <input type="text" name="journal_body" id="journal_body" class="form-control-plaintext rounded-3" placeholder="What's on your mind?" value="{{ $journal->body }}">
                    </div>
                    <div class="mt-3">
                        <input type="text" name="journal_reply" id="journal_reply_{{ $journal->id }}" class="form-control rounded-3" placeholder="reply" value="">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-save">
                        <i class="fa-solid fa-circle-check"></i> Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>