<div class="card">
    <div class="card-header bg-primary text-white">Add Receipt</div>
    <div class="card-body">
        <form id="receipt" action="post_process_receipts.php" method="post">
            <input type="hidden" name="id">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="username" class="form-label">Nama Customer</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="Entry" name="Entry">Entry</option>

                    </select>
                </div>

            </div>
            <button type="submit" name="simpan" id="save" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>