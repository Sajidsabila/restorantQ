<?php
include ("../layout/header.php");
$sql = "select * from users order by id desc";
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
        <h3 class="text-center">Data User</h3>
        <a class="col-1 btn btn-primary my-2" href="form.php">Add data</a>
        <table id="my-datatables" class="table  table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
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
                        <td><?php echo $data['username']; ?></td>
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