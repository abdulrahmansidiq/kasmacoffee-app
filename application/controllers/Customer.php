<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('customer_m');
		check_not_login();
	}

	public function index()
	{
		$data['row'] = $this->customer_m->get();
		$this->template->load('template', 'customer/customer_data', $data);
	}

	public function tambah()
	{
		$customer = new stdClass();
		$customer->customer_id = null;
		$customer->name = null;
		$customer->gender = null;
		$customer->phone = null;
		$customer->address = null;
		$data = array(
			'page' => 'tambah',
			'row' => $customer
		);
		$this->template->load('template', 'customer/customer_form', $data);
	}

	public function ubah($id)
	{
		$query = $this->customer_m->get($id);
		if ($query->num_rows() > 0) {
			$customer = $query->row();
			$data = array(
				'page' => 'ubah',
				'row' => $customer
			);
			$this->template->load('template', 'customer/customer_form', $data);
		} else {
?>
			<script type="text/javascript">
				alert('Data Tidak Ditemukan');
				window.location = "<?= site_url('customer'); ?>";
			</script>
		<?php
		}
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);

		if (isset($_POST['tambah'])) {
			//disini cek user

			$this->customer_m->tambah($post);
		} else if (isset($_POST['ubah'])) {
			$this->customer_m->ubah($post);
		}
		if ($this->db->affected_rows() > 0) {
		?>
			<script type="text/javascript">
				alert('Data Berhasil Disimpan');
			</script>
		<?php
		}
		?>
		<script type="text/javascript">
			window.location = "<?= site_url('customer'); ?>";
		</script>
		<?php
	}


	public function hapus($id)
	{
		$this->customer_m->hapus($id);
		if ($this->db->affected_rows() > 0) {
		?>
			<script type="text/javascript">
				alert('Data Berhasil Dihapus');
			</script>
		<?php
		}
		?>
		<script type="text/javascript">
			window.location = "<?= site_url('customer'); ?>";
		</script>
<?php
	}
}
