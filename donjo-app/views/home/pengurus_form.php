<div class="content-wrapper">
	<section class="content-header">
		<h1>Staf Pemerintahan <?= ucwords($this->setting->sebutan_desa)?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('pengurus')?>"</i> Daftar Staf Pemerintahan</a></li>
			<li class="active">Staf Pemerintahan <?= ucwords($this->setting->sebutan_desa)?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row" >
			<div class="col-sm-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?= site_url()?>pengurus" class="btn btn-social btn-flat btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Staf</a>
					</div>
					<div class="box-body">
						<form action="" id="main" name="main" method="POST"  class="form-horizontal">
							<div class="form-group" >
				  			<label class="col-sm-4 col-lg-2 control-label"  for="id_pend">NIK / Nama Penduduk </label>
								<div class="col-sm-7">
									<select class="form-contr	ol select2 input-sm" id="id_pend" name="id_pend"  onchange="formAction('main')" style="width:100%" >
										<option selected="selected">-- Silakan Masukan NIK / Nama--</option>
										<?php foreach ($penduduk as $data): ?>
											<option value="<?= $data['id']?>" <?php if ($individu['id']==$data['id']): ?>selected<?php endif; ?>>NIK : <?= $data['nik']." - ".$data['nama']?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
	          </form>
					</div>
				</div>
			</div>
			<form id="validasi" action="<?=$form_action?>" method="POST" enctype="multipart/form-data"  class="form-horizontal">
				<input type="hidden" name="id_pend" value="<?= $individu['id']?>">
				<div class="col-md-3">
					<div class="box box-primary">
						<div class="box-body box-profile">
							<?php if ($pamong['foto']): ?>
								<img class="profile-user-img img-responsive img-circle" src="<?= AmbilFoto($pamong['foto'])?>" alt="Foto">
							<?php else: ?>
								<img class="profile-user-img img-responsive img-circle" src="<?= base_url()?>assets/files/user_pict/kuser.png" alt="Foto">
							<?php endif; ?>
							<br/>
							<p class="text-muted text-center"><code>(Kosongkan jika tidak ingin mengubah foto)</code></p>
							<br/>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control" id="file_path2" name="foto">
								<input type="file" class="hidden" id="file2" name="foto">
								<input type="hidden" name="old_foto" value="<?= $pamong['foto']?>">
								<span class="input-group-btn">
									<button type="button" class="btn btn-info btn-flat"  id="file_browser2"><i class="fa fa-search"></i> Browse</button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="box box-primary">
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pamong_nama">Nama Pegawai <?= ucwords($this->setting->sebutan_desa)?></label>
								<div class="col-sm-7">
									<input type="hidden" name="pamong_status" value="1">
									<input id="pamong_nama" name="pamong_nama" class="form-control input-sm required" type="text" placeholder="Nama" value="<?= ($individu['nama'])?>" disabled="disabled"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pamong_nip">NIP / NIAPD</label>
								<div class="col-sm-7">
									<input id="pamong_nip" name="pamong_nip" class="form-control input-sm" type="text" placeholder="NIP / NIAPD" value="<?=$pamong['pamong_nip']?>" ></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pamong_nik">Nomor Induk Kependudukan</label>
								<div class="col-sm-7">
									<input id="pamong_nik" name="pamong_nik" class="form-control input-sm" type="text" placeholder="Nomor Induk Kependudukan" value="<?=$individu['nik']?>" disabled="disabled"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pamong_ttl">Tempat/Tanggal Lahir</label>
								<div class="col-sm-7">
									<input name="pamong_ttl" class="form-control input-sm" type="text" placeholder="Tempat/Tanggal Lahir" value="<?= strtoupper($individu['tempatlahir'].' / '.$individu['tanggallahir'])?>" disabled="disabled"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pamong_sex">Jenis Kelamin</label>
								<div class="col-sm-7">
									<input name="pamong_sex" class="form-control input-sm" type="text" placeholder="Jenis Kelamin" value="<?= $individu['sex']?>" disabled="disabled"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pamong_pendidikan">Pendidikan</label>
								<div class="col-sm-7">
									<input name="pamong_pendidikan" class="form-control input-sm" type="text" placeholder="Pendidikan" value="<?= $individu['pendidikan_kk']?>" disabled="disabled"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pamong_agama">Agama</label>
								<div class="col-sm-7">
									<input name="pamong_agama" class="form-control input-sm" type="text" placeholder="Agama" value="<?= $individu['agama']?>" disabled="disabled"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pamong_nosk">Nomor SK Pengangkatan</label>
								<div class="col-sm-7">
									<input name="pamong_nosk" class="form-control input-sm" type="text" placeholder="Nomor SK Pengangkatan" value="<?= $pamong['pamong_nosk']?>" ></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pamong_tglsk">Tanggal SK Pengangkatan</label>
								<div class="col-sm-7">
									<input name="pamong_tglsk" class="form-control input-sm" type="text" placeholder="Tanggal SK Pengangkatan" value="<?= $pamong['pamong_tglsk']?>" ></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pamong_masajab">Masa Jabatan (Usia/Periode)</label>
								<div class="col-sm-7">
									<input name="pamong_masajab" class="form-control input-sm" type="text" placeholder="Contoh: 6 Tahun Periode Pertama (2015 s/d 2021)" value="<?= $pamong['pamong_masajab']?>" ></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="jabatan">Jabatan</label>
								<div class="col-sm-7">
									<input id="jabatan" name="jabatan" class="form-control input-sm" type="text" placeholder="Jabatan" value="<?= $pamong['jabatan']?>" ></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-4 col-lg-4 control-label" for="status">Status Pegawai Desa</label>
								<div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons">
									<label id="sx3" class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?php if ($pamong['pamong_status'] == '1' OR $pamong['pamong_status'] == NULL): ?>active<?php endif ?>">
										<input id="group1" type="radio" name="pamong_status" class="form-check-input" type="radio" value="1" <?php if ($pamong['pamong_status'] == '1' OR $pamong['pamong_status'] == NULL): ?>checked <?php endif ?> autocomplete="off"> Aktif
									</label>
									<label id="sx4" class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?php if ($pamong['pamong_status'] == '2'): ?>active<?php endif ?>">
										<input id="group2" type="radio" name="pamong_status" class="form-check-input" type="radio" value="2" <?php if ($pamong['pamong_status'] == '2'): ?>checked<?php endif ?> autocomplete="off"> Tidak Aktif
									</label>
								</div>
							</div>
						</div>
						<div class='box-footer'>
							<div class='col-xs-12'>
								<button type='reset' class='btn btn-social btn-flat btn-danger btn-sm'  onclick="reset_form($(this).val());"><i class='fa fa-times'></i> Batal</button>
								<button type='submit' class='btn btn-social btn-flat btn-info btn-sm pull-right confirm'><i class='fa fa-check'></i> Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>
<script>
	function reset_form()
	{
		<?php if ($pamong['pamong_status'] =='1' OR $pamong['pamong_status'] == NULL): ?>
			$("#sx3").addClass('active');
			$("#sx4").removeClass("active");
		<?php endif ?>
		<?php if ($pamong['pamong_status'] =='2'): ?>
			$("#sx4").addClass('active');
			$("#sx3").removeClass("active");
		<?php endif ?>
	};
</script>
