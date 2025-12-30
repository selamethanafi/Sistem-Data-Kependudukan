<?php require_once APP_ROOT . '/protect.php';
allow_level(['Administrator']);
?>
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">No KK</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="no_kk" name="no_kk" placeholder="No KK" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Kpl Keluarga</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="kepala" name="kepala" placeholder="Kpl Keluarga" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nomor Rumah</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor Rumah" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">RT/RW</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="rt" name="rt" placeholder="RT" required>
				</div>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="rw" name="rw" placeholder="RW" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Desa</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="desa" name="desa" placeholder="Desa" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Kecamatan</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="kec" name="kec" placeholder="Kecamatan" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Kabupaten</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="kab" name="kab" placeholder="Kabupaten" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Provinsi</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="prov" name="prov" placeholder="Provinsi" required>
				</div>
			</div>
           	<div class="form-group row">
				<label class="col-sm-2 col-form-label">Pemilik</label>
				<div class="col-sm-3">
					<select name="pemilik" id="pemilik" class="form-control">
						<option>- Pilih -</option>
						<option value="1">Ya</option>
						<option value="0">Tidak</option>
					</select>
				</div>
			</div>
				<div class="form-group row">
				<label class="col-sm-2 col-form-label">Apakah tinggal di sini</label>
				<div class="col-sm-3">
					<select name="tinggal" id="tinggal" class="form-control">
						<option>- Pilih -</option>
						<option value="1">Ya</option>
						<option value="0">Tidak</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">HP</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="hp" name="hp" placeholder ="6281234567890"
					/>
				</div>
			</div>	
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Chat _Id</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="chat_id" name="chat_id" placeholder ="6281234567890@lid"
					/>
				</div>
			</div>	
		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-kartu" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Simpan'])){
        $sql_simpan = "INSERT INTO tb_kk (no_kk, kepala, desa, rt, rw, kec, kab, prov, nomor, hp, pemilik, tinggal, chat_id) VALUES (
            '".$_POST['no_kk']."',
            '".$_POST['kepala']."',
            '".$_POST['desa']."',
            '".$_POST['rt']."',
            '".$_POST['rw']."',
            '".$_POST['kec']."',
            '".$_POST['kab']."',
            '".$_POST['prov']."',
            '".$_POST['nomor']."',
            '".$_POST['hp']."',
            '".$_POST['pemilik']."',
            '".$_POST['tinggal']."',            
            '".$_POST['chat_id']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-kartu';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-kartu';
          }
      })</script>";
    }}
     //selesai proses simpan data
