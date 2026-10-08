<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('unit_m');
		check_not_login();
	}

	public function index()
	{
		$data['row'] = $this->unit_m->get();
		$this->template->load('template', 'produk/unit/unit_data', $data);
	}

	public function tambah()
	{
		$unit = new stdClass();
		$unit->unit_id = null;
		$unit->name = null;
		$data = array(
			'page' => 'tambah',
			'row' => $unit
		);
		$this->template->load('template', 'produk/unit/unit_form', $data);
	}

	public function ubah($id)
	{
		$query = $this->unit_m->get($id);
		if ($query->num_rows() > 0) {
			$unit = $query->row();
			$data = array(
				'page' => 'ubah',
				'row' => $unit
			);
			$this->template->load('template', 'produk/unit/unit_form', $data);
		} else {
?>
			<script type="text/javascript">
				alert('Data Tidak Ditemukan');
				window.location = "<?= site_url('unit'); ?>";
			</script>
<?php
		}
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['tambah'])) {
			$this->unit_m->tambah($post);
		} else if (isset($_POST['ubah'])) {
			$this->unit_m->ubah($post);
		}
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data Berhasil Disimpan');
		}
		redirect('unit');
	}


	public function hapus($id)
	{
		$this->unit_m->hapus($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data Berhasil Dihapus');
		}
		redirect('unit');
	}
}
