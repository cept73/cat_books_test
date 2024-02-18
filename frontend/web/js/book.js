
function subscribe(authorId, buttonObject)
{
    var phone = parseInt(
        $(buttonObject).parent().parent().find('[name=phone]').val()
    );

    $.ajax({
        url: '/ajax/subscribe',
        type: 'POST',
        dataType: 'json',
        data: {author_id: authorId, phone: phone},
        success: function (data) {
            // Hide modal
            var modalElement = document.getElementById('subscribeAuthor' + authorId);
            var modal = bootstrap.Modal.getInstance(modalElement);
            modal.hide();

            if (data.status !== 'ok') {
                return;
            }

            // Show toast
            var toastElement = document.getElementById('toastSubscribeSuccessful');
            var toast = new bootstrap.Toast(toastElement, {'delay': 3000})
            toast.show();
        }
    });
}
