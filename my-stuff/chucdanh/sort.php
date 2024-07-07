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
$conn = new mysqli("localhost","root","","qlnckh_sql");?>
<body>

    <div class="row-fluid">
        <div class="span12">


         

            <div class="container">

<br><br>
<div class="pull-right">
				<a href="indexs.php">View All Again</a>
				</div>
				
                
				
				<?php
				
				if (isset($_POST['asc']) || isset($_POST['desc'])){ 
				$sort=$_POST['sort'];

				?>
					<form method="POST" action="sort.php">
				<label>Sort Item by:</label>
                <div class="input-group">
                        <select class="form-select" aria-label="Default select example" name="sort" required>
                            <option>Chọn điều kiện</option>
                            <option value="name" <?php if($sort=='name') echo 'selected'?>>Name</option>
                            <option value="dinhmuc" <?php if($sort=='dinhmuc') echo 'selected'?>>Dinh muc</option>
                            <option value="thoigian" <?php if($sort=='thoigian') echo 'selected'?>>Thoigian</option>
                        </select>
                        <?php
                        if(isset($_POST['desc'])):
                        ?>
                        <button type="submit" name="asc" class="btn btn-secondary"><i class="fa-solid fa-sort-up"></i></button>
                        <button type="submit" name="desc" class="btn btn-primary"><i class="fa-solid fa-sort-down"></i></button>
                        <?php
                        else:
                        ?>
                        <button type="submit" name="asc" class="btn btn-primary"><i class="fa-solid fa-sort-up"></i></button>
                        <button type="submit" name="desc" class="btn btn-secondary"><i class="fa-solid fa-sort-down"></i></button>
                        <?php
                        endif;
                        ?>
                    </div>
				</form>
                    <table  class="table table-striped table-bordered">
                         
                         <thead>
                     
                             <tr>
                             
                                 <th>Item Name</th>
                                 <th>dinh muc</th>
                                 <th>thoi gian</th>
                                 
                             </tr>
                         </thead>
                         <tbody>
                         <?php 
                         $sql = "SELECT * FROM chucdanh";
                         switch ($sort) {
                            case 'name':
                                $sql.=" order by ten_cd";
                                break;
                            case 'dinhmuc':
                                $sql.=" order by dinhmuc";
                                break;
                            case 'thoigian':
                                $sql.=" order by thoigian_apdung"; 
                                break;
                         }
                         if(isset($_POST['desc'])){
                            $sql.=" desc";
                         }
                         $result = $conn -> query($sql);
                         while($row=$result->fetch_assoc()){
                         $id=$row['ma_cd'];
                         ?>
                              
										<tr>
									
                                        <td><?php echo $row['ten_cd'] ?></td>
                                         <td><?php echo $row['dinhmuc'] ?></td>
                                         <td><?php echo $row['thoigian_apdung'] ?></td>
                                </tr>
                         
						          <?php } ?>
                            </tbody>
                        </table>
						
					<?php } ?>
</form>

        </div>
        </div>
        </div>
    </div>



</body>
</html>


