$('.activity-view-link').click(function() {
    $.get(
        'index.php?r=book/view',         
        {
            id: $(this).closest('tr').data('key')
        },
        function (data) {
            $('.modal-body').html(data);
            $('#activity-modal').modal();
        }  
    );
});