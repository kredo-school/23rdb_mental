<div class="modal fade" id="edit-username-{{ Auth::user()->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="h5 modal-title">
                    Edit Username
                </h3>
            </div>
            <form action="{{ route('chat.update.username', Auth::user()->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mt-3">
                        <input type="text" name="chat_username" id="chat_username" class="form-control rounded-3" placeholder="Username in chat" value="{{ Auth::user()->username }}">
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