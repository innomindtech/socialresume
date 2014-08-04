$().ready(function() {
	 
 $('#send_to').change(function(){
 
 var group_id = $("#send_to").val();
    $.ajax({
        type: "POST",
        url: BASE_URL+'admin/newsletter/ajaxNewsletter', 
        data:{ group_id: group_id},
        dataType:"json",//return type expected as json
        success: function(states){
               $.each(states,function(key,val){
                    var opt = $('<option />'); 
                    opt.val(key);
                    opt.text(val);
                    $('#states').append(opt);
               });
        },
});
 
 });
 
 });
 