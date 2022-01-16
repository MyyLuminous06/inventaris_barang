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
        <title>Admin</title>
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
                        <h1 class="mt-4">Halaman Admin</h1>
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
                            Tambah Admin
                          </button>

                          
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                        $ambilsemuadataadmin = mysqli_query($conn, "select*from login");
                                         $i=1;
                                        while($data=mysqli_fetch_array($ambilsemuadataadmin)) {
                                             $id = $data['iduser'];
                                             $em = $data['email'];
                                             $pw = $data['password'];


                                         ?>

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$em;?></td>
                                            <td>
                                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?=$id;?>">
                                                Edit
                                              </button>
                                              <input type="hidden" name="idbarangygmaudihapus" value="<?=$id;?>">
                                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$id;?>">
                                                Hapus
                                              </button>
                                            </td>
                                        </tr>
                                        
                                         <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?=$id;?>">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                                                
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">Edit Admin</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                                        </div>
                                                                  
                                        <!-- Modal body -->
                                        <form method="post">
                                        <div class="modal-body">
                                        <input type="email" name="email" value="<?=$em;?>" class="form-control"required > 
                                        <br>
                                        <input type="password" name="password" value="<?=$pw;?>" class="form-control"required>
                                        <br>    
                                        <input type="hidden" name="id" value="<?=$id;?>">                                    
                                        <button type="submit" class="btn btn-primary" name="updateadmin">Submit</button>
                                        </div>
                                        </form> 

                                                                  
                                            </div>
                                              </div>
                                              </div>
                                                            
                                               </div>


                                        <!-- delete Modal -->
                                        <div class="modal fade" id="delete<?=$id;?>">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                                                
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">Hapus Admin</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                                        </div>
                                                                  
                                        <!-- Modal body -->
                                        <form method="post">
                                        <div class="modal-body">
                                        Apakah anda yakin ingin menghapus <?=$em;?>?
                                        <input type="hidden" name="id" value="<?=$id;?>">
                                        <br>
                                        <br>                                       
                                        <button type="submit" class="btn btn-danger" name="hapusadmin">Hapus</button>
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
      <h4 class="modal-title">Tambah Admin</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button> 
      </div>
                                
      <!-- Modal body -->
      <form method="post">
      <div class="modal-body">
      <input type="email" name="email" placeholder="Email" class="form-control"required > 
      <br>
      <input type="password" name="password" placeholder="Password" class="form-control"required>
      <br>
      <button type="submit" class="btn btn-primary" name="tambahadminbaru">Submit</button>
      </div>
      </form> 

                                
          </div>
            </div>
            </div>
                          
             </div>

</html>
