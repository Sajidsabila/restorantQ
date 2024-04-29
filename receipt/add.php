<?php include ("../layout/header.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$query = "SELECT * from receipts where id = '$id'";
$sql = mysqli_query($db, $query);

$receipts = $sql->num_rows > 0 ? mysqli_fetch_assoc($sql) : null;
$query = "select rd.id, m.name, rd.menu_id, rd.receipt_id, m.name as menu, c.name as categori,
                    rd.note, concat('Rp ', format(sum(rd.price),0 )) as price, rd.amount,
                    concat('Rp ', format(sum(rd.price * rd.amount), 0))
                    as total from  receipt_details as rd join menus as m on
                    rd.menu_id=m.id join categories as c on m.category_id=c.id WHERE
                    rd.receipt_id = '$id' group by rd.menu_id";
$receipt_details = mysqli_query($db, $query);
?>
<div class="container" style="margin: 100px;">
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
        <?php include ("form.php"); ?>
        <?php if ($receipts): ?>
            <!-- Button trigger modal -->

            <!-- Modal -->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pesanan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="post_process_details.php" method="post">
                                <input type="hidden" name="id_receipts" value=<?= $id; ?>>
                                <input type="hidden" name="id">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nama Menu</label>
                                    <select id="select2-modal" name="nameMenus" class="form-control">
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
                                    <input type="text" class="form-control" id="username" name="note" required>
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

            <h3 class="text-center">Details</h3>
            <button type="button" class="btn btn-primary col-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add
            </button>

            <table id="my-datatables" class="table  table-striped table-bordered">
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
                    while ($receipt_detail = mysqli_fetch_array($receipt_details)) {

                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $receipt_detail['name'] ?></td>
                            <td><?php echo $receipt_detail['categori'] ?></td>
                            <td><?php echo $receipt_detail['note'] ?></td>
                            <td><?php echo $receipt_detail['price'] ?></td>
                            <td><?php echo $receipt_detail['amount'] ?></td>
                            <td><?php echo $receipt_detail['total'] ?></td>
                            <td>
                                <div class="d-flex">
                                    <form action="delete_details.php" method="post">
                                        <input type="hidden" name="id" value="<?= $receipt_detail["id"]; ?>">
                                        <input type="hidden" name="receipt_id" value="<?= $id; ?>">
                                        <button type="submit" name="submit"
                                            onclick="return confirm('Anda yakin menghapus data ini?');"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <button type="button"
                                        onclick="edit('<?php echo $receipt_detail['id'] ?>,<?php echo $receipt_detail['menu_id'] ?>, <?php echo $receipt_detail['note'] ?>,<?php echo $receipt_detail['amount'] ?>')"
                                        class="btn btn-warning btn-sm ms-1" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Edit
                                    </button>
                            </td>
            </div>
            </tr>
            <?php


                    }
                    ?>
        <tr>
            <td>Total</td>
            <?php
            $query_total = "select rd.id, m.name, rd.id, rd.receipt_id, m.name as menu, c.name as categori,
                    rd.note, concat('Rp ', format(sum(rd.price),0 )) as price, rd.amount,
                    concat('Rp ', format(sum(rd.price * rd.amount), 0))
                    as total from  receipt_details as rd join menus as m on
                    rd.menu_id=m.id join categories as c on m.category_id=c.id WHERE
                    rd.receipt_id = '$id'";
            $query1 = mysqli_query($db, $query_total);
            if ($query1) {
                if (mysqli_num_rows($query1) > 0) {
                    while ($row = mysqli_fetch_assoc($query1)) {
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>" . $row['total'] . "</td>";
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
                echo "gagal ";
            }
            ?>
            <td></td>

        </tr>
        </tbody>
        </table>
    <?php endif; ?>
</div>
</div>
</div>
<?php include ("../layout/footer.php"); ?>