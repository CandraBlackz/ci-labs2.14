<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model{

	public function __construct(){
		parent:: __construct();
	}

	public function create($table,$data){
		$this->db->insert($table,$data);
	}

	public function read($table,$limit,$offset){
		// $query = $this->db->query("select * from $table order by ID DESC");

		$this->db->from($table);
		$this->db->limit($limit,$offset);
		$this->db->order_by('ID', 'DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}

			$query->free_result();
		}

		else{
			$data = NULL;
		}

		return $data;
	}

	public function edit($id,$table){
		$this->db->where('ID',$id);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			$data = $query->row();
			$query->free_result();
		}
		else{
			$data = NULL;
		}

		return $data;
	}

	public function update($id,$data,$table){
		$this->db->where('ID', $id);
		$this->db->update($table,$data);
	}

	public function delete($id,$table){
		$this->db->where('ID',$id);
		$this->db->delete($table);
	}

	public function total_rows($table){
		return $this->db->count_all_results($table);
	}
}
