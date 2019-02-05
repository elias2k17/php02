/*
асинхронно меняем статус у заказов
подсмотрено здесь =)
https://stackoverflow.com/questions/32389767/how-do-i-execute-a-php-query-on-select-option-choice-using-ajax
*/
$(document).ready(function(){
    $(".order_status_list").change(function(){
        var order_id = $(this).attr("order_id");
        var order_status_id = $(this).val();
        var dataString = "order_id="+order_id+"&order_status_id="+order_status_id;

        $.ajax({
            type: "POST",
            url: "/?path=order/update_status",
            data: dataString,
            success: function(result) {
                        alert(result);
                     }
        });
    });
});