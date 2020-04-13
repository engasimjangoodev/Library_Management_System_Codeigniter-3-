<?php


class Member_model extends CI_Model
{
	public function __construct()
	{
		$this->table = 'member';

	}

//used
	function member_list()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('Library', 'Library_id = Library.id') ;

		$data = $this->db->get();

//
//		$data = $this->db->get('member');
//		return $this->result();
		return $data->result();

	}

	function member_list_id($member_id = '', $where = [])
	{
		$this->db->select('*');
		$this->db->from($this->table);
//        $this->db->join('coupon_courses', 'coupon_curses.course_id = coupons.course_id' , 'Left');
		$this->db->where($where);
		if (is_numeric($member_id)) {
			$this->db->where('id', $member_id);
			$section = $this->db->get()->row();
			return $section;

		}
	}
//used
	function add_member($cover_img)
	{
		$data = array(
			'name' 	=> $this->input->post("name"),
			'phone' 	=> $this->input->post("phone"),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' 	=> $this->input->post('password'),
			'card_id' 	=> $this->input->post('card_id'),
			'address' => $this->input->post('address'),
			'Library_id' => $this->input->post('Library_id'),
			'profile_photo' => $cover_img,


		);
		$result = $this->db->insert($this->table,$data);
		return $result;
	}

	function delete($member_id){

		$this->db->where('id', $member_id);
		$result=$this->db->delete($this->table);
		return $result;
	}

	function update( $member_id , $cover_file )
	{

		$data = array(
			'title' 	=> $this->input->post("Edit_title"),
			'subject' 	=> $this->input->post("Edit_subject"),
			'number_of_coypies' => $this->input->post('Edit_number_of_coypies'),
			'price' => $this->input->post('Edit_price'),
			'Supplier_id' 	=> $this->input->post('Edit_Supplier_id'),
			'Staff_id' 	=> $this->input->post('Edit_Staff_id'),
			'Publisher_id' => $this->input->post('Edit_Publisher_id'),
			'ISBN' => $this->input->post('Edit_ISBN'),
			'category_id' => $this->input->post('Edit_category_id'),
			'cover_img' =>$cover_file,

		);

		try{
			$this->db->set($data);

			$this->db->where('id', $member_id);
			$this->db->update($this->table, $data);
			return true;
		}catch (Exception $exception){
			return false;
		}

	}



//used
	function  get_Library()
	{
		$data = $this->db->get('library');
		return $data->result();

	}




}
