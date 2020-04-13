<script type="application/javascript">
	$(document).ready(function(){

		show_product();	//call function show all product
		//Save product
		$('#btn_save').on('click',function() {
			var title = $('#title').val();
			var subject = $('#subject').val();
			var price = $('#price').val();
			var number_of_coypies = $('#number_of_coypies').val();
			var Supplier_id = $('#Supplier_id').val();
			var Publisher_id = $('#Publisher_id').val();
			var Staff_id = $('#Staff_id').val();
			// var cover_file = $('#cover_file').val();


			$.ajax({
				type: "POST",
				url  : "<?php echo site_url('Book/save')?>",
				async : false,
				dataType: "JSON",
				data: { title: title, subject: subject, price: price, number_of_coypies: number_of_coypies,
					Supplier_id: Supplier_id, Publisher_id: Publisher_id, Staff_id: Staff_id},
				success: function (data) {

					if (data.error) {
						if (data.title_error != '') {
							$('#title_error').html(data.title_error);
						} else {
							$('#title_error').html('');
						}
						if (data.subject_error != '') {
							$('#subject_error').html(data.subject_error);
						} else {
							$('#subject_error').html('');
						}
						if (data.price_error != '') {
							$('#price_error').html(data.price_error);
						}
						else {
							$('#price_error').html('');
						}
						if (data.number_of_coypies_error != '') {
							$('#number_of_coypies_error').html(data.number_of_coypies_error);
						} else {
							$('#number_of_coypies_error').html('');
						}
						if (data.Supplier_id_error != '') {
							$('#Supplier_id_error').html(data.Supplier_id_error);
						} else {
							$('#Supplier_id_error').html('');
						}
						if (data.Publisher_id_error != '') {
							$('#Publisher_id_error').html(data.Publisher_id_error);
						} else {
							$('#Publisher_id_error').html('');
						}
						if (data.Staff_id_error != '') {
							$('#Staff_id_error').html(data.Staff_id_error);
						} else {
							$('#Staff_id_error').html('');
						}

					}
					if (data.success) {
						$('#success_message').html(data.success);

						$('#number_of_coypies_error').html('');
						$('#Publisher_id_error').html('');
						$('#title_error').html('');
						$('#price_error').html('');
						$('#subject_error').html('');
						$('#Staff_id_error').html('');
						$('#Supplier_id_error').html('');


						$('[name="number_of_coypies"]').val("");
						$('[name="Publisher_id"]').val("");
						$('[name="title"]').val("");
						$('[name="subject"]').val("");
						$('[name="Staff_id"]').val("");
						$('[name="Supplier_id"]').val("");
						$('[name="price"]').val("");


						$('#Modal_Add').modal('hide');
						show_product();
					}
					$('#contact').attr('disabled', false);
				}


			});
			return false;
		});

		$('#mydata').dataTable();

		//function show all product
		function show_product(){
			$.ajax({
				type  : 'ajax',
				url  : "<?php echo site_url('Book/book_data')?>",
				async : false,
				dataType : 'json',
				success : function(data){
					var html = '';
					var i;
					for(i=0; i<data.length; i++){
						html += '<tr>'+
							// '<td>'+data[i].id+'</td>'+

							'<td>'+data[i].id+'</td>'+
							'<td>'+data[i].title+'</td>'+
							'<td>'+data[i].subject+'</td>'+
							'<td>'+data[i].price+'</td>'+
							'<td>'+data[i].number_of_coypies+'</td>'+
							'<td>'+data[i].Supplier_name+'</td>'+
							'<td>'+data[i].Publisher_name+'</td>'+
							'<td>'+data[i].Staff_name+'</td>'+

							'<td style="text-align:right;">'+
							'<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-book_id="'+data[i].id+'" >Edit</a>'+' '+
							'<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-book_id="'+data[i].id+'">Delete</a>'+
							'</td>'+
							'</tr>';
					}
					$('#show_data').html(html);
				}

			});
		}

		//get data for update record
		$('#show_data').on('click','.item_edit',function(){
			// var book_id = 3;

			var book_id = $(this).data('book_id');
			$.ajax({
				type: "POST",
				url  : "<?php echo site_url('Book/book_list_id')?>",
				dataType : "JSON",
				data : {book_id:book_id},
				success: function(data){
					$('[name="Edit_number_of_coypies"]').val('');
					$('[name="Edit_Publisher_id"]').val('');
					$('[name="Edit_title"]').val('');
					$('[name="Edit_subject"]').val('');
					$('[name="Edit_Staff_id"]').val('');
					$('[name="Edit_Supplier_id"]').val('');
					$('[name="Edit_price"]').val('');
					$('[name="up_book_id"]').val('');


					$('[name="up_book_id"]').val(data.id);
					$('[name="Edit_number_of_coypies"]').val(data.number_of_coypies);
					$('[name="Edit_Publisher_id"]').val(data.Publisher_id);
					$('[name="Edit_title"]').val(data.title);
					$('[name="Edit_subject"]').val(data.subject);
					$('[name="Edit_Staff_id"]').val(data.Staff_id);
					$('[name="Edit_Supplier_id"]').val(data.Supplier_id);
					$('[name="Edit_price"]').val(data.price);
					$('#Modal_Edit').modal('show');
				}

			});
			return false;

		});

		//update record to database
		$('#btn_update').on('click',function(){
			var Edit_number_of_coypies = $('#Edit_number_of_coypies').val();
			var Edit_Publisher_id = $('#Edit_Publisher_id').val();
			var Edit_title        = $('#Edit_title').val();
			var Edit_subject      = $('#Edit_subject').val();
			var Edit_Staff_id     = $('#Edit_Staff_id').val();
			var Edit_Supplier_id  = $('#Edit_Supplier_id').val();
			var Edit_price        = $('#Edit_price').val();
			var book_id 		  = $('[name="up_book_id"]').val();

			$.ajax({
				type : "POST",
				url  : "<?php echo site_url('Book/update')?>",
				dataType : "JSON",
				data : {Edit_number_of_coypies:Edit_number_of_coypies , Edit_Publisher_id:Edit_Publisher_id, Edit_title:Edit_title ,
					Edit_Supplier_id:Edit_Supplier_id ,Edit_subject:Edit_subject,Edit_Staff_id:Edit_Staff_id,Edit_price:Edit_price ,book_id:book_id},
				success: function(data)
				{
					if (data.error) {
						if (data.Edit_title_error != '') {
							$('#Edit_title_error').html(data.Edit_title_error);
						} else {
							$('#Edit_title_error').html('');
						}
						if (data.Edit_subject_error != '') {
							$('#Edit_subject_error').html(data.Edit_subject_error);
						} else {
							$('#Edit_subject_error').html('');
						}
						if (data.Edit_price_error != '') {
							$('#Edit_price_error').html(data.Edit_price_error);
						} else {
							$('#Edit_price_error').html('');
						}
						if (data.Edit_number_of_coypies_error != '') {
							$('#Edit_number_of_coypies_error').html(data.Edit_number_of_coypies_error);
						} else {
							$('#Edit_number_of_coypies_error').html('');
						}
						if (data.Edit_Supplier_id_error != '') {
							$('#Edit_Supplier_id_error').html(data.Edit_Supplier_id_error);
						} else {
							$('#Edit_Supplier_id_error').html('');
						}
						if (data.Edit_Publisher_id_error != '') {
							$('#Edit_Publisher_id_error').html(data.Edit_Publisher_id_error);
						} else {
							$('#Edit_Publisher_id_error').html('');
						}
						if (data.Edit_Staff_id_error != '') {
							$('#Edit_Staff_id_error').html(data.Edit_Staff_id_error);
						} else {
							$('#Edit_Staff_id_error').html('');

						}

						$('#Modal_Edit').modal('show');

					}else
						{
							$('#success_message').html(data.success);

							$('#Edit_number_of_coypies_error').html('');
							$('#Edit_Publisher_id_error').html('');
							$('#Edit_title_error').html('');
							$('#Edit_price_error').html('');
							$('#Edit_subject_error').html('');
							$('#Edit_Staff_id_error').html('');
							$('#Edit_Supplier_id_error').html('');


							$('[name="Edit_number_of_coypies"]').val("");
				 		$('[name="Edit_Publisher_id"]').val("");
						$('[name="Edit_title"]').val("");
						$('[name="Edit_subject"]').val("");
						$('[name="Edit_Staff_id"]').val("");
						$('[name="Edit_Supplier_id"]').val("");
						$('[name="Edit_price"]').val("");

						$('#Modal_Edit').modal('hide');
						show_product();
					}
				}
			});
			return false;
		});



		//get data for delete record
		$('#show_data').on('click','.item_delete',function(){
			var book_id = $(this).data('book_id');

			$('#Modal_Delete').modal('show');
			$('[name="book_id_delete"]').val(book_id);
		});

		//delete record to database
		$('#btn_delete').on('click',function(){
			var book_id = $('#book_id_delete').val();
			$.ajax({
				type : "POST",
				url  : "<?php echo site_url('Book/delete')?>",
				dataType : "JSON",
				data : {book_id:book_id},
				success: function(data){
					$('[name="book_id_delete"]').val("");
					$('#Modal_Delete').modal('hide');
					show_product();
				}
			});
			return false;
		});


		//load dropdown list in add model from database
		$('#add_btn').on('click',function(){
			var book_id = $('#book_id_delete').val();
			$.ajax({
				type : "POST",
				url  : "<?php echo site_url('Book/get_supplier')?>",
				dataType : "JSON",
				success: function(data){


					var Supplier_html = '';
					var Publisher_html = '';
					var Staff_html = '';

					// loop length controller
					var supplier_len = data.supplier.length;
					var Publisher_len = data.Publisher.length;
					var Staff_len = data.Staff.length;


					for (var i = 0; i < supplier_len; i++) {
						Supplier_html += '<option value=' + data.supplier[i].id + '>' + data.supplier[i].name + '</option>';
					}
						$('#Supplier_id').html(Supplier_html);


					for (var i = 0; i < Publisher_len; i++) {
						Publisher_html += '<option value=' + data.Publisher[i].id + '>' + data.Publisher[i].name + '</option>';
					}
						$('#Publisher_id').html(Publisher_html);


					for (var i = 0; i < Staff_len; i++) {
						Staff_html += '<option value=' + data.Staff[i].id + '>' + data.Staff[i].name + '</option>';
					}
						$('#Staff_id').html(Staff_html);




					$('#Modal_Add').modal('show');

				}
			});
			return false;
		});

	});

</script>
