$(document).ready(function(){
	fetch();

	//add
	$('#addnew').click(function(){
		$('#add').modal('show');
	});
	$('#addForm').submit(function(e){
		e.preventDefault();
		var addform = $(this).serialize();
		//console.log(addform);
		$.ajax({
			method: 'POST',
			url: 'add.php',
			data: addform,
			dataType: 'json',
			success: function(response){
				$('#add').modal('hide');
				if(response.error){
					$('#alert').show();
					$('#alert_message').html(response.message);
				}
				else{
					$('#alert').show();
					$('#alert_message').html(response.message);
					fetch();
				}
			}
		});
	});
	//

	//edit
	$(document).on('click', '.edit', function(){
		var id = $(this).data('id');
		getDetails(id);
		$('#edit').modal('show');
	});
	$('#editForm').submit(function(e){
		e.preventDefault();
		var editform = $(this).serialize();
		$.ajax({
			method: 'POST',
			url: 'edit.php',
			data: editform,
			dataType: 'json',
			success: function(response){
				if(response.error){
					$('#alert').show();
					$('#alert_message').html(response.message);
				}
				else{
					$('#alert').show();
					$('#alert_message').html(response.message);
					fetch();
				}

				$('#edit').modal('hide');
			}
		});
	});
	//

	//delete
	$(document).on('click', '.delete', function(){
		var id = $(this).data('id');
		getDetails(id);
		$('#delete').modal('show');
	});

	$('.id').click(function(){
		var id = $(this).val();
		$.ajax({
			method: 'POST', 
			url: 'delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(response.error){
					$('#alert').show();
					$('#alert_message').html(response.message);
				}
				else{
					$('#alert').show();
					$('#alert_message').html(response.message);
					fetch();
				}
				
				$('#delete').modal('hide');
			}
		});
	});
	//
	
	

// test
//done new 
$(document).on('click', '.done', function(){
	var id = $(this).data('id');
	getDetails(id);
	$('#done').modal('show');
});
$('#doneForm').submit(function(e){
	e.preventDefault();
	var doneform = $(this).serialize();
	$.ajax({
		method: 'POST',
		url: 'done.php',
		data: doneform,
		dataType: 'json',
		success: function(response){
			if(response.error){
				$('#alert').show();
				$('#alert_message').html(response.message);
			}
			else{
				$('#alert').show();
				$('#alert_message').html(response.message);
				fetch();
			}

			$('#done').modal('hide');
		}
	});
});
//



// test done






    // 	//done
	// $(document).on('click', '.done', function(){
	// 	var id = $(this).data('id');
	// 	getDetails(id);
	// 	$('#done').modal('show');
	// });

	// $('.id').click(function(){
	// 	var id = $(this).val();
	// 	$.ajax({
	// 		method: 'POST', 
	// 		url: 'done.php',
	// 		data: {id:id},
	// 		dataType: 'json',
	// 		success: function(response){
	// 			if(response.error){
	// 				$('#alert').show();
	// 				$('#alert_message').html(response.message);
	// 			}
	// 			else{
	// 				$('#alert').show();
	// 				$('#alert_message').html(response.message);
	// 				fetch();
	// 			}
				
	// 			$('#done').modal('hide');
	// 		}
	// 	});
	// });
	// //

	//hide message
	$(document).on('click', '.close', function(){
		$('#alert').hide();
	});

});

function fetch(){
	$.ajax({
		method: 'POST',
		url: 'fetch.php',
		success: function(response){
			$('#tbody').html(response);
		}
	});
}

function getDetails(id){
	$.ajax({
		method: 'POST',
		url: 'fetch_row.php',
		data: {id:id},
		dataType: 'json',
		success: function(response){
			if(response.error){
				$('#edit').modal('hide');
				$('#delete').modal('hide');
                $('#done').modal('hide');
				$('#alert').show();
				$('#alert_message').html(response.message);
			}
			else{
				$('.id').val(response.data.id);
				$('.task_desc').val(response.data.task_desc);
				$('.task_created').val(response.data.task_created);
				$('.task_due').val(response.data.task_due);
				$('.user_id').val(response.data.user_id);
				$('.task_complete').val(response.data.task_complete);
			
			}
		}
	});
}