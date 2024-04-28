<?php include ("../layout/header.php"); ?>
<?php
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$query = "select * from categories where id = '$id'";
$sql = mysqli_query($db, $query);
$data = $sql->num_rows > 0 ? mysqli_fetch_assoc($sql) : null;
?>
<div class="container" style="margin-top: 100px">
    <div class="card">
        <div class="card-header bg-primary text-white"><?= $id ? "Edit" : "Add"; ?> Data User</div>
        <div class="card-body">

            <form action="post_process.php" method="post">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" required value=<?php echo $data ? $data['name'] : ' '; ?>>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Note / Catatan </label>
                        <input type="text" class="form-control" name="note" required value=<?php echo $data ? $data['note'] : ''; ?>>
                    </div>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>
</div>