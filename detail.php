 <!-- Page Content -->
 <?php 

  $id = (isset($_GET['id']) ? $_GET['id'] : '');

  $query = "SELECT * FROM berita WHERE terbit ='1' AND ID = '$id'";
  $result = mysqli_query($connect, $query);
  $updateviewnum = mysqli_query($connect, "UPDATE berita SET viewnum = viewnum+1 WHERE ID = '$id'");

   if (isset($_POST['komentar'])) {

    $id_berita = $id;
	$nama = $_POST['nama'];
	$isi = $_POST['isi'];


		$sql = "INSERT INTO komentar VALUES ('', '$id_berita', '$nama', '$isi' , '0')";

		$result = mysqli_query($connect, $sql);

		echo "<script> 
				alert('Berhasil Menambahkan Komentar');
				document.location.href = './?open=detail&id=$id';
		 	 </script>";
	

}
$ambilkomentar = "SELECT * FROM komentar WHERE id_berita ='$id' AND post ='1' ";
$komentar = mysqli_query($connect, $ambilkomentar);


 ?>
 <div class="container">

     <div class="row">

         <!-- Post Content Column -->
         <div class="col-lg-12">
             <?php while ( $row = mysqli_fetch_assoc($result) ) : ?>
             <!-- Title -->
             <h1 class="mt-4"><?= $row['judul']; ?></h1>

             <!-- Author -->
             <p class="lead">
                 by
                 <b><?= $row['updateby']; ?></b>
             </p>

             <hr>

             <!-- Date/Time -->
             <?php $date = $row['tanggal'];
        $newDate = date("d-F-Y , H:i:s", strtotime($date)); ?>
             <p>Posted on <?= $newDate; ?> WIB</p>

             <hr>

             <!-- Preview Image -->
             <img class="img-fluid rounded col-lg-12" src="<?= $row['gambar']; ?>" alt="<?= $row['judul']; ?>">

             <hr>

             <!-- Post Content -->
             <p><?= nl2br($row['isi']); ?></p>
             <?php endwhile; ?>
             <hr>
             <fieldset class="border p-3">
                 <legend class="w-auto">Komentar</legend>
                 <form class="text-left" action="./?open=detail&id=<?= $id ?>" method="POST"
                     enctype="multipart/form-data">
                     <div class="form-group">
                         <label>Nama</label>
                         <input type="text" name="nama" class="form-control col-12" placeholder="Nama">
                         <br>
                         <textarea class="form-control" name="isi" rows="3" placeholder="Isi"></textarea>
                         <br>
                         <button type="submit" class="btn btn-primary" name="komentar">Kirim</button>
                     </div>
                 </form>
             </fieldset>
             <fieldset class="border p-2">
                 <legend class="w-auto">Isi Komentar</legend>
                 <?php while ( $tampilkomentar = mysqli_fetch_assoc($komentar) ) : ?>
                 <fieldset class="border p-1">
                     <h5 class="w-auto"><?= $tampilkomentar['nama'] ?></h5>
                     <?= $tampilkomentar['isi'] ?>
                 </fieldset>
                 <?php endwhile; ?>
             </fieldset>
             <br>

         </div>
     </div>
 </div>