<?php


class Book_model extends CI_Model
{
	public function __construct()
	{
		$this->table = 'book';

	}


	function book_list()
	{
//
//		$this->db->select('*');
//		$this->db->from($this->table);
//		$this->db->join('supplier', 'Supplier_id = Supplier.id');
//		$query = $this->db->row();



//		$query = "SELECT *
//FROM `book`
//JOIN supplier ON Supplier_id = supplier.id";
//
//
//$data =$this->db->query($query);
		 $this->db->select('book.id, book.cover_img as cover_img_link , title , category.name as qat_name ,subject, price, number_of_coypies as Qty ,
		  Staff.name  as  Staff_name , Supplier.name as Supplier_name , Publisher.name as Publisher_name , ISBN    ');
		$this->db->from($this->table);
		 $this->db->join('Supplier', 'Supplier_id = Supplier.id') ;
		$this->db->join('Publisher', 'Publisher_id = Publisher.id') ;
		$this->db->join('Staff', 'Staff_id = Staff.id') ;
		$this->db->join('category', 'Category_id = category.id') ;

$data = $this->db->get();

//
//		$data = $this->db->get('book');
//		return $this->result();
		return $data->result();

	}

	function book_list_id($book_id = '', $where = [])
	{
		$this->db->select('*');
		$this->db->from($this->table);
//        $this->db->join('coupon_courses', 'coupon_curses.course_id = coupons.course_id' , 'Left');
		$this->db->where($where);
		if (is_numeric($book_id)) {
			$this->db->where('id', $book_id);
			$section = $this->db->get()->row();
			return $section;

		}
	}

	function add_book($cover_img)
	{
		$data = array(
			'title' 	=> $this->input->post("title"),
			'subject' 	=> $this->input->post("subject"),
			'number_of_coypies' => $this->input->post('number_of_coypies'),
			'price' => $this->input->post('price'),
			'Supplier_id' 	=> $this->input->post('Supplier_id'),
			'Staff_id' 	=> $this->input->post('Staff_id'),
			'Publisher_id' => $this->input->post('Publisher_id'),
			'Category_id' => $this->input->post('category_id'),
			'ISBN' => $this->input->post('ISBN'),
			'cover_img' => $cover_img,


		);
		$result = $this->db->insert($this->table,$data);
		return $result;
	}

	function delete($book_id){

		$this->db->where('id', $book_id);
		$result=$this->db->delete($this->table);
		return $result;
	}

	function update( $book_id , $cover_file )
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

			$this->db->where('id', $book_id);
			$this->db->update($this->table, $data);
			return true;
		}catch (Exception $exception){
			return false;
		}

	}

	function  get_supplier()
	{
		$data = $this->db->get('Supplier');
		return $data->result();


	}

	function  get_Publisher()
	{
		$data = $this->db->get('Publisher');
		return $data->result();

	}
	function  get_Staff()
	{
		$data = $this->db->get('Staff');

		return $data->result();

	}
	function  get_Category()
	{
		$data = $this->db->get('category');
		return $data->result();

	}




}
