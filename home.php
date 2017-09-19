<?php
require_once 'data/sesi.php';
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BKKBN</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="assets/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="assets/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<style type="text/css">
    .myselect option { color: black; }
    /* Hidden placeholder */
    .myselect option[disabled]:first-child { display: none; }
    .myselect{color:#43f40e;}
</style>

<!--calender-->
<link rel='stylesheet' href='lib/cupertino/jquery-ui.min.css' />
<link href='fullcalendar.print.min.css' rel='stylesheet' media='print' />
<link href='fullcalendar.min.css' rel='stylesheet' />
<script src='lib/moment.min.js'></script>
<script src='lib/jquery.min.js'></script>
<script src='fullcalendar.min.js'></script>
<script src='locale-all.js'></script>

<?php
require_once 'data/sesi.php';
require_once 'data/koneksi.php';

$sql = "SELECT * FROM kegiatan WHERE status_keg='Disetujui Direktur'";
$stmt = $connect->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$sql2 = "SELECT * FROM kegiatan WHERE status_keg='Disetujui Direktur'";
$stmt2 = $connect->prepare($sql2);
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
$stmt2->execute();
?>

<script>

    $(document).ready(function() {
        var initialLocaleCode = 'id';

        $('#calendar').fullCalendar({
            theme: true,
            defaultDate: '2017-05-12',
            locale: initialLocaleCode,
            //editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [

                <?php
                    $no=1;
                    while ($x = $stmt->fetch()) {
                        $x['tgl2__keg'] = date('Y-m-d', strtotime($x['tgl2_keg'] . ' +1 day'));

                ?>
                {
                    title: '<?php echo $x['nama_keg'];?>',
                    start: '<?php echo $x['tgl_keg'];?>',
                    end: '<?php echo $x['tgl2__keg'];?>',
                    id: '<?php echo $x['id_keg'];?>'
                },
                <?php
                }
                ?>
            ],
            eventClick: function(calEvent, jsEvent, view) {
                 $("#myModal"+calEvent.id).modal();
            }

         });
        
    });

 

</script>
<style>

    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }

</style>
<!--end calender-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php" style="color: #2d29f4">Sistem Informasi Pengelolaan Agenda Kegiatan</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: #4286f4;">
                        <i class="fa fa-user fa-fw"></i><?php echo ($_SESSION['username'])." &nbsp;";?><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="data/do_logout.php" style="color: #4286f4;"><i class="fa fa-sign-out fa-fw"></i> Log Out</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search text-center">
                            <br><img src ="assets/img/logo.png" width="70%"><br><br>
                            <center><h4 style="color: #43f40e;font-weight: bold;"><?php echo strtoupper($_SESSION['nama']);?></h4></center>
                        </li>
                        <?php
                        if($_SESSION['level']!="Administrator"){
                        ?>
                        <li>
                            <a href="home.php?view=kegiatan" style="color: #2d29f4;"><i class="fa fa-file-text-o fa-fw"></i> &nbsp;Agenda Kegiatan</a>
                        </li>
                        <li>
                            <a href="home.php?view=laporan" style="color: #2d29f4;"><i class="fa fa-book fa-fw"></i> &nbsp;Laporan Hasil Kegiatan</a>
                        </li>
                        <li>
                            <a href="home.php?view=kalender" style="color: #2d29f4;"><i class="fa fa-calendar fa-fw"></i> &nbsp;Kalender Kegiatan</a>
                        </li>
                        <?php
                        }else{?>
                        <li>
                            <a href="home.php?view=hak_akses" style="color: #2d29f4;"><i class="fa  fa fa-users fa-fw"></i> &nbsp;Hak Akses</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="row">
                    <div class="col-md-12">
                    <?php
                        if(@$_GET['view']=="kegiatan"){
                            if($_SESSION['level']=="Pegawai"){
                              include "page/pegawai/kegiatan.php";  
                            }else if($_SESSION['level']=="Pudir"){
                              include "page/pudir/kegiatan.php";  
                            }else if($_SESSION['level']=="Direktur"){
                              include "page/direktur/kegiatan.php";  
                            }else if($_SESSION['level']=="Sekdir"){
                              include "page/sekdir/kegiatan.php";  
                            }                            
                        }
                        if(@$_GET['view']=="laporan"){
                            if($_SESSION['level']=="Pegawai"){
                              include "page/pegawai/laporan.php";  
                            }else if($_SESSION['level']=="Pudir"){
                              include "page/pudir/laporan.php";  
                            }else if($_SESSION['level']=="Direktur"){
                              include "page/direktur/laporan.php";  
                            }else if($_SESSION['level']=="Sekdir"){
                              include "page/sekdir/laporan.php";  
                            }
                        }
                        if(@$_GET['view']=="kalender"){
                          include "page/kalender.php";  
                        }
                        if(@$_GET['view']=="hak_akses"){
                            if($_SESSION['level']=="Administrator"){
                                include "page/hak_akses.php";  
                            }
                        }
                        if(@$_GET['view']=="tambah_hak_akses"){
                            if($_SESSION['level']=="Administrator"){
                                include "page/form_hak_akses.php";
                            }  
                        }
                        if(@$_GET['view']=="edit_hak_akses"){
                            if($_SESSION['level']=="Administrator"){
                                include "page/edit_hak_akses.php";
                            }  
                        }
                        if(@$_GET['view']=="tambah_kegiatan"){
                            if($_SESSION['level']=="Pegawai"){
                                include "page/pegawai/form_kegiatan.php";
                            }  
                        }                        
                        if(@$_GET['view']=="edit_kegiatan"){
                            if($_SESSION['level']=="Pegawai"){
                                include "page/pegawai/edit_kegiatan.php";
                            }  
                        }
                        if(@$_GET['view']=="tambah_dana"){
                          //include "page/pegawai/form_dana.php";  
                        }
                        if(@$_GET['view']=="tambah_laporan"){
                            if($_SESSION['level']=="Pegawai"){
                                include "page/pegawai/form_laporan.php";
                            }  
                        }                        
                        if(@$_GET['view']=="edit_laporan"){
                            if($_SESSION['level']=="Pegawai"){
                                include "page/pegawai/edit_laporan.php";
                            }  
                        }
                        if(@$_GET['view']=="pelaksana"){
                            if($_SESSION['level']!="Administrator"){
                                include "page/pegawai/pelaksana.php";
                            }  
                        }
                        if(@$_GET['view']=="print"){
                            if($_SESSION['level']=="Sekdir"){
                                include "page/sekdir/print.php";
                            }  
                        }
                        if(@$_GET['view']=="print_"){
                            if($_SESSION['level']=="Sekdir"){
                                include "page/sekdir/print_.php"; 
                            } 
                        }
                        if(@$_GET['view']==""){
                            echo '<center><br><br><br><br><br><br><br><h1 style="color:#2d29f4;line-height: 1.35em; font-weight: bold;">SELAMAT DATANG<br>DI<br>SISTEM INFORMASI<br>PENGELOLAAN AGENDA KEGIATAN</h1></center>';
                        }
                    ?>
                    </div>
                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php
        $no=1;
        while ($y = $stmt2->fetch()){
    ?>


    <div class="modal fade" id="myModal<?php echo $y['id_keg'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Detail Kegiatan</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Nama Kegiatan : <?php echo $y['nama_keg'];?></p>
                                                        <p>Tanggal : <?php echo tanggal_indo($y['tgl_keg']); if($y['tgl2_keg']!=0000-00-00){ echo ' s/d '.tanggal_indo($y['tgl2_keg']);}?></p>
                                                        <p>Tempat : <?php echo $y['tmp_keg']; ?></p>
                                                        <p>Dana : <?php echo $y['dana_keg']; ?></p>
                                                        <p>Pelaksana :
                                                            <a href="home.php?view=pelaksana&id_keg=<?php echo $y['id_keg']; ?>" target="_blank"><?php 
                                                            $id_keg=$y['id_keg']; 
                                                            $sqlx = "SELECT COUNT(*) c FROM pelaksana WHERE id_keg='$id_keg' ";
                                                            $stmtx = $connect->prepare($sqlx);
                                                            $stmtx->setFetchMode(PDO::FETCH_ASSOC);
                                                            $stmtx->execute();
                                                            $p = $stmtx->fetch();
                                                            echo $p['c']; 
                                                        ?> Orang</a>
                                                        </p>
                                                        <p>Pengajuan Oleh : 
                                                            <?php $oleh=$y['id_user']; 
                                                                $sql4 = "SELECT * FROM user WHERE id_user='$oleh' ";
                                                                $stmt4 = $connect->prepare($sql4);
                                                                $stmt4->setFetchMode(PDO::FETCH_ASSOC);
                                                                $stmt4->execute();
                                                                $o = $stmt4->fetch();
                                                                echo $o['nama'];
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

    <?php
        }
    ?>


    <!-- jQuery 
    <script src="assets/vendor/jquery/jquery.min.js"></script>-->

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="assets/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="assets/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });

    $(document).ready(function(){
        fakewaffle.responsiveTabs(['xs']);
        $('.footable').footable();
    });
    var panelView = $('.panel-group.responsive').is(':visible');    
    $( window ).resize( function () {
        if ( $('.panel-group.responsive').is(':visible') != panelView ) {
            $('.footable').removeClass('footable-loaded').footable();
            panelView = $('.panel-group.responsive').is(':visible');
        }
    } );

    function submitForm(action)
    {
        document.getElementById('myForm').action = action;
        document.getElementById('myForm').submit();
    }

    function addFields(){
        var number = document.getElementById("member").value;
        var container = document.getElementById("container");
        while (container.hasChildNodes()) {
            container.removeChild(container.lastChild);
        }
        var pangkat=[];
        for (i=0;i<number;i++){
            var label = document.createElement("label");
                label.innerHTML = "Pelaksana " + (i+1);
            var nama = document.createElement("input");
                nama.type = "text";
                nama.className = "form-control";
                nama.name = "nama" + i;
                nama.placeholder="Nama";
            var nip = document.createElement("input");
                nip.type = "text";
                nip.className = "form-control";
                nip.name = "nip" + i;
                nip.placeholder="NIP";
            var pangkat2 = ["Juru Muda / I.a","Juru Muda Tingkat I / II.b","Juru / I.c","Juru Tingkat I / I.d","Pengatur Muda / II.a","Pengatur Muda Tingkat I / II.b","Pengatur / II.c","Pengatur Tingkat I/ II.d","Penata Muda / III.a","Penata Muda Tingkat I / III.b","Penata / III.c","Penata Tingkat I / III.d","Pembina / IV.a","Pembina Tingkat I / IV.b","Pembina Utama Muda / IV.c","Pembina Utama Madya / IV.d","Pembina Utama / IV.e"];
            pangkat[i] = document.createElement("select");
                pangkat[i].className = "form-control myselect";
                pangkat[i].name = "pangkat" + i;
                pangkat[i].onchange = function(){this.style.color="black";};
            var jabatan = document.createElement("input");
                jabatan.type = "text";
                jabatan.className = "form-control";
                jabatan.name = "jabatan" + i;
                jabatan.placeholder="Jabatan";
            var unit = document.createElement("input");
                unit.type = "text";
                unit.className = "form-control";
                unit.name = "unit" + i;
                unit.placeholder="Unit Kerja";
            container.appendChild(label);
            container.appendChild(nama);
            container.appendChild(nip);
            container.appendChild(pangkat[i]);
                //Create and append the options
                var option2 = document.createElement("option");
                option2.value = "0";
                option2.text = "Pangkat/Gol. Ruang";
                option2.disabled=true;
                option2.selected=true;
                pangkat[i].appendChild(option2);
                for (var j = 0; j < pangkat2.length; j++) {
                    var option = document.createElement("option");
                    option.value = pangkat2[j];
                    option.text = pangkat2[j];
                    pangkat[i].appendChild(option);
                }
            container.appendChild(jabatan);
            container.appendChild(unit);
            container.appendChild(document.createElement("br"));
        }

        
    }

    function viewFields(){
        var number = document.getElementById("member").value;
        var nomor = document.getElementById("plk").value;
        var no = document.getElementById("plk").value;
        var container = document.getElementById("container");
        while (container.hasChildNodes()) {
            container.removeChild(container.lastChild);
        }
        var pangkat=[];
        for (i=0;i<number;i++){
            var label = document.createElement("label");
                label.innerHTML = "Pelaksana " + (parseInt(nomor)+1+i);
            var nama = document.createElement("input");
                nama.type = "text";
                nama.className = "form-control";
                nama.name = "nama" + (parseInt(nomor)+i);
                nama.placeholder="Nama";
            var nip = document.createElement("input");
                nip.type = "text";
                nip.className = "form-control";
                nip.name = "nip" + (parseInt(nomor)+i);
                nip.placeholder="NIP";
            var pangkat2 = ["Juru Muda / I.a","Juru Muda Tingkat I / II.b","Juru / I.c","Juru Tingkat I / I.d","Pengatur Muda / II.a","Pengatur Muda Tingkat I / II.b","Pengatur / II.c","Pengatur Tingkat I/ II.d","Penata Muda / III.a","Penata Muda Tingkat I / III.b","Penata / III.c","Penata Tingkat I / III.d","Pembina / IV.a","Pembina Tingkat I / IV.b","Pembina Utama Muda / IV.c","Pembina Utama Madya / IV.d","Pembina Utama / IV.e"];
            pangkat[i] = document.createElement("select");
                pangkat[i].className = "form-control myselect";
                pangkat[i].name = "pangkat" + (parseInt(nomor)+i);
                pangkat[i].onchange = function(){this.style.color="black";};
            var jabatan = document.createElement("input");
                jabatan.type = "text";
                jabatan.className = "form-control";
                jabatan.name = "jabatan" + (parseInt(nomor)+i);
                jabatan.placeholder="Jabatan";
            var unit = document.createElement("input");
                unit.type = "text";
                unit.className = "form-control";
                unit.name = "unit" + (parseInt(nomor)+i);
                unit.placeholder="Unit Kerja";
            container.appendChild(label);
            container.appendChild(nama);
            container.appendChild(nip);
            container.appendChild(pangkat[i]);
                //Create and append the options
                var option2 = document.createElement("option");
                option2.value = "0";
                option2.text = "Pangkat/Gol. Ruang";
                option2.disabled=true;
                option2.selected=true;
                pangkat[i].appendChild(option2);
                for (var j = 0; j < pangkat2.length; j++) {
                    var option = document.createElement("option");
                    option.value = pangkat2[j];
                    option.text = pangkat2[j];
                    pangkat[i].appendChild(option);
                }
            container.appendChild(jabatan);
            container.appendChild(unit);
            container.appendChild(document.createElement("br"));
        }

        
    }
    </script>



</body>

</html>