            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Form Hak Akses</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="data/simpan_hak_akses.php" method="post" enctype="multipart/form-data" name="FUpload" id="FUpload">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input  type ="text" class="form-control" name="username" required>
                                        </div>
										<div class="form-group">
                                            <label>Password</label>
                                            <input  type ="password" class="form-control" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type ="text" class="form-control" name="nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type ="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Level</label>
                                            <select class="form-control" name="level" required>
                                                <option>Pegawai</option>
                                                <option>Pudir</option>
                                                <option>Sekdir</option>
                                                <option>Direktur</option>
                                                <option>Administrator</option>
                                            </select>
                                        </div><br>
                                        <center><button type="submit" class="btn btn-primary">SIMPAN</button></center>
                                    </form>
                                </div>
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