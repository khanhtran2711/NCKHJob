<?php
global $wpdb;
include 'wp-load.php';
// echo home_url( $wp->request ); display the current url
?>

<div class="wrapper">
	<nav id="sidebar" class="sidebar js-sidebar">
		<div class="sidebar-content js-simplebar">
			<a class="sidebar-brand" href="<?= $home ?>" style="width:100%">
				<span class="align-middle" style="width: inherit">
					<img src="https://blu.edu.vn/assets/img/logo.png" alt="" style="width: inherit">
				</span>
			</a>

			<ul class="sidebar-nav">
				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= $home ?>">
						<i class="align-middle" data-feather="home"></i> <span class="align-middle">Trang chủ</span>
					</a>
				</li>
				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= home_url('/qltime') ?>">
						<i class="align-middle" data-feather="home"></i> <span class="align-middle">Quản lý thời gian nộp</span>
					</a>
				</li>
				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= home_url('/qlrole') ?>">
						<i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Quản lý vai trò</span>
					</a>
				</li>
				<li class="sidebar-header">
					Quản lý danh mục
				</li>



				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= home_url('/chucdanh') ?>">
						<i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Quản lý chức danh</span>
					</a>
				</li>

				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= home_url('/loaigtr') ?>">
						<i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Quản lý loại giảm trừ</span>
					</a>
				</li>

				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= home_url('/khoa') ?>">
						<i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Quản lý đơn vị</span>
					</a>
				</li>

				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= home_url('/namhoc') ?>">
						<i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Quản lý năm học</span>
					</a>
				</li>

				<li class="sidebar-header">
					Quản lý NCKH và duyệt
				</li>

				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= home_url('/cap_detai') ?>">
						<i class="align-middle" data-feather="check-circle"></i> <span class="align-middle" style="word-spacing: 0px;">QL và duyệt cấp đề tài</span>
					</a>
				</li>
				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= home_url('/loaict') ?>">
						<i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">QL và duyệt công trình</span>
					</a>
				</li>

				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= home_url('/loaisltc') ?>">
						<i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">QL GC của loại công trình</span>
					</a>
				</li>

				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= home_url('/loaigt') ?>">
						<i class="align-middle" data-feather="check-circle"></i> <span class="align-middle" style="word-spacing: -2px;">QL và duyệt giải thưởng</span>
					</a>
				</li>



				<li class="sidebar-header">
					Thống kê NCKH
				</li>

				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= home_url('/tktoantruong') ?>">
						<i class="align-middle" data-feather="activity"></i> <span class="align-middle">Theo toàn trường</span>
					</a>
				</li>

				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= home_url('/tkkhoa') ?>">
						<i class="align-middle" data-feather="activity"></i> <span class="align-middle">Theo đơn vị</span>
					</a>
				</li>
				<li class="sidebar-item">
					<a class="sidebar-link" href="<?= home_url('/tkcb') ?>">
						<i class="align-middle" data-feather="activity"></i> <span class="align-middle">Theo cán bộ</span>
					</a>
				</li>
			</ul>

		</div>
	</nav>