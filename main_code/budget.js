$(document).ready(register);
function register(){
	console.log("working");
	init_list();
	$("#enter").click(function(e){
		var part=$("#part").val();
		var amount=$("#amount").val();
		var formdata = {
			part:part,
			amount:amount
		}
		console.log(formdata);
		$.ajax({
			url:'budget.php',
			type:"POST",
			data:formdata,
			dataType:'text',
			success:handle_success,
			error:handle_error
		});
		function handle_success(){
			alert("done");
			$(this).closest('form').find("input[type=text], textarea").val("");
			//$("#budgetform")[0].reset();
			$('input[type="text"],textarea').val('');
			$('input[type="number"],textarea').val('');
			reset();
			init_list();
		}
		function handle_error(){
			alert("error");
		}
		function reset(){
			count = 0;
			console.log("in reset");
			$("#table_body").empty();
		}
	});
	function init_list(){
	console.log("in init_list");
	$.ajax({
		type:'GET',
		url: 'getbudgetData.php',
		dataType : 'json',
		success:handle_success_data,
		error: handle_error
	});

	function handle_success_data(data){
		//console.log(data);
			$.each(data, function(i, item){
			// console.log(i , '==>', item.);
			
			updateTable(item.id,item.part, item.amount);
			// count = item.id;
			// id_p_list.push([item.id, item.date]);
			});
		}
	function handle_error(ts){
			console.log(ts.responseText);
		}
	}
	function updateTable(id1,part,amount){
	console.log(id1,part,amount);
	var table_body = $("#table_body");
	var newelement = "";
	newelement += "<tr id="+ id1 +">";
	var th_head="<th>";
	newelement += th_head;
	newelement += part;
	newelement += "</th>";
	newelement += th_head;
	newelement += amount;
	newelement += "</th>";
	newelement += th_head;
	newelement += "<span class='input-group-addon' style='color:#263238'>"
	newelement += "<span class='glyphicon glyphicon-remove' id="
	newelement += id1;
	newelement += "></span></span>";
	newelement += "</th>";
	table_body.append(newelement);
	$("#input_pl").val("");
}

	$("#total").click(function(e){
		console.log("in total");
		$.ajax({
			type:'GET',
			url: 'gettotal.php',
			dataType : 'json',
			success:handle_success_total,
			error: handle_error
		});
		function handle_success_total(data){
			console.log(data);
			$.each(data, function(i, item){
				console.log(i , '==>', item);
				amount=item["Sum"];
			});
			console.log(amount);
			$("#totalcalc").text(amount);
		}
		function handle_error(ts){
			console.log(ts.responseText);
		}
		});
	$(document).on('click','.glyphicon',function(e){
		console.log("Clicked");
		var primary_id = e.currentTarget.id;
		console.log( "primary_id : " , primary_id);
		var datanew = {id:String(primary_id)};
		$.ajax({
		type:"POST",
		data:datanew,
		url:'removeitem.php',
		dataType:'text',
		success:handle_put_success,
		error:handle_error,
		});
	});
	function handle_put_success(data){
		console.log(data);
		console.log("removed");
		reset();
		init_list();
	}
	function handle_error(){
		console.log("not removed");
	}
	function reset(){
			count = 0;
			console.log("in reset");
			$("#table_body").empty();
		}
}