<?php 

    include "header.php";

?>

<h2>Histori Produk</h2>

<table class="table table-hover table-striped">

    <thead>

        <th>NO</th><th>Tanggal Transaksi</th><th>Tanggal Sampai Rumah</th><th>Nama Produk</th><th>Status</th><th>Aksi</th>

    </thead>

    <tbody>

        <?php 

        include "koneksi.php";

        $qry_histori=mysqli_query($conn,"select * from peminjaman_buku order by id_peminjaman_buku desc");

        $no=0;

        while($dt_histori=mysqli_fetch_array($qry_histori)){

            $no++;

            //menampilkan produk di keranjang

            $produk_dikeranjang="<ol>";

            $qry_produk=mysqli_query($conn,"select * from  detail_peminjaman_buku join produk on produk.id_produk=detail_peminjaman_buku.id_buku where id_peminjaman_buku = '".$dt_histori['id_peminjaman_buku']."'");

            while($dt_buku=mysqli_fetch_array($qry_buku)){

                $produk_dikeranjang.="<li>".$dt_produk['nama_produk']."</li>";

            }

            $produk_dikeranjang.="</ol>";

            //menampilkan status sudah dibeli atau belum

            $qry_cek_kembali=mysqli_query($conn,"select * from pengembalian_buku where id_peminjaman_buku = '".$dt_histori['id_peminjaman_buku']."'");

            if(mysqli_num_rows($qry_cek_kembali)>0){

                $dt_kembali=mysqli_fetch_array($qry_cek_kembali);

                $denda="denda Rp. ".$dt_kembali['denda'];

                $status_kembali="<label class='alert alert-success'>Sudah kembali <br>".$denda."</label>";

                $button_kembali="";

            } else {

                $status_kembali="<label class='alert alert-danger'>Belum dibeli</label>";

                $button_kembali="<a href='kembali.php?id=".$dt_histori['id_peminjaman_buku']."' class='btn btn-warning' onclick='return confirm(\"hello\")'>Kembalikan</a>";

            }

        ?>

            <tr>

                <td><?=$no?></td><td><?=$dt_histori['tanggal_transaksi']?></td><td><?=$dt_histori['tanggal_sampai_rumah']?></td><td><?=$buku_dipinjam?></td><td><?=$status_kembali?></td><td><?=$button_kembali?></td>

            </tr>

        <?php

        }

        ?>

    </tbody>

</table>

<?php 

    include "footer.php";

?>