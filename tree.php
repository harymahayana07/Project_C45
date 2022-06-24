<?php $thisPage = "POHON KEPUTUSAN";
require_once 'conn/koneksi.php';
if (!isset($_SESSION['usr'])) {
	header("location:auth/login-form.php");
}
?>
<?php
include_once("partial/headers.php");
if (isset($_GET['act'])) {
	$action = $_GET['act'];
	$id = $_GET['id'];
	if ($action == 'delete_all') {
		mysql_query("TRUNCATE pohon_keputusan");
		header('location:tree.php?status_hapus_all=sukses-hapus-all');
	}
} else {
	$query = mysql_query("select * from pohon_keputusan order by(id)");
	$jumlah = mysql_num_rows($query);
	require 'partial/navbar.php';
	require 'partial/sidebar.php';
?>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						<h3><i class="fas fa-stream">&nbsp;</i>TREE</h3>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item active">Tree</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid mt-2">
			<div class="row mb-2">
				<div class="content-header">
					<div class="container-fluid">
						<div class="row" style="float: right;">
							<div class="col-md-12 col-md-4">
								<a href="<?= base_url('pohon_tree.php') ?>" type="button" class="btn btn-warning btn-responsive"><i class="fas fa-eye"></i>&emsp; Lihat Pohon Keputusan</a>&emsp;
								<button type="button" class="btn btn-danger btn-responsive" data-bs-toggle="modal" data-bs-target="#hapusDataTree">
									<i class="fas fa-trash-alt"></i></i> Reset
								</button>&emsp;
								<div class="modal fade" id="hapusDataTree" tabindex="-1" aria-labelledby="hapusDataModal" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header bg-warning">
												<h5>Hapus Data Tree</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												Yakin Hapus Semua Data ?
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
												<a href="tree.php?act=delete_all" class="btn btn-primary"> Ya </a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="wrapper">
				<section class="content">
					<?php
					$status = isset($_GET['status_hapus_all']) ? $_GET['status_hapus_all'] : '';
					$msg = '';
					switch ($status):
						case 'sukses-hapus-all':
							$msg = 'Semua data berhasil dihapus';
							break;
					endswitch;

					if ($msg) : ?>
						<div style="margin-left: 9px; margin-right: 9px;">
							<div class="col-md-6 col-md-3 alert alert-info"><i class="fas fa-check-circle"></i><a href="tree.php"><button type="button" class="close"><span>&times;</span></button></a>&emsp;<?php echo $msg; ?></div>
						</div>
					<?php endif; ?>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										
											<?php
											if ($jumlah == 0) {
												$msg = "pohon keputusan belum terbentuk";
												echo '<div class="alert alert-warning mx-0"><i class="fas fa-exclamation-triangle"></i>&emsp;' . $msg .  '</div>';
											} else {
												echo "Jumlah Data Tree: " . $jumlah;
											}
											?>
									</div>
									<div class="card-body">
										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr class="text-center">
													<th>Id</th>
													<th>Aturan</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$warna1 = '#ffffff';
												$warna2 = '#f5f5f5';
												$warna  = $warna1;
												$no = 1;
												while ($row = mysql_fetch_array($query)) {
													if ($warna == $warna1) {
														$warna = $warna2;
													} else {
														$warna = $warna1;
													}
												?>
													<tr bgcolor=<?php echo $warna; ?>>
														<td align='center'><?php echo $row['id']; ?></td>
														<td><?php
															echo "IF ";
															if ($row['parent'] != '') {
																echo $row['parent'] . " AND ";
															}
															echo $row['akar'] . " THEN jurusan= " . $row['keputusan']; ?>
														</td>
													</tr>
											<?php
													$no++;
												}
											}
											?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<?php include_once("partial/footers.php"); ?>
	</div>
	</body>

	</html>