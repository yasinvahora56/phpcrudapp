<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "crudapp";

$con = mysqli_connect($servername, $username, $password, $database);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['noedit'])) {
        $sno = $_POST['noedit'];
        $title = $_POST['edittitle'];
        $dess = $_POST['editdis'];

        $update = "UPDATE `users` SET `title`='$title',`disscription`='$dess' WHERE `sno` = $sno";
        $run_query = mysqli_query($con, $update);
        if ($run_query) {
            echo "<script>alert('Not Updated Successfully')</script>";
            echo "<script>window.open('index.php','_self')</script>";
            exit();
        } else {
            echo "Not Can't be update";
        }
    } else {
        if (isset($_POST["sub_btn"])) {
            $title = $_POST["title"];
            $discription = $_POST["discription"];
            $insert_query = "INSERT INTO `users`(`title`, `disscription`) VALUES ('$title','$discription')";
            $result = mysqli_query($con, $insert_query);
            if ($result) {
                echo "<script>alert('Note Inserted Successfully')</script>";
                echo "<script>window.open('index.php', '_self')</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <style>
        .description-cell {
            max-width: 320px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body class="bg-light">

    <?php
    $tittle = "";
    $disscription = "";
    if (isset($_GET['edit_notes'])) {
        $smo = $_GET['edit_notes'];
        $select_query = "SELECT * FROM `users` WHERE sno = $smo";
        $runn_queru = mysqli_query($con, $select_query);
        $fetch_assoc = mysqli_fetch_assoc($runn_queru);
        if ($fetch_assoc) {
            $tittle = $fetch_assoc['title'];
            $disscription = $fetch_assoc['disscription'];
        }
    }
    ?>

    <!-- Edit and Update Note Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius:0;">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit This Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/Crudapp/index.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="noedit" value="<?php echo isset($_GET['edit_notes']) ? $_GET['edit_notes'] : ''; ?>">
                        <div class="form-group">
                            <label for="title">Note Title</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($tittle); ?>" name="edittitle">
                        </div>
                        <div class="form-group">
                            <label for="desc">Note Description</label>
                            <textarea class="form-control" name="editdis" rows="3"><?php echo htmlspecialchars($disscription); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-white">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark" name="update_btn">Update Note</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="" style="margin-bottom: 5%;">
        <nav class="navbar navbar-expand-lg bg-dark text-light">
            <div class="container-fluid">
                <a class="navbar-brand text-light" href="index.php">Yasin Notes</a>
                </div>
        </nav>
    </div>
    <div class="mb-5">
        <form class="w-50 m-auto" action="" method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control bg-white" id="title" name="title" placeholder="Enter Title">
            </div>
            <div class="form-group mt-3">
                <label for="discription">Description</label>
                <!-- <input type="text" class="form-control" id="discription" name="discription" placeholder="Enter discription"> -->
                <textarea name="discription" class="form-control h-1 bg-white" id="discription" placeholder="Enter Description"></textarea>
            </div>
            <button type="submit" name="sub_btn" class="btn btn-dark mt-3">Submit</button>
        </form>
    </div>

    <?php
            $select_quercy = "SELECT * FROM `users`";
            $runc = mysqli_query($con, $select_quercy);
            $fetch_assocc = mysqli_fetch_row($runc);
            if ($fetch_assocc > 0) {
                echo "<div class='' style='width: 20%; margin-left:55%;'>
        <form class='form-inline row g-2 my-2 my-lg-0' action='searchdata_product.php' method='get'>
            <div class='col'>
                <input class='form-control' type='search' placeholder='Search' aria-label='Search' name='search_data_pro'>
            </div>
            <div class='col-auto'>
                <!-- <button class='btn btn-dark' name='search_data' type='submit'>Search</button> -->
                <input type='submit' value='search' class='btn btn-dark' name='search_data'>
            </div>
        </form>
    </div>";
            }
            ?>
        
        <?php

            function serchdata(){
                global $con;
                $number = 1;
                if(isset($_GET['search_data'])){
                    $data = $_GET['search_data_pro'];
                    $select_data = "SELECT * FROM `users` WHERE `title` like %$data%";
                    $run_data = mysqli_query($con, $select_data);
                    if($run_data){
                        while($fetch_row = mysqli_fetch_array($run_data)){
                            $sno = $fetch_row['sno'];
                            $title = $fetch_row['title'];
                            $disscription = $fetch_row['disscription'];
                            
                            echo "<tr><td class='bg-secondary text-light text-center'>$number</td>
                        
                        <td class='bg-secondary text-light text-center'>$title</td>
                        
                        <td class='description-cell bg-secondary text-light text-center text-nowrap'>$disscription</td>
                        
                        <td class='bg-secondary text-light text-center'>
                        
                        <button class='btn btn-dark me-2' data-bs-toggle='modal' data-bs-target='#editModal'><a href='index.php?edit_notes=$sno' class=''><i class='fas fa-edit fa-lg' style='color: #ffffff;'></i></a></button>

                        <button class='btn btn-dark'><a href='index.php?delete_notes=$sno' class='text-light text-decoration-none'><i class='fa-solid fa-trash' style='color: #ffffff;'></i></a></button></td>'</tr>";
                        $number++;
                        }
                    }
                }
            }


        ?>

    </div>
    <div class="container w-50 m-auto">
        <table class="table table-bordered">
            <?php
            $select_quercy = "SELECT * FROM `users`";
            $runc = mysqli_query($con, $select_quercy);
            $fetch_assocc = mysqli_fetch_row($runc);
            if ($fetch_assocc > 0) {
                echo "<thead>
                <tr>
                    <th class='bg-dark text-light text-center'>No.</th>
                    <th class='bg-dark text-light text-center'>Title</th>
                    <th class='bg-dark text-light text-center'>Description</th>
                    <th class='bg-dark text-light text-center'>Actions</th>
                </tr>";
            }
            ?>

            </thead>
            <tbody>
                <?php
                $number = 1;
                $select_query = "SELECT * FROM `users`";
                $run = mysqli_query($con, $select_query);
                while ($row_fetch = mysqli_fetch_array($run)) {
                    $snmo = $row_fetch['sno'];
                    $note_tit = $row_fetch['title'];
                    $disscription = $row_fetch['disscription'];
                    echo "
                        <tr><td class='bg-secondary text-light text-center'>$number</td>
                        
                        <td class='bg-secondary text-light text-center'>$note_tit</td>
                        
                        <td class='description-cell bg-secondary text-light text-center text-nowrap'>$disscription</td>
                        
                        <td class='bg-secondary text-light text-center'>
                        
                        <button class='btn btn-dark me-2' data-bs-toggle='modal' data-bs-target='#editModal'><a href='index.php?edit_notes=$snmo' class=''><i class='fas fa-edit fa-lg' style='color: #ffffff;'></i></a></button>

                        <button class='btn btn-dark'><a href='index.php?delete_notes=$snmo' class='text-light text-decoration-none'><i class='fa-solid fa-trash' style='color: #ffffff;'></i></a></button></td>'</tr>";
                    $number++;
                }
                if (isset($_GET['delete_notes'])) {
                    $del = $_GET['delete_notes'];
                    $delete_query = "DELETE FROM `users` WHERE `sno` = $del";
                    $run_query = mysqli_query($con, $delete_query);
                    if ($run_query) {
                        echo "<script>alert('note deleted')</script>";
                        echo "<script>window.open('index.php', '_self')</script>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>