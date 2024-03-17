<?php
include 'my-stuff/loaisltc/config.php';
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
 * Template name: Loaisltc management Page
 */

get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">
       
        <main id="main" class="site-main">
            
            <div class="container">
               
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="loaisltc">
                    <div class="form-body">
                        <div class="row">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="ten_loaisl" name="ten_loaisl" type="text" placeholder="Tên đơn vị tính/ mức điểm/giờ chuẩn" data-sb-validations="required" />
                                <label for="ten_loaisl">Tên đơn vị tính/ mức điểm/giờ chuẩn</label>
                                <div class="invalid-feedback" data-sb-feedback="ten_loaigt:required">Tên đơn vị tính/ mức điểm/giờ chuẩn is required.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="giatri_sl" name="giatri_sl" type="text" placeholder="Giá trị" data-sb-validations="required" />
                                <label for="giatri_sl">Giá trị (1)</label>
                                <div class="invalid-feedback" data-sb-feedback="giatri_sl:required">Giá trị is required.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="thoigian_apdung" name="thoigian_apdung" type="date" placeholder="Thời gian áp dụng" data-sb-validations="required" value="<?=date('Y-m-d')?>"/>
                                <label for="thờiGianApDụng">Thời gian áp dụng</label>
                                <div class="invalid-feedback" data-sb-feedback="thờiGianApDụng:required">Thời gian áp dụng is required.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="ma_loaict" aria-label="Loaict">
                                    <?php
                                        $sql = "SELECT * FROM `LoaiCongTrinh_Khac`";

                                        $re = $conn->query($sql);
                                        while ($row = $re->fetch_assoc()):
                                    ?>
                                        <option value="<?=$row['ma_loai']?>"><?=$row['ten_loai']?></option>
                                    <?php
                                        endwhile;
                                    ?>
                                </select>
                                <label for="ma_cdt">Loại Công Trình</label>
                            </div>
                          

                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="workoutformbtn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container mt-3">
                    <h2>Danh sách các loại giải thưởng</h2>
                    <p><?=get_the_content()?></p>
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
    const currentUrl = window.location.hostname;
    const folder = "NCKH";
    let localURL =currentUrl+'/'+folder;
    let path = window.location.pathname.split('/').pop();
    const array = window.location.pathname.split('/');
    const lastsegment = array[array.length-2];
console.log(lastsegment);
    $("#loaisltc").on("submit", function(event) {
        
        callCreate();
    });

    $(document).ready(function() {

        read();


    });

    function callCreate() {
        let urlc = "http://"+localURL+"/my-stuff/"+lastsegment+"/create.php";
        $.post(urlc, {
            ten_loaisl: $('#ten_loaisl').val(),
            giatri_sl: $('#giatri_sl').val(),
                thoigian_apdung:$('#thoigian_apdung').val(),
                ma_loaict: $("#ma_loaict").val()
            },
            function(data, status) {
                console.log(data);
            });
    }

    function getReadUrl() {
        const params = new URLSearchParams(window.location.search);
        let urlr = "http://"+localURL+"/my-stuff/"+lastsegment+"/read.php";

        if (params.has('id')) {
            urlr += "?id=" + params.get('id');
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
