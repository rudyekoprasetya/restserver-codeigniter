<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//load library 
use chriskacerguis\RestServer\RestController;

class Pengurus extends RestController {

	public function __construct() {
		parent::__construct();
		//load model
		$this->load->Model('Model_pengurus');
	}

	public function index_get() {
		$id=$this->get('id');

		//jika id tidak diisi 
		if($id===null) {
			//semua data
			$data=$this->Model_pengurus->getAll();
		} else {
			//filter data
			$data=$this->Model_pengurus->getByID($id);
		}		

		$this->response( [
                    'status' => true,
                    'message' => 'Data Ditemukan',
                    'data' => $data
                ], 200 );
	}

	public function index_post() {
		$data=array(
			'id'=>$this->post('id'),
			'nama'=>$this->post('nama'),
			'alamat'=>$this->post('alamat'),
			'gender'=>$this->post('gender'),
			'gaji'=>$this->post('gaji')
		);

		$simpan=$this->Model_pengurus->addData($data);

		if($simpan) { //jika berhasil
			$this->response( [
                    'status' => true,
                    'message' => 'Data Berhasil Disimpan',
                    'data' => $data
                ], 200 );
		} else { //jika gagal
			$this->response( [
                    'status' => false,
                    'message' => 'Data Gagal Disimpan'
                ], 400 );
		}
	}

	public function index_put() {
		$id=$this->put('id');

		$data=array(
			'nama'=>$this->put('nama'),
			'alamat'=>$this->put('alamat'),
			'gender'=>$this->put('gender'),
			'gaji'=>$this->put('gaji')
		);

		$ubah=$this->Model_pengurus->updateData($data,$id);

		if($ubah) { //jika berhasil
			$this->response( [
                    'status' => true,
                    'message' => 'Data Berhasil Diupdate',
                    'data' => $data
                ], 200 );
		} else { //jika gagal
			$this->response( [
                    'status' => false,
                    'message' => 'Data Gagal Diupdate'
                ], 400 );
		}
	}

	public function index_delete() {
		$id=$this->delete('id');

		if($id===null) {
			$this->response( [
                    'status' => false,
                    'message' => 'ID Kosong'
                ], 404 );
		} else {
			$hapus=$this->Model_pengurus->delData($id);
			if($hapus) { //jika berhasil
				$this->response( [
                    'status' => true,
                    'message' => 'Data Berhasil Dihapus',
                    'id' => $id
                ], 200 );
			} else {
				$this->response( [
                    'status' => false,
                    'message' => 'Data Gagal Dihapus'
                ], 400 );
			}
		}
	}

}