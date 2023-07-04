<fieldset class="border p-2">
    <legend class="w-auto text-left">List Berita</legend>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Judul</th>
                <th scope="col">Nama</th>
                <th scope="col">Isi</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
		  			$no = 1;
		  			$sql = "SELECT komentar.id_komentar, komentar.id_berita, berita.ID, berita.judul, komentar.nama, komentar.isi FROM berita, komentar WHERE berita.ID=komentar.id_berita ORDER BY ID DESC";
		  			$result = mysqli_query($connect, $sql);
		  		 ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $row['judul']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['isi']; ?></td>
                <td>
                    <a href="./?mod=komentar&act=post&id=<?= $row['id_komentar']; ?>">Post</a> |
                    <a href="./?mod=komentar&act=hapus&id=<?= $row['id_komentar']; ?>">Hapus</a>
                </td>
            </tr>
            <?php $no++; ?>
            <?php endwhile; ?>
        </tbody>
    </table>
</fieldset>
<?php
// hapus komentar

if (isset($_GET['act']) && $_GET['act'] =='hapus') {
	$id = $_GET['id'];
	$query = "DELETE FROM komentar WHERE id_komentar = '$id'";
	$sql = mysqli_query($connect,$query);
	echo "<script> 
			document.location.href = './?mod=komentar';
		  </script>";
}

if(isset($_GET['act']) && $_GET['act'] == 'post') {

	$id = $_GET['id'];
	$sql = "SELECT * FROM komentar WHERE id_komentar = '$id'";
	$resultper = mysqli_query($connect, $sql);
	$row = mysqli_fetch_assoc($resultper);
	$post = $row['post'];
        if ($post === "0"){
            $sqlsatu = "UPDATE komentar SET post = '1' WHERE id_komentar = '$id' ";
            $resultsatu = mysqli_query($connect, $sqlsatu);
        }else{
            $sqlkosong = "UPDATE komentar SET post = '0' WHERE id_komentar = '$id' ";
            $resultkosong = mysqli_query($connect, $sqlkosong);
        }
    
        echo "<script> 
                document.location.href = './?mod=komentar';
              </script>";


}
?>