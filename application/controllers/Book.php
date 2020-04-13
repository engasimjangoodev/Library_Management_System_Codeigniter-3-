<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Book_model");
		$this->load->library('form_validation');
		$this->load->helper('URL');

	}

	public function book()
	{
		$this->load->view('books');
	}

	public function index()

	{

		$data['content'] = $this->load->view("books", '', true);

		$this->load->view('template', $data);

	}public function book_add_form_page()

	{

		$data['content'] = $this->load->view("book_add_form", '', true);

		$this->load->view('template', $data);

	}

	function book_data()
	{

		$data = $this->Book_model->book_list();
		echo json_encode($data);
	}

	function book_list_id()
	{
		$book_id = $this->input->post('book_id');
		$data = $this->Book_model->book_list_id($book_id);

		echo json_encode($data);


	}

	public function save()
	{

		$this->form_validation->set_rules('title', 'Book title', 'required|min_length[5]|max_length[55]');
		$this->form_validation->set_rules('number_of_coypies', 'Please Enter Number of Coypies', 'required');
		$this->form_validation->set_rules('Supplier_id', 'Please Select Supplier ID', 'required');
		$this->form_validation->set_rules('Publisher_id', 'Please Select Publisher ID', 'required');
		$this->form_validation->set_rules('subject', 'Book Subject', 'required|min_length[5]|max_length[55]');
		$this->form_validation->set_rules('price', 'Price is Required ', 'required');
		$this->form_validation->set_rules('Staff_id', 'Please Select Staff ID ', 'required');
		$this->form_validation->set_rules('category_id', 'Please Select Category ', 'required');
		$this->form_validation->set_rules('ISBN', 'Please Add ISBN ', 'required');
		//check if file is not selected then ask for required file by defining required rule
		// type will check after file selection
		if (empty($_FILES['cover_file']['name'])) {
			$this->form_validation->set_rules('cover_file', 'Cover Photo', 'required');
		}


		if ($this->form_validation->run()) {

			//loading image files
			$config['upload_path'] = APPPATH . '../assets/images/Books/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('cover_file')) {
				$data = array(
					'error' => true,
					'cover_file_load_error' => $this->upload->display_errors(),
				);


			} else {

				$data = $this->upload->data();
				$cover_img = $data["file_name"];
				$data = $this->Book_model->add_book($cover_img);
				$data = array(
					'success' => '<div class="alert alert-success">Book Add Successfully </div>'
				);

			}
		} else {
			$data = array(
				'error' => true,
				'title_error' => form_error('title'),
				'number_of_coypies_error' => form_error('number_of_coypies'),
				'Supplier_id_error' => form_error('Supplier_id'),
				'Publisher_id_error' => form_error('Publisher_id'),
				'subject_error' => form_error('subject'),
				'price_error' => form_error('price'),
				'Staff_id_error' => form_error('Staff_id'),
				'category_id_error' => form_error('category_id'),
				'cover_file_error' => form_error('cover_file'),
//				'cover_file_error' => form_error('file_check'),

				'ISBN_error' => form_error('ISBN'),

			);
		}
		echo json_encode($data);
	}


	public function update()
	{

		$this->form_validation->set_rules('Edit_title', 'Book title', 'required|min_length[5]|max_length[55]');
		$this->form_validation->set_rules('Edit_number_of_coypies', 'Please Enter Number of Coypies', 'required');
		$this->form_validation->set_rules('Edit_Supplier_id', 'Please Select Supplier ID', 'required');
		$this->form_validation->set_rules('Edit_Publisher_id', 'Please Select Publisher ID', 'required');
		$this->form_validation->set_rules('Edit_subject', 'Book Subject', 'required|min_length[5]|max_length[55]');
		$this->form_validation->set_rules('Edit_price', 'Price is Required ', 'required');
		$this->form_validation->set_rules('Edit_Staff_id', 'Please Select Staff ID ', 'required');
		$this->form_validation->set_rules('Edit_category_id', 'Please Select Category ', 'required');
		$this->form_validation->set_rules('Edit_ISBN', 'Please Add ISBN ', 'required');

		//check if file is not selected then ask for required file by defining required rule
		// type will check after file selection
//		if (empty($_FILES['Edit_cover_file']['name'])) {
//			$this->form_validation->set_rules('Edit_cover_file', 'Cover Photo', 'required');
//		}
		if ($this->form_validation->run()) {

//			loading image files
			$config['upload_path'] = APPPATH . '../assets/images/Books/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('Edit_cover_file')) {
				$data = array(
					'error' => true,
					'Edit_cover_file_load_error' => $this->upload->display_errors(),
				);


			} else {
				$book_id = $this->input->post("up_book_id");
				$book_data = $this->Book_model->book_list_id($book_id);
//				$person = $this->person->get_by_id($this->input->post('id'));
				if (file_exists(APPPATH . '../assets/images/Books/' . $book_data->cover_img) && $book_data->cover_img)
					unlink(APPPATH . '../assets/images/Books/' . $book_data->cover_img);

//				$data['photo'] = $upload;

				$data1 = $this->upload->data();
				$cover_file1 = $data1["file_name"];
				$data = $this->Book_model->update($book_id, $cover_file1);

				$data = array(
					'success' => '<div class="alert alert-success">Book Update Successfully </div>'
				);
			}
		} else {
			$data = array(
				'error' => true,
				'Edit_title_error' => form_error('Edit_title'),
				'Edit_number_of_coypies_error' => form_error('Edit_number_of_coypies'),
				'Edit_Supplier_id_error' => form_error('Edit_Supplier_id'),
				'Edit_Publisher_id_error' => form_error('Edit_Publisher_id'),
				'Edit_subject_error' => form_error('Edit_subject'),
				'Edit_price_error' => form_error('Edit_price'),
				'Edit_Staff_id_error' => form_error('Edit_Staff_id'),
				'Edit_category_id_error' => form_error('Edit_category_id'),
				'Edit_ISBN_error' => form_error('Edit_ISBN'),
				'Edit_cover_file_error' => form_error('Edit_cover_file'),
			);
		}
		echo json_encode($data);
	}


	public function delete()
	{
		$book_id = $this->input->post("book_id");
		$data = $this->Book_model->delete($book_id);
		echo json_encode($data);

	}

	public function get_supplier()
	{
		$data = array(
			"supplier" => $this->Book_model->get_supplier(),
			"Publisher" => $this->Book_model->get_Publisher(),
			"Staff" => $this->Book_model->get_Staff(),
			"Category" => $this->Book_model->get_Category(),

		);

		echo json_encode($data);


	}


}
