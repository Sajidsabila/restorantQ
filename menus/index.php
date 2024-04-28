<?php
include ("../layout/header.php");
$sql = "
                    SELECT m.id,  m.name as a, c.name as 
b, c.note, format((m.price),0) as harga  , m.status from menus as m join categories as c on c.id=m.category_id
order by m.id desc;";
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
        <h3 class="text-center">Data Menu</h3>
        <a class="col-1 btn btn-primary my-2" href="form.php">Add data</a>
        <table id="my-datatables" class="table  table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Kategori </th>
                    <th>Note / Catatan </th>
                    <th>Price</th>
                    <th>Status</th>
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
                        <td><?php echo $data['a'] ?></td>
                        <td><?php echo $data['b']; ?></td>
                        <td><?php echo $data['note']; ?></td>
                        <td><?php echo $data['harga']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                        <td>
                            <div class="d-flex">
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= $data["id"]; ?>">
                                    <button type="submit" name="submit"
                                        onclick="return confirm('Anda yakin menghapus data ini?');"
                                        class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="form.php?id=<?= $data['id']; ?>" class="btn btn-warning btn-sm ms-2">Edit</a>
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