<?php
require '../functions/act.php';
require '../functions/db.php';

$cari = $_GET['keyword'];
?>

	<div class="row">
		<div class="col-12">
				<table class="table table-hover">
					<thead class="table-light">
						<tr>
							<th scope="col">No</th>
							<th scope="col">ID Pelanggan</th>
							<th scope="col">Nama</th>
							<th scope="col">Alamat</th>
							<th scope="col">Jenis Kelamin</th>
							<th scope="col">Opsi</th>
						</tr>
				</thead>
				<tbody>
					<tr>
						<?php
							$pembeli = getSearch('pembeli', 'id_pembeli', 'nama', $cari);

							$no = 1;
							while($row = mysqli_fetch_assoc($pembeli)){
						?>
							<th scope="row"><?= $no++ ?></th>
							<td><?= $row['id_pembeli'] ?></td>
							<td><?= $row['nama']?></td>
							<td><?= $row['alamat'] ?></td>
							<td><?= $row['jenis_kelamin'] ?></td>
							<td>
								<span>
									<a href="pembeli_detail.php?id=<?= $row['id_pembeli']; ?>" class="btn btn-outline-secondary btn-sm">Detail</a>
									<a href="pembeli_edit.php?id=<?= $row['id_pembeli']; ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
									<a id="hapus" href="" class="btn btn-secondary text-white btn-sm"
									onclick="if(confirm('Apakah kamu yakin ingin menghapus data pembeli ini?')){
															location.href='pembeli_hapus.php?id=<?php echo $row['id_pembeli']; ?>'
															}">
											Hapus
									</a>
								</span>
							</td>
						</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>