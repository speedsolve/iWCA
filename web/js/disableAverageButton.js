/**
 * hideAverageButton
 * average記録のない時ボタンを隠す
 */
$(document).ready(function(){
   $('#event').change(function() {
       if($(this).val() == '333bf'||$(this).val() == '333fm'||$(this).val() == '444bf'||$(this).val() == '555bf'||$(this).val() == '333mbf'){
          $('.average').button('disable');
       } else {
          $('.average').button('enable');
       }
   });
});
