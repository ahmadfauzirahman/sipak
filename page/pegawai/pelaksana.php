<?php
require_once 'data/sesi.php';
require_once 'data/koneksi.php';

if (isset($_REQUEST['id_keg'])) {
    $id_keg = $_REQUEST['id_keg'];
} else {
    echo "ID tidak ada";
    exit();
}

$sql = "SELECT * FROM pelaksana WHERE id_keg =$id_keg";
$stmt = $connect->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$sql2 = "SELECT * FROM kegiatan WHERE id_keg =$id_keg";
$stmt2 = $connect->prepare($sql2);
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
$stmt2->execute();
$y = $stmt2->fetch();
?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pelaksana <?php echo $y['nama_keg'];?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>

                                    <tr>
                                        <th width="7%">No</th>
                                        <th>Nama Pelaksana</th>
                                        <th>NIP</th>
                                        <th>Pangkat/Gol.Ruang</th>
                                        <th>Jabatan</th>
                                        <th>Unit Kerja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no=1;
                                        while ($x = $stmt->fetch()) {
                                    ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $x['nama_plk'];?></td>
                                            <td><?php echo $x['nip_plk'];?></td>
                                            <td><?php if($x['nama_plk']!=null){echo $x['pangkat_plk'];}?></td>
                                            <td><?php echo $x['jabatan_plk'];?></td>
                                            <td><?php echo $x['unit_plk'];?></td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->