<?php require_once APP_ROOT . '/protect.php';
allow_level(['Administrator']);
?>

<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data KK</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-kartu" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Kepala Keluarga</th>
						<th>No Rumah</th>
						<th>Alamat</th>
						<th>Anggota KK</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
              $sql = $koneksi->query("select * from tb_kk");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['kepala']; ?>
						</td>
						<td>
							<?php echo $data['nomor']; ?>
						</td>
						<td>
							<?php echo $data['desa']; ?>
							RT
							<?php echo $data['rt']; ?>/ RW
							<?php echo $data['rw']; ?>
						</td>
						<td>
							<a href="?page=anggota&kode=<?php echo $data['id_kk']; ?>" title="Anggota KK"
							 class="btn btn-info btn-sm">
								<i class="fa fa-users"></i>
							</a>
						</td>
						<td>
						    <a href="?page=view-kartu&kode=<?php echo $data['id_kk']; ?>" title="Detail"
							 class="btn btn-info btn-sm"><i class="fa fa-user"></i>
							 </a>
							 <a href="?page=edit-kartu&kode=<?php echo $data['id_kk']; ?>" title="Ubah" class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-kartu&kode=<?php echo $data['id_kk']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
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
	<!-- /.card-body -->