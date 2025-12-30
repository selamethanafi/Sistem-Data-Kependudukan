<?php
$koneksi = new mysqli ("localhost","sigta","PrBRpAE68addZRJS","sigta");
$key = 'be3c94862086562d97a535a4353d0d8811';
$app_key = $_POST['token'] ?? '';
$message = $_POST['message'] ?? '';
$chat_id = $_POST['chat_id'] ?? '';
/*
$app_key = 'be3c94862086562d97a535a4353d0d8811';

$message = 'GTA KELUARGA';
$chat_id = '230863132483753@lid';
*/
$message = strtoupper($message);
// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$response = array();

if($app_key == $key)
{
    $ta= mysqli_query($koneksi, "SELECT * FROM `tb_kk` WHERE `chat_id` = '$chat_id'");
    if(mysqli_num_rows($ta) == 0)
    {
        $h["pesan"]= "Mohon maaf nomor whatsapp tidak ditemukan";
    }
    else
    {
        $da = mysqli_fetch_assoc($ta);
        $no_kk = $da['no_kk'];
        $id_kk = $da['id_kk'];
        $nama_warga = $da['kepala'];
        $nomor_rumah = $da['nomor'];
        $rt = $da['rt'];
        $rw = $da['rw'];
        $desa = $da['desa'];
        $kec = $da['kec'];
        $kab = $da['kab'];
        $prov = $da['prov'];
        $mulai = $da['mulai'];
        $chat_id = $da['chat_id'];
        
        $hp = $da['hp'];
        $password = $da['password'];
        if($message == 'GTA PASSWORD')
        {
            $plain = substr(str_shuffle('ABCDEFGHJKLMNPQRSTWXYZ123456789'), 0, 6);
            $hash = password_hash($plain, PASSWORD_DEFAULT);
            $sql_ubah = "UPDATE `tb_kk` SET `password` = '$hash' where `no_kk`= '$no_kk'";
            $query_ubah = mysqli_query($koneksi, $sql_ubah);

            $pesan = "Yth. Bapak / Ibu $nama_warga Warga GTA, kami informasikan akun di https://www.gta.web.id\n\nUsername $no_kk\n\nPassword $plain\n\n
Atas perhatian dan kerja samanya, kami ucapkan terima kasih.";
            $h["pesan"]= $pesan;
        }
        else if($message == 'GTA KELUARGA')
        {
            $pesan = "Menyampaikan informasi data warga Perumahan Graha Tengaran Asri RT 21B RW 04 DESA Tengaran\n\nData Kartu Keluarga\n";
            $pesan .= "Nama ".$nama_warga."\nNomor Rumah ".$nomor_rumah."\nAlamat RT ".$rt." RW ".$rw." Desa ".$desa." Kec. ".$kec." Kab. ".$kab." Prov ".$prov."\nMulai tinggal ".$mulai."\nChat Id ".$chat_id."\n\n";
            $tb = mysqli_query($koneksi, "SELECT * FROM `tb_anggota` WHERE `id_kk` = '$id_kk'");
            if(mysqli_num_rows($tb) == 0)
            {
                $pesan= "Mohon maaf data anggota keluarga tidak ditemukan";
            }
            else
            {

                while($db = mysqli_fetch_assoc($tb))
                {
                    $id_pend = $db['id_pend'];
                    $hubungan = $db['hubungan'];
                    $tc = mysqli_query($koneksi, "SELECT * FROM `tb_pdd` WHERE `id_pend` = '$id_pend'");
                    $pesan .= $hubungan."\n";
                    while($dc = mysqli_fetch_assoc($tc))
                    {
                        $nik = $dc['nik'] ?? '0';
                        $nama = $dc['nama'] ?? '';
                        $tempat = $dc['tempat_lh'] ?? '';
                        $tgl_lh = $dc['tgl_lh'] ?? '';
                        $jekel = $dc['jekel'] ?? '';
                        $agama = $dc['agama'] ?? '';
                        $kawin = $d['kawin'] ?? '';
                        $pekerjaan = $dc['pekerjaan'] ?? '';
                        $hp = $dc['hp'] ?? '';
                        $pesan .= "NIK $nik\nNama ".$nama."\nTempat Lahir ".$tempat."\nTanggal Lahir ".$tgl_lh."\nJenkel ".$jekel."\nAgama ".$agama."\nStatus perkawinan ".$kawin."\nPekerjaan ".$pekerjaan."\nNomor HP ".$hp."\n\n";
                    }
                }
                $pesan .="\nBila ada data yang belum benar silakan menghubungi Admin GTA";                
                $h["pesan"]= $pesan;
            }
        }
        else
        {
            $h["pesan"]= $message."\n\nMohon maaf informasi yang dimaksud belum tersedia";        
        }
    }
	array_push($response, $h);
	echo json_encode($response);
    
}
else
{
    $h["pesan"]="akses ilegal";
	array_push($response, $h);
	echo json_encode($response);
}
mysqli_close($koneksi);