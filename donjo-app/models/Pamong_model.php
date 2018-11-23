<?php class Pamong_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function list_data($aktif = false)
	{
		$sql = "SELECT u.*, p.nama as nama, p.nik as nik, p.tempatlahir, p.tanggallahir, x.nama AS sex, b.nama AS pendidikan_kk, g.nama AS agama
			FROM tweb_desa_pamong u
			LEFT JOIN tweb_penduduk p ON u.id_pend = p.id
			LEFT JOIN tweb_penduduk_pendidikan_kk b ON p.pendidikan_kk_id = b.id
			LEFT JOIN tweb_penduduk_sex x ON p.sex = x.id
			LEFT JOIN tweb_penduduk_agama g ON p.agama_id = g.id
			WHERE 1";
    $sql .= $aktif ? " AND u.pamong_status = '1'" : null;
		$sql .= $this->search_sql();
		$sql .= $this->filter_sql();

		$query = $this->db->query($sql);
		$data  = $query->result_array();

		for ($i=0; $i<count($data); $i++)
		{
			$data[$i]['no'] = $i + 1;
		}
		return $data;
	}

	public function list_semua()
	{
		$data = $this->db->select('*')->get('tweb_desa_pamong')->result_array();
		return $data;
	}

	public function autocomplete()
	{
		$sql = "SELECT * FROM
				(SELECT p.nama
					FROM tweb_desa_pamong u
					LEFT JOIN tweb_penduduk p ON u.id_pend = p.id) a
				UNION SELECT p.nik
					FROM tweb_desa_pamong u
					LEFT JOIN tweb_penduduk p ON u.id_pend = p.id
				UNION SELECT pamong_nip FROM tweb_desa_pamong";
		$query = $this->db->query($sql);
		$data  = $query->result_array();

		$outp = '';
		for ($i=0; $i<count($data); $i++)
		{
			$outp .= ",'" .addslashes($data[$i]['nama']). "'";
		}
		$outp = substr($outp, 1);
		$outp = '[' .$outp. ']';
		return $outp;
	}

	private function search_sql()
	{
		if (isset($_SESSION['cari']))
		{
			$cari = $_SESSION['cari'];
			$kw = $this->db->escape_like_str($cari);
			$kw = '%' .$kw. '%';
			$search_sql = " AND (p.nama LIKE '$kw' OR u.pamong_nip LIKE '$kw' OR p.nik LIKE '$kw')";
			return $search_sql;
		}
	}

	private function filter_sql()
	{
		if (isset($_SESSION['filter']))
		{
			$kf = $_SESSION['filter'];
			$filter_sql = " AND u.pamong_status = $kf";
			return $filter_sql;
		}
	}

	public function get_data($id=0)
	{
		$sql = "SELECT * FROM tweb_desa_pamong WHERE pamong_id = ?";
		$query = $this->db->query($sql, $id);
		$data  = $query->row_array();
		return $data;
	 }

	public function get_pamong_by_nama($nama='')
	{
		$pamong = $this->db->select('*')->from('tweb_desa_pamong')->where('pamong_nama', $nama)->limit(1)->get()->row_array();
		return $pamong;
	}

	public function insert()
	{
		$_SESSION['success'] = 1;
		$nama_file = '';
		$lokasi_file = $_FILES['foto']['tmp_name'];
		$tipe_file = $_FILES['foto']['type'];
		$nama_file = $_FILES['foto']['name'];

		if (!empty($nama_file))
		{
		  $nama_file = urlencode(generator(6)."_".$_FILES['foto']['name']);
			if (!empty($lokasi_file) AND in_array($tipe_file, unserialize(MIME_TYPE_GAMBAR)))
			{
				UploadFoto($nama_file, $old_foto='', $tipe_file);
			}
			else
			{
				$nama_file = '';
				$_SESSION['success'] = -1;
				$_SESSION['error_msg'] = " -> Jenis file salah: " . $tipe_file;
			}
		}

		$data['id_pend'] = $this->input->post('id_pend');
		$data['pamong_nip'] = $this->input->post('pamong_nip');
		$data['jabatan'] = $this->input->post('jabatan');
		$data['pamong_status'] = $this->input->post('pamong_status');
		$data['pamong_nosk'] = $this->input->post('pamong_nosk');
		$data['pamong_tglsk'] = $this->input->post('pamong_tglsk');
		$data['pamong_masajab'] = $this->input->post('pamong_masajab');
		$data['pamong_tgl_terdaftar'] = NOW();
		$data['foto'] = $nama_file;
		$outp = $this->db->insert('tweb_desa_pamong', $data);

		if (!$outp) $_SESSION['success'] = -1;
	}

	public function update($id=0)
	{
		unset($_SESSION['validation_error']);
		$_SESSION['success'] = 1;;
		unset($_SESSION['error_msg']);
		$lokasi_file = $_FILES['foto']['tmp_name'];
		$tipe_file = $_FILES['foto']['type'];
		$nama_file = $_FILES['foto']['name'];
		$old_foto = $this->input->post('old_foto');
		if (!empty($nama_file))
		{
		  $nama_file  = urlencode(generator(6)."_".$_FILES['foto']['name']);
			if (!empty($lokasi_file) AND in_array($tipe_file, unserialize(MIME_TYPE_GAMBAR)))
			{
				UploadFoto($nama_file, $old_foto, $tipe_file);
			}
			else
			{
				$nama_file = '';
				$_SESSION['success'] = -1;
				$_SESSION['error_msg'] = " -> Jenis file salah: " . $tipe_file;
			}
		}

		$data = array(
			'id_pend' => $this->input->post('id_pend'),
			'pamong_nip' => $this->input->post('pamong_nip'),
			'jabatan' => $this->input->post('jabatan'),
			'pamong_status' => $this->input->post('pamong_status'),
			'pamong_nosk' => $this->input->post('pamong_nosk'),
			'pamong_tglsk' => tgl_indo_in($this->input->post('pamong_tglsk')),
			'pamong_masajab' => $this->input->post('pamong_masajab')
		);
		if (!empty($nama_file))
		{
			$data['foto'] = $nama_file;
		}
		$this->db->where("pamong_id", $id)->update('tweb_desa_pamong', $data);
	}

	public function delete($id='')
	{
		$foto = $this->db->select('foto')->where('pamong_id',$id)->get('tweb_desa_pamong')->row()->foto;
		if (!empty($foto))
		{
			unlink(LOKASI_USER_PICT.$foto);
			unlink(LOKASI_USER_PICT.'kecil_'.$foto);
		}
		$sql = "DELETE FROM tweb_desa_pamong WHERE pamong_id = ?";
		$outp = $this->db->query($sql,array($id));
		return $outp;
	}

	public function delete_all()
	{
		$_SESSION['success'] = 1;
		$id_cb = $_POST['id_cb'];

		if (count($id_cb))
		{
			foreach ($id_cb as $id)
			{
				$outp = $this->delete($id);
				if (!$outp) $_SESSION['success'] = -1;
			}
		}
	}

	public function ttd($id='', $val=0)
	{
		if ($val == 1)
		{
			// Hanya satu pamong yang boleh digunakan sebagai ttd default
			$this->db->where('pamong_ttd', 1)->update('tweb_desa_pamong', array('pamong_ttd'=>0));
		}
		$this->db->where('pamong_id', $id)->update('tweb_desa_pamong', array('pamong_ttd'=>$val));
	}

}
?>
