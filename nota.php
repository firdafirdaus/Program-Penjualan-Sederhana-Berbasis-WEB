<?php  
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>

<section class="konten">
	<div class="container">


	<!-- nota copas saja dari nota yang ada di admin -->
	<h2>Nota Pembelian</h2>
<?php
	$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
	$detail = $ambil->fetch_assoc();
 ?>


 <div class="row">
 	<div class="col-md-4">
 		<h3>Pembelian</h3>
 		<strong>No. Pembelian: <?php echo $detail['id_pembelian'] ?></strong><br>
 		Tanggal: <?php echo $detail['tgl_pembelian']; ?><br>
 		Total: Rp. <?php echo number_format($detail['total_pembelian']) ?>
 	</div>
 	<div class="col-md-4">
 		<h3>Pelanggan</h3>
 		<strong><?php echo $detail['nm_pelanggan']; ?></strong> <br>
 		 <p>
		 	<?php echo $detail['telepon_pelanggan']; ?> <br>
		 	<?php echo $detail['email_pelanggan']; ?>
		 </p>
 	</div>
 	<div class="col-md-4">
 		<h3>Pengiriman</h3>
 		<strong><?php echo $detail['nm_kota']; ?></strong> <br>
 		Ongkos Kirim. Rp. <?php echo number_format($detail['tarif']); ?><br>
 		Alamat: <?php echo$detail['alamat_pengiriman'] ?>
 	</div>
 </div>

 <table class="table table-bordered">
 	<thead>
 		<tr>
 			<th>No</th>
 			<th>Nama</th>
 			<th>Harga</th>
 			<th>Jumlah</th>
 			<th>Subtotal</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php $nomor=1; ?>
 		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
 		<?php while($pecah=$ambil->fetch_assoc()){ ?>
 		<tr>
 			<td><?php echo $nomor; ?></td>
 			<td><?php echo $pecah['nama']; ?></td>
 			<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
 			<td><?php echo $pecah['jumlah']; ?></td>
 			<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
 		</tr>
 		<?php $nomor++; ?>
 		<?php } ?>
 	</tbody>
 </table>


 <div class="row">
 	<div class="col-mod-7">
 		<div class="alert alert-info">
 			<p>
 				Silahkan lakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']) ; 
 				?> ke <br>
 				<strong>BANK BRI 123-0000123-3456 AN. FIRDA FIRDAUS</strong>
 			</p>
 		</div>
 	</div>
 </div>
	

	</div>
</section>

</body>
</html>