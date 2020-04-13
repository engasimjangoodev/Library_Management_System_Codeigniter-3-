<?php


class Category_model extends CI_Model
{

	public function __construct()
	{
		$this->table = 'category';
	}

	function list_data()
	{

		$this->db->from($this->table);
		$data = $this->db->get();
		return $data->result();

	}

	function edit_List_by_id($id = '', $where = [])
	{
		$this->db->select('*');
		$this->db->from($this->table);
//        $this->db->join('coupon_courses', 'coupon_curses.course_id = coupons.course_id' , 'Left');
		$this->db->where($where);
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			$section = $this->db->get()->row();
			return $section;

		}
	}


	function add_category()
	{
		$data = array(
			'name' => $this->input->post("category_name"),
		);
		$result = $this->db->insert($this->table, $data);
		return $result;
	}

	function delete($id)
	{

		$this->db->where('id', $id);
		$result = $this->db->delete($this->table);
		return $result;
	}

	function update($id)
	{

		$data = array(
			'name' => $this->input->post("Edit_category_name"),

		);

		try {
			$this->db->set($data);

			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return true;
		} catch (Exception $exception) {
			return false;
		}

	}


}
