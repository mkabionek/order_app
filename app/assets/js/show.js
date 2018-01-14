var loadBtn = $('#load-note');
var saveBtn = $('#save-note');
var noteField = $('#note');
var noteBlock = $('#mod-div');

var showDiv = $('.thumbnail.show');
var element = showDiv.children()[0];
if(element.tagName === "H2"){
    showDiv.addClass('empty')
}


loadBtn.click(function (e) {
    noteBlock.toggleClass('hidden');
    var order_id = $('#order-id').val();
    $.ajax({
        type: "POST",
        url: '/order/getnote',
        data: {
            'order_id': order_id
        },
        success: function (e) {
            if (e === 'Error') {
                //
            }else {
                var note = JSON.parse(e);
                noteField.val(note.modification);
            }
        }
    });
})

saveBtn.click(function (e) {
    var order_id = $('#order-id').val();
    var note = $('#note').val();
    $.ajax({
        type: "POST",
        url: '/order/updatenote',
        data: {
            'order_id': order_id,
            'note': note
        },
        success: function (e) {
            console.log(e)
        }
    });
})


$("#accept-btn").on("click", function(){
    var order_id = $("#order-id").val();

    $("#accept-btn").fadeOut(800, function(){
        $("#accept-btn").remove();
    });

    console.log(order_id);

    $.ajax({
        type: "POST",
        url: '/order/accept',
        data: {
            'order_id': order_id
        },
        success: function (e) {
            console.log(e)
        }
    });
});
