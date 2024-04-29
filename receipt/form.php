<div class="card">
    <div class="card-header bg-primary text-white"><?= $id ? "Edit" : "Add"; ?> Receipt</div>
    <div class="card-body">
        <form action="post_process_receipts.php" method="post">
            <input type="hidden" name="id" value=<?= $id; ?>>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="username" class="form-label">Customer</label>
                    <input type="text" class="form-control" id="name" name="name" required 
                    value=<?= $receipts ? $receipts['customer_name'] : ''; ?>>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="Entry" name="Entry" <?= $id ? $receipts['status'] == 'Entry' ? 'selected' : '' : '' ?>>
                            Entry</option>
                        <option value="Done" name="Entry" <?= $id ? '' : 'hidden'; ?> <?= $id ? $receipts['status'] == 'Done' ? 'selected' : '' : '' ?>>Done</option>
                    </select>
                </div>

            </div>
            <button type="submit" name="simpan" id="save" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>