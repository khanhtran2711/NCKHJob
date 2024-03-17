<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';

include '../../chitiet.php';

$a = $_POST['ma_nh'];
$b = $_POST['ma_khoa'];

$sql4= "SELECT namhoc FROM `NamHoc` WHERE ma_nh = $a ";
	$re4 = $conn->query($sql4);
		$row4 = $re4->fetch_assoc();
	$namhoc = $row4['namhoc'];
	$listtonghop = array();

	$sql2 = "SELECT dtnc.`ma_dtnckh`,cb.ma_cb, cb.user_id, max(cbcd.id),cd.ten_cd, dtnc.ten_dtnckh, dtnc.nam_kethuc,dtnc.sluong_thamgia, dtcb.ten_loaivt, cd.dinhmuc, cdt.ten_cdt,cdt.giochuan,khoa.ten_khoa FROM `DeTai_NCKH` dtnc INNER JOIN `DeTai_CanBo` dtcb on dtnc.ma_dtnckh=dtcb.ma_dtnckh INNER JOIN `Canbo` cb on cb.ma_cb=dtcb.macb INNER JOIN `CanBo_ChucDanh` cbcd on cbcd.ma_cb=cb.ma_cb INNER JOIN `NamHoc` nh on dtnc.ma_nh = nh.ma_nh INNER JOIN `ChucDanh` cd on cd.ma_cd=cbcd.ma_cd INNER JOIN `CapDeTai` cdt ON cdt.ma_cdt=dtnc.ma_cdt INNER JOIN `Khoa_PB` khoa on khoa.ma_khoa = cb.ma_khoa WHERE nh.ma_nh = $a and cb.ma_khoa=$b and dtnc.trangthai = 1  GROUP by dtnc.`ma_dtnckh`,cb.ma_cb, cb.user_id;";
    
	$re = $conn->query($sql2);

	error_log('sql = ' . $sql2);

    $sql1 = "SELECT gt.ma_gt,cb.ma_cb, cb.user_id, max(cbcd.id),cd.ten_cd, gt.ten_gt, cbgt.thoigiannhan, cd.dinhmuc, lgt.ten_loaigt ,lgt.heso_loaigt,khoa.ten_khoa FROM `GiaiThuong` gt INNER JOIN `CanBo_GiaiThuong` cbgt on gt.ma_gt=cbgt.ma_gt INNER JOIN `Canbo` cb on cb.ma_cb=cbgt.ma_cb INNER JOIN `CanBo_ChucDanh` cbcd on cbcd.ma_cb=cb.ma_cb INNER JOIN `NamHoc` nh on gt.ma_nh = nh.ma_nh INNER JOIN `ChucDanh` cd on cd.ma_cd=cbcd.ma_cd INNER JOIN `LoaiGiaiThuong` lgt ON lgt.ma_loaigt=gt.ma_loaigt INNER JOIN `Khoa_PB` khoa on khoa.ma_khoa = cb.ma_khoa WHERE nh.ma_nh = $a and cb.ma_khoa=$b and gt.trangthai = 1 GROUP by gt.ma_gt,cb.ma_cb, cb.user_id;";

    $re1 = $conn->query($sql1);

	error_log('sql = ' . $sql1);

$sql3 = "SELECT ctk.ma_ctr,cb.ma_cb, cb.user_id, max(cbcd.id),cd.ten_cd, ctk.ten_ctr, ctk.thoigian_hoanthanh, cd.dinhmuc, ctk.ten_tc_ky_nxb ,lsl.giatri_sl, khoa.ten_khoa , lctk.ten_loai , ctk.sluong_thamgia, cbct.ten_loaivt FROM `CongTrinh_Khac` ctk INNER JOIN `CanBo_Ctr` cbct on ctk.ma_ctr=cbct.ma_ctr INNER JOIN `Canbo` cb on cb.ma_cb=cbct.ma_cb INNER JOIN `CanBo_ChucDanh` cbcd on cbcd.ma_cb=cb.ma_cb INNER JOIN `NamHoc` nh on ctk.ma_nh = nh.ma_nh INNER JOIN `ChucDanh` cd on cd.ma_cd=cbcd.ma_cd INNER JOIN `LoaiSL_TC` lsl ON lsl.ma_loaisl=ctk.ma_loaisltc INNER JOIN `LoaiCongTrinh_Khac` lctk ON lctk.ma_loai=lsl.ma_loaict INNER JOIN `Khoa_PB` khoa on khoa.ma_khoa = cb.ma_khoa WHERE nh.ma_nh = $a and cb.ma_khoa=$b and ctk.trangthai = 1 GROUP by ctk.ma_ctr,cb.ma_cb, cb.user_id;";
$re3 = $conn->query($sql3);

	error_log('sql = ' . $sql3);
	// webpage form starts here
	echo "<tbody>";
	echo "<thead>";
	echo "<th>Họ tên</th><th>Khoa</th><th>Tên đề tài NCKH</th><th>Loại công trình</th><th>Cấp đề tài/Tên Tạp chí/Tên Kỷ yếu-Tên NXB</th><th>Kết thúc</th><th>Số lượng</th><th>Vị trí</th><th>Số lượng quy đổi</th>";
	echo "</thead>";
	while ($row = $re->fetch_assoc()) {
        $user = new WP_User($row['user_id']);
		$c = new Chitiet();
			$c->setMacb($row['ma_cb']);
			$c->setUserid($row['user_id']);
			$c->setKhoa($row['ten_khoa']);
		
			$c->setTendetai($row['ten_dtnckh']);
			$c->setLoaict('Đề Tài NCKH');
			$c->setCap($row['ten_cdt']);
			$c->setKetthuc($row['nam_kethuc']);
			$c->setSoluong($row['sluong_thamgia']);
			$c->setVitri($row['ten_loaivt']);
			
			
			array_push($listtonghop,$c);
		echo "<tr>";
        echo "<td>" . $user->last_name." ".$user->first_name . "</td>";
        echo "<td>" . $row['ten_khoa'] . "</td>";
		echo "<td>" . $row['ten_dtnckh'] . "</td>";
		echo "<td> Đề Tài NCKH </td>";
        echo "<td>" . $row['ten_cdt'] . "</td>";
		echo "<td>" . $row['nam_kethuc'] . "</td>";
		echo "<td>" . $row['sluong_thamgia'] . "</td>";
		echo "<td>" . $row['ten_loaivt'] . "</td>";
        $giotong = $row['giochuan'];
        $sogioquydoi = 0;
        if($row['ten_loaivt']=='TV chính')
            $sogioquydoi = $giotong/3 + ($giotong*(2/3))/($row['sluong_thamgia']);
        else{
            $sogioquydoi = ($giotong*(2/3))/($row['sluong_thamgia']);
        }
        echo "<td>".number_format($sogioquydoi,2)."</td>";
		$c->setQuydoi(number_format($sogioquydoi,2));
		$c->setNamhoc($namhoc);
		// echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_dtnckh"] . '">Update</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
	}
    while ($row = $re1->fetch_assoc()) {
        $user = new WP_User($row['user_id']);
		echo "<tr>";
        echo "<td>" . $user->last_name." ".$user->first_name . "</td>";
        echo "<td>" . $row['ten_khoa'] . "</td>";
		echo "<td>" . $row['ten_gt'] . "</td>";
		echo "<td> Giải thưởng </td>";
        echo "<td>" . $row['ten_loaigt'] . "</td>";
		echo "<td>" . $row['thoigiannhan'] . "</td>";
		echo "<td></td>";
		echo "<td></td>";
        echo "<td>".$row['heso_loaigt']."</td>";
		$c = new Chitiet();
			$c->setMacb($row['ma_cb']);
			$c->setUserid($row['user_id']);
			$c->setKhoa($row['ten_khoa']);
		
			$c->setTendetai($row['ten_gt']);
			$c->setLoaict('Giải thưởng');
			$c->setCap($row['ten_loaigt']);
			$c->setKetthuc($row['thoigiannhan']);
			$c->setQuydoi($row['heso_loaigt']);
		$c->setNamhoc($namhoc);
		array_push($listtonghop,$c);
		// echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_dtnckh"] . '">Update</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		
	}
    while ($row = $re3->fetch_assoc()) {
        $user = new WP_User($row['user_id']);
		echo "<tr>";
        echo "<td>" . $user->last_name." ".$user->first_name . "</td>";
        echo "<td>" . $row['ten_khoa'] . "</td>";
		echo "<td>" . $row['ten_ctr'] . "</td>";
		echo "<td>" . $row['ten_loai'] . "</td>";
        echo "<td>" . $row['ten_tc_ky_nxb'] . "</td>";
		echo "<td>" . $row['thoigian_hoanthanh'] . "</td>";
        echo "<td>" . $row['sluong_thamgia'] . "</td>";
		echo "<td>" . $row['ten_loaivt'] . "</td>";
		$giotong = $row['giatri_sl'];
        $sogioquydoi = 0;
        if($row['ten_loaivt']=='TV chính')
            $sogioquydoi = $giotong/3 + ($giotong*(2/3))/($row['sluong_thamgia']);
        else{
            $sogioquydoi = ($giotong*(2/3))/($row['sluong_thamgia']);
        }
        echo "<td>".number_format($sogioquydoi,2)."</td>";
		$c = new Chitiet();
			$c->setMacb($row['ma_cb']);
			$c->setUserid($row['user_id']);
			$c->setKhoa($row['ten_khoa']);
		
			$c->setTendetai($row['ten_ctr']);
			$c->setLoaict($row['ten_loai']);
			$c->setCap($row['ten_tc_ky_nxb']);
			$c->setKetthuc($row['thoigian_hoanthanh']);
			$c->setQuydoi(number_format($sogioquydoi,2));
		$c->setNamhoc($namhoc);
		array_push($listtonghop,$c);
		// echo '<td><a class="btn btn-info" href="'.$pagename.'?id=' . $row["ma_dtnckh"] . '">Update</a></td>';
		// echo '<td> <a class="btn btn-danger" href="'.$mystufflink.$foldername.'delete.php?id=' . $row['ma_cdt'] . '">Delete</a></td>';
		echo "</tr>";
		
	}
    echo "</tbody>";
	file_put_contents('../myfileqd.json', json_encode($listtonghop,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
	$conn->close();
