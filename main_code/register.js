$(document).ready(register);
function register(){
	var name=/([A-Za-z]+)/g
	var mail=/(([a-z0-9]+([.]|[_]))*[a-z0-9])+[@]([a-z]+\.)+[a-z]+/g
	var num=/([0-9])+/g
	console.log("working");
	$(".form-control").keydown(function(e){
		if(e.keyCode==13){
			e.preventDefault();
		}
	});
	$("#register").click(function (e){
		console.log("done");
		var fname=$("#fname").val();
		var lname=$("#lname").val();
		var email=$("#email").val();
		var number=$("#number").val();
		var password=$("#password").val();
		var password_confirmation=$("#password_confirmation").val();
		if(name.test(fname)){
			console.log("true");
		}
		else{
			//alert("Only alphabets");
			$("#fname").focus();
			return false;
		}
		if(name.test(lname)){
			console.log("true");
		}
		else{
			//alert("Only alphabets");			
			$("#lname").focus();
			return false;
		}
		if(mail.test(email)){
			console.log("true");
		}
		else{
			alert("Invalid email");
			$("#email").focus();
			return false;
		}
		if(num.test(number)){
			console.log("true");
		}
		else{
			alert("Invalid email");
			$("#number").focus();
			return false;
		}
		if(password!=password_confirmation){
			alert("Wrong password");
		}
		if(fname.length==0||lname.length==0||email.length==0||number.length==0||password.length==0||password_confirmation.length==0)
		{
			alert("Enter valid details");
		}
		else{
			put_in_database(fname,lname,email,number,password);
		}		
	});
	function put_in_database(fname,lname,email,number,password){
		var formdata={
			fname:fname,
			lname:lname,
			email:email,
			number:number,
			password:password
		}
		$.ajax({
			url:'putData.php',
			type:"POST",
			data:formdata,
			dataType:'text',
			success:handle_success,
			error:handle_error
		});
		function handle_success(){
			$('#login').modal('show');
		}
		function handle_error(){
			alert("error");
		}
	}
	$("#loginbtn").click(function (e){
		var loginemail=$("#loginemail").val();
		var loginpassword=$("#loginpassword").val();
		if(mail.test(loginemail)){
			console.log("true");
		}
		else{
			alert("Invalid email");
			$("#loginemail").focus();
			return false;
		}

		check_for_user(loginemail,loginpassword);
	function check_for_user(loginemail,loginpassword){
		console.log("in check_for_user");
		var i=0;
		i++;
		var c="";
		var x="1";
		var user="";
	var formdata={
			loginemail:loginemail,
			loginpassword:loginpassword
		}
		$.ajax({
			url:'getData.php',
			type:"POST",
			data:formdata,
			dataType:'text',
			success:handle_success,
			error:handle_error
		});
		function handle_success(info){
			console.log(info);
			var obj = jQuery.parseJSON(info);
			console.log(obj);
					$.each(obj.server_response,function (index,value) {
					user=value.name;
					c=value.Count;
					});
					if(x==c)
					{
					alert("Welcome"+" "+user+" to Time-It");
					console.log("here");
					window.location.replace("http://projecttimeit.esy.es/firstpage.html");
						}
						else
						{
						alert("Enter valid username and password");
						}

	}
		function handle_error(){
			alert("error in login");
		}
	}
	 });

	$("#myform1").submit(function()
	{
	return false;
	});
}