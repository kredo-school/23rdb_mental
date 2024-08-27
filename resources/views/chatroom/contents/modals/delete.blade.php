<div class="modal fade" id="delete-chat-{{ $chat->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title">
                    Delete Journaling
                </h3>
            </div>
            <form action="{{ route('chatroom.destroy', $chat->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete this chat?</p>
                    <div class="mt-3">
                        <input type="text" name="chat_body" id="chat_body" class="form-control-plaintext rounded-3" placeholder="What's on your mind?" value="{{ $chat->body }}">
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