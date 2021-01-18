<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pengurus extends CI_Model {

	public function getAll() {
		// SELECT * FROM Pengurus
		return $this->db->get('pengurus')->result_array();
	}

	public function getByID($id) {
		// SELECT * FROM pengurus WHERE id=$id
		return $this->db->get_where('pengurus',array('id'=>$id))->result_array();
	}

	public function addData($data) {
		//INSERT INTO pengurus VALUES()
		$simpan=$this->db->insert('pengurus',$data);
		if($simpan) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function updateData($data,$id){
		// UPDATE PENGURUS SET WHERE id=id
		$update=$this->db->update('pengurus',$data,array('id'=>$id));
		if($update) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function delData($id) {
		$hapus=$this->db->delete('pengurus',array('id'=>$id));
		if($hapus) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}