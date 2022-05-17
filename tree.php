<?php
session_start();
if (!isset($_SESSION['usr'])) {
	header("location:login-form.php");
}

include "koneksi.php";
if (isset($_GET['act'])) {
	$action = $_GET['act'];
	$id = $_GET['id'];
	if ($action == 'delete') {
		mysql_query("TRUNCATE pohon_keputusan");
		header('location:index.php?menu=tree');
	}
}
$query = mysql_query("select * from pohon_keputusan order by(id)");
$jumlah = mysql_num_rows($query);
//jika pohon keputusan kosong
if ($jumlah == 0) {
	echo "<center><h3> Pohon keputusan belum terbentuk...</h3></center>";
} else {
	if ($_SESSION['lvl'] == 'admin') {
		echo "<center>
					Klik 'Uji Rule' untuk menguji akurasi rule...<br>								
				</center>";
	}
	echo "Jumlah rule : " . $jumlah . "<br>";
	//hanya kaprodi yang bisa menghapus pohon keputusan dan menguji akurasi
	if ($_SESSION['lvl'] == '0') {
?>
		<p>Opsi:
			<a href="?menu=tree&act=delete" onClick="return confirm('Anda yakin akan hapus pohon keputusan?')">Hapus Pohon Keputusan</a> |
			<a href="?menu=pohon_tree">Lihat Pohon Keputusan</a> |
			<a href="?menu=uji_rule">Uji Rule</a>
		</p>
	<?php
	} else if ($_SESSION['lvl'] == 'siswa') {
		echo "<a href=\"?menu=pohon_tree\" >Lihat Pohon Keputusan</a>";
	}
	?>
	<table bgcolor='#7c96ba' border='1' cellspacing='0' cellspading='0' align='center' width=900>
		<tr align='center'>
			<th>Id</th>
			<th>Aturan</th>
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
			<tr bgcolor=<?php echo $warna; ?>>
				<td align='center'><?php echo $row['id']; ?></td>
				<td><?php
					echo "IF ";
					if ($row['parent'] != '') {
						echo $row['parent'] . " AND ";
					}
					echo $row['akar'] . " THEN Jurusan = " . $row['keputusan']; ?>
				</td>
			</tr>
		<?php
			$no++;
		}
		?>
	</table>
<?php
}
?>