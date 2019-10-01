$(document).ready(user);
function user(){
	console.log("user working");
	$.ajax({
      url: "username.php",
      cache: false,
      success: function(html){
      	$("#twoof").text(html);
      }
    });
}