

						<div>
						<p style="text-align: center; margin-bottom: 5px;" class="reviewtb">
						내 고객 후기
						</p>
						</div>


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


						echo '<div id="board">';
						echo '<div class="photo_list">';
						echo '<table id="reviewList">';
						if($review_cnt > 0){
							for ($i=0; $row=sql_fetch_array($result); $i++){
								$img_path = estimate_img($row['estimate_idx']);
								$score = $row['score'];
								echo "<tr>";
								echo "<td>";
								echo "<a href='#.'>";
								echo "<div class='title'>";
								echo "<p class='type'>".get_etype($row['e_type'])."</p>";
								echo "<p class='date'>".$row['updatetime']."</p>";
								echo "</div>";
								echo "<div class='con_wrap'>";
								echo "<div class='img'>".estimate_img_thumbnail($img_path, 70, 70)."</div>";
								echo "<div class='con'>";
								echo "<h5 class='main_co'>".$row['title']."</h5>";
								echo "<span class='name'>".$row['nickname']."</span>&nbsp;&nbsp;";
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
								echo "</span>";
								echo "<div class='subject2' href='javascript:'>".$row['review']."</div>";
								echo "</div>";
								echo "</div>";
								echo "</a>";
								echo "</td>";
								echo "</tr>";
							}
						}else{
							echo "<tr><td colspan='2' class='no_data'><div><i class='xi-error-o'></i>이용후기가 없습니다.</div></td></tr>";
						}
						echo '</table>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
					
					?>
					
				
