<?php

class Book_Issue_model extends CI_Model
{
	public function __construct()
	{
		$this->table = 'books_status';

	}


	function issue_book_list()
	{

		$this->db->select('books_status.id as id,  book.title as title , Staff.name  as  Staff_name , books_status.status as status ,
		 					 books_status.create_time as date_borrow , books_status.Due_Date as Due_Date , Member.name as Member_name');
		$this->db->from($this->table);
		$this->db->join('book', 'Book_id = book.id');
		$this->db->join('Member', 'Member_id = Member.id');
		$this->db->join('Staff', 'books_status.Staff_id = Staff.id');
		$data = $this->db->get();
		return $data->result();

	}

	function book_list_id($id = '', $where = [])
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

	function add_book($Staff_id,$status)
	{
		$data = array(
			'Book_id' => $this->input->post("book_id"),
			'Member_id' => $this->input->post("member_id"),
			'Due_Date' => $this->input->post('due_date'),
			'status' =>$status,
			'Staff_id' => $Staff_id,

		);
		$result = $this->db->insert($this->table, $data);
		return $result;
	}

	function delete($book_id)
	{

		$this->db->where('id', $book_id);
		$result = $this->db->delete($this->table);
		return $result;
	}

	function update($book_id)
	{

		$data = array(
			'title' => $this->input->post("Edit_title"),
			'subject' => $this->input->post("Edit_subject"),
			'number_of_coypies' => $this->input->post('Edit_number_of_coypies'),
			'price' => $this->input->post('Edit_price'),
			'Supplier_id' => $this->input->post('Edit_Supplier_id'),
			'Staff_id' => $this->input->post('Edit_Staff_id'),
			'Publisher_id' => $this->input->post('Edit_Publisher_id'),

		);

		try {
			$this->db->set($data);

			$this->db->where('id', $book_id);
			$this->db->update($this->table, $data);
			return true;
		} catch (Exception $exception) {
			return false;
		}

	}

	function get_Members()
	{
		$data = $this->db->get('member');
		return $data->result();


	}

	function get_Books()
	{
		$data = $this->db->get('book');
		return $data->result();


	}

//$this->db->select('books_status.id as id,  book.title as title , Staff.name  as  Staff_name , books_status.status as status ,
//		 					 books_status.create_time as date_borrow , books_status.Due_Date as Due_Date , Member.name as Member_name');
//$this->db->from($this->table);
//$this->db->join('book', 'Book_id = book.id');
//$this->db->join('Member', 'Member_id = Member.id');
//$this->db->join('Staff', 'books_status.Staff_id = Staff.id');
//$data = $this->db->get();

//return $data->result();


	function get_Book_data_By_ID($id = '', $where = [])
	{
		$this->db->select('Book.title , book.cover_img as cover_img, Book.ISBN , Book.number_of_coypies , Category.name as category_name ,
		 Supplier.name as Supplier_name  , Publisher.name as publisher_name    ');
		$this->db->from('book');
		$this->db->join('publisher', 'Publisher_id = publisher.id');
		$this->db->join('supplier', 'Supplier_id = supplier.id');
		$this->db->join('category', 'Category_id = category.id');

		$this->db->where($where);
		if (is_numeric($id)) {
			$this->db->where('book.id', $id);
			$section = $this->db->get()->row();
			return $section;

		}
	}


	function get_Members_data_By_ID($id = '', $where = [])
	{
		$this->db->select('email , phone , address ,create_time as join_at ,
		 profile_photo as img , card_id , username ');
		$this->db->from('member');

		$this->db->where($where);
		if (is_numeric($id)) {
			$this->db->where('member.id', $id);
			$section = $this->db->get()->row();
			return $section;

		}
	}



}
