<?php
include ("../layout/header.php");
$sql = "
select rd.receipt_id, r.receipt_date, r.customer_name, 
concat('Rp ', format(sum(rd.price * rd.amount), 0)) as total, r.status, 
u.name, concat('Rp ', format(sum(rd.price * rd.amount), 0)) as total_pendapatan 
from receipts as r join receipt_details as rd on rd.receipt_id=r.id 
join users as u on r.user_id=u.id where r.receipt_date = curdate() group by rd.receipt_id";

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
        <h3 class="text-center">Data Receipts</h3>
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
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($query)) {

                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['receipt_date'] ?></td>
                        <td><?php echo $data['customer_name'] ?></td>
                        <td><?php echo $data['status']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['total']; ?></td>
        </div>
        </tr>

        <?php
                }
                ?>
    <tr>
        <td>Total : </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <?php
        $sql1 = "
            select concat('Rp ', format(sum(rd.price * rd.amount), 0)) as total_pendapatan 
            from receipts as r join receipt_details as rd on rd.receipt_id=r.id 
            join users as u on r.user_id=u.id where r.receipt_date = curdate()";
        $query1 = mysqli_query($db, $sql1);
        $pendapatan = mysqli_fetch_assoc($query1)
            ?>
        <td rowspan="5"><?php echo $pendapatan['total_pendapatan']; ?></td>
    </tr>
    </tbody>
    </table>
</div>
</div>
</div>
<?php include ("../layout/footer.php"); ?>