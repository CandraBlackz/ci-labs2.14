<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		// echo $this->uri->segment(1);
		// echo $this->uri->segment(2);
		// echo $this->uri->segment(3);

		echo $this->uri->total_segments();
		$this->load->view('menu_member');
	}

	public function tambah_artikel(){

		$action = $this->uri->segment(3);
		$this->load->helper('form');
		$this->load->library('form_validation');
		if($action=='kirim'){
			$post = $this->input->post();

			$this->form_validation->set_rules('title', 'Judul Artikel', 'required');
			$this->form_validation->set_rules('author', 'Penulis', 'required');			
			$this->form_validation->set_rules('content', 'Isi Artikel', 'required');
			$this->form_validation->set_message('required', '%s masih kosong, silahkan diisi');			
			$this->form_validation->set_error_delimiters('<p class="alert">', '</p>');

			if($this->form_validation->run() == FALSE){
				$this->load->view('tambah_artikel');
			}
			else{

				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 100;
				$config['max_width'] = 1024;
				$config['max_height'] = 768;

				$this->load->library('upload', $config);
				if($this->upload->do_upload('userfile')){
					$upload_data = $this->upload->data();
					$featured_image = base_url().'uploads/'.$upload_data['file_name'];

					$this->load->model('Post_model');

					$data = array(
						'title' => $post['title'],
						'author' => $post['author'],
						'date' => date('Y-m-d'),
						'content' => $post['content'],
						'featured_image' => $featured_image
					);
	
					$this->Post_model->create('tbl_post',$data);	
					$this->load->view('tambah_artikel_berhasil', $data);
				}
				else{
					$data = array(
						'error' => $this->upload->display_errors()
						);
					$this->load->view('tambah_artikel',$data);
				}

				/*

				*/
			}

		}
		else{
			$this->load->view('tambah_artikel');
		}

	}

	public function daftar_artikel(){
		$this->load->model('Post_model');
		$this->load->library('pagination');

		$config['base_url'] = base_url('front/daftar_artikel/hal/');
		$config['total_rows'] = $this->Post_model->total_rows('tbl_post');
		$config['per_page'] = 5;

		/* config */
		$config['full_tag_open'] = '<div class="paging">';
		$config['full_tag_close'] = '</div>';
		$config['first_url'] = '';

		$this->pagination->initialize($config);

		$limit = $config['per_page'];
		$offset = (int) $this->uri->segment(4);

		$data = array(
			'record' => $this->Post_model->read('tbl_post', $limit, $offset),
			'pagination' => $this->pagination->create_links()
		);
		
		$this->load->view('daftar_artikel', $data);
	}

	public function edit_artikel($id=0){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Post_model');

		if($id != 0 && !empty($id)){
			$data = array(
				'record' => $this->Post_model->edit($id, 'tbl_post')
			);

			$this->load->view('edit_artikel', $data);
		}
		else{
			redirect(base_url('front/daftar_artikel'));
		}

	}

	public function update_artikel(){
		$post = $this->input->post();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul Artikel', 'required');
		$this->form_validation->set_rules('author', 'Penulis', 'required');			
		$this->form_validation->set_rules('content', 'Isi Artikel', 'required');
		$this->form_validation->set_message('required', '%s masih kosong, silahkan diisi');			
		$this->form_validation->set_error_delimiters('<p class="alert">', '</p>');

		if($this->form_validation->run() == TRUE){
			$this->load->model('Post_model');

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 100;
			$config['max_width'] = 1024;
			$config['max_height'] = 768;

			$this->load->library('upload', $config);
			if($this->upload->do_upload('userfile')){
				$upload_data = $this->upload->data();
				$featured_image = base_url().'uploads/'.$upload_data['file_name'];

				$this->load->model('Post_model');

				$data = array(
					'title' => $post['title'],
					'author' => $post['author'],
					'date' => date('Y-m-d'),
					'content' => $post['content'],
					'featured_image' => $featured_image
				);

			$this->Post_model->update($post['ID'],$data,'tbl_post');
			redirect(base_url('front/daftar_artikel'));
			}
		}
		else{

		}

	}

	public function delete_artikel($id=0){
		$this->load->model('Post_model');
		$this->Post_model->delete($id,'tbl_post');

		redirect(base_url('front/daftar_artikel'));
	}

	public function register(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|callback_username_check');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi');
		$this->form_validation->set_message('valid_email', 'silahkan ketikkan format email yang benar');
		$this->form_validation->set_message('min_length', 'password kurang dari 5 digit');
		$this->form_validation->set_error_delimiters('<p class="alert">','</p>');

		if($this->form_validation->run() == FALSE){
			$this->load->view('form_register');
		}
		else{
			$this->load->model('User_model');
			$this->User_model->user_register($this->input->post(NULL,TRUE)); 
			$this->load->view('register_sukses');
		}
	}	

	public function email_check($str){
		$this->load->model('User_model');
		if($this->User_model->exist_row_check('email', $str) > 0){
			$this->form_validation->set_message('email_check', 'Email sudah digunakan, mohon diganti yang lain');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}

	public function username_check($str){
		$this->load->model('User_model');
		if($this->User_model->exist_row_check('username', $str) > 0){
			$this->form_validation->set_message('username_check', 'Username sudah digunakan, mohon diganti yang lain');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}

}
