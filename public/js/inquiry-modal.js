$(document).ready(function() {
    $('#inquiryDetail').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var username = button.data('username');
        var email = button.data('email');
        var body = button.data('body');
        var id = button.data('id');
        
        var modal = $(this);
        modal.find('#modal-username').text(username);
        modal.find('#modal-email').text(email);
        modal.find('#modal-body').text(body);
        modal.find('#modal-id').text(id);
    });
});