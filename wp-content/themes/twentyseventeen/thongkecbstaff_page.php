<?php
include 'mydbfile.php';
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 * Template name: ThongKe theo cb - for staff Page
 */
$user = get_current_user_id();
$sql = "SELECT `user_email` FROM `realdev_users` WHERE id= $user";
error_log('sql = ' . $sql);
$re = $conn->query($sql);
$row = $re->fetch_assoc();


get_header();


?>
<div class="wrap">
    <div id="primary" class="content-area">

        <main id="main" class="site-main">

            <div class="container">

                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="tkkhoa">
                    <div class="form-body">
                        <div class="row">
                        <div class="form-floating mb-3 ui-widget">
                            <input class="form-control" id="email" name="email" type="text" value="<?=$row['user_email']?>" readonly/>
                            <label for="tendetai">Tìm theo email của cán bộ</label>
                            <div class="invalid-feedback" data-sb-feedback="ghichu:required">Email is required.</div>
                        </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="ma_nh" aria-label="Năm học">
                                    <?php
                                    $sql = "SELECT * FROM `NamHoc`";

                                    $re = $conn->query($sql);
                                    while ($row = $re->fetch_assoc()) :
                                    ?>
                                        <option value="<?= $row['ma_nh'] ?>"><?= $row['namhoc'] ?></option>
                                    <?php
                                    endwhile;
                                    ?>
                                </select>
                                <label for="ma_nh">Năm học</label>

                            </div>
                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="workoutformbtn" id="btnTongHop">Thống kê tổng hợp</button>
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="workoutformbtn" id="btnQuyDoi">Thống kê quy đổi</button>
                            </div>
                        </div>
                    </div>
                        </div>


                    </div>

                </form>

                <div class="container mt-3">
                    <h2>Thông tin hiện tại</h2>

                    <table class="table table-striped" id="records">

                    </table>
                    <form action="/NCKH/my-stuff/exportjsonth.php" class="my-3">
                        <button style="display: none;" type="submit" id="exportth" name="exportth" class="btn btn-info ms-auto">Xuất file excel tổng hợp (xlsx)</button>
                        
                    </form>
                    <form action="/NCKH/my-stuff/exportjsonqd.php" class="my-3">
                        <button style="display: none;" type="submit" id="exportqd" name="exportqd" class="btn btn-info ms-auto">Xuất file excel quy đổi(xlsx)</button>
                    </form>
                    <a href="<?= home_url() ?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>
                </div>

            </div>
        </main>
    </div>
</div>
<?php
$jquery = get_theme_file_uri('/assets/js/jquery-3.7.0.js');
?>
<script src="<?= $jquery ?>"></script>
<script>
    const currentUrl = window.location.hostname;
    const folder = "NCKH";
    let localURL = currentUrl + '/' + folder;
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = 'tkcb';


    // $("#tkkhoa").on("submit", function(event) {
    //     event.preventDefault();
    //     callRead();
    // });
    $("#btnTongHop").on("click",function(event) {
        event.preventDefault();
        callReadTH();
    })
    $("#btnQuyDoi").on("click",function(event) {
        event.preventDefault();
        callReadQD();
    })
    // $(document).ready(function() {

    //     read();


    // });

    function callReadQD() {
        let urlc = "http://" + localURL + "/my-stuff/" + lastsegment + "/read-quydoi.php";
        $.post(urlc, {
            ma_nh: $('#ma_nh').val(),
            email: $('#email').val()
            },
            function(data, status) {
                
                document.getElementById("records").innerHTML=data;       
                document.getElementById("exportqd").style.display="block";    
                document.getElementById("exportth").style.display="none";          
            });
    }
    function callReadTH() {
        let urlc = "http://" + localURL + "/my-stuff/" + lastsegment + "/read-tonghop.php";
        $.post(urlc, {
            ma_nh: $('#ma_nh').val(),
            email: $('#email').val()
            },
            function(data, status) {
                
                document.getElementById("records").innerHTML=data;     
                document.getElementById("exportth").style.display="block";      
                document.getElementById("exportqd").style.display="none";          
            });
    }

    // function getReadUrl() {
    //     const params = new URLSearchParams(window.location.search);
    //     let urlr = "http://" + localURL + "/my-stuff/" + lastsegment + "/read.php";

    //     if (params.has('id')) {
    //         urlr += "?id=" + params.get('id');
    //     }

    //     return urlr;
    // }

    // function read() {
    //     const url = getReadUrl();
    //     $.get(url, function(data) {
    //         document.getElementById("records").innerHTML = data;
    //     });
    // }
</script>

<?php
get_footer();
