<span id="success_message" class="success"></span>
<form method="post" id="add_form" enctype="multipart/form-data">
	<div class="" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		 aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">Add New Book</h5>
				
				</div>
				<div class="modal-body">

					<div class="form-group row">
						<label class="col-md-2 col-form-label">Book Title</label>
						<div class="col-md-10">
							<input type="text" name="title" id="title" class="form-control" placeholder="Book Title">
							<span id="title_error" class="text-danger"></span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Subject</label>
						<div class="col-md-10">
							<input type="text" name="subject" id="subject" class="form-control" placeholder="subject">
							<span id="subject_error" class="text-danger"></span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">ISBN</label>
						<div class="col-md-10">
							<input type="text" name="ISBN" id="ISBN" class="form-control" placeholder="ISBN">
							<span id="ISBN_error" class="text-danger"></span>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-2 col-form-label">Quantity</label>
						<div class="col-md-10">
							<input type="number" name="number_of_coypies" id="number_of_coypies" class="form-control"
								   placeholder="Enter Number of Coypies">
							<span id="number_of_coypies_error" class="text-danger"></span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Price</label>
						<div class="col-md-10">
							<input type="number" name="price" id="price" class="form-control" placeholder="Price">
							<span id="price_error" class="text-danger"></span>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2"></div>
						<div class="col-md-3">
							<label class="col-md-12 col-form-label">Supplier</label>
							<select name="Supplier_id" class="form-control" id="Supplier_id">

							</select>
							<span id="Supplier_id_error" class="text-danger"></span>
						</div>


						<div class="col-md-3">
							<label class="col-md-12 col-form-label">Publisher</label>
							<select class="form-control" name="Publisher_id" id="Publisher_id">
							</select>
							<span id="Publisher_id_error" class="text-danger"></span>
						</div>


						<div class="col-md-3">
							<label class="col-md-12 col-form-label">Staff</label>
							<select class="form-control" name="Staff_id" id="Staff_id">
							</select>
							<span id="Staff_id_error" class="text-danger"></span>
						</div>

					</div>
					<div class="form-group row">

						<div class="col-md-2"></div>

						<div class="col-md-3">
							<label class="col-md-12 col-form-label">Category</label>
							<select class="form-control" name="category_id" id="category_id">
							</select>
							<span id="category_id_error" class="text-danger"></span>
						</div>
						<div class="col-md-7">
							<label class=" col-form-label">Cover Image</label>

							<input type="file" name="cover_file" class="form-control-file" id="cover_file">
							<span id="cover_file_error" class="text-danger"></span>
							<span id="cover_file_load_error" class="text-danger"></span>
						</div>


					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" id="btn_save" class="btn btn-info">Save</button>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.2.1.js' ?>"></script>

<script type="application/javascript">
	$(document).ready(function () {
		load_drop_down_data();
			$('#add_form').on('submit', function (e) {
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('Book/save')?>",
					async: false,
					dataType: "JSON",
					data: new FormData(this),
					processData: false,
					contentType: false,
					cache: false,
					async: false,
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
							} else {
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
							if (data.category_id_error != '') {
								$('#category_id_error').html(data.category_id_error);
							} else {
								$('#category_id_error').html('');
							}
							if (data.ISBN_error != '') {
								$('#ISBN_error').html(data.ISBN_error);
							} else {
								$('#ISBN_error').html('');
							}

							if (data.cover_file_load_error != '') {
								$('#cover_file_load_error').html(data.cover_file_load_error);
							} else {
								$('#cover_file_load_error').html('');
							}
							if (data.cover_file_error != '') {
								$('#cover_file_error').html(data.cover_file_error);
							} else {
								$('#cover_file_error').html('');
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
							$('#category_id_error').html('');
							$('#ISBN_error').html('');
							$('#cover_file_load_error').html('');
							$('#cover_file_error').html('');


							$('[name="number_of_coypies"]').val("");
							$('[name="Publisher_id"]').val("");
							$('[name="title"]').val("");
							$('[name="subject"]').val("");
							$('[name="Staff_id"]').val("");
							$('[name="Supplier_id"]').val("");
							$('[name="price"]').val("");
							$('[name="ISBN"]').val("");
							$('[name="category_id"]').val("");
							$('[name="cover_file"]').val("");


							$('#Modal_Add').modal('hide');
						}
						$('#contact').attr('disabled', false);
					}

				});
				return false;

			});
		//load dropdown list in add model from database
	function load_drop_down_data() {
			// var book_id = $('#book_id').val();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('Book/get_supplier')?>",
				dataType: "JSON",
				success: function (data) {


					var Supplier_html = '<option value="" selected></option>';
					var Publisher_html = '<option value="" selected></option>';
					var Staff_html = '<option value="" selected></option>';
					var category_html = '<option value="" selected></option>';

					// loop length controller
					var supplier_len = data.supplier.length;
					var Publisher_len = data.Publisher.length;
					var Staff_len = data.Staff.length;
					var Category_len = data.Category.length;


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

					for (var i = 0; i < Category_len; i++) {
						category_html += '<option value=' + data.Category[i].id + '>' + data.Category[i].name + '</option>';
					}
					$('#category_id').html(category_html);



				}
			});
			return false;
		};
		}
	);

</script>
