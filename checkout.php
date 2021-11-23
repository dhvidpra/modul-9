<?php 

    session_start();

    include "koneksi.php";

    $cart=@$_SESSION['cart'];

    if(count($cart)>0){

        // simpan pesan baru

        mysqli_query = 'INSERT INTO orders "(name, datecreation, status, username) VALUES ("New Order","'.date('Y-m-d').'",0,"acc2")';

        mysqli_query($con, $sql1);
        $ordersid = mysqli_insert_id($con); 
        $cart = unserialize(serialize($_SESSION['cart']));
        
        //Set $cart sebagai array, serialize () mengubah string menjadi array
        for($i=0; $i<count($cart);$i++) {
        $sql2 = 'INSERT INTO oderdetail (productid, orderid, price, quantity) VALUES ('.$cart[$i]->id.', '.$ordersid.', '.$cart[$i]->price.', '.$cart[$i]->quantity.')';
        mysqli_query($con, $sql2);
        }

        //Menghapus semua produk dalam keranjang
        unset($_SESSION['cart']);
        ?>
        Thanks for buying products. Click <a href="buku.php">here</a> to continue purchasing products.

        unset($_SESSION['cart']);

        echo '<script>alert("Anda berhasil memasukkan produk ke keranjang");location.href="keranjang.php"</script>';

    }

?>