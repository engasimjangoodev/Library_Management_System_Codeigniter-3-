<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Category_model");
		$this->load->library('form_validation');
		$this->load->helper('URL');

	}


	public function index()

	{

		$data['content'] = $this->load->view("category_list", '', true);

		$this->load->view('template', $data);

	}

	function list_data()
	{

		$data = $this->Category_model->list_data();
		echo json_encode($data);
	}

	function add_new_category()
	{
		$data['content'] = $this->load->view("add_category", '', true);

		$this->load->view('template', $data);
	}


	function edit_List_by_id()
	{
		$category_id = $this->input->post('category_id');
		$data = $this->Category_model->edit_List_by_id($category_id);

		echo json_encode($data);


	}

	public function save()
	{

		$this->form_validation->set_rules('category_name', 'Category Name', 'required|min_length[5]|max_length[55]');

		if ($this->form_validation->run()) {
			$data = $this->Category_model->add_category();
			$data = array(
				'success' => '<div class="alert alert-success">Category Add Successfully </div>'
			);
		} else {
			$data = array(
				'error' => true,
				'category_name_error' => form_error('category_name'),
			);
		}
		echo json_encode($data);
	}


	public function update()
	{

		$this->form_validation->set_rules('Edit_category_name', 'Category Name ', 'required|min_length[5]|max_length[55]');


		if ($this->form_validation->run()) {
			$up_category_id = $this->input->post("up_category_id");
			$data = $this->Category_model->update($up_category_id);

			$data = array(
				'success' => '<div class="alert alert-success">Category Name Update Successfully </div>'
			);
		} else {
			$data = array(
				'error' => true,
				'Edit_category_name_error' => form_error('Edit_category_name'),
			);
		}
		echo json_encode($data);
	}


	public function delete()
	{
		$id = $this->input->post("category_id");
		$data = $this->Category_model->delete($id);
		echo json_encode($data);

	}

	public function get_supplier()
	{
		$data = array(
			"supplier" => $this->Book_model->get_supplier(),
			"Publisher" => $this->Book_model->get_Publisher(),
			"Staff" => $this->Book_model->get_Staff(),
		);

		echo json_encode($data);


	}


}
