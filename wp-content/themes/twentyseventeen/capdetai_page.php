<?php
include 'my-stuff/cap_detai/config.php';
global $wpdb;

include 'mydbfile.php';
include 'wp-load.php';
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
 * Template name: CapDeTai management Page
 */
if (!is_user_logged_in()) {
    wp_redirect( wp_login_url() );
}
get_header();?>
<div class="wrap">
    <div id="primary" class="content-area">
       
        <main id="main" class="site-main">
            
            <div class="container">
                <div class="mb-3">Duyệt các đề tài NCKH mới, vui lòng nhấp vào đây <a href="<?=home_url('/duyetdetai/')?>" class="text-decoration-none btn btn-info">Duyệt đề tài</a></div>
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="capdetai">
                    <div class="form-body">
                        <div class="row">
                        <div id="mess"></div>
                        <div class="chuthich"></div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="ten_cdt" name="ten_cdt" type="text" placeholder="Tên cấp đề tài" data-sb-validations="required" />
                                <label for="tenCấpDềTai">Tên cấp đề tài</label>
                                <div class="invalid-feedback" data-sb-feedback="tenCấpDềTai:required">Tên cấp đề tài is required.</div>
                            </div>
                            <div class="chuthich"></div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="giochuan" name="giochuan" type="text" placeholder="Giờ chuẩn" data-sb-validations="required" />
                                <label for="giờChuẩn">Giờ chuẩn</label>
                                <div class="invalid-feedback" data-sb-feedback="giờChuẩn:required">Giờ chuẩn is required.</div>
                            </div>
                            <div class="chuthich"></div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="thoigian_apdung" name="thoigian_apdung" type="date" placeholder="Thời gian áp dụng" data-sb-validations="required" value="<?=date('Y-m-d')?>"/>
                                <label for="thờiGianApDụng">Thời gian áp dụng</label>
                                <div class="invalid-feedback" data-sb-feedback="thờiGianApDụng:required">Thời gian áp dụng is required.</div>
                            </div>
                            <div class="chuthich"></div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="ma_nh" aria-label="Năm học">
                                    <option value="0">Chọn năm học</option>
                                    <?php
                                    $sql = "SELECT * FROM `NamHoc` ORDER BY namhoc";

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
                            <!-- <input type="hidden" id="user_id" class="form-control" name="time_mins" value="<?= get_current_user_id(); ?>"> -->

                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="workoutformbtn">Lưu</button>
                                <?php
                            $url = home_url();
                            ?>
                                        <input type="hidden" id="homeurl" value="<?=$url?>">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container mt-3">
                    <h2>Danh sách các cấp đề tài</h2>
                    <p><?=get_the_content()?></p>
                    <br><br>
                        <label>Sắp xếp theo:</label>
                        <div class="input-group">
                            <select class="form-select" aria-label="Default select example" id="sort" required>
                                <option value="none">Chọn điều kiện</option>
                                <option value="ten">Tên</option>
                                <option value="dinhmuc">Giờ chuẩn</option>
                                <option value="thoigian">Thời gian áp dụng</option>
                                <option value="namhoc">Năm học</option>
                            </select>
                            <button type="submit" name="asc" id="asc" class="btn btn-secondary" style="z-index:0"><i class="fa-solid fa-sort-up"></i></button>
                            <button type="submit" name="desc" id="desc" class="btn btn-secondary"  style="z-index:0"><i class="fa-solid fa-sort-down"></i></button>
                        </div>
                    <table class="table table-striped" id="records">

                    </table>
                    <a href="<?=home_url()?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>
                </div>
            </div> <!--container-->

        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- .wrap -->

<?php
$jquery = get_theme_file_uri('/assets/js/jquery-3.7.0.js');
?>
<script src="<?= $jquery ?>"></script>
<script>
    // window.setTimeout(function() {
    // $("#mess").fadeTo(1000, 0).slideUp(1000, function(){
    //     $(this).remove(); 
    // });
// }, 5000);
    const currentUrl = window.location.hostname;
    const folder = "NCKH";
    let localURL = $("#homeurl").val();
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = array[array.length-2];
    

    $("#capdetai").on("submit", function(event) {
        
        callCreate();
        $("#mess").fadeTo(2000, 500).slideUp(500, function(){
                       $(this).slideUp(500);
                }); 
        read();
    });

    $(document).ready(function() {

        read();
        const params = new URLSearchParams(window.location.search);
        if(params.has('sort')){
            $sort = params.get('sort');
            $("#sort").val($sort);
            if(params.has('by')){
                //giam dan
                $by = params.get('by');
                $("#desc").attr("class",'btn btn-primary');
                $("#asc").attr("class",'btn btn-secondary');
                getReadUrlSort($sort,true);
            }
            //tang dan
            else{
                $("#asc").attr("class",'btn btn-primary');
                $("#desc").attr("class",'btn btn-secondary');
                getReadUrlSort($sort,false);
            }
        }


    });
    function confirmDesactiv()
    {
    return confirm("bạn có muốn xóa không?")
    }
    function confirmSave()
    {
    return confirm("Thông tin này đã được sử dụng. Nếu sửa, nội dung sẽ bị ảnh hưởng. Bạn có chắc không?")
    }

    function callCreate() {
        event.preventDefault();
        let urlc = localURL+"/my-stuff/"+lastsegment+"/create.php";
        $.post(urlc, {
                ten_cdt: $('#ten_cdt').val(),
                giochuan: $('#giochuan').val(),
                thoigian_apdung:$('#thoigian_apdung').val(),
                ma_nh:$('#ma_nh').val()
            },
            function(data, status) {
                const alertmess = '<div class="auto-close alert alert-success" role="alert"> Đã thêm thành công</div>'
                console.log(alertmess);
                document.getElementById("mess").innerHTML = alertmess;
                
            });
    }
    $("#asc").on("click", function(event) {
        event.preventDefault();
        $sort = $("#sort").val();
        $("#asc").attr("class",'btn btn-primary');
        $("#desc").attr("class",'btn btn-secondary');
        $("#sort").focus();
        if ($sort == 'none')
            read();
        else
            getReadUrlSort($sort,false);
    })
    $("#desc").on("click", function(event) {
        event.preventDefault();
        $sort = $("#sort").val();
        $("#desc").attr("class",'btn btn-primary');
        $("#asc").attr("class",'btn btn-secondary');
        $("#sort").focus();
        if ($sort == 'none')
            read();
        else
            getReadUrlSort($sort,true);
    })
    function getReadUrlSort($sort,$desc) {
        let urlr =  localURL + "/my-stuff/" + lastsegment + "/read-sort.php";
        

        const params = new URLSearchParams(window.location.search);
        if (params.has('id')) {
            urlr += "?id=" + params.get('id');
        }
        if (params.has('pg')) {
            urlr += "?pg=" + params.get('pg');
            if($sort != 'none')
             urlr += "&sort="+$sort;
        }
        else{
            if($sort != 'none')
             urlr += "?sort="+$sort;
        }
        if($desc)
            urlr += "&by=desc";
        $.get(urlr, function(data) {
            document.getElementById("records").innerHTML = data;
        });
    }

    function getReadUrl() {
        const params = new URLSearchParams(window.location.search);
        let urlr = localURL+"/my-stuff/"+lastsegment+"/read.php";

        if (params.has('id')) {
            urlr += "?id=" + params.get('id');
        }
        if (params.has('pg')) {
            urlr += "?pg=" + params.get('pg');
        }

        return urlr;
    }

    function read() {
        const url = getReadUrl();
        $.get(url, function(data) {
            document.getElementById("records").innerHTML = data;
        });
    }
</script>
<?php
get_footer();
