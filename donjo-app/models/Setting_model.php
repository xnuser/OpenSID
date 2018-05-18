<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $pre = array();
    $CI = &get_instance();

    // Terpaksa menjalankan migrasi, karena apabila tabel setting_aplikasi
    // atau user_action belum ada, aplikasi tidak bisa di-load
    if (!$this->db->table_exists('setting_aplikasi') OR  !$this->db->table_exists('user_action')) {
      $this->load->model('database_model');
      $this->database_model->migrasi_db_cri();
    }

    if ($this->setting) return;
    if ($this->config->item("useDatabaseConfig")) {
      $pr = $this->db->order_by('key')->get("setting_aplikasi")->result();
      foreach($pr as $p)
      {
        $pre[addslashes($p->key)] = addslashes($p->value);
      }
    }
    else
    {
      $pre = (object) $CI->config->config;
    }
    $CI->setting = (object) $pre;
    $CI->list_setting = $pr; // Untuk tampilan daftar setting
    $this->apply_setting();
  }

  // Setting untuk PHP
  private function apply_setting(){
    //  https://stackoverflow.com/questions/16765158/date-it-is-not-safe-to-rely-on-the-systems-timezone-settings
    date_default_timezone_set($this->setting->timezone);//ganti ke timezone lokal
    // Ambil google api key dari desa/config/config.php kalau tidak ada di database
    if(empty($this->setting->google_key)){
      $this->setting->google_key = config_item('google_key');
    }
  }

  function update($data){
    $_SESSION['success']=1;

    foreach ($data as $key => $value) {
      // Update setting yang diubah
      if ($this->setting->$key != $value) {
        $outp = $this->db->where('key', $key)->update('setting_aplikasi', array('key'=>$key, 'value'=>$value));
        $this->setting->$key = $value;
        if(!$outp) $_SESSION['success']=-1;
      }
    }
    $this->apply_setting();
  }

  function update_slider(){
    $_SESSION['success']=1;
    $this->setting->sumber_gambar_slider = $this->input->post('pilihan_sumber');
    $outp = $this->db->where('key','sumber_gambar_slider')->update('setting_aplikasi', array('value'=>$this->input->post('pilihan_sumber')));
    if(!$outp) $_SESSION['success']=-1;
  }

}
