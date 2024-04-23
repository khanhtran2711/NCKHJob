<?php
global $wpdb;
include 'wp-load.php';
include 'mydbfile.php';


?>

<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="<?=$home?>" style="width:100%">
                    <span class="align-middle" style="width: inherit">
						<img src="https://blu.edu.vn/assets/img/logo.png" alt="" style="width: inherit">
					</span>
                </a>

				<ul class="sidebar-nav">
                <li class="sidebar-item ">
						<a class="sidebar-link" href="<?=$home?>">
              <i class="align-middle" data-feather="home"></i> <span class="align-middle">Trang chủ</span>
            </a>
					</li>
			<?php
			$user = get_current_user_id();
			$sql = "SELECT `vaitro_noibo` FROM `Canbo` c INNER JOIN `realdev_users` usr on c.user_id=usr.ID WHERE id= $user";
			error_log('sql = ' . $sql);
			$re = $conn->query($sql);
			$row = $re->fetch_assoc();
			if($row['vaitro_noibo']==1):
			?>
					<li class="sidebar-item">
						<a class="sidebar-link" href="<?=home_url('/duyetchucdanh')?>">
						<i class="align-middle" data-feather="file-text"></i>  <span class="align-middle">Duyệt chức danh</span>
            </a>
				</li>
				<li class="sidebar-item">
						<a class="sidebar-link" href="<?=home_url('/duyetgiamtru')?>">
						<i class="align-middle" data-feather="file-text"></i>  <span class="align-middle">Duyệt giảm trừ</span>
            </a>
				</li>
			<?php
			endif;
			?>
					<li class="sidebar-header">
					<a class="" href="<?=home_url( '/cbprofile')?>">Cập nhật thông tin chuyên môn</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?=home_url('/doichucdanh')?>">
                        <i class="align-middle" data-feather="edit"></i>  <span class="align-middle">Thay đổi chức danh</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?=home_url('/doigiamtru')?>">
                        <i class="align-middle" data-feather="edit"></i>  <span class="align-middle">Thay đổi giảm trừ</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?=home_url('/doikhoa')?>">
                        <i class="align-middle" data-feather="edit"></i>  <span class="align-middle">Sửa thông tin đơn vị</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?=admin_url( 'profile.php')?>">
              <i class="align-middle" data-feather="edit"></i> <span class="align-middle">Sửa thông tin cá nhân</span>
            </a>
					</li>

					<li class="sidebar-header">
						Kê khai NCKH
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?=home_url('/detainckh')?>">
              <i class="align-middle" data-feather="folder"></i> <span class="align-middle">Nhập thông tin đề tài</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?=home_url('/congtrinh')?>">
              <i class="align-middle" data-feather="folder"></i> <span class="align-middle">Nhập thông tin công trình</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?=home_url('/giaithuong')?>">
              <i class="align-middle" data-feather="folder"></i> <span class="align-middle" style="word-spacing: -2px;">Nhập thông tin giải thưởng</span>
            </a>
					</li>

					

					<li class="sidebar-header">
						Thống kê NCKH
					</li>

					<!-- <li class="sidebar-item">
						<a class="sidebar-link" href="charts-chartjs.html">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Theo toàn trường</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="maps-google.html">
              <i class="align-middle" data-feather="map"></i> <span class="align-middle">Theo đơn vị</span>
            </a>
					</li> -->
                    <li class="sidebar-item">
						<a class="sidebar-link" href="<?=home_url('/tkcbstaff')?>">
              <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Theo cán bộ</span>
            </a>
					</li>
				</ul>

			</div>
		</nav>
