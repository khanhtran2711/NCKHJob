<?php

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
 * Template name: Workout Page
 */

get_header(); ?>
<div id="mess">

</div>
<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <div class="container">
                <form class="form form-vertical" method="POST" enctype="multipart/form-data" id="target">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="workoutdate">Work out Date</label>
                                    <input type="date" id="workoutdate" class="form-control" name="workoutdate">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="activity">Activity</label>
                                    <input type="text" id="activity" class="form-control" name="activity" value="">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="time_mins">Times in Min</label>
                                    <input type="text" id="time_mins" class="form-control" name="time_mins" value="">
                                </div>
                            </div>
                            <input type="hidden" id="user_id" class="form-control" name="time_mins" value="<?= get_current_user_id(); ?>">

                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success  me-1 mb-1" name="workoutformbtn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container mt-3">
                    <h2>Workout History</h2>
                    <p>The .table-striped class adds zebra-stripes to a table:</p>
                    <table class="table table-striped" id="records">

                    </table>
                    
                </div>
            </div> <!--container-->

        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- .wrap -->

<?php
$jquery = get_theme_file_uri( '/assets/js/jquery-3.7.0.js' );
?>
<script src="<?=$jquery?>"></script>
<script>
    $("#target").on("submit", function(event) {
        callCreate();
    });

    $(document).ready(function() {

        read();


    });

    function callCreate(){
        const url = "/NCKH/my-stuff/create_workout.php";
        $.post(url,
        {
            workoutdate: $('#workoutdate').val(),
            activity: $('#activity').val(),
            time_mins: $('#time_mins').val(),
            user_id: $('#user_id').val(),
        },
        function(data, status){
            const alertmess = '<div class="auto-close alert alert-success" role="alert"> Đã thêm thành công</div>'
                // document.getElementById("mess").innerHTML = alertmess;
        });
    }

    function getReadUrl() {
        const params = new URLSearchParams(window.location.search);
        let url = "/NCKH/my-stuff/read_workout.php";

        if (params.has('id')) {
            url += "?id=" + params.get('id');
        }

        return url;
    }

    function read() {
        const url = getReadUrl();
        console.log(url);
        // $.get(url, function(data) {
        //     document.getElementById("records").innerHTML = data;
        // });
    }
</script>
<?php
get_footer();
