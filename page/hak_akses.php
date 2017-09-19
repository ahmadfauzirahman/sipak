<?php
require_once 'data/sesi.php';
require_once 'data/koneksi.php';

$sql = "SELECT * FROM user";
$stmt = $connect->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Hak Akses</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-right">
                            <a href="home.php?view=tambah_hak_akses"><button type="button" class="btn btn-success"><i class="fa fa-plus fa-fw"></i><strong>Tambah</strong></button></a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="7%">No</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Aksi</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no=1;
                                        while ($x = $stmt->fetch()) {
                                    ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $x['username']; ?></td>
                                            <td><?php echo $x['nama']; ?></td>
                                            <td><?php echo $x['email']; ?></td>
                                            <td><?php echo $x['level']; ?></td>
                                            <td class="center" width="15%">
                                                <a href="home.php?view=edit_hak_akses&id_user=<?php echo $x['id_user']; ?>"><button type="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil fa-fw"></i><strong>EDIT</strong>
                                                </button></a>
                                                <a href="data/hapus_hak_akses.php?id_user=<?php echo $x['id_user']; ?>" onClick="return confirm('Anda Yakin Ingin Menghapus Hak Akses <?php echo ($x['username']);?> ?')"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i><strong>HAPUS</strong>
                                                </button></a>
                                            </td>
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