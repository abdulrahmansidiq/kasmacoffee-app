<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_not_login();
	}

	public function index()
	{
		$this->template->load('template', 'profile');
	}

	public function upload_photo()
	{
		$config['upload_path']   = './uploads/profile/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = 2048; // 2MB
		$config['file_name']     = 'user-'.$this->fungsi->user_login()->user_id.'-'.date('ymd').'-'.substr(md5(rand()),0,10);

		$this->load->library('upload', $config);

		if (@$_FILES['photo']['name'] != null) {
			if ($this->upload->do_upload('photo')) {
				
				$user_id = $this->fungsi->user_login()->user_id;
				$old_photo = $this->fungsi->user_login()->photo;

				// Hapus foto lama jika ada
				if($old_photo != null && file_exists('./uploads/profile/'.$old_photo)) {
					unlink('./uploads/profile/'.$old_photo);
				}

				$new_photo = $this->upload->data('file_name');
				
				$this->db->set('photo', $new_photo);
				$this->db->where('user_id', $user_id);
				$this->db->update('user');

				echo "<script>
					alert('Foto profil berhasil diupload');
					window.location='".site_url('profile')."';
				</script>";
			} else {
				$error = $this->upload->display_errors();
				echo "<script>
					alert('Gagal upload: ".$error."');
					window.location='".site_url('profile')."';
				</script>";
			}
		} else {
			echo "<script>
				alert('Pilih foto terlebih dahulu');
				window.location='".site_url('profile')."';
			</script>";
		}
	}

	public function change_password()
	{
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		$conf_password = $this->input->post('conf_password');
		
		if($new_password !== $conf_password) {
			echo "<script>
				alert('Konfirmasi password tidak sesuai!');
				window.location='".site_url('profile')."';
			</script>";
			return;
		}

		$user_id = $this->fungsi->user_login()->user_id;
		$current_password = $this->fungsi->user_login()->password;

		if(sha1($old_password) !== $current_password) {
			echo "<script>
				alert('Password lama salah!');
				window.location='".site_url('profile')."';
			</script>";
			return;
		}

		$this->db->set('password', sha1($new_password));
		$this->db->where('user_id', $user_id);
		$this->db->update('user');

		echo "<script>
			alert('Password berhasil diubah!');
			window.location='".site_url('profile')."';
		</script>";
	}
}
