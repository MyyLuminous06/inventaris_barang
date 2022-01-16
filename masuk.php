<?php 
require 'function.php';
require 'cek_login.php';
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang masuk</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Ganesha Husada</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stok barang
                            </a>
                             <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang masuk
                            </a>
                             <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang keluar
                            </a>
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Halaman Admin
                            </a>
                            <a class="nav-link" href="pinjam.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Peminjaman
                            </a>
                             <a class="nav-link" href="logout.php">
                                logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Barang Masuk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        </div>
                        <div class="row">
                            
                        </div>
                            <div class="card mb-4">
                            <div class="card-header">

                        <!-- Button to Open the Modal -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Tambah Barang
                          </button>
                          <a href="export_masuk.php" class="btn btn-info">Export Data</a>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stock s where s.idbarang = m.idbarang");
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)) {
                                             $idb = $data['idbarang'];
                                             $idm = $data['idmasuk'];
                                             $tanggal = $data['tanggal'];
                                             $namabarang = $data['namabarang'];
                                             $qty = $data['qty'];
                                             $keterangan = $data['keterangan'];  
                                        

                                     ?>

                                        <tr>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$qty;?></td>
                                            <td><?=$keterangan;?></td>
                                             <td>
                                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?=$idb;?>">
                                                Edit
                                              </button>
                                              <input type="hidden" name="idbarangygmaudihapus" value="<?=$idb;?>">
                                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>">
                                                Hapus
                                              </button>
                                            </td>
                                        </tr>
                                          <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?=$idb;?>">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                                                
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">Edit Barang</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                                        </div>
                                                                  
                                        <!-- Modal body -->
                                        <form method="post">
                                        <div class="modal-body">
                                        <input type="text" name="keterangan" value="<?=$keterangan;?>" class="form-control"required>
                                        <br>  
                                        <input type="number" name="qty" value="<?=$qty;?>" class="form-control"required>
                                        <br>  
                                        <input type="hidden" name="idb" value="<?=$idb;?>">    
                                        <input type="hidden" name="idm" value="<?=$idm;?>">                                 
                                        <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
                                        </div>
                                        </form> 

                                                                  
                                            </div>
                                              </div>
                                              </div>
                                                            
                                               </div>


                                        <!-- delete Modal -->
                                        <div class="modal fade" id="delete<?=$idb;?>">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                                                
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">Hapus Barang</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                                        </div>
                                                                  
                                        <!-- Modal body -->
                                        <form method="post">
                                        <div class="modal-body">
                                        Apakah anda yakin ingin menghapus <?=$namabarang;?>?
                                        <input type="hidden" name="idb" value="<?=$idb;?>">
                                        <input type="hidden" name="kty" value="<?=$qty;?>">
                                        <input type="hidden" name="idm" value="<?=$idm;?>"> 
                                        <br>
                                        <br>                                       
                                        <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Submit</button>
                                        </div>
                                        </form> 

                                                                  
                                            </div>
                                              </div>
                                              </div>
                                                            
                                               </div>


                                    <?php

                                     }

                                     ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                           
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

  <meta charset="utf-8">
                          <meta name="viewport" content="width=device-width, initial-scale=1">
                          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>       



      <!-- The Modal -->
      <div class="modal fade" id="myModal">
      <div class="modal-dialog">
      <div class="modal-content">
                              
      <!-- Modal Header -->
      <div class="modal-header">
      <h4 class="modal-title">Tambah Barang Masuk</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button> 
      </div>
                                
      <!-- Modal body -->
      <form method="post">
      <div class="modal-body">

      <select name="barangnya" class="form-control">
        <?php 
        $ambilsemuadata = mysqli_query($conn, "select * from stock");
        while ($fetcharray = mysqli_fetch_array($ambilsemuadata)){
            $namabarangnya = $fetcharray['namabarang'];
            $idbarangnya = $fetcharray['idbarang'];
        ?>
        <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>

        <?php 
        }
        ?>
          
      </select>
      <br>
      <input type="number" name="qty" class="form-control" placeholder="Quanttity" required>
      <br>
      <input type="text" name="penerima" class="form-control" placeholder="Keterangan" required>
      <br>
      <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
      </div>
      </form> 

                                
          </div>
            </div>
            </div>
                          
             </div>



</html>
