<?php 
	if ($totalBarang == 0) {
		echo "<h3> Saat ini belum ada data di dalam keranjang belanja anda</h3>";
	}else{
		$no=1;

		echo "<table class='table-list'>
				<tr class='baris-title'>
					<th class='tengah'>No</th>
					<th class='kiri'>Image</th>
					<th class='kiri'>Nama Barang</th>
					<th class='tengah'>Qty</th>
					<th class='kanan'>Harga Satuan</th>
					<th class='kanan'>Total</th>
				</tr>";
			$subtotal=0;
		#mengeluarkan variable array keranjang
				foreach ((array)$keranjang AS $key => $value) {
					$barang_id = $key;

					$namabarang = $value['nama_barang'];
					$quantity = $value['quantity'];
					$gambar = $value['gambar'];
					$harga = $value['harga'];

					$total = $quantity * $harga;
					$subtotal = $subtotal + $total;
					echo "<tr class='baris-title'>
							<td class='tengah'>$no</td>
							<td class='kiri'><img src='".BASE_URL."assets/images/barang/$gambar' height='100px' /></td>
							<td class='kiri'>$namabarang</td>
							<td class='tengah'><input type='text' name='$barang_id' value='$quantity' class='update-quantity'</td>
							<td class='kanan'>".rupiah($harga)."</td>
							<td class='kanan hapus'>".rupiah($total)."<a href='".BASE_URL."hapus_item.php?barang_id=$barang_id'>X</a></td>
						</tr>";
					$no++;
				}
				echo "<tr>
						<td colspan='5' class='kanan'><b>Sub Total</b></td>
						<td class='kanan'><b>".rupiah($subtotal)."</b></td>
					</tr>";

			echo "</table>";

			echo "<div id='frame-button-keranjang'>
					<a id='lanjut-belanja' href='".BASE_URL."index.php'>< Lanjut Belanja</a>
					<a id='lanjut-pemesanan' href='".BASE_URL."data-pemesan.html'>Lanjut Pemesanan ></a>
			  </div>";
	}
 ?>
 <script >
 	// script untuk update quantity dan menghitung otomatis
 	$(".update-quantity").on("input", function(e){
		var barang_id = $(this).attr("name");
		var value = $(this).val();
		
		$.ajax({
			method: "POST",
			url: "update_keranjang.php",
			data: "barang_id="+barang_id+"&value="+value
		})
		.done(function(data){
			location.reload();
		});
		
	});
 </script>