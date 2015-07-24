function init_click_handler_view() {
    $('.activity-view-link').click(function () {
        $.get(
                'index.php?r=book/view',
                {
                    id: $(this).closest('tr').data('key')
                },
        function (data) {
            $('#activity-modal').find('.modal-body').html(data);
            $('#activity-modal').modal();
            $("#activity-modal").modal("show");
        }
        );
    });
}
;

init_click_handler_view();
$("#ViewId").on("pjax:success", function () {
    init_click_handler_view();
});
