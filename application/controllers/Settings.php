<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		check_admin();
		
		// Auto-create settings table if not exists
		if (!$this->db->table_exists('settings')) {
			$this->load->dbforge();
			$fields = array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'nama_usaha' => array('type' => 'VARCHAR', 'constraint' => '100', 'default' => 'KopiPOS'),
				'alamat' => array('type' => 'TEXT', 'null' => TRUE),
				'telepon' => array('type' => 'VARCHAR', 'constraint' => '20', 'null' => TRUE),
				'logo' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('settings', TRUE);
			
			$this->db->insert('settings', ['nama_usaha' => 'KopiPOS']);
		}
	}

	public function index()
	{
		$data['setting'] = $this->db->get_where('settings', ['id' => 1])->row();
		$this->template->load('template', 'settings', $data);
	}

	public function update()
	{
		$post = $this->input->post(null, TRUE);
		
		$data = [
			'nama_usaha' => $post['nama_usaha'],
			'alamat'     => $post['alamat'],
			'telepon'    => $post['telepon'],
		];

		if (!empty($_FILES['logo']['name'])) {
			$config['upload_path']   = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']      = 2048;
			$config['file_name']     = 'logo-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('logo')) {
				// Remove old logo if exists
				$old_setting = $this->db->get_where('settings', ['id' => 1])->row();
				if ($old_setting->logo != null) {
					$target_file = './uploads/' . $old_setting->logo;
					if (file_exists($target_file)) {
						unlink($target_file);
					}
				}
				$data['logo'] = $this->upload->data('file_name');
			} else {
				echo "<script>alert('Gagal upload logo: ".$this->upload->display_errors()."'); window.location='".site_url('settings')."';</script>";
				return;
			}
		}

		$this->db->where('id', 1);
		$this->db->update('settings', $data);
		
		echo "<script>alert('Pengaturan berhasil disimpan!'); window.location='".site_url('settings')."';</script>";
	}
}
