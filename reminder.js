var id_p_list=[];
$(document).ready(reminder);
function reminder(){
	console.log("Working");
	init_list();
	var dailyop=0;
	var monthlyop=0;
	var weeklyop=0;
	var neverop=1;
	$("#sel").change(function(){
	var repetition="never";
	var repetition=$("#sel").val();
	console.log(repetition);
		if(repetition== "daily"){
      document.getElementById('daily').style.display ="block";
      document.getElementById('weekly').style.display ="none";
      document.getElementById('monthly').style.display ="none";
      dailyop=1;neverop=0;weeklyop=0;monthlyop=0;
    }
    else if(repetition== "weekly"){
      document.getElementById('daily').style.display ="none";
      document.getElementById('weekly').style.display ="block";
      document.getElementById('monthly').style.display ="none";
      weeklyop=1;neverop=0;dailyop=0;monthlyop=0;
    }
    else if(repetition== "monthly"){
      document.getElementById('daily').style.display ="none";
      document.getElementById('weekly').style.display ="none";
      document.getElementById('monthly').style.display ="block";
      monthlyop=1;neverop=0;dailyop=0;weeklyop=0;
    }
    else if(repetition== "never"){
      document.getElementById('daily').style.display ="none";
      document.getElementById('weekly').style.display ="none";
      document.getElementById('monthly').style.display ="none";
      neverop=1;dailyop=0;weeklyop=0;monthlyop=0;
    }
    });
    function init_list(){
	console.log("in init_list");
	$.ajax({
		type:'GET',
		url: 'getreminderData.php',
		dataType : 'json',
		success:handle_success_data,
		error: handle_error
	});

	function handle_success_data(data){
		//console.log(data);
			$.each(data, function(i, item){
			// console.log(i , '==>', item.);
			if(item.never==1)
				rep="Never";
			if(item.daily==1)
				rep="Daily";
			if(item.weekly==1)
				rep="Weekly";
			if(item.monthly==1)
				rep="Monthly";
			updateTable(item.id, item.event, item.date, item.time, rep);
			// count = item.id;
			// id_p_list.push([item.id, item.date]);
			});
		}
	function handle_error(ts){
			console.log(ts.responseText);
		}
	}
	function updateTable(id1, event, date, time, repetition){
	console.log(event,date);
	var table_body = $("#table_body");
	var newelement = "";
	newelement += "<tr id="+ id1 +">";
	var th_head="<th>";
	newelement += th_head;
	newelement += event;
	newelement += "</th>";
	newelement += th_head;
	newelement += date;
	newelement += "</th>";
	newelement += th_head;
	newelement += time;
	newelement += "</th>";
	newelement += th_head;
	newelement += repetition;
	newelement += "</th>";
	newelement += th_head;
	newelement += "<span class='input-group-addon' style='color:#263238'>"
	newelement += "<span class='glyphicon glyphicon-remove' id="
	newelement += id1;
	newelement += "></span></span>";
	newelement += "</th>";
	console.log(newelement);
	table_body.append(newelement);
	$("#input_pl").val("");
}
	$("#confirm").click(function(e){
		var date=$("#date").val();
		var event=$("#event").val();
		var time=$("#time").val();
		console.log(time);
		var monday = $("input[name='monday']:checked").val();
		var tuesday = $("input[name='tuesday']:checked").val();
		var wednesday = $("input[name='wednesday']:checked").val();
		var thursday = $("input[name='thursday']:checked").val();
		var friday = $("input[name='friday']:checked").val();
		var saturday = $("input[name='saturday']:checked").val();
		var sunday = $("input[name='sunday']:checked").val();
		if(monday=="on"){monday=1;} else {monday=0;}
		if(tuesday=="on"){tuesday=1;} else {tuesday=0;}
		if(wednesday=="on"){wednesday=1;} else {wednesday=0;}
		if(thursday=="on"){thursday=1;} else {thursday=0;}
		if(friday=="on"){friday=1;} else {friday=0;}
		if(saturday=="on"){saturday=1;} else {saturday=0;}
		if(sunday=="on"){sunday=1;} else {sunday=0;}

		var formdata={
				date:date,
				event:event,
				time:time,
				daily:dailyop,
				weekly:weeklyop,
				monthly:monthlyop,
				never:neverop,
				monday:monday,
				tuesday:tuesday,
				wednesday:wednesday,
				thursday:thursday,
				friday:friday,
				saturday:saturday,
				sunday:sunday
			}
		console.log(formdata);
		$.ajax({
				url:'reminderData.php',
				type:"POST",
				data:formdata,
				dataType:'text',
				success:handle_success,
				error:handle_error
			});
		function handle_success(){
			alert("done");
			$(this).closest('form').find("input[type=text], textarea").val("");
			$("#eventform")[0].reset();
			reset();
			init_list();
		}
		function handle_error(){
			alert("gadbad");
		}
		function reset(){
			count = 0;
			console.log("in reset");
			$("#table_body").empty();
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
		url:'removeitemrem.php',
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