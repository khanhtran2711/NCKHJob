<?php
include '../../mydbfile.php';

global $wpdb;
include '../../wp-load.php';
include '../../nhiemvu.php';



	$a = $_POST['ma_nh'];
	$b = $_POST['ma_khoa'];

	
	$sql4= "SELECT namhoc FROM `NamHoc` WHERE ma_nh = $a ";
	$re4 = $conn->query($sql4);
		$row4 = $re4->fetch_assoc();
	$namhoc = $row4['namhoc'];


	$sql = "SELECT cb.user_id, cb.ma_cb, cdt.giochuan, dtcb.ten_loaivt,dtnc.sluong_thamgia, k.ten_khoa FROM `DeTai_NCKH` dtnc INNER JOIN `DeTai_CanBo` dtcb on dtnc.ma_dtnckh=dtcb.ma_dtnckh INNER JOIN `Canbo` cb on cb.ma_cb=dtcb.macb INNER JOIN `NamHoc` nh on dtnc.ma_nh = nh.ma_nh INNER JOIN `CapDeTai` cdt ON cdt.ma_cdt=dtnc.ma_cdt INNER JOIN `Khoa_PB` k on k.ma_khoa=cb.ma_khoa WHERE nh.ma_nh =$a and cb.ma_khoa=$b and dtnc.trangthai = 1;";
    
	$re = $conn->query($sql);

	error_log('sql = ' . $sql);
	$listtonghop = array();

	while ($row = $re->fetch_assoc()) {
		$giotong = $row['giochuan'];
		$sogioquydoi = 0;
		if($row['ten_loaivt']=='TV Chính')
			$sogioquydoi = $giotong/3 + ($giotong*(2/3))/($row['sluong_thamgia']);
		else{
			$sogioquydoi = ($giotong*(2/3))/($row['sluong_thamgia']);
		}
		if(count($listtonghop)==0){
			$c = new Nhiemvu();
			$c->setMacb($row['ma_cb']);
			$c->setUserid($row['user_id']);
			$c->setKhoa($row['ten_khoa']);
			$c->setNamhoc($namhoc);
			$c->setDetai(number_format($sogioquydoi,1));
			array_push($listtonghop,$c);
		}else{
			$flag = false;
			foreach ($listtonghop as $item) {
				if($row['ma_cb']==$item->getMacb()){
					$temp = $item->getDetai();
					$item->setDetai(number_format($temp+$sogioquydoi,1));
					$flag=true;
					break;
				}
			}
			if(!$flag){
				$c = new Nhiemvu();
				$c->setMacb($row['ma_cb']);
				$c->setUserid($row['user_id']);
				$c->setKhoa($row['ten_khoa']);
				$c->setNamhoc($namhoc);
				$c->setDetai(number_format($sogioquydoi,1));
				array_push($listtonghop,$c);
			}
			
			
		}
		
	}

	$sql2 = "SELECT gt.ma_gt , cb.user_id,cb.ma_cb, lgt.heso_loaigt, k.ten_khoa, lgt.ten_loaigt FROM `GiaiThuong` gt INNER JOIN `CanBo_GiaiThuong` cbgt on gt.ma_gt=cbgt.ma_gt INNER JOIN `Canbo` cb on cb.ma_cb=cbgt.ma_cb INNER JOIN `NamHoc` nh on gt.ma_nh = nh.ma_nh INNER JOIN `LoaiGiaiThuong` lgt ON lgt.ma_loaigt=gt.ma_loaigt INNER JOIN `Khoa_PB` k on k.ma_khoa=cb.ma_khoa WHERE nh.ma_nh =$a and cb.ma_khoa=$b and gt.trangthai = 1";

	$re2 = $conn->query($sql2);

	error_log('sql = ' . $sql2);

	$sql22 = "SELECT gt.ma_gt, COUNT(cb.user_id) as sl FROM `GiaiThuong` gt INNER JOIN `CanBo_GiaiThuong` cbgt on gt.ma_gt=cbgt.ma_gt INNER JOIN `Canbo` cb on cb.ma_cb=cbgt.ma_cb INNER JOIN `NamHoc` nh on gt.ma_nh = nh.ma_nh INNER JOIN `LoaiGiaiThuong` lgt ON lgt.ma_loaigt=gt.ma_loaigt INNER JOIN `Khoa_PB` k on k.ma_khoa=cb.ma_khoa WHERE nh.ma_nh =$a and gt.trangthai = 1 GROUP by gt.ma_gt;";
	$re22 = $conn->query($sql22);

	error_log('sql22 = ' . $sql22);
    $gtrarray = array();
while($row22 = $re22->fetch_assoc()){
    $key = $row22['ma_gt'];
    $value = $row22['sl'];
    $gtrarray[$key] = $value;
}
	//;
	while ($row = $re2->fetch_assoc()) {
		$flag = false;
		$magt = $row['ma_gt'];
        $sl = $gtrarray[$magt];
		foreach ($listtonghop as $item) {
			if($row['ma_cb']==$item->getMacb()){
				if (str_contains($row['ten_loaigt'], 'cấp khoa')) {
					$temp = $item->getHuongsv();
					$item->setHuongsv(number_format($temp+($row['heso_loaigt']/$sl),2));
				}
				else if(str_contains($row['ten_loaigt'], 'đề tài NCKH, sáng tạo kỹ thuật')) {
					$temp = $item->getSvnckh();
					$item->setSvnckh(number_format($temp+($row['heso_loaigt']/$sl),2));
				}
				else{
					$temp = $item->getOlympic();
					$item->setOlympic(number_format($temp+($row['heso_loaigt']/$sl),2));
				
				}
				$flag=true;
				break;

			}
		}
		if(!$flag){
			$c = new Nhiemvu();
			$c->setMacb($row['ma_cb']);
			$c->setUserid($row['user_id']);
			$c->setKhoa($row['ten_khoa']);
			$c->setNamhoc($namhoc);
			if (str_contains($row['ten_loaigt'], 'cấp khoa')) {
				$c->setHuongsv(number_format($row['heso_loaigt']/$sl,2));
			}
			else if(str_contains($row['ten_loaigt'], 'đề tài NCKH, sáng tạo kỹ thuật')) {
				$c->setSvnckh(number_format($row['heso_loaigt']/$sl,2));
			}
			else{
				$c->setOlympic(number_format($row['heso_loaigt']/$sl,2));
			
			}
			array_push($listtonghop,$c);
		}
	}

	$sql3 = "SELECT cb.user_id,cb.ma_cb, lsl.ten_loaisl, lsl.giatri_sl, k.ten_khoa , lctk.ten_loai,cbct.ten_loaivt,ctk.sluong_thamgia,sotinchi FROM `CongTrinh_Khac` ctk INNER JOIN `CanBo_Ctr` cbct on ctk.ma_ctr=cbct.ma_ctr INNER JOIN `Canbo` cb on cb.ma_cb=cbct.ma_cb INNER JOIN `NamHoc` nh on ctk.ma_nh = nh.ma_nh INNER JOIN `LoaiSL_TC` lsl ON lsl.ma_loaisl=ctk.ma_loaisltc INNER JOIN `LoaiCongTrinh_Khac` lctk ON lctk.ma_loai=lsl.ma_loaict INNER JOIN `Khoa_PB` k on k.ma_khoa=cb.ma_khoa WHERE nh.ma_nh =$a and cb.ma_khoa=$b and ctk.trangthai = 1";

	$re3 = $conn->query($sql3);

	error_log('sql = ' . $sql3);

	while ($row = $re3->fetch_assoc()) {
		$giotong = $row['giatri_sl'];
		$sotinchi = $row['sotinchi'];
        $sogioquydoi = 0;
        if($row['ten_loaivt']=='TV Chính')
            $sogioquydoi = ($giotong/3*$sotinchi) + ($giotong*(2/3)*$sotinchi)/($row['sluong_thamgia']);
        else{
            $sogioquydoi = ($giotong*(2/3)*$sotinchi)/($row['sluong_thamgia']);
        }
		$flag = false;
		foreach ($listtonghop as $item) {
			if($row['ma_cb']==$item->getMacb()){
				if (str_contains(strtolower($row['ten_loai']), 'giáo trình')) {
					$temp = $item->getGiaotrinh();
					$item->setGiaotrinh(number_format($temp+$sogioquydoi,1));
				}
				else if (str_contains(strtolower($row['ten_loai']), 'tạp chí')) {
					$temp = $item->getBaitapchi();
					$item->setBaitapchi(number_format($temp+$sogioquydoi,1));
				}
				else if (str_contains(strtolower($row['ten_loai']), 'kỷ yếu')) {
					$temp = $item->getBaikyyeu();
					$item->setBaikyyeu(number_format($temp+$sogioquydoi,1));
				}
				else if (str_contains(strtolower($row['ten_loai']), 'sách')) {
					$temp = $item->getSach();
					$item->setSach(number_format($temp+$sogioquydoi,1));
				}
				else  {
					$temp = $item->getTailieu();
					$item->setTailieu(number_format($temp+$sogioquydoi,1));
				}
				$flag=true;
					break;
			}
		}
		if(!$flag){
			$c = new Nhiemvu();
			$c->setMacb($row['ma_cb']);
			$c->setUserid($row['user_id']);
			$c->setKhoa($row['ten_khoa']);
			$c->setNamhoc($namhoc);
			if (str_contains(strtolower($row['ten_loai']), 'giáo trình' )) {
			
				$c->setGiaotrinh(number_format($sogioquydoi,1));
			}
			else if (str_contains(strtolower($row['ten_loai']), 'tạp chí')) {
				
				$c->setBaitapchi(number_format($sogioquydoi,1));
			}
			else if (str_contains(strtolower($row['ten_loai']), 'kỷ yếu')) {
				
				$c->setBaikyyeu(number_format($sogioquydoi,1));
			}
			else if (str_contains(strtolower($row['ten_loai']), 'sách')) {
		
				$c->setSach(number_format($sogioquydoi,1));
			}
			else  {
				$c->setTailieu(number_format($sogioquydoi,1));
			}
			array_push($listtonghop,$c);
		}
			
	}

	// echo json_encode($listtonghop);
	// // webpage form starts here
	echo "<tbody>";
	echo "<thead>";
	echo "<th>Họ tên</th><th>đề tài NCKH</th><th>Giáo trình</th><th>Sách</th><th>Tài liệu</th><th>Tạp chí</th><th>Kỷ yếu</th><th>Hdan SV</th><th>SVNCKH</th><th>Olympic</th><th>Tổng giờ</th><th>Định mức</th><th>Giờ vượt</th><th>Ghi chú</th>";
	echo "</thead>";
	
	foreach ($listtonghop as $item) {
		
		echo "<tr>";
		$user = new WP_User($item->getUserid());
		
		echo "<td>" . $user->last_name." ".$user->first_name . "</td>";
		// echo "<td>" . $item->getMacb() . "</td>";
		echo "<td>" . $item->getDetai() . "</td>";
		echo "<td>" . $item->getGiaotrinh() . "</td>";

		echo "<td>" . $item->getSach() . "</td>";
		echo "<td>" . $item->getTailieu() . "</td>";
		echo "<td>" . $item->getBaitapchi() . "</td>";
		echo "<td>" . $item->getBaikyyeu() . "</td>";
		echo "<td>" . $item->getHuongsv() . "</td>";
		echo "<td>" . $item->getSvnckh() . "</td>";
		echo "<td>" . $item->getOlympic() . "</td>";
		echo "<td>" . $item->sumTotal() . "</td>";
		$item->setTotal($item->sumTotal());
		$sqlextra = "SELECT max(cd.dinhmuc) as dinhmucmax FROM `CanBo_ChucDanh` as cbcd inner join `ChucDanh` as cd on cbcd.ma_cd = cd.ma_cd inner join `Canbo` as cb on cbcd.ma_cb=cb.ma_cb INNER JOIN `realdev_users` as u on u.ID=cb.user_id WHERE cb.user_id=".$item->getUserid();
		error_log('sql = ' . $sqlextra);
		$ree = $conn->query($sqlextra);
		$row = $ree->fetch_assoc();
		

		$sqlextra2 = "SELECT lgtr.mucgiam, lgtr.ten_gtr,sothang FROM `Canbo` cb INNER JOIN `realdev_users` as u on u.ID=cb.user_id INNER JOIN `CanBo_GiamTru` cbgtr on cb.ma_cb=cbgtr.ma_cb INNER JOIN `LoaiGiamTru` lgtr on cbgtr.ma_gtr=lgtr.ma_gtr WHERE cbgtr.trangthaisudung=1 and cbgtr.trangthaiduyet=1 and cb.user_id=".$item->getUserid()." and cbgtr.ma_nh=$a ORDER by cbgtr.thoigiannhan desc";
		$ree2 = $conn->query($sqlextra2);
		if($ree2!=false && $ree2->num_rows>0){
			
			$tilesothang = 0;
			$note ="";
			$i=0;
			$dinhmucnew = 0;
			while($row2 = $ree2->fetch_assoc()){
				if(str_contains($row2['ten_gtr'], 'nghỉ thai sản')){
					$tilesothang = $row2['sothang']/6;
				}else{
					$tilesothang = $row2['sothang']/10;
				}
				// chua biet cai nay tinh sao??????
				
				$dinhmuctam = $row['dinhmucmax'] * (1-($row2['mucgiam']*$tilesothang));
				if($dinhmucnew==0){
					$dinhmucnew = $dinhmuctam;
				}
				else if($dinhmuctam<$dinhmucnew){
					$dinhmucnew = $dinhmuctam;
				}
				if($i==0)
				$note .= $row2['ten_gtr'];
				else
				$note .= ','.$row2['ten_gtr'];

				$i++;
			}
			
			
		}else{
			$dinhmucnew = $row['dinhmucmax'];
			$note= '';
		}
		echo "<td>" . $dinhmucnew . "</td>";
		$item->setDinhmuc($dinhmucnew);

		$extrahours = $item->sumTotal() - $dinhmucnew;
		echo "<td>" . $extrahours . "</td>";
		$item->setVuot($extrahours);
		echo "<td>" . $note . "</td>";
		$item->setNote($note);
		echo "</tr>";
	}
	
    echo "</tbody>";
	
	


	file_put_contents('../myfileth.json', json_encode($listtonghop,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
	$conn->close();
?>