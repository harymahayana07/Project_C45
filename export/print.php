<html>

<head>
    <title>SMAN 2 MATARAM</title>
</head>

<body onload="window.print();">
    <div style="width:100%;margin:0 auto;text-align:center;">
        <h4>Laporan Hasil Prediksi Jurusan Siswa</h4>
        <br />
        <table width="100%" cellspacing="0" cellpadding="5" border="1">
            <thead>
                <tr align="center">
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Asal Sekolah</th>
                    <th>Hasil Prediksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                $query = mysql_query("SELECT a.nisn,b.nama,b.jenis_kelamin,b.asal_sekolah,a.hasil 
							FROM hasil_prediksi a INNER JOIN data_siswa b ON (a.nisn=b.nisn) 
							ORDER BY(a.nisn)");
                while ($row = mysql_fetch_array($query)) {
                    $no++;
                ?>
                    <tr align="center">
                        <td><?= $no; ?></td>
                        <td><?= $row[0]; ?></td>
                        <td><?= $row[1]; ?></td>
                        <td><?= $row[2]; ?></td>
                        <td><?= $row[3]; ?></td>
                        <td><?= $row[4]; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>