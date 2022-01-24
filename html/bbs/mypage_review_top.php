<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>

<div id="board">
					<div class="view">
						<ul class="shop_list" id="proposeList">
						<li style="width: 100% !important">
							<?php
					
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
									and a.rc_email = '{$member['mb_email']}'
								group by a.rc_email ";

						$score_row = sql_fetch($sql);

						$review_cnt = $score_row['cnt'];
						$score = $score_row['score'];
						$sql = " select
									a.idx,
									a.estimate_idx,
									b.e_type,
									b.item_cat,
									concat(substr(a.nickname,1,1),'**') AS nickname,
									b.area1,
									b.area2,
									a.score,
									b.goods_state,
									b.title,
									a.review,
									date_format(a.updatetime,'%Y.%m.%d') as updatetime,
									case when ifnull(a.review,'') !=  ''  then 'Y' else 'N' end as reviewYn
								from 
									g5_estimate_propose a
									join g5_estimate_list b on a.estimate_idx = b.idx
								where 
									ifnull(a.review,'') !=  '' 
									and a.rc_email = '{$member['mb_email']}'
								order by a.estimate_idx desc ";
								
						$result = sql_query($sql);

                        //사진, 이름, 거래지역 등 불러오기 추가 with KJS dance 20220117
						
						$sql = " select
						mb_photo_site,
						mb_name,
						mb_biz_goods_item
					from 
						g5_member
					where 
						mb_email = '{$member['mb_email']}'"
						;

			$seller_info = sql_query($sql);
			$seller_profile = mysqli_fetch_array($seller_info);

			

						echo '<div id="board">';
						echo '<div class="form-group">';
						echo '<ul class="shop_list" id="selectList">';
						echo '<p style="text-align: center; margin-bottom: 5px;">';
						echo "<span class='main_co'>안녕하세요 ".$seller_profile['mb_name']."님!</span>";
						echo'</p>';
						echo "<div class='img'> <img src = '/data/estimate/" .$seller_profile['mb_photo_site']. "'></div>";
						echo '<p class="text-right" id="reviewTitle">';
						echo "<span class='main_co'>".$seller_profile['mb_biz_goods_item']."</span>";
						echo'</br>';						
						echo "<span class='icon_star'>";
						if($score < 1){
							echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 2){
							echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 3){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 4){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 5){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
						}else{
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
						}
						echo '</span>';
						echo'</br>';
						echo "평점 <span class='main_co'>".$score."</span> / 5.0";
						echo'</br>';
						//echo '<p style="text-align: center; margin-bottom: 5px;">';
						echo "거래후기&nbsp;<span class='main_co'>".$review_cnt."</span>";
					    $sql_common  = " from ";
						$sql_common .= " 	{$g5['estimate_list']} a ";
						$sql_common .= " 	join {$g5['estimate_propose']} b on a.idx = b.estimate_idx ";
						$sql_common .= " 	left join ( ";
						$sql_common .= " 		select estimate_idx, count(*) as cnt from {$g5['estimate_propose']} group by estimate_idx ";
						$sql_common .= " 	) c on a.idx = c.estimate_idx ";
						$sql_common .= " where ";
						$sql_common .= " 	b.rc_email = '{$member['mb_email']}' ";
						$sql_common .= " 	and b.selected = '1' ";
						
						$sql = " select count(*) as cnt " . $sql_common;
						$row = sql_fetch($sql);
						$total_count = $row['cnt'];
						
						$sql = " select
						count(*) as goods_cnt
					from 
						cs_goods
					where 
						seller = '{$member['mb_email']}'"
						;

						$row = sql_fetch($sql);
						$goods_cnt = $row['goods_cnt'];

						echo'</br>';
						
						echo "총 견적&nbsp;<span class='main_co'>".$total_count."</span>";
						echo'</br>';
						echo "총 상품&nbsp;<span class='main_co'>".$goods_cnt."</span>";
						echo'</p>';
						
												
						//거래지역 및 수거품목
							$sql = " select * from {$g5['member_area_table']} where mb_id = '{$member['mb_id']}' ";

							$member_area = sql_query($sql);
							echo  "<p class='signup_txt_area'>";								
							echo  "내지역 <span class='main_co'>";

							for ($i=0; $row=sql_fetch_array($member_area); $i++)
							{
								
								echo  $row['mb_area1']."&nbsp;";
								if($row['mb_area2']){
									echo $row['mb_area2']."&nbsp;&nbsp;&nbsp;";
								}else{
									echo "전체&nbsp;&nbsp;&nbsp;";
														
							}
							}
							echo  "</span>";
							
							echo "</p>";

														

						//$row['rc_nickname'] = preg_replace('/(?<=.{1})./u', '○', $row['rc_nickname']);
						//		echo "<h4>" . $row['rc_nickname'] . "</h4>";
						
						echo '</div>';
						echo '</div>';
						


						
						


							?>
						</li>
						</ul>
					</div>
				</div>