<?php include ("../layout/header.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

?>

<div class="container" style="margin-top: 100px;">
    <div class="row">
        <?php
        if (isset($_GET['error'])) {
            ?>
            <div class="alert alert-danger">
                <?= $_GET['error']; ?>
            </div>

            <?php
        }

        if (isset($_GET['success'])) {

            ?>
            <div class="alert alert-success">
                <?= $_GET['success']; ?>
            </div>
            <?php
        }
        ?>

        <?php
        $receipts_id = isset($_GET['receipt_id']) ? $_GET['receipt_id'] : 0;
        $sql = "select rd.id, m.name, rd.id, rd.receipt_id, m.name as menu, c.name as categori, 
        rd.note, concat('Rp ', format(sum(rd.price),0 )) as price, rd.amount, 
        concat('Rp ', format(sum(rd.price * rd.amount), 0)) 
        as total from receipts as r join receipt_details
         as rd on rd.receipt_id=r.id join users as u 
         on r.user_id=u.id join menus as m on
          rd.menu_id=m.id join categories as c on m.category_id=c.id WHERE
           r.id = (SELECT max(r.id) from receipts as r ) or rd.id = '$receipts_id' group by rd.menu_id;;";
        $query = mysqli_query($db, $sql);
        ?>
        <div class="form ">

            <?php include ("form.php"); ?>
            <?php

            $query_get = "select rd.id, m.name, rd.id, rd.receipt_id, m.name as menu, c.name as categori, 
        rd.note, concat('Rp ', format(sum(rd.price),0 )) as price, rd.amount, 
        concat('Rp ', format(sum(rd.price * rd.amount), 0)) 
        as total from receipts as r join receipt_details
         as rd on rd.receipt_id=r.id join users as u 
         on r.user_id=u.id join menus as m on
          rd.menu_id=m.id join categories as c on m.category_id=c.id WHERE rd.id = '$receipts_id' group by rd.menu_id";
            $sql = mysqli_query($db, $query_get);
            $data = $sql->num_rows > 0 ? mysqli_fetch_assoc($sql) : null;
            ?>
        </div>
        <div id="data" style="display: <?= $receipts_id ? 'block' : 'none'; ?>">
            <h3 class="text-center mt-3">Data Recipt </h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary col-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add
            </button>

            <!-- Modal -->
            <?php
            $user = $_SESSION['user_id'];
            $query1 = "SELECT id FROM receipts WHERE id = (select max(id) from receipts where user_id ='$user')";
            $sql1 = mysqli_query($db, $query1);
            $data_id_receipts = mysqli_fetch_assoc($sql1);

            if (mysqli_num_rows($sql1) < 1) {
                die("data tidak ditemukan");
            }
            ?>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pesanan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="post_process_details.php" method="post">
                                <input type="hidden" name="id_receipts" value=<?= $data_id_receipts['id']; ?>>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Nama Menu</label>
                                    <select name="nameMenus" class="form-control">
                                        <?php

                                        $sql = "SELECT id, name, format((price), 0) as harga, price
                                    FROM menus";
                                        $result = $db->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row["id"] .
                                                    ',' . $row["price"] . "'>" . $row["name"] . " " . " ( " . $row[("harga")] . " ) " . "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>Tidak ada data yang ditemukan</option>";
                                        }


                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Note</label>
                                    <input type="text" name="note" class="form-control" id="username" name="note"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Amount</label>
                                    <input type="number" class="form-control" name="amount" required>
                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close Modal  -->

            <table id="my-datatables" class="table  table-striped table-bordered mb-3">
                <thead>
                    <tr>

                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Note</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($data = mysqli_fetch_array($query)) {

                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['name'] ?></td>
                            <td><?php echo $data['categori'] ?></td>
                            <td><?php echo $data['note']; ?></td>
                            <td><?php echo $data['price']; ?></td>
                            <td><?php echo $data['amount']; ?></td>
                            <td><?php echo $data['total']; ?></td>
                            <td>
                                <div class="d-flex">
                                    <form action="delete_details.php" method="post">
                                        <input type="hidden" name="id" value="<?= $data["id"]; ?>">
                                        <button type="submit" name="submit"
                                            onclick="return confirm('Anda yakin menghapus data ini?');"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <a href="add.php?id=<?= $data['id']; ?>" class="btn btn-warning btn-sm ms-2">Edit</a>
                            </td>
            </div>
            </tr>
            <?php
                    }
                    ?>
        <tr>
            <td>Total :</td>
            <?php
            error_reporting();
            $sql1 = "select rd.receipt_id,
             concat('Rp ', format(sum(rd.price * rd.amount), 0)) as 
             total_tagihan from receipts as r join receipt_details as rd on 
             rd.receipt_id=r.id join users as u on r.user_id=u.id join menus as m on rd.menu_id=m.id join categories as c on m.category_id=c.id WHERE r.id = (SELECT max(id) from receipts as r ) group by r.id";
            $query1 = mysqli_query($db, $sql1);
            if ($query1) {
                if (mysqli_num_rows($query1) > 0) {
                    while ($row = mysqli_fetch_assoc($query1)) {
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>" . $row['total_tagihan'] . "</td>";
                    }
                } else {
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td>0</td>";
                }
            } else {
                echo "Error: " . mysqli_error($koneksi);
            }
            ?>
        </tr>
        </tbody>
        </table>
    </div>
</div>
</div>
<script>
    document.getElementById('receipt').addEventListener('submit', function (e) {
        e.preventDefault();
        document.getElementById('data').style.display = 'block';
    });
</script>
<?php
include ("../layout/footer.php");
?>