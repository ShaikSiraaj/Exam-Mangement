<?php
include "../connection.php";
include "assets/header.php";
include "assets/navbar.php";
?>

<script type="text/javascript">
    const faculty = document.querySelector('#faculty');
    if (faculty) {
        faculty.classList.add('active');
        const collapseFaculty = document.querySelector('#collapseFaculty');
        if (collapseFaculty) collapseFaculty.classList.add('show');
    }
</script>

<div class="container-fluid pr-5 pl-5">
    <h3>Import Faculty</h3>
    <div class="box-container">
        <div class="card-header">Upload Faculty Excel File</div>
        <br>
        <form id="import_faculty_form" action="assets/import_faculty_process.php" method="POST" enctype="multipart/form-data">
            <div class="row mb-3 form-group">
                <label class="col-sm-3 col-form-label fw-600" for="faculty_file">Select Excel File :</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" name="faculty_file" id="faculty_file" accept=".xlsx, .xls, .csv" required>
                    <small class="form-text text-muted">Supported formats: .xlsx, .xls, .csv. File should have 'Name' and 'Email' columns.</small>
                </div>
            </div>

            <div style="text-align: center; padding-top:10px">
                <input style="background-color: #2a498b; border-color:#2e2cc9; height: 38px; width: 150px" class="btn btn-primary" type="submit" name="import_faculty_btn" id="import_faculty_btn" value="Import & Send PDF">
            </div>
        </form>
    </div>
    <br>
</div>
</body>

</html>
