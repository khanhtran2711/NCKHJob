<?php
include 'my-stuff/detainckh/config.php';
include 'mydbfile.php';
global $wpdb;
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
 * Template name: DuyetDeTai form Page
 */
get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">

        <main id="main" class="site-main">

            <div class="container">

                <div class="container mt-3">
                    <h2>Thông tin về các đề tài NCKH</h2>
                    <p><?= get_the_content() ?></p>
                    <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="filter">
                        <div class="form-body">
                            <div class="row">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="trangthai" aria-label="Trạng thái">
                                        <option value="none">Chọn tất cả</option>
                                        <option value="0">Chưa duyệt</option>
                                        <option value="1">Đã duyệt</option>

                                    </select>
                                    <label for="trangthai">Trạng thái</label>

                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="nam" aria-label="Năm học">
                                        <option value="none">Chọn tất cả</option>
                                        <?php
                                            $sql = "SELECT * FROM `NamHoc` ORDER by NamHoc ";

                                            $re = $conn->query($sql);
                                            while ($row = $re->fetch_assoc()):
                                        ?>
                                            <option value="<?=$row['ma_nh']?>"><?=$row['namhoc']?></option>
                                        <?php
                                            endwhile;
                                        ?>

                                    </select>
                                    <label for="nam">Năm học</label>

                                </div><!--form-->
                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-success  me-1 mb-1" name="..." id="btnFilter">Lọc</button>

                                </div>
                            </div>
                        </div>
                        <?php
                            $url = home_url();
                            ?>
                                        <input type="hidden" id="homeurl" value="<?=$url?>">

                    </form>
            <table class="table table-striped" id="records">

            </table>
            <a href="<?= home_url() ?>" class="text-decoration-none btn btn-info">Trở về trang chủ</a>
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
    const currentUrl = window.location.hostname;
    const folder = "NCKH";
    let localURL = $("#homeurl").val();
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = "detainckh";
    function confirmDesactiv()
    {
    return confirm("bạn có muốn xóa không?")
    }
    $(document).ready(function() {

        read();


    });

    $("#btnFilter").on("click", function(event) {
        event.preventDefault();
        $trangthai = $("#trangthai").val();
        $nam = $("#nam").val();
        if ($trangthai == 'none' && $nam == 'none')
            read();
        else
            getReadUrl($trangthai, $nam);
    })


    function getReadUrl($trangthai, $nam) {
        let urlr =  localURL + "/my-stuff/" + lastsegment + "/read-admin.php";
        const params = new URLSearchParams(window.location.search);
       

        if($nam == 'none')            
            urlr += "?trangthai=" + $trangthai;
        else if ($trangthai == 'none')
            urlr += "?nam=" + $nam;
        else urlr += "?trangthai="+$trangthai+"&nam="+$nam;

        $.get(urlr, function(data) {
            document.getElementById("records").innerHTML = data;
        });
    }

    function getReadUrl1() {
        const params = new URLSearchParams(window.location.search);
        let url =  localURL + "/my-stuff/" +lastsegment+"/read-admin.php";
        $page= 1;
        if (params.has('pg')) {
            url += "?pg=" + params.get('pg');
        }
        if(params.has('trangthai') && params.has('nam') ) {
            url += "&trangthai=" + params.get('trangthai') +"&nam="+ params.get('nam');
        }else if(params.has('trangthai')){
            url += "&trangthai=" + params.get('trangthai');
        }else if(params.has('nam')){
            url += "&nam=" + params.get('nam');
        }
        
        return url;
    }

    function read() {
        const url = getReadUrl1();
        // console.log(url);
        $.get(url, function(data) {
            document.getElementById("records").innerHTML = data;
        });
    }
</script>
<?php
get_footer();
