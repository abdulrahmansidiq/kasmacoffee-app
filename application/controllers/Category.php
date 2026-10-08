<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_m');
		check_not_login();
	}

	public function index()
	{
		$data['row'] = $this->category_m->get();
		$this->template->load('template', 'produk/category/category_data', $data);
	}

	public function tambah()
	{
		$category = new stdClass();
		$category->category_id = null;
		$category->name = null;
		$data = array(
			'page' => 'tambah',
			'row' => $category
		);
		$this->template->load('template', 'produk/category/category_form', $data);
	}

	public function ubah($id)
	{
		$query = $this->category_m->get($id);
		if ($query->num_rows() > 0) {
			$category = $query->row();
			$data = array(
				'page' => 'ubah',
				'row' => $category
			);
			$this->template->load('template', 'produk/category/category_form', $data);
		} else {
?>
			<script type="text/javascript">
				alert('Data Tidak Ditemukan');
				window.location = "<?= site_url('category'); ?>";
			</script>
<?php
		}
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['tambah'])) {
			$this->category_m->tambah($post);
		} else if (isset($_POST['ubah'])) {
			$this->category_m->ubah($post);
		}
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data Berhasil Disimpan');
		}
		redirect('category');
	}


	public function hapus($id)
	{
		$this->category_m->hapus($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data Berhasil Dihapus');
		}
		redirect('category');
	}
}
