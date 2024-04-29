<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- datatable -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#my-datatables').DataTable();

    });
</script>
<script>
    function edit(id, menuId, note, amount) {
        document.getElementsByName('id')[0].value = id;
        document.getElementsByName('nameMenus')[0].value = menuId;
        document.getElementsByName('note')[0].value = note;
        document.getElementsByName('amount')[0].value = amount;
        $("#nameMenus").val(menuId).trigger("change");
    }
</script>
</body>

</html>