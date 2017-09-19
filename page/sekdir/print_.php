<?php
require_once 'data/sesi.php';
require_once 'data/koneksi.php';

if (isset($_REQUEST['id_keg'])) {
    $id_keg = $_REQUEST['id_keg'];
} else {
    echo "ID tidak ada";
    exit();
}

$sql = "SELECT * FROM kegiatan WHERE id_keg=$id_keg";
$stmt = $connect->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();
$obj = $stmt->fetch();

$sql2 = "SELECT * FROM pelaksana WHERE id_keg =$id_keg";
$stmt2 = $connect->prepare($sql2);
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
$stmt2->execute();
?>
<div class="row">
    <table>
        <tr>
            <td style="height: 20px;"></td>
        </tr>
        <tr>
            <td style="width: 40px;"></td>
            <td>
                <img src="assets/img/logo.png" style="height: 110px;">
            </td>
            <td style="width: 515px;">
        <center>
            <font face="Times New Roman" size="5" style="font-weight: bold;"><p>DESA TEMUSAI <br></font>
                <font face="Times New Roman" size="4">BADAN KEPENDUDUKAN DAN KELUARGA<br>BERENCANA NASIONAL<br></font>
                <font face="Times New Roman" size="3"> RIAU</p></font>

            <font face="Times New Roman" size="1"><p>Melayani Masyarakat<br>Jl. Terubuk No.1, Wonorejo, Marpoyan Damai, Kota Pekanbaru, Riau 28125<br> Website : http://riau.bkkbn.go.id, Fax : (0761) - 38006</font>

        </center>
        </td>
        <td>
            <img src="assets/img/riau.png" style="height: 100px;">
        </td>
        </tr>
        <tr>
            <td colspan="4"><hr style="border-color:black;-webkit-margin-before: 0px;-webkit-margin-after: 10px;"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td style="width: 515px;">
        <center>
            <font face="Times New Roman" size="5" style="text-decoration: underline;font-weight: bold;"><p style="-webkit-margin-after: 5px;">S U R A T  &nbsp;&nbsp;&nbsp;T U G A S<br></font></p>
            <font face="Times New Roman" size="4" style="font-weight: bold;"><p>Nomor : <?php echo @$_POST['no_surat']; ?></p></font><br>
        </center>
        </td>
        <td></td>
        </tr>

        <tr>
            <td style="width: 15px;"></td>
            <td colspan="3" style="width: 400px;padding-right: 20px">
                <font face="Times New Roman" size="3"><p style=" text-align:justify;line-height: 1.5;"><span style="display:inline-block; width: 30;"></span>Yang bertanda tangan di bawah ini Direktur BKKBN Riau dengan ini memberi tugas kepada:<br></p></font>

                <?php
                $no = 1;
                while ($x = $stmt2->fetch()) {
                    ?>

                    <font face="Times New Roman" size="3"><p style="line-height: 1.5;"><span style="display:inline-block; width: 100;"></span><?php echo $no++; ?>. Nama<span style="display:inline-block; width: 99;"></span>:<?php echo '    ' . $x['nama_plk']; ?><br><span style="display:inline-block; width: 116;"></span>NIP<span style="display:inline-block; width: 112;"></span>:<?php echo '    ' . $x['nip_plk']; ?><br><span style="display:inline-block; width: 116;"></span>Pangkat / Gol.Ruang :<?php echo '    ' . $x['pangkat_plk']; ?><br><span style="display:inline-block; width: 116;"></span>Jabatan<span style="display:inline-block; width: 90;"></span>:<?php echo '    ' . $x['jabatan_plk']; ?><br><span style="display:inline-block; width: 116;"></span>Unit Kerja<span style="display:inline-block; width: 70;"></span>:<?php echo '    ' . $x['unit_plk']; ?></font><br>

                        <?php
                    }
                    ?>
                    <br>
                <font face="Times New Roman" size="3"><p style=" text-align:justify;line-height: 1.5;"><span style="display:inline-block; width: 30;"></span>Dalam rangka melaksanakan kegiatan <?php echo $obj->nama_keg; ?> di <?php echo $obj->tmp_keg; ?> pada tanggal <?php echo tanggal_indo($obj->tgl_keg);
                    if ($obj->tgl2_keg != 0000 - 00 - 00
                    ) {
                        ?> sampai dengan <?php echo tanggal_indo($obj->tgl2_keg);
                    } ?>.<br></p></font>

                <font face="Times New Roman" size="3"><p style=" text-align:justify;line-height: 1.5;"><span style="display:inline-block; width: 30;"></span>Demikian surat tugas ini dibuat, agar yang bersangkutan melaksanakan tugas dengan baik dan penuh tanggung jawab.</p></font><br>

                <font face="Times New Roman" size="3"><p style=" text-align:justify;-webkit-margin-after: 0px;" line-height: 1.5;><span style="display:inline-block; width: 440;"></span>Dikeluarkan di : Pekanbaru<p style="text-decoration: underline;text-align:justify;-webkit-margin-after: 0px;"><span style="display:inline-block; width: 440;"></span>Pada tanggal : <?php echo tanggal_indo(@$_POST['tgl_surat']); ?></p><p><span style="display:inline-block; width: 440;"></span><?php if (@$_POST['ttd'] == "Direktur") {
                        echo'Direktur,';
                    } else {
                        echo 'an.Direktur,';
                        if (@$_POST['ttd'] == "Pudir I") {
                            echo'<br><span style="display:inline-block; width: 440;"></span>Pembantu Direktur I';
                        } else if (@$_POST['ttd'] == "Pudir II") {
                            echo'<br><span style="display:inline-block; width: 440;"></span>Pembantu Direktur II';
                        } else if (@$_POST['ttd'] == "Pudir III") {
                            echo'<br><span style="display:inline-block; width: 440;"></span>Pembantu Direktur III';
                        }
                    } ?></p></font><br><br><br>

                <font face="Times New Roman" size="3"><p style="text-decoration: underline;text-align:justify;-webkit-margin-after: 0px;"><span style="display:inline-block; width: 440;"></span><?php if (@$_POST['ttd'] == "Direktur") {
                        echo'Hj. Rusherina, S.Pd, S.Kep, M.Kes';
                    } else {
                        if (@$_POST['ttd'] == "Pudir I") {
                            echo'<br><span style="display:inline-block; width: 440;"></span>H. Husnan, SKp., MKM';
                        } else if (@$_POST['ttd'] == "Pudir II") {
                            echo'<br><span style="display:inline-block; width: 440;"></span>Hj. Juraida Roito Hrp, SKM., M.Kes';
                        } else if (@$_POST['ttd'] == "Pudir III") {
                            echo'<br><span style="display:inline-block; width: 440;"></span>Fitri, SP., MKM';
                        }
                    } ?></p><p><span style="display:inline-block; width: 440;"></span><?php if (@$_POST['ttd'] == "Direktur") {
                        echo'NIP. 196504241988032002';
                    } else {
                        if (@$_POST['ttd'] == "Pudir I") {
                            echo'<br><span style="display:inline-block; width: 440;"></span>NIP. 196505101985031008';
                        } else if (@$_POST['ttd'] == "Pudir II") {
                            echo'<br><span style="display:inline-block; width: 440;"></span>NIP. 196608021989032002';
                        } else if (@$_POST['ttd'] == "Pudir III") {
                            echo'<br><span style="display:inline-block; width: 440;"></span>NIP. 198008132006042010';
                        }
                    } ?></p></font><br><br><br>

            </td>			
        </tr>
    </table>
</div>