<link rel="stylesheet" href="{{ asset('css/chats.css') }}">

 <div class="modal fade" id="edit-chat-{{ $chat->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow px-5 py-3">
            <div class="modal-header chats-modal border-0 mt-3 mb-4">
                <h1 class="modal-title">
                    Edit the Chat
                </h1>
            </div>
            <div class="modal-body">
                <p class="h3">
                    Edit
                    <i class="fa-regular fa-image chats-box-icon"></i>
                </p>
                <div class="form-floating modal-framebase">
                    <textarea class="form-control-lg w-100 border-0 chats-frame1" name="chats" id="chats" value="{{ $chat->body }}"></textarea>
                    @error('chats')
                    <div class="text-danger small">{{ $message }}</div>  
                    @enderror
                </div>
            </div>
            <div class="modal-footer border-0  mx-auto">
                <form action="{{ route('admin.chats.update', $chat->id) }}"  method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="mx-auto">
                        <button type="button" class="btn-cancel me-4" data-bs-dismiss="modal"> Cancel </button>
                        
                        <button type="submit" class="btn-save"><i class="fa-solid fa-circle-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>