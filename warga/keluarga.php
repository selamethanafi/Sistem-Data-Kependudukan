<?php require_once APP_ROOT . '/protect.php';
allow_level(['warga']);
?>


<?php
if (!defined('INDEX')) {
    http_response_code(403);
    exit('Akses langsung dilarang');
}

$id_kk = $_SESSION['ses_id'] ;
?>
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-users"></i> Anggota KK</h3>
	</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>NIK</th>
								<th>Nama</th>
								<th>Jekel</th>
								<th>Hub Keluarga</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>

							<?php
              $no = 1;
              $sql = $koneksi->query("
    SELECT 
        p.id_pend,
        p.nik,
        p.nama,
        p.jekel,
        a.hubungan,
        a.id_anggota
    FROM tb_pdd p
    INNER JOIN tb_anggota a ON p.id_pend = a.id_pend
    WHERE status='Ada' AND id_kk=$id_kk
");
              while ($data= $sql->fetch_assoc()) {
            ?>

							<tr>
								<td>
									<?php echo $data['nik']; ?>
								</td>
								<td>
									<?php echo $data['nama']; ?>
								</td>
								<td>
									<?php echo $data['jekel']; ?>
								</td>
								<td>
									<?php echo $data['hubungan']; ?>
								</td>
								<td>
								    <a href="?page=view-kel&kode=<?php echo $data['id_pend']; ?>" title="Detail"
							 class="btn btn-info btn-sm">
								<i class="fa fa-user"></i>
							</a>

								</td>
							</tr>

							<?php
              }
            ?>
						</tbody>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<a href="?page=data-kartu" title="Kembali" class="btn btn-warning">Kembali</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
        $sql_simpan = "INSERT INTO tb_anggota (id_kk, id_pend, hubungan) VALUES (
            '".$_POST['id_kk']."',
            '".$_POST['id_pend']."',
            '".$_POST['hubungan']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=anggota&kode=".$_POST['id_kk']."';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=anggota&kode=".$_POST['id_kk']."';
          }
      })</script>";
    }}
     //selesai proses simpan data
