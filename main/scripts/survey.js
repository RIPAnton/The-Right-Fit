var studentCount = 0;

function getStudentCount(currentCount){	
	studentCount = currentCount;
}	

function add_student(clicked_id){
	//will need to add student name and email to a txt file that the surveyController.php will look at once the whole survey creation is submitted
	//will also add the student as an 'li' in the 'ol' with an id of "$name.$email" along with a button to remove that 'li' and button

	var student = clicked_id.replace(clicked_id.substr(0, clicked_id.indexOf("_") + 1), "");
	var studentName = student.substring(0, student.indexOf("."));
	var studentEmail = student.substring(student.indexOf(".") + 1);
	
	document.getElementById(clicked_id).disabled = true;
	var token = document.getElementById(clicked_id).getAttribute("toy");
	
	$(document).ready(function(){
		$.ajax({
			type: "POST",
			url: 'create-survey.php',
			data: {"student_id":student}
		});	
	});
	
	try{
		$("#list_filler_notice").remove();
		$("#list_filler_span").before("<li id='list_" + student + "'>" + studentName + " (" + studentEmail + ") <button class='btn btn-primary btn-sm' onclick='remove_student(this.id)' id='remove_" + student + "' toy=" + token + ">x</button></li>");
	}
	catch(e){
		$("#list_filler_span").before("<li id='list_" + student + "'>" + student + " <button class='btn btn-primary btn-sm' onclick='remove_student(this.id)' id='remove_" + student + "' toy=" + token + ">x</button></li>");
	}finally{
		studentCount++;
	}
}

function remove_student(clicked_id){
	var student = clicked_id.replace(clicked_id.substr(0, clicked_id.indexOf("_") + 1), "");
	var token = document.getElementById(clicked_id).getAttribute("toy");
	console.log(token);
	//remove from text file with ajax
	$(document).ready(function(){
		$.ajax({
			type: "POST",
			url: 'create-survey.php',
			data: {"student_id_remove":student}
		});	
	});
	//removes li element with "list_" . student id
	var liToRemove = document.getElementById("list_" + student);
	liToRemove.parentNode.removeChild(liToRemove);
	//changes button property disabled to false if id is "stu_" . student id
	
	try{
		document.getElementById("stu_" + student).disabled = false;	
	}
	catch(e){}
	finally{
		studentCount--;
		if(studentCount == 0){
			$("#list_filler_span").before("<em id='list_filler_notice'>Students will appear here as you search and add them.</em>");
		}	
	}
	
	/*
	for(var i=0; i < inhouseAddedStudents.length; i++){
		inhouseAddedStudents.splice(i, 1);
		break;
	}	
	
	
	$(document).ready(function(){
		$.ajax({
			url:'text files/' + token + '_current_students.txt',
			type:'HEAD',
			error: function()
			{
				$("#list_filler_span").before("<em id='list_filler_notice'>Students will appear here as you add them.</em>");
			},
			success: function()
			{
				//file exists
			}
		});
	});*/
}
		
