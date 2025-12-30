<?php require_once APP_ROOT . '/protect.php';
allow_level(['Administrator']);
?>

<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_kk WHERE id_kk='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Data Kartu Keluarga</h3>
	</div>
	<div class="card-body p-0">
		<table class="table">
			<tbody>
				<tr>
					<td style="width: 150px">No Sistem</td>
					<td>: <?php echo $data_cek['id_kk'];?></td>
				</tr>
                <tr>
					<td style="width: 150px">No KK</td>
 					<td>: <?php echo $data_cek['no_kk'];?></td>
 				</tr>
                <tr>
					<td style="width: 150px">Kpl Keluarga</td>
 					<td>: <?php echo $data_cek['kepala'];?></td>
 				</tr>
                <tr>
					<td style="width: 150px">Desa</td>
					<td>: <?php echo $data_cek['desa'];?>
				</tr>
                <tr>
					<td style="width: 150px">: RT/RW</td>
					<td>: <?php echo $data_cek['rt'];?> / <?php echo $data_cek['rw'];?>
					</td>
				</tr>
                <tr>
					<td style="width: 150px">Kecamatan</td>
					<td>: <?php echo $data_cek['kec'];?>
                <tr>
					<td style="width: 150px">Kabupaten</td>
					<td>: <?php echo $data_cek['kab'];?></td>
				</tr>
                <tr>
					<td style="width: 150px">Provinsi</td>
					<td>: <?php echo $data_cek['prov'];?></td>
				</tr>
                <tr>
					<td style="width: 150px">Chat Id</td>
					<td>: <?php echo $data_cek['chat_id'];?></td>
				</tr>
			</tbody>
		</table>
		<div class="card-footer">
			<a href="?page=data-kartu" class="btn btn-warning">Kembali</a>
		</div>
	</div>
</div>
