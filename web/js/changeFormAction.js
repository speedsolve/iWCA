/**
 * changeFormAction.js
 * フォームのactionをsubmitボタンで分ける
 **/
$(document).ready(function(){
    $('[action]').click(function(){
        if($(this).attr('action') != ""){
            $('form').attr('action', $(this).attr('action'));
        }
    });
});
