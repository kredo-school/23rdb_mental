$(document).ready(function() {
    $('#edit-quote').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
      
        var quote= button.data('quote');
        var author = button.data('author');
        var id = button.data('id');
        
        var modal = $(this);
        modal.find('#modal-quote').text(quote);
        modal.find('#modal-author').text(author);
        modal.find('#modal-id').text(id);
    });
});