<?php
include ("../layout/header.php");
$id = $_SESSION['user_id'];
$sql = "select r.id , rd.id as receipt_id,  r.receipt_date, r.customer_name, 
 concat('Rp ',  format(ifnull(sum(rd.price * rd.amount), 0), 0))
  as total, r.status, u.name  FROM receipts r inner join users u on u.id = r.user_id
left join receipt_details rd on r.id=rd.receipt_id where year(r.receipt_date) = '2024' group by r.id order by r.id desc";
$query = mysqli_query($db, $sql);
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
        <h3 class="text-center">Data Receipt</h3>
        <a class="col-1 btn btn-primary my-2" href="add.php">Add data</a>
        <table id="my-datatables" class="table  table-striped table-bordered">
            <thead>
                <tr>

                    <th>No</th>
                    <th>Tanggal </th>
                    <th>Nama Customer</th>
                    <th>total tagihan</th>
                    <th>Status</th>
                    <th>User</th>
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
                        <td><?php echo date("d-m-Y H:i:s", strtotime($data['receipt_date'])) ?></td>
                        <td><?php echo $data['customer_name'] ?></td>
                        <td><?php echo $data['total']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td>
                            <div class="d-flex">
                                <form action="delete_receipts.php" method="post">
                                    <input type="hidden" name="id" value="<?= $data["id"]; ?>">
                                    <button type="submit" name="submit"
                                        onclick="return confirm('Anda yakin menghapus data ini?');"
                                        class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="add.php?id=<?= $data['receipt_id']; ?>"
                                    class="btn btn-warning btn-sm ms-2">Edit</a>
                        </td>
        </div>
        </tr>
        <?php
                }
                ?>
    </tbody>
    </table>
</div>
</div>
</div>
<?php include ("../layout/footer.php"); ?>