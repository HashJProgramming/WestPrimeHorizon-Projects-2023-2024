<?php
include_once "functions/authentication.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - GSM - Guidance Monitoring System</title>
    <meta name="description" content="GSM - Guidance Monitoring System">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Basic-icons.css">
    <link rel="stylesheet" href="assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="assets/css/Pricing-Clean-badges.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark navbar-custom">
        <div class="container"><a class="navbar-brand" href="#">GMS - Guidance Monitoring System</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarResponsive"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="functions/user-logout.php">logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="text-center text-white masthead">
        <div class="masthead-content">
            <div class="container">
                <h1 class="masthead-heading mb-0">WEST PRIME HORIZON</h1>
                <h2 class="masthead-subheading mb-0">Institute Inc.</h2>
            </div>
        </div>
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </header>
    <div class="container py-4 py-xl-5">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Violation Page</h2>
                <p>GSM - GUIDANCE MONITORING SYSTEM</p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <h3 class="text-dark mb-4">Violation List</h3>
            </div>
            <div class="col">
                <form action="functions/violation-search.php" method="post">
                    <div class="input-group"><span class="input-group-text">Student ID</span>
                        <input class="form-control" type="text" name="student_id"/>
                        <button class="btn btn-primary" type="submit">Search</button></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card" id="TableSorterCard-2">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table tablesorter" id="ipi-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">VIOLATION&nbsp;ID</th>
                                    <th class="text-center">STUDENT ID</th>
                                    <th class="text-center">FULLNAME</th>
                                    <th class="text-center">AGE</th>
                                    <th class="text-center">SEX</th>
                                    <th class="text-center">STRAND</th>
                                    <th class="text-center">GUARDIAN</th>
                                    <th class="text-center filter-false sorter-false">PHONE</th>
                                    <th class="text-center filter-false sorter-false">TYPE</th>
                                    <th class="text-center filter-false sorter-false">OFFENSE</th>
                                    <th class="text-center filter-false sorter-false">LEVEL</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php
                                include 'functions/get-data.php';

                                // Connect to the database
                                $db = new PDO('mysql:host=localhost;dbname=db_gms', 'root', '');

                                if(isset($_GET['student_id'])){
                                    $sql = 'SELECT * FROM violations WHERE student_id = "'.$_GET['student_id'].'"';

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();
                                    $results = $stmt->fetchAll();

                                    // Loop through the results and add them to the table 
                                    foreach ($results as $row) {
                                    ?>
                                        <tr>
                                            <td class="border-0 align-middle"><strong><?php echo $row['id']; ?></strong></td>
                                            <?php
                                                get_student($row['student_id']);
                                            ?>
                                                <td class="border-0 align-middle"><strong><?php echo $row['type']; ?></strong></td>
                                                <td class="border-0 align-middle"><strong><?php echo $row['offense']; ?></strong></td>
                                                <td class="border-0 align-middle"><strong><?php echo $row['level']; ?></strong></td>
                                        </tr>
                                        
                                    <?php
                                    }

                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="py-5 bg-black">
        <div class="container">
            <p class="text-center text-white m-0 small">Copyright&nbsp;© GSM - Guidance Monitoring System 2023</p>
        </div>
    </footer>
    <div class="modal fade" role="dialog" tabindex="-1" id="register">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Student</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form class="text-center" action="functions/create-student.php" method="post">
                        <div class="mb-3"><input class="form-control" type="text" name="student_id" placeholder="Student ID"></div>
                        <div class="mb-3"><input class="form-control" type="text" name="fullname" placeholder="Fullname"></div>
                        <div class="mb-3"><input class="form-control" name="birthday" placeholder="Username" type="date"></div>
                        <div class="mb-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-xl-6"><input class="form-control" type="text" name="age" placeholder="Age"></div>
                                    <div class="col-md-6 col-xl-6"><input class="form-control" type="text" name="gender" placeholder="Sex"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3"><input class="form-control" type="text" name="strand" placeholder="Strand"></div>
                        <div class="mb-3"><input class="form-control" type="text" name="guardian_name" placeholder="Guardian Name"></div>
                        <div class="mb-3"><input class="form-control" type="text" name="guardian_phone" placeholder="Guardian Phone"></div>
                        <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Add Student</button></div>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="update">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Student</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form class="text-center" action="functions/update-student.php" method="post">
                        <input type="hidden" name="data_id">
                        <div class="mb-3"><input class="form-control" type="text" name="fullname" placeholder="Fullname"></div>
                        <div class="mb-3"><input class="form-control" name="birthday" placeholder="Username" type="date"></div>
                        <div class="mb-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-xl-6"><input class="form-control" type="text" name="age" placeholder="Age"></div>
                                    <div class="col-md-6 col-xl-6"><input class="form-control" type="text" name="gender" placeholder="Sex"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3"><input class="form-control" type="text" name="strand" placeholder="Strand"></div>
                        <div class="mb-3"><input class="form-control" type="text" name="guardian_name" placeholder="Guardian Name"></div>
                        <div class="mb-3"><input class="form-control" type="text" name="guardian_phone" placeholder="Guardian Phone"></div>
                        <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Update Student</button></div>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="violation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Violation</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form class="text-center" action="functions/create-violation.php" method="post">
                        <div class="mb-3"><input class="form-control" type="text" name="id" placeholder="Student ID"></div>
                        <div id="floating-label-1" class="form-floating mb-3"><select name="type" class="form-select form-select" for="floatinginput" placeholder="Major">
                                <option value="Major">Major</option>
                                <option value="Minor">Minor</option>
                            </select><label class="form-label" id="floating-label-2" for="floatinginput">Select Type...</label></div>
                        <div id="floating-label-3" class="form-floating mb-3"><select name="level" class="form-select form-select" for="floatinginput" placeholder="1st Offense">
                                <option value="1st Offense">1st Offense</option>
                                <option value="2nd Offense">2nd Offense</option>
                                <option value="3rd Offense">3rd Offense</option>
                                <option value="Candidate for Expulsion">Candidate for Expulsion</option>
                            </select><label class="form-label" id="floating-label-4" for="floatinginput">Select Level...</label></div>
                        <div class="mb-3"><textarea class="form-control" placeholder="Offense" name="offense"></textarea></div>
                        <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Add Violation</button></div>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="view-students">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Student</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6">
                                <h3 class="text-dark mb-4">Students List</h3>
                            </div>
                            <div class="col">
                                <form action="functions/student-search.php" method="post">
                                    <div class="input-group"><span class="input-group-text">Student ID</span>
                                        <input class="form-control" type="text" name="student_id"/>
                                        <button class="btn btn-primary" type="submit">Search</button></div> 
                                </form>
                            </div>
                        </div>
                        <div class="card" id="TableSorterCard">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table tablesorter" id="ipi-table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th class="text-center">student id</th>
                                                    <th class="text-center">fullname</th>
                                                    <th class="text-center">birthday</th>
                                                    <th class="text-center">age</th>
                                                    <th class="text-center">sex</th>
                                                    <th class="text-center">strand</th>
                                                    <th class="text-center">Guardian</th>
                                                    <th class="text-center filter-false sorter-false">phone</th>
                                                    <th class="text-center filter-false sorter-false">actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                    <?php include_once 'functions/view-students.php';?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="view-violations">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Violations</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6">
                                <h3 class="text-dark mb-4">Violation List</h3>
                            </div>
                            <div class="col">
                                <form action="functions/violation-search.php" method="post">
                                    <div class="input-group"><span class="input-group-text">Student ID</span>
                                        <input class="form-control" type="text" name="student_id"/>
                                        <button class="btn btn-primary" type="submit">Search</button></div> 
                                </form>
                            </div>
                        </div>
                        <div class="card" id="TableSorterCard-1">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table tablesorter" id="ipi-table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th class="text-center">VIOLATION&nbsp;ID</th>
                                                    <th class="text-center">STUDENT ID</th>
                                                    <th class="text-center">FULLNAME</th>
                                                    <th class="text-center">AGE</th>
                                                    <th class="text-center">SEX</th>
                                                    <th class="text-center">STRAND</th>
                                                    <th class="text-center">GUARDIAN</th>
                                                    <th class="text-center filter-false sorter-false">PHONE</th>
                                                    <th class="text-center filter-false sorter-false">TYPE</th>
                                                    <th class="text-center filter-false sorter-false">OFFENSE</th>
                                                    <th class="text-center filter-false sorter-false">LEVEL</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <?php include_once 'functions/view-violations.php';?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="confirmation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="functions/remove-student.php" method="post">
                <input type="hidden" name="data_id">
                <div class="modal-header">
                    <h4 class="modal-title">Remove Student</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove this student?</p>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-danger" type="submit">Remove</button></div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $('a[data-bs-target="#update"]').on('click', function() {
            var id = $(this).data('id');
            var fullname = $(this).data('fullname');
            var birthdate = $(this).data('birthdate');
            var age = $(this).data('age');
            var sex = $(this).data('sex');
            var strand = $(this).data('strand');
            var guardian_name = $(this).data('gurdian');
            var phone = $(this).data('phone');

            console.log(id);
            
            $('input[name="data_id"]').each(function() {
                $(this).val(id);
            });

            $('input[name="fullname"]').each(function() {
                $(this).val(fullname);
            });

            $('input[name="birthday"]').each(function() {
                $(this).val(birthdate);
            });

            $('input[name="age"]').each(function() {
                $(this).val(age);
            });

            $('input[name="gender"]').each(function() {
                $(this).val(sex);
            });

            $('input[name="strand"]').each(function() {
                $(this).val(strand);
            });

            $('input[name="guardian_name"]').each(function() {
                $(this).val(guardian_name);
            });

            $('input[name="guardian_phone"]').each(function() {
                $(this).val(phone);
            });
        });
        $('a[data-bs-target="#confirmation"]').on('click', function() {
            var id = $(this).data('id');
            console.log(id);
            $('input[name="data_id"]').each(function() {
                $(this).val(id);
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</body>

</html>