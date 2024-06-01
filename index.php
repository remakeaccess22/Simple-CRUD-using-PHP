<?php
session_start();
require_once('database/dbconnection.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datatable Sample</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="sweetalert/sweetalert2.min.css">
    <link rel="stylesheet" href="datatables/datatables.min.css">

</head>

<body>
    <div class="container">
        <div class="card mt-3">
            <div class="card-header">
                <h5>Employee Table</h5>
            </div>

            <div class="card-body">
                <a href="#" class="btn btn-primary btn-sm" id="btnAdd">+ ADD EMPLOYEE</a>
                <div class="table-responsive">
                    <table id="table1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="col text-nowrap">Employee ID</th>
                                <th class="col text-nowrap">Name</th>
                                <th class="col text-nowrap">Email</th>
                                <th class="col text-nowrap">Password</th>
                                <th class="col text-nowrap">Phone Number</th>
                                <th class="col text-nowrap">Hire Date</th>
                                <th class="col text-nowrap">Job ID</th>
                                <th class="col text-nowrap">Salary</th>
                                <th class="col text-nowrap">Commission PCT</th>
                                <th class="col text-nowrap">Manager ID</th>
                                <th class="col text-nowrap">Department ID</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $sql = "SELECT * FROM employees";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                        $employee_id = $row['employee_id'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $email = $row['email'];
                        $password = $row['password'];
                        $phone_number = $row['phone_number'];
                        $hire_date = $row['hire_date'];
                        $job_id = $row['job_id'];
                        $salary = $row['salary'];
                        $commission_pct = $row['commission_pct'];
                        $manager_id = $row['manager_id'];
                        $department_id = $row['department_id'];
                        $name = $first_name." ".$last_name;
                    ?>
                            <tr>
                                <td><?php echo $employee_id; ?></td>
                                <td class="col text-nowrap"><?php echo $name; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $password; ?></td>
                                <td><?php echo $phone_number; ?></td>
                                <td><?php echo $hire_date; ?></td>
                                <td><?php echo $job_id; ?></td>
                                <td><?php echo $salary; ?></td>
                                <td><?php echo $commission_pct; ?></td>
                                <td><?php echo $manager_id; ?></td>
                                <td><?php echo $department_id; ?></td>

                                <td>
                                    <div class="d-flex justify-content-end">
                                        <a href="#" id="btnEdit" data-id="<?php echo $employee_id;?>"
                                            data-first_name="<?php echo $first_name;?>"
                                            data-last_name="<?php echo $last_name;?>" data-email="<?php echo $email;?>"
                                            data-password="<?php echo $password;?>"
                                            data-phone_number="<?php echo $phone_number;?>"
                                            data-hire_date="<?php echo $hire_date;?>"
                                            data-job_id="<?php echo $job_id;?>" data-salary="<?php echo $salary;?>"
                                            data-commission_pct="<?php echo $commission_pct;?>"
                                            data-manager_id="<?php echo $manager_id;?>"
                                            data-department_id="<?php echo $department_id;?>"
                                            class="btn btn-warning btn-sm mx-2">EDIT</a>
                                        <div class=" d-flex justify-content-end">
                                            <a href="#" id="btnDelete" data-id="<?php echo $employee_id; ?>"
                                                class="btn btn-danger btn-sm mx-2">DELETE</a>

                                        </div>
                                </td>
                            </tr>

                            <?php           
                    }
                ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="modalAdd">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Employee</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <label for="txtFname">Enter firstname:</label>
                    <input type="text" id="txtFname" class="form-control">

                    <label for="txtLname">Enter lastname:</label>
                    <input type="text" id="txtLname" class="form-control">

                    <label for="txtEmail">Enter email:</label>
                    <input type="email" id="txtEmail" class="form-control">

                    <label for="txtPassword">Enter password:</label>
                    <input type="password" id="txtPassword" class="form-control">

                    <label for="txtPhoneNumber">Enter phone number:</label>
                    <input type="text" id="txtPhoneNumber" class="form-control">

                    <label for="txtHireDate">Enter hire date:</label>
                    <input type="text" id="txtHireDate" class="form-control">

                    <label for="txtJobID">Enter job ID:</label>
                    <input type="text" id="txtJobID" class="form-control">

                    <label for="txtSalary">Enter salary:</label>
                    <input type="text" id="txtSalary" class="form-control">

                    <label for="txtCommissionPCT">Enter commission PCT:</label>
                    <input type="text" id="txtCommissionPCT" class="form-control">

                    <label for="txtManagerID">Enter manager ID:</label>
                    <input type="text" id="txtManagerID" class="form-control">

                    <label for="txtDepartmentID">Enter department ID:</label>
                    <input type="text" id="txtDepartmentID" class="form-control">


                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="btnSave">Save</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Employee</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" id="e_emp_id">
                    <label for="e_txtFname">Enter firstname:</label>
                    <input type="text" id="e_txtFname" class="form-control">

                    <label for="e_txtLname">Enter lastname:</label>
                    <input type="text" id="e_txtLname" class="form-control">

                    <label for="e_txtEmail">Enter email:</label>
                    <input type="email" id="e_txtEmail" class="form-control">

                    <label for="e_txtPassword">Enter password:</label>
                    <input type="password" id="e_txtPassword" class="form-control">

                    <label for="e_txtPhoneNumber">Enter phone number:</label>
                    <input type="text" id="e_txtPhoneNumber" class="form-control">

                    <label for="e_txtHireDate">Enter hire date:</label>
                    <input type="text" id="e_txtHireDate" class="form-control">

                    <label for="e_txtJobID">Enter job ID:</label>
                    <input type="text" id="e_txtJobID" class="form-control">

                    <label for="e_txtSalary">Enter salary:</label>
                    <input type="text" id="e_txtSalary" class="form-control">

                    <label for="e_txtCommissionPCT">Enter commission PCT:</label>
                    <input type="text" id="e_txtCommissionPCT" class="form-control">

                    <label for="e_txtManagerID">Enter manager ID:</label>
                    <input type="text" id="e_txtManagerID" class="form-control">

                    <label for="e_txtDepartmentID">Enter department ID:</label>
                    <input type="text" id="e_txtDepartmentID" class="form-control">

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="btnUpdate">Update</button>
                </div>

            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="sweetalert/sweetalert2.all.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="datatables/datatables.min.js"></script>
    <script>
    $('#table1').DataTable();


    $(document).on('click', '#btnDelete', function() {
        var id = $(this).data('id');
        confirmDelete(id);

    });
    $(document).on('click', '#btnEdit', function() {
        //get data values from the button edit
        var id = $(this).data('id');
        var first_name = $(this).data('first_name');
        var last_name = $(this).data('last_name');
        var email = $(this).data('email');
        var password = $(this).data('password');
        var phone_number = $(this).data('phone_number');
        var hire_date = $(this).data('hire_date');
        var job_id = $(this).data('job_id');
        var salary = $(this).data('salary');
        var commission_pct = $(this).data('commission_pct');
        var manager_id = $(this).data('manager_id');
        var department_id = $(this).data('department_id');

        //set the values of the fields in modal edit
        $('#e_emp_id').val(id);
        $('#e_txtFname').val(first_name);
        $('#e_txtLname').val(last_name);
        $('#e_txtEmail').val(email);
        $('#e_txtPassword').val(password);
        $('#e_txtPhoneNumber').val(phone_number);
        $('#e_txtHireDate').val(hire_date);
        $('#e_txtJobID').val(job_id);
        $('#e_txtSalary').val(salary);
        $('#e_txtCommissionPCT').val(commission_pct);
        $('#e_txtManagerID').val(manager_id);
        $('#e_txtDepartmentID').val(department_id);

        //show modal
        $('#modalEdit').modal('show');

    });
    $(document).on('click', '#btnAdd', function() {
        $('#modalAdd').modal('show');

    });
    $(document).on('click', '#btnUpdate', function() {
        confirmEdit();

    });
    $(document).on('click', '#btnSave', function() {
        confirmAdd();

    });

    function deleteEmployee(id) {
        //set as object
        var values = {
            "id": id
        }

        $.ajax({
            type: "POST",
            url: "php_operation/delete_employee.php",
            data: values,
            dataType: 'JSON',
            success: function(response) {
                var status = response[0].status;
                var error = response[0].error;

                if (status == "success") showAlert('success', 'Success', 'Employee deleted');
                if (status == "error") showAlert('error', 'Error', error);

            }

        });

    }

    function updateEmployee() {
        var id = $('#e_emp_id').val();
        var fname = $('#e_txtFname').val();
        var lname = $('#e_txtLname').val();
        var email = $('#e_txtEmail').val();
        var password = $('#e_txtPassword').val();
        var phone_number = $('#e_txtPhoneNumber').val();
        var hire_date = $('#e_txtHireDate').val();
        var job_id = $('#e_txtJobID').val();
        var salary = $('#e_txtSalary').val();
        var commission_pct = $('#e_txtCommissionPCT').val();
        var manager_id = $('#e_txtManagerID').val();
        var department_id = $('#e_txtDepartmentID').val();

        //check if empty
        if (fname == "") {
            showAlert('error', 'Empty Fields', 'Please enter firstname! ');
            return;
        }
        if (lname == "") {
            showAlert('error', 'Empty Fields', 'Please enter lastname! ');
            return;
        }
        if (email == "") {
            showAlert('error', 'Empty Fields', 'Please enter email! ');
            return;
        }

        if (password == "") {
            showAlert('error', 'Empty Fields', 'Please enter password! ');
            return;
        }

        if (phone_number == "") {
            showAlert('error', 'Empty Fields', 'Please enter phone number! ');
            return;
        }

        if (hire_date == "") {
            showAlert('error', 'Empty Fields', 'Please enter hire date! ');
            return;
        }

        if (job_id == "") {
            showAlert('error', 'Empty Fields', 'Please enter job ID! ');
            return;
        }

        if (salary == "") {
            showAlert('error', 'Empty Fields', 'Please enter salary! ');
            return;
        }

        if (commission_pct == "") {
            showAlert('error', 'Empty Fields', 'Please enter commission PCT! ');
            return;
        }

        if (manager_id == "") {
            showAlert('error', 'Empty Fields', 'Please enter manager ID! ');
            return;
        }

        if (department_id == "") {
            showAlert('error', 'Empty Fields', 'Please enter department ID! ');
            return;
        }


        //set as object
        var values = {
            "id": id,
            "fname": fname,
            "lname": lname,
            "email": email,
            "password": password,
            "phone_number": phone_number,
            "hire_date": hire_date,
            "job_id": job_id,
            "salary": salary,
            "commission_pct": commission_pct,
            "manager_id": manager_id,
            "department_id": department_id

        }

        $.ajax({
            type: "POST",
            url: "php_operation/update_employee.php",
            data: values,
            dataType: 'JSON',
            success: function(response) {
                var status = response[0].status;
                var error = response[0].error;

                if (status == "success") showAlert('success', 'Success', 'Employee updated!');
                if (status == "error") showAlert('error', 'Error', error);

            }

        });

    }

    function addEmployee() {
        var fname = $('#txtFname').val();
        var lname = $('#txtLname').val();
        var email = $('#txtEmail').val();
        var password = $('#txtPassword').val();
        var phone_number = $('#txtPhoneNumber').val();
        var hire_date = $('#txtHireDate').val();
        var job_id = $('#txtJobID').val();
        var salary = $('#txtSalary').val();
        var commission_pct = $('#txtCommissionPCT').val();
        var manager_id = $('#txtManagerID').val();
        var department_id = $('#txtDepartmentID').val();

        //check if empty
        if (fname == "") {
            showAlert('error', 'Empty Fields', 'Please enter firstname! ');
            return;
        }
        if (lname == "") {
            showAlert('error', 'Empty Fields', 'Please enter lastname! ');
            return;
        }
        if (email == "") {
            showAlert('error', 'Empty Fields', 'Please enter email! ');
            return;
        }

        if (password == "") {
            showAlert('error', 'Empty Fields', 'Please enter password! ');
            return;
        }

        if (phone_number == "") {
            showAlert('error', 'Empty Fields', 'Please enter phone number! ');
            return;
        }

        if (hire_date == "") {
            showAlert('error', 'Empty Fields', 'Please enter hire date! ');
            return;
        }

        if (job_id == "") {
            showAlert('error', 'Empty Fields', 'Please enter job ID! ');
            return;
        }

        if (salary == "") {
            showAlert('error', 'Empty Fields', 'Please enter salary! ');
            return;
        }

        if (commission_pct == "") {
            showAlert('error', 'Empty Fields', 'Please enter commission PCT! ');
            return;
        }

        if (manager_id == "") {
            showAlert('error', 'Empty Fields', 'Please enter manager ID! ');
            return;
        }

        if (department_id == "") {
            showAlert('error', 'Empty Fields', 'Please enter department ID! ');
            return;
        }

        //set as object
        var values = {
            "fname": fname,
            "lname": lname,
            "email": email,
            "password": password,
            "phone_number": phone_number,
            "hire_date": hire_date,
            "job_id": job_id,
            "salary": salary,
            "commission_pct": commission_pct,
            "manager_id": manager_id,
            "department_id": department_id
        }

        $.ajax({
            type: "POST",
            url: "php_operation/add_employee.php",
            data: values,
            dataType: 'JSON',
            success: function(response) {
                var status = response[0].status;
                var error = response[0].error;

                if (status == "success") showAlert('success', 'Success', 'Employee added!');
                if (status == "error") showAlert('error', 'Error', error);

                console.log(response);

            }

        });

    }

    function confirmDelete(id) {
        Swal.fire({
            icon: "question",
            title: "Do you want to delete this employee?",
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, Delete It",
        }).then((result) => {
            if (result.isConfirmed) {
                deleteEmployee(id);

            }

        });
    }

    function confirmEdit() {
        Swal.fire({
            icon: "question",
            title: "Do you want to update this employee?",
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, Update It",
        }).then((result) => {
            if (result.isConfirmed) {
                updateEmployee();

            }

        });
    }

    function confirmAdd() {
        Swal.fire({
            icon: "question",
            title: "Do you want to add a new employee?",
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, Add It",
        }).then((result) => {
            if (result.isConfirmed) {
                addEmployee();

            }

        });
    }

    function showAlert(icon, title, content) {
        Swal.fire({
            icon: icon,
            title: title,
            text: content,
            confirmButtonText: 'CONTINUE',
            allowEscapeKey: false,
            allowOutsideClick: false,
        }).then((result) => {

            if (result.isConfirmed) {
                if (icon == 'success')
                    location.reload(true); //reload the page


            }
        });


    }
    </script>
</body>

</html>