<?php require_once APP_ROOT . '/protect.php';
allow_level(['Administrator','Operator']);
?>
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Penduduk</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-pend" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Data</a> <a href="?page=add-kartu" class="btn btn-success">
					<i class="fa fa-users"></i> Tambah KK</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>JK</th>
						<th>No KK</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
			  $sql = $koneksi->query("SELECT p.id_pend, p.tgl_lh, p.tempat_lh, p.nik, p.nama, p.jekel, p.agama, p.kawin, p.pekerjaan, a.id_kk, k.no_kk, k.kepala, k.hp from 
			  tb_pdd p left join tb_anggota a on p.id_pend=a.id_pend 
			  left join tb_kk k on a.id_kk=k.id_kk where status='Ada'");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
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
							<?php echo $data['kepala']; ?>-
							<?php echo $data['hp']; ?>
							<?php
							if(!empty($data['hp']))
							{
							    $no_hp = preg_replace('/[^0-9]/', '', $data['hp']); // bersihkan
                        $pesan = "Yth. Bpk/Ibu {$data['kepala']},\n".
             "Kami dari RT 21B ingin memastikan apakah data keluarga yang telah dientry sudah benar.\n".
             "Mohon dibalas:\n".
             "- BENAR (jika sudah sesuai)\n".
             "- atau kirimkan perbaikannya jika ada kesalahan.\n".
             "Terima kasih.\n\nNama {$data['nama']}\nNIK {$data['nik']}\nTempat lahir {$data['tempat_lh']}\nTanggal lahir {$data['tgl_lh']}\nJenis Kelamin {$data['jekel']}\nStatus perkawinan {$data['kawin']}\nPekerjaan {$data['pekerjaan']}";
    ?>

    <a href="https://wa.me/<?= $no_hp ?>?text=<?= urlencode($pesan) ?>"
       target="_blank"
       class="btn btn-success btn-sm mt-1">
        <i class="fab fa-whatsapp"></i> Chat WA
    </a>
    <?php
							}
							?>
						</td>

						<td>
							<a href="?page=view-pend&kode=<?php echo $data['id_pend']; ?>" title="Detail"
							 class="btn btn-info btn-sm">
								<i class="fa fa-user"></i>
							</a>
							<a href="?page=edit-pend&kode=<?php echo $data['id_pend']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-pend&kode=<?php echo $data['id_pend']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
								</>
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
	<!-- /.card-body -->