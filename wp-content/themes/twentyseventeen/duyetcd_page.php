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
 * Template name: Duyet chuc danh form Page
 */
if(isset($_GET['id'])){

$sql = "UPDATE `CanBo_ChucDanh` SET `trangthaiduyet`= 1 , `trangthaisudung`=1 WHERE `id`= " . $_GET['id'];
        
error_log('sql = '.$sql);

$result = $conn->query($sql);


$conn->close();
header("location: ".home_url('/duyetchucdanh'));
}
get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">

        <main id="main" class="site-main">

            <div class="container">

                <div class="container mt-3">
                    <h2>Thông tin cần duyệt</h2>
                    <p><?= get_the_content() ?></p>
                    <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="filter">
                        <div class="form-body">
                            <div class="row">
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
    
    let localURL = $("#homeurl").val();
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = "chucdanh";
    function confirmDesactiv()
    {
    return confirm("bạn có muốn xóa không?")
    }
    function confirmRefuse()
    {
    return confirm("Khi thực hiện hành động này, sẽ không được thu hồi, bạn có chắc chắn thực hiện hành động này?")
    }
    $(document).ready(function() {

        read();


    });

    // $("#filter").on("click", function(event) {
    //     event.preventDefault();
    //     $param = $("#trangthai").val();
    //     if ($param == 'none')
    //         read();
    //     else
    //         getReadUrl($param);
    // })


    function getReadUrl($param) {
        const params = new URLSearchParams(window.location.search);
        let urlr = localURL + "/my-stuff/" + lastsegment + "/read-admin.php";

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
