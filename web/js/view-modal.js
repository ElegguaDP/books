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

init_click_handlers(); //first run
$().on("pjax:success", function() {
  init_click_handlers(); //reactivate links in grid after pjax update
});