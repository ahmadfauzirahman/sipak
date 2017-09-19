<?php
require_once 'data/sesi.php';
require_once 'data/koneksi.php';

$dana = array("Dana Mandiri","Dana Sponsor");
?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Form Kegiatan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <form role="form"  id="myForm" action="" method="post" enctype="multipart/form-data" name="FUpload" id="FUpload">
                                    <div class="col-lg-6">                                    
                                        <div class="form-group">
                                            <label>Nama Kegiatan</label>
                                            <input  type ="text" class="form-control" name="nama_keg" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label><br>
                                            <div class="col-lg-5">
                                            <input  type ="date" class="form-control" name="tgl_keg" required >
                                            </div>
                                            <div class="col-lg-2 text-center" style="height:34;line-height: 2.5;font-weight: bold;">s/d</div>
                                            <div class="col-lg-5">
                                            <input  type ="date" class="form-control" name="tgl2_keg">
                                            </div>
                                        </div><br><br>
                                        <div class="form-group">
                                            <label>Tempat</label>
                                            <input type ="text" class="form-control" name="tmp_keg" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Dana</label>
                                            <select class="form-control" name="dana_keg" required>
                                                 <?php 
                                                    foreach ($dana as $w) { ?>
                                                <option  value="<?php echo $w; ?>">
                                                    <?php echo $w; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Pelaksana</label>
                                            <input type="number" class="form-control" id="member" name="plk_keg" required>
                                            <a href="#" id="filldetails" onclick="addFields()">Isi Data Pelaksana</a>
                                        </div>
                                        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                                        <input type="hidden" name="status_keg" value="Menunggu Persetujuan Pudir">
                                        
                                    </div>
                                    <div class="col-lg-6">
                                        <div id="container"></div>
                                    </div>
                                    <div class="col-lg-12">
                                        <br>
                                        <center><button type="submit" onclick="submitForm('data/simpan_kegiatan.php')" class="btn btn-primary">AJUKAN KEGIATAN</button>
                                        <button type="submit" onclick="submitForm('data/draft_kegiatan.php')" class="btn btn-default">SIMPAN DRAFT</button></center>
                                    </div>
                                </form>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->