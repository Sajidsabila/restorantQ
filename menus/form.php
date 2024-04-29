<?php include ("../layout/header.php"); ?>
<?php
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$query = "SELECT * from menus where id = '$id'";
$sql = mysqli_query($db, $query);
$data = $sql->num_rows > 0 ? mysqli_fetch_assoc($sql) : null;
?>
<div class="container" style="margin-top: 100px">
    <div class="card">
        <div class="card-header bg-primary text-white"> Add Data Menus</div>
        <div class="card-body">

            <form action="post_process.php" method="post">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" id="menu" name="name" required
                         value=<?php echo $data ? $data['name'] : ''; ?>
                            >
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note / Catatan</label>
                        <input type="text" class="form-control" name="note" required value=<?php echo $data ? $data['note'] : ''; ?> >
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status">
                            <option value="Aktif" name="status">Aktif</option>
                            <option value="Non aktif" name="status">Non aktif</option>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Category</label>
                        <select name="category" class="form-control">
                            <?php

                            $sql = "SELECT id as categories_id, name
                                    FROM categories";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $selected = ($data['category_id'] == $row['categories_id']) ? 'selected' : '';
                                    echo '<option value="' . $row['categories_id'] . '" "' . $selected . '">' . $row['name'] . '</option>';
                                }
                            } else {
                                echo "<option value=''>Tidak ada data yang ditemukan</option>";
                            }


                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" value="<?= $data['price']; ?>">
                    </div>

                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>
</div>