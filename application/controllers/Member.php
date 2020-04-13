<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Member_model");
		$this->load->library('form_validation');
		$this->load->helper('URL');

	}

//used
	public function members_list_page()
	{
		$data['content'] = $this->load->view("members_list", '', true);

		$this->load->view('template', $data);
	}

//used
	public function index()

	{

		$data['content'] = $this->load->view("member_add", '', true);

		$this->load->view('template', $data);

	}

//used
	function member_data()
	{

		$data = $this->Member_model->member_list();
		echo json_encode($data);
	}

	function member_list_id()
	{
		$member_id = $this->input->post('member_id');
		$data = $this->Member_model->member_list_id($member_id);

		echo json_encode($data);


	}

//used
	public function save()
	{

		$this->form_validation->set_rules('name', '', 'required|min_length[5]|max_length[55]');
		$this->form_validation->set_rules('phone', '', 'required');
		$this->form_validation->set_rules('email', '', 'required');
		$this->form_validation->set_rules('username', '', 'required');
		$this->form_validation->set_rules('password', '', 'required|min_length[5]|max_length[55]');
		$this->form_validation->set_rules('card_id', '', 'required');
		$this->form_validation->set_rules('address', '', 'required');
		$this->form_validation->set_rules('Library_id', '', 'required');
		//check if file is not selected then ask for required file by defining required rule
		// type will check after file selection
		if (empty($_FILES['profile_photo']['name'])) {
			$this->form_validation->set_rules('profile_photo', 'Profile Photo', 'required');
		}


		if ($this->form_validation->run()) {

			//loading image files
			$config['upload_path'] = APPPATH . '../assets/images/Members/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('profile_photo')) {
				$data = array(
					'error' => true,
					'profile_photo_load_error' => $this->upload->display_errors(),
				);


			} else {

				$data = $this->upload->data();
				$cover_img = $data["file_name"];
				$data = $this->Member_model->add_member($cover_img);
				$data = array(
					'success' => '<div class="alert alert-success">member Add Successfully </div>'
				);

			}
		} else {
			$data = array(
				'error' => true,
				'name_error' => form_error('name'),
				'phone_error' => form_error('phone'),
				'email_error' => form_error('email'),
				'username_error' => form_error('username'),
				'password_error' => form_error('password'),
				'card_id_error' => form_error('card_id'),
				'address_error' => form_error('address'),
				'Library_id_error' => form_error('Library_id'),
				'profile_photo_error' => form_error('profile_photo'),
			);
		}
		echo json_encode($data);
	}


	public function update()
	{

		$this->form_validation->set_rules('Edit_title', 'member title', 'required|min_length[5]|max_length[55]');
		$this->form_validation->set_rules('Edit_number_of_coypies', 'Please Enter Number of Coypies', 'required');
		$this->form_validation->set_rules('Edit_Supplier_id', 'Please Select Supplier ID', 'required');
		$this->form_validation->set_rules('Edit_Publisher_id', 'Please Select Publisher ID', 'required');
		$this->form_validation->set_rules('Edit_subject', 'member Subject', 'required|min_length[5]|max_length[55]');
		$this->form_validation->set_rules('Edit_price', 'Price is Required ', 'required');
		$this->form_validation->set_rules('Edit_Staff_id', 'Please Select Staff ID ', 'required');
		$this->form_validation->set_rules('Edit_category_id', 'Please Select Category ', 'required');
		$this->form_validation->set_rules('Edit_ISBN', 'Please Add ISBN ', 'required');

		//check if file is not selected then ask for required file by defining required rule
		// type will check after file selection
//		if (empty($_FILES['Edit_profile_photo']['name'])) {
//			$this->form_validation->set_rules('Edit_profile_photo', 'Cover Photo', 'required');
//		}
		if ($this->form_validation->run()) {

//			loading image files
			$config['upload_path'] = APPPATH . '../assets/images/Members/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('Edit_profile_photo')) {
				$data = array(
					'error' => true,
					'Edit_profile_photo_load_error' => $this->upload->display_errors(),
				);


			} else {
				$member_id = $this->input->post("up_member_id");
				$member_data = $this->Member_model->member_list_id($member_id);
//				$person = $this->person->get_by_id($this->input->post('id'));
				if (file_exists(APPPATH . '../assets/images/Members/' . $member_data->cover_img) && $member_data->cover_img)
					unlink(APPPATH . '../assets/images/Members/' . $member_data->cover_img);

//				$data['photo'] = $upload;

				$data1 = $this->upload->data();
				$profile_photo1 = $data1["file_name"];
				$data = $this->Member_model->update($member_id, $profile_photo1);

				$data = array(
					'success' => '<div class="alert alert-success">member Update Successfully </div>'
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
				'Edit_profile_photo_error' => form_error('Edit_profile_photo'),
			);
		}
		echo json_encode($data);
	}


	public function delete()
	{
		$member_id = $this->input->post("member_id");
		$data = $this->Member_model->delete($member_id);
		echo json_encode($data);

	}

	//used
	public function get_Library()
	{
		$data = array(
			"Library" => $this->Member_model->get_Library(),

		);

		echo json_encode($data);


	}


}
