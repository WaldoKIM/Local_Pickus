<?php
include_once("./_common.php");
// with KJS dance
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = " select a.* from {$g5['member_table']} a ";
if($e_type == "0" || $e_type == "1"){
	$sql .= " where mb_biz_type in ('1','3') ";
}else{
	$sql .= " where mb_biz_type in ('2','3') ";
}
echo $member['mb_level'];
if($member['mb_level'] == 10 ){
	$sql .= " and mb_id in ( select mb_id from {$g5['member_area_table']} where 1=1 and ( ( mb_area1 = '$area1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$area1' and mb_area2 = '$area2'))) and mb_show_type = 1";
	$sql .= " order by mb_biz_score desc limit 8";
}else{
	$sql .= " and mb_id in ( select mb_id from {$g5['member_area_table']} where 1=1 and ( ( mb_area1 = '$area1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$area1' and mb_area2 = '$area2')))";
	$sql .= " order by mb_biz_score desc limit 8";
}
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++){
	$sql = " select
				a.rc_email,
				round(avg(a.score),1) as score,
				round(avg(a.score)/5 * 100,0) as rate,
				count(*) as cnt
			from
				g5_estimate_propose a
				join g5_estimate_list b on a.estimate_idx = b.idx
			where
				ifnull(a.review,'') !=  ''
				and a.rc_email = '{$row['mb_email']}'
			group by a.rc_email ";

	$score_row = sql_fetch($sql);

	$score = $score_row['score'];
	echo "<li class='list'>";
	echo "<div>";
	echo "<div class='img'><img src = '/data/estimate/".$row['mb_photo_site']."'><a href='#' id='show_modal'>업체소개</a></div>";
	echo "<div class='text'>";
	if($score > 0 && $score_row['cnt'] > 0)
	{
		if($score < 1){
			echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
		}else if($score < 2){
			echo "<p style='color: #1379cd; margin-top: 0;'><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i></p>";
		}else if($score < 3){
			echo "<p style='color: #1379cd; margin-top: 0;'><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i></p>";
		}else if($score < 4){
			echo "<p style='color: #1379cd; margin-top: 0;'><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i></p>";
		}else if($score < 5){
			echo "<p style='color: #1379cd; margin-top: 0;'><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i></p>";
		}else{
			echo "<p style='color: #1379cd; margin-top: 0;'><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i></p>";
		}
		echo "<a class='re_btn' href='javascript:doReview(\"".$row['mb_email']."\",\"".$row['mb_biz_score']."\")'>후기보기 <i class='xi-angle-right-min'></i></a>";
	}
	echo "<h4>".$row['mb_name']."</h4>";
	//echo "<h5>".$row['mb_biz_addr1']."</h5>";
	echo "</div>";
	echo "<div class='btn_list'>";
	echo "<ul class='row'>";
	echo "<li style='padding: 0;'>";
	echo "<input type='hidden' name='rc_email_chk[]' id='rc_email_chk_".$i."' value='N' >";
	echo "<input type='hidden' name='rc_email[]' id='rc_email_".$i."' value='".$row['mb_email']."' >";
	echo "<a id='request_".$i."' class='main_bg' href='javascript:doRequsetPartner(\"".$i."\")'>문의하기</a>";
	echo "</li>";
	echo "</ul>";
	echo "</div>";
	echo "</div>";
	echo "</li>";		
} 

?>
<script type="text/javascript">
	var btn_x = document.getElementById("close_modal");
	var modal = document.getElementById("modal_background");
	var show_modal = document.getElementById("show_modal");

	$(show_modal).click(function(){
		$( ".modal_background" ).css( "display", "block" );
	});

	btn_x.onclick = function() {
	  modal.style.display = "none";
	}
	window.onclick = function(event) {
		
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
</script>