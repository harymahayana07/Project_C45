<?php
session_start();
if (!isset($_SESSION['usr'])) {
	header("location:login-form.php");
}
?>
<?php
require 'partial/sidebar.php';
require 'partial/navbar.php';
?>
<?php
include "koneksi.php";
$query = mysql_query("select * from data_training order by(id)");
$jumlah = mysql_num_rows($query);

if ($jumlah == 0) {
	echo "<center><h3>Data training masih kosong...</h3></center>";
} else {

	if (isset($_POST['submit'])) {
		include "proses_mining.php";
	} else {
?>

		<!--  -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<h1 class="m-0">MINING DATA</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">Home</li>
								<li class="breadcrumb-item active">Mining</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<!--  -->
			<div class="container-fluid mt-2">
				<!--  -->
				<div class="row mb-2">
					<!--  -->
					<div class="content-header">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-12 col-md-4">
									<center>
										<form method=POST action='' class="d-inline">
											<input type=submit name=submit value=Proses Mining!>
										</form>
									</center>
								</div>

							</div>
						</div>
					</div>
					<!--  -->
				</div>



				<div class="col-md-12">
					<p style="text-align: left;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php
																													echo "Jumlah data : " . $jumlah;
																													?></p>

					<table style="text-align: center;" bgcolor='#7c96ba' border='1' cellspacing='0' align='center' width=900>
						<tr>
							<th>No</th>
							<th>ppdb</th>
							<th>Bahasa indonesia</th>
							<th>matematika</th>
							<th>bahasa inggris</th>
							<th>ipa</th>
							<th>ips</th>
							<th>skhu</th>
						</tr>
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
							<tr bgcolor=<?php echo $warna; ?> align=center>
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $row['ppdb']; ?></td>
								<td><?php echo $row['bhs_indonesia']; ?></td>
								<td><?php echo $row['matematika']; ?></td>
								<td><?php echo $row['bhs_inggris']; ?></td>
								<td><?php echo $row['ipa']; ?></td>
								<td><?php echo $row['ips']; ?></td>
								<td><?php echo $row['skhu']; ?></td>
							</tr>
						<?php
							$no++;
						}
						?>
					</table>
			<?php
		}
	}
			?>
				</div>

			</div>
			<!-- end table -->
		</div>
		<script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
		<?php
		require 'partial/footer.php';
		?>