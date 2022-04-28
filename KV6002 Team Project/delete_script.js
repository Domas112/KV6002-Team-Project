$(document).ready(function(){
 
	$('#btn_delete').click(function(){
	 
	 if(confirm("Are you sure you want to delete this?"))
	 {
	  var pay_id = [];
	  
	  $(':checkbox:checked').each(function(i){
	   pay_id[i] = $(this).val();
	  });
	  
	  if(pay_id.length === 0) //tell you if the array is empty
	  {
	   alert("Please Select atleast one checkbox");
	  }
	  else{
	   $.ajax({
		url:'http://unn-w19030982.newnumyspace.co.uk/kv6002/payment/delete_action.php',
		method:'POST',
		data:{pay_id:pay_id},
		success:function()
		{
		 for(var i=0; i<pay_id.length; i++)
		 {
		  $('tr#'+pay_id[i]+'').css('background-color', '#ccc');
		  $('tr#'+pay_id[i]+'').fadeOut('slow');
		 }
		}
		
	   });
	  }
	  
	 }
	 else
	 {
	  return false;
	 }
	});
	
   });