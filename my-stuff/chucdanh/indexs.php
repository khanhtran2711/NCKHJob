<!DOCTYPE html>
<html lang="en">

<head>

    <title>Sort</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Data Table CSS -->
    <link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<?php
$conn = new mysqli("localhost", "root", "", "qlnckh_sql");
?>

<body>

    <div class="row-fluid">
        <div class="span12">




            <div class="container">

                <br><br>
                <form method="POST" action="sort.php">
                    <label>Sort Item by:</label>
                    <div class="input-group">
                        <select class="form-select" aria-label="Default select example" name="sort" required>
                            <option>Chọn điều kiện</option>
                            <option value="name">Name</option>
                            <option value="dinhmuc">Dinh muc</option>
                            <option value="thoigian">Thoigian</option>
                        </select>
                        <button type="submit" name="asc" class="btn btn-secondary"><i class="fa-solid fa-sort-up"></i></button>
                        <button type="submit" name="desc" class="btn btn-secondary"><i class="fa-solid fa-sort-down"></i></button>
                    </div>



                </form>

                <table class="table table-striped table-bordered">

                    <thead>

                        <tr>

                            <th>Item Name</th>
                            <th>dinh muc</th>
                            <th>thoi gian</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT * FROM chucdanh");
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['ma_cd'];
                        ?>

                            <tr>

                                <td><?php echo $row['ten_cd'] ?></td>
                                <td><?php echo $row['dinhmuc'] ?></td>
                                <td><?php echo $row['thoigian_apdung'] ?></td>

                            </tr>

                        <?php } ?>
                    </tbody>
                </table>


                </form>

            </div>
        </div>
    </div>
    </div>
<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
<style type="text/css">
    .info{
        color:red;
        font-size:20px;
        border:1px solid black;
        padding:20px;
        background-color:yellow;
    }
</style>
</head>
<body>

    <button type="button" id="add">Thêm</button>

    <button type="button" id="delete">Xóa</button>

    <p>- Lập Trình Web</p>

    <script>
        $(document).ready(function(){
            $("#add").click(function(){
                $("p").toggleClass("info",true);
            });
            $("#delete").click(function(){
                $("p").toggleClass("info",false);
            });
        });
    </script>

</body>
</html>


</body>

</html>