<?
class Page {
	function board( $totalPage, $totalList, $listScale, $pageScale, $startPage, $fistImgName, $prexImgName, $nextImgName, $lastImgName, $search_itmes, $pageName="") {
		if(!$pageName) $pageName = $_SERVER["PHP_SELF"];
		if( $totalList > $listScale ) {
			//첫페이지
			$mv_data=$this->encode("startPage=0");
			echo "<a href='$pageName?board_data=$mv_data&search_items=$search_itmes' title='제일앞으로' class='fa-angle-double-left item_page_number_np'>$fistImgName</a>";
			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage);
				echo "<a href='$pageName?board_data=$mv_data&search_items=$search_itmes' title='이전' class='fa-angle-left item_page_number_np'>$prexImgName</a>";
			}
			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage);
						echo "<a href='$pageName?board_data=$mv_data&search_items=$search_itmes'><span class='item_page_number_off'>$pageNum</span></a>";	
					} else {
						echo "<font class='item_page_number_on'>$pageNum</font>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage);
				echo "<a href='$pageName?board_data=$mv_data&search_items=$search_itmes' title='다음' class='fa-angle-right item_page_number_np'>$nextImgName</a>";
			}
			//마지막페이지
			$last_page = floor($totalList/$listScale);
			if($totalList%$listScale==0) $last_page = (($last_page)*$listScale)-$listScale;
			else $last_page = ($last_page)*$listScale;
			$mv_data=$this->encode("startPage=".$last_page);
			echo "<a href='$pageName?board_data=$mv_data&search_items=$search_itmes' title='제일뒤로' class='fa-angle-double-right item_page_number_np'>$lastImgName</a>";
		}
		if( $totalList <= $listScale) {
			echo "<font class='item_page_number_on'>1</font>";
		}
	}

	function logList( $totalPage, $totalList, $listScale, $pageScale, $startPage, $fistImgName, $prexImgName, $nextImgName, $lastImgName, $date, $year, $mon, $day) {
		if( $totalList > $listScale ) {
			//첫페이지
			$mv_data=$this->encode("startPage=0&listNo=".$listNo."&date=".$date."&year=".$year."&mon=".$mon."&day=".$day);
			echo "<a href='$_SERVER[PHP_SELF]?bbs_data=$mv_data' title='제일앞으로' class='fa-angle-double-left item_page_number_np'>$fistImgName</a>";
			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage."&listNo=".$listNo."&date=".$date."&year=".$year."&mon=".$mon."&day=".$day);
				echo "<a href='$_SERVER[PHP_SELF]?bbs_data=$mv_data' title='이전' class='fa-angle-left item_page_number_np'>$prexImgName</a>";
			}
			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage."&listNo=".$listNo."&date=".$date."&year=".$year."&mon=".$mon."&day=".$day);
						echo "<a href='$_SERVER[PHP_SELF]?bbs_data=$mv_data'><span class='item_page_number_off'>$pageNum</span> </a>";	
					} else {
						echo "<font class='item_page_number_on'>$pageNum</font>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage."&listNo=".$listNo."&date=".$date."&year=".$year."&mon=".$mon."&day=".$day);
				echo "<a href='$_SERVER[PHP_SELF]?bbs_data=$mv_data' title='다음' class='fa-angle-right item_page_number_np'>$nextImgName</a>";
			}
			//마지막페이지
			$last_page = ceil($totalList/$listScale);
			if($totalList%$listScale==0) $last_page = (($last_page)*$listScale)-$listScale;
			else $last_page = ($last_page)*$listScale;
			$mv_data=$this->encode("startPage=".$last_page."&listNo=".$listNo."&date=".$date."&year=".$year."&mon=".$mon."&day=".$day);
			echo "<a href='$_SERVER[PHP_SELF]?bbs_data=$mv_data' title='제일뒤로' class='fa-angle-double-right item_page_number_np'>$lastImgName</a>";
		}
		if( $totalList <= $listScale) {
			echo "<font class='item_page_number_on'>1</font>";
		}
	}

	function poll( $totalPage, $totalList, $listScale, $pageScale, $startPage, $prexImgName, $nextImgName) {
		if( $totalList > $listScale ) {
			//첫페이지
			$mv_data=$this->encode("startPage=0");
			echo "<a href='$_SERVER[PHP_SELF]?poll_data=$mv_data&search_items=$search_itmes' title='제일앞으로' class='fa-angle-double-left item_page_number_np'>$fistImgName</a>";

			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage);
				echo "<a href='$_SERVER[PHP_SELF]?poll_data=$mv_data' title='이전' class='fa-angle-left item_page_number_np'>$prexImgName</a>";
			}
			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage);
						echo "<a href='$_SERVER[PHP_SELF]?poll_data=$mv_data'><span class='item_page_number_off'>$pageNum</span></a>";	
					} else {
						echo "<font class='item_page_number_on'>$pageNum</font>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage);
				echo "<a href='$_SERVER[PHP_SELF]?poll_data=$mv_data' title='다음' class='fa-angle-right  item_page_number_off'>$nextImgName</a>";
			}
			//마지막페이지
			$last_page = floor($totalList/$listScale);
			if($totalList%$listScale==0) $last_page = (($last_page)*$listScale)-$listScale;
			else $last_page = ($last_page)*$listScale;
			$mv_data=$this->encode("startPage=".$last_page);
			echo "<a href='$_SERVER[PHP_SELF]?poll_data=$mv_data' title='제일뒤로' class='fa-angle-double-right  item_page_number_off'>$lastImgName</a>";
		}
		if( $totalList <= $listScale) {
			echo "<font class='item_page_number_on'>1</font>";
		}
	}


	function bbs( $code, $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, $fistImgName, $prexImgName, $nextImgName, $lastImgName, $search_item=0, $search_order="") {
		if( $totalList > $listScale ) {
			//첫페이지
			$mv_data=$this->encode("startPage=0&code=".$code."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&cate=".$cate);
			echo "<a href='$_SERVER[PHP_SELF]?bbs_data=$mv_data&search_items=$search_itmes' title='제일앞으로' class='fa-angle-double-left  item_page_number_off'>$fistImgName</a>";
			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage."&code=".$code."&table=".$table."&search_item=".$search_item."&search_order=".$search_order);
				echo "<a href='$_SERVER[PHP_SELF]?bbs_data=$mv_data' title='이전' class='fa-angle-left  item_page_number_off'>$prexImgName</a>";
			}
			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage."&code=".$code."&table=".$table."&search_item=".$search_item."&search_order=".$search_order);
						echo "<a href='$_SERVER[PHP_SELF]?bbs_data=$mv_data'><span class='item_page_number_off'>$pageNum</span> </a>";
					} else {
						echo "<font class='item_page_number_on'>$pageNum</font>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage."&code=".$code."&table=".$table."&search_item=".$search_item."&search_order=".$search_order);
				echo "<a href='$_SERVER[PHP_SELF]?bbs_data=$mv_data' title='다음' class='fa-angle-right  item_page_number_off'>$nextImgName</a>";
			}
			//마지막페이지
			$last_page = ceil($totalList/$listScale);
			if($totalList%$listScale==0) $last_page = (($last_page)*$listScale)-$listScale;
			else $last_page = ($last_page)*$listScale;
			$mv_data=$this->encode("startPage=".$last_page."&code=".$code."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&cate=".$cate);
			echo "<a href='$_SERVER[PHP_SELF]?bbs_data=$mv_data' title='제일뒤로' class='fa-angle-double-right  item_page_number_off'>$lastImgName</a>";
		}
		if( $totalList <= $listScale) {
			echo "<font class='item_page_number_on'>1</font>";
		}
	}

	function bbsAdmin( $code, $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, $prexImgName, $nextImgName, $search_item=0, $search_order="", $cate) {
		if( $totalList > $listScale ) {
			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage."&code=".$code."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&cate=".$cate);
				echo "<a href='$_SERVER[PHP_SELF]?bbs_data=$mv_data' title='이전' class='fa-angle-left  item_page_number_off'>$prexImgName</a>";
			}
			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage."&code=".$code."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&cate=".$cate);
						echo "<a href='$_SERVER[PHP_SELF]?bbs_data=$mv_data'><span class='item_page_number_off'>$pageNum</span></a>";
					} else {
						echo "<font class='item_page_number_on'>$pageNum</font>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage."&code=".$code."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&cate=".$cate);
				echo "<a href='$_SERVER[PHP_SELF]?bbs_data=$mv_data' title='다음' class='fa-angle-right item_page_number_np'>$nextImgName</a>";
			}
		}
		if( $totalList <= $listScale) {
			echo "<font class='item_page_number_on'>1</font>";
		}
	}

	function goods( $part_idx, $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, $fistImgName, $prexImgName, $nextImgName, $lastImgName, $search_item=0, $search_order, $position="", $pageName="") {
		if(!$pageName) $pageName = $_SERVER[PHP_SELF];
		if( $totalList > $listScale ) {
			//첫페이지
			$mv_data=$this->encode("startPage=0&part_idx=".$part_idx."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&position=".$position);
			echo "<a href='$pageName?goods_data=$mv_data' title='제일앞으로' class='fa-angle-double-left item_page_number_np'>$fistImgName</a>";

			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage."&part_idx=".$part_idx."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&position=".$position);
				echo "<a href='$pageName?goods_data=$mv_data' title='이전' class='fa-angle-left item_page_number_np'>$prexImgName</a>";
			}

			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage."&part_idx=".$part_idx."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&position=".$position);
						echo "<a href='$pageName?goods_data=$mv_data' class='btn-paging'><span class='item_page_number_off'>$pageNum</span></a>";
					} else {
						echo "<font class='item_page_number_on'>$pageNum</font>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage."&part_idx=".$part_idx."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&position=".$position);
				echo "<a href='$pageName?goods_data=$mv_data'  title='다음' class='fa-angle-right item_page_number_np'>$nextImgName</a>";
			}
			//마지막페이지
			$last_page = floor($totalList/$listScale);
			if($totalList%$listScale==0) $last_page = (($last_page)*$listScale)-$listScale;
			else $last_page = ($last_page)*$listScale;
			$mv_data=$this->encode("startPage=".$last_page."&part_idx=".$part_idx."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&position=".$position);
			echo "<a href='$pageName?goods_data=$mv_data' title='제일뒤로' class='fa-angle-double-right item_page_number_np'>$lastImgName</a>";
		}
		if( $totalList <= $listScale) {
			echo "<font class='item_page_number_on'>1</font>";
		}
	}


	function goods2( $part_idx, $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, $prexImgName, $nextImgName, $goods_search_yn,$part_code1,$part_code2,$part_code3,$search_name,$search_code,$search_content,$search_keyword,$search_item ) {

		if( $totalList > $listScale ) {
			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage."&part_idx=".$part_idx."&table=".$table."&goods_search_yn=".$goods_search_yn."&part_code1=".$part_code1."&part_code2=".$part_code2."&part_code3=".$part_code3."&search_code=".$search_code."&search_name=".$search_name."&search_content=".$search_content."&search_keyword=".$search_keyword."&search_item=".$search_item);
				echo "&nbsp;&nbsp;<a href='$_SERVER[PHP_SELF]?goods_data=$mv_data'>$prexImgName</a>&nbsp;&nbsp;";
			}

			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage."&part_idx=".$part_idx."&table=".$table."&goods_search_yn=".$goods_search_yn."&part_code1=".$part_code1."&part_code2=".$part_code2."&part_code3=".$part_code3."&search_code=".$search_code."&search_name=".$search_name."&search_content=".$search_content."&search_keyword=".$search_keyword."&search_item=".$search_item);
						echo "<a href='$_SERVER[PHP_SELF]?goods_data=$mv_data'>[$pageNum]</a>";
					} else {
						echo "<b><font color='#000000'>&nbsp;$pageNum&nbsp;<b></b></font></b>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage."&part_idx=".$part_idx."&table=".$table."&goods_search_yn=".$goods_search_yn."&part_code1=".$part_code1."&part_code2=".$part_code2."&part_code3=".$part_code3."&search_code=".$search_code."&search_name=".$search_name."&search_content=".$search_content."&search_keyword=".$search_keyword."&search_item=".$search_item);
				echo "&nbsp;&nbsp;<a href='$_SERVER[PHP_SELF]?goods_data=$mv_data'>$nextImgName</a>&nbsp;&nbsp;";
			}
		}
		if( $totalList <= $listScale) {
			echo "<b><font color='#000000'>1</font></b>";
		}
	}

	function gongu( $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, $prexImgName, $nextImgName, $search_item=0, $search_order="") {
		if( $totalList > $listScale ) {
			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage."&table=".$table."&search_item=".$search_item."&search_order=".$search_order);
				echo "<a href='$_SERVER[PHP_SELF]?gongu_data=$mv_data'>$prexImgName</a>";
			}

			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage."&table=".$table."&search_item=".$search_item."&search_order=".$search_order);
						echo "<a href='$_SERVER[PHP_SELF]?gongu_data=$mv_data'>[$pageNum]</a>";
					} else {
						echo "<b><font color='#E18B8B'>&nbsp;$pageNum&nbsp;<b></b></font></b>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage."&table=".$table."&search_item=".$search_item."&search_order=".$search_order);
				echo "<a href='$_SERVER[PHP_SELF]?gongu_data=$mv_data'>$nextImgName</a>";
			}
		}
		if( $totalList <= $listScale) {
			echo "<b><font color='#000000'>1</font></b>";
		}
	}

	function member( $totalPage, $totalList, $listScale, $pageScale, $startPage, $prexImgName, $nextImgName, $search_item=0, $search_order="", $order_chk=0, $order_list=0, $search_01=0, $search_02=0, $search_03=0) {
		if( $totalList > $listScale ) {
			//첫페이지
			$mv_data=$this->encode("startPage=0&part_idx=".$part_idx."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&cate=".$cate);
			echo "<a href='$_SERVER[PHP_SELF]?mem_data=$mv_data&search_items=$search_itmes' title='제일앞으로' class='fa-angle-double-left item_page_number_np'>$fistImgName</a>";

			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage."&search_item=".$search_item."&search_order=".$search_order."&order_chk=".$order_chk."&order_list=".$order_list."&search_01=".$search_01."&search_02=".$search_02."&search_03=".$search_03);
				echo "<a href='$_SERVER[PHP_SELF]?mem_data=$mv_data' title='이전' class='fa-angle-left item_page_number_np'>$prexImgName</a>";
			}

			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage."&search_item=".$search_item."&search_order=".$search_order."&order_chk=".$order_chk."&order_list=".$order_list."&search_01=".$search_01."&search_02=".$search_02."&search_03=".$search_03);
						echo "<a href='$_SERVER[PHP_SELF]?mem_data=$mv_data'><span class='item_page_number_off'>$pageNum</span></a>";
					} else {
						echo "<font class='item_page_number_on'>$pageNum</font>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage."&search_item=".$search_item."&search_order=".$search_order."&order_chk=".$order_chk."&order_list=".$order_list."&search_01=".$search_01."&search_02=".$search_02."&search_03=".$search_03);
				echo "<a href='$_SERVER[PHP_SELF]?mem_data=$mv_data' title='다음' class='fa-angle-right item_page_number_np'>$nextImgName</a>";
			}
			//마지막페이지
			$last_page = floor(($totalList-1)/$listScale);
			$last_page = $last_page*$listScale;
			$mv_data=$this->encode("startPage=".$last_page."&code=".$code."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&cate=".$cate);
			echo "<a href='$_SERVER[PHP_SELF]?mem_data=$mv_data' title='제일뒤로' class='fa-angle-double-right item_page_number_np'>$lastImgName</a>";
		}
		if( $totalList <= $listScale) {
			echo "<font class='item_page_number_on'>1</font>";
		}
	}

	function review( $totalPage, $totalList, $listScale, $pageScale, $startPage, $prexImgName, $nextImgName, $search_item=0, $search_order="") {
		if( $totalList > $listScale ) {
			//첫페이지
			$mv_data=$this->encode("startPage=0&part_idx=".$part_idx."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&cate=".$cate);
			echo "<a href='$_SERVER[PHP_SELF]?review_data=$mv_data&search_items=$search_itmes' title='제일앞으로' class='fa-angle-double-left item_page_number_np'>$fistImgName</a>";
			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage."&search_item=".$search_item."&search_order=".$search_order);
				echo "<a href='$_SERVER[PHP_SELF]?review_data=$mv_data' title='이전' class='fa-angle-left item_page_number_np'>$prexImgName</a>";
			}

			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage."&search_item=".$search_item."&search_order=".$search_order);
						echo "<a href='$_SERVER[PHP_SELF]?mem_data=$mv_data'><span class='item_page_number_off'>$pageNum</span></a>";
					} else {
						echo "<font class='item_page_number_on'>$pageNum</font>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage."&search_item=".$search_item."&search_order=".$search_order);
				echo "<a href='$_SERVER[PHP_SELF]?review_data=$mv_data' title='다음' class='fa-angle-right item_page_number_np'>$nextImgName</a>";
			}
			//마지막페이지
			$last_page = floor(($totalList-1)/$listScale);
			$last_page = $last_page*$listScale;
			$mv_data=$this->encode("startPage=".$last_page."&code=".$code."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&cate=".$cate);
			echo "<a href='$_SERVER[PHP_SELF]?review_data=$mv_data' title='제일뒤로' class='fa-angle-double-right item_page_number_np'>$lastImgName</a>";
		}
		if( $totalList <= $listScale) {
			echo "<font class='item_page_number_on'>1</font>";
		}
	}

	function my_point( $totalPage, $totalList, $listScale, $pageScale, $startPage, $fistImgName, $prexImgName, $nextImgName, $lastImgName) {
		if( $totalList > $listScale ) {
			//첫페이지
			$mv_data=$this->encode("startPage=0");
			echo "<a href='$_SERVER[PHP_SELF]?point_data=$mv_data&search_items=$search_itmes' title='제일앞으로' class='fa-angle-double-left item_page_number_np'>$fistImgName</a>";
			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage);
				echo "<a href='$_SERVER[PHP_SELF]?point_data=$mv_data' title='이전' class='fa-angle-left item_page_number_np'>$prexImgName</a>";
			}

			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage);
						echo "<a href='$_SERVER[PHP_SELF]?point_data=$mv_data'><span class='item_page_number_off'>$pageNum</span></a>";
					} else {
						echo "<font class='item_page_number_on'>$pageNum</font>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage);
				echo "<a href='$_SERVER[PHP_SELF]?point_data=$mv_data' title='다음' class='fa-angle-right item_page_number_np'>$nextImgName</a>";
			}
			//마지막페이지
			$last_page = ceil($totalList/$listScale);
			if($totalList%$listScale==0) $last_page = (($last_page)*$listScale)-$listScale;
			else $last_page = ($last_page)*$listScale;
			$mv_data=$this->encode("startPage=".$last_page);
			echo "<a href='$_SERVER[PHP_SELF]?point_data=$mv_data&search_items=$search_itmes'  title='제일뒤로' class='fa-angle-double-right item_page_number_np'>$lastImgName</a>";
		}
		if( $totalList <= $listScale) {
			echo "<font class='item_page_number_on'>1</font>";
		}
	}

	function wallet( $trade_stat, $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, $prexImgName, $nextImgName, $search_item_chk=0, $search_mem_item=0, $search_trade_item=0, $search_order="", $search_day="", $search_day_str="", $search_item_unit="") {
		if( $totalList > $listScale ) {
			//첫페이지
			$mv_data=$this->encode("startPage=0&part_idx=".$part_idx."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&cate=".$cate."&search_item_unit=".$search_item_unit);
			echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data&search_items=$search_itmes' style='padding:0.3em 1em; margin-right:0.2em; background-color:#E9E9E9; border-radius:4px; color:#333; font-size:11pt;' title='제일앞으로' class='fa-angle-double-left'>$fistImgName</a>";
			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage."&trade_stat=".$trade_stat."&table=".$table."&search_item_chk=".$search_item_chk."&search_mem_item=".$search_mem_item."&search_trade_item=".$search_trade_item."&search_order=".$search_order."&search_day=".$search_day."&search_day_str=".$search_day_str."&search_item_unit=".$search_item_unit);
				echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data' onfocus=this.blur() style='padding:0.3em 1em;margin-right:0.2em; background-color:#E9E9E9; border-radius:4px; color:#333; font-size:11pt;' title='이전' class='fa-angle-left'>$prexImgName</a>";
			}

			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage."&trade_stat=".$trade_stat."&table=".$table."&search_item_chk=".$search_item_chk."&search_mem_item=".$search_mem_item."&search_trade_item=".$search_trade_item."&search_order=".$search_order."&search_day=".$search_day."&search_day_str=".$search_day_str."&search_item_unit=".$search_item_unit);
						echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data' onfocus=this.blur() style='padding:0.3em 0.6em; margin-right:0.2em; background-color:#333; border-radius:4px; color:#ffffff; font-size:11pt;'>$pageNum</a>";
					} else {
						echo "<font color='#E18B8B' style='padding:0.3em 0.6em; margin-right:0.2em; background-color:#E86262; border-radius:4px; color:#ffffff; font-weight: bold; font-size:11pt;'>$pageNum</font>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage."&trade_stat=".$trade_stat."&table=".$table."&search_item_chk=".$search_item_chk."&search_mem_item=".$search_mem_item."&search_trade_item=".$search_trade_item."&search_order=".$search_order."&search_day=".$search_day."&search_day_str=".$search_day_str."&search_item_unit=".$search_item_unit);
				echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data' onfocus=this.blur() style='padding:0.3em 1em; margin-right:0.2em; background-color:#E9E9E9; border-radius:4px; color:#333; font-size:11pt;' title='다음' class='fa-angle-right'>$nextImgName</a>";
			}
			//마지막페이지
			$last_page = floor(($totalList-1)/$listScale);
			$last_page = $last_page*$listScale;
			$mv_data=$this->encode("startPage=".$last_page."&code=".$code."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&cate=".$cate."&search_item_unit=".$search_item_unit);
			echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data' style='padding:0.3em 1em;margin-right:0.4em; background-color:#E9E9E9; border-radius:4px; color:#333; font-size:11pt;' title='제일뒤로' class='fa-angle-double-right'>$lastImgName</a>";
		}
		if( $totalList <= $listScale) {
			echo "<font color='#E18B8B' style='padding:0.3em 0.6em; margin-right:0.2em; background-color:#E86262; border-radius:4px; color:#ffffff; font-weight: bold; font-size:11pt;'>1</font>";
		}
	}

	function trade( $trade_stat, $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, $prexImgName, $nextImgName, $search_item_chk=0, $search_mem_item=0, $search_trade_item=0, $search_order="", $search_day="", $search_day_str="") {
		if( $totalList > $listScale ) {
			//첫페이지
			$mv_data=$this->encode("startPage=0&part_idx=".$part_idx."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&cate=".$cate);
			echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data&search_items=$search_itmes' title='제일앞으로' class='fa-angle-double-left item_page_number_np'>$fistImgName</a>";
			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage."&trade_stat=".$trade_stat."&table=".$table."&search_item_chk=".$search_item_chk."&search_mem_item=".$search_mem_item."&search_trade_item=".$search_trade_item."&search_order=".$search_order."&search_day=".$search_day."&search_day_str=".$search_day_str);
				echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data' title='이전' class='fa-angle-left item_page_number_np'>$prexImgName</a>";
			}

			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage."&trade_stat=".$trade_stat."&table=".$table."&search_item_chk=".$search_item_chk."&search_mem_item=".$search_mem_item."&search_trade_item=".$search_trade_item."&search_order=".$search_order."&search_day=".$search_day."&search_day_str=".$search_day_str);
						echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data'><span class='item_page_number_off'>$pageNum</span></a>";
					} else {
						echo "<font class='item_page_number_on'>$pageNum</font>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage."&trade_stat=".$trade_stat."&table=".$table."&search_item_chk=".$search_item_chk."&search_mem_item=".$search_mem_item."&search_trade_item=".$search_trade_item."&search_order=".$search_order."&search_day=".$search_day."&search_day_str=".$search_day_str);
				echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data' title='다음' class='fa-angle-right item_page_number_np'>$nextImgName</a>";
			}
			//마지막페이지
			$last_page = floor(($totalList-1)/$listScale);
			$last_page = $last_page*$listScale;
			$mv_data=$this->encode("startPage=".$last_page."&code=".$code."&table=".$table."&search_item=".$search_item."&search_order=".$search_order."&cate=".$cate);
			echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data' title='제일뒤로' class='fa-angle-double-right item_page_number_np'>$lastImgName</a>";
		}
		if( $totalList <= $listScale) {
			echo "<font class='item_page_number_on'>1</font>";
		}
	}

	function my_trade( $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, $fistImgName, $prexImgName, $nextImgName, $lastImgName) {
		if( $totalList > $listScale ) {
			//첫페이지
			$mv_data=$this->encode("startPage=0&trade_stat=".$trade_stat."&table=".$table);
			echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data' title='제일앞으로' class='fa-angle-double-left item_page_number_np'>$fistImgName</a>";
			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$prePage."&trade_stat=".$trade_stat."&table=".$table);
				echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data' title='이전' class='fa-angle-left item_page_number_np'>$prexImgName</a>";
			}

			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {
					if( $nextPage!= $startPage ) {
						$mv_data=$this->encode("startPage=".$nextPage."&trade_stat=".$trade_stat."&table=".$table);
						echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data'><span class='item_page_number_off'>$pageNum</span></a>";
					} else {
						echo "<font class='item_page_number_on'>$pageNum</font>";
					}
				}
			}
			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				$mv_data=$this->encode("startPage=".$nNextPage."&trade_stat=".$trade_stat."&table=".$table);
				echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data' title='다음' class='fa-angle-right item_page_number_np'>$nextImgName</a>";
			}
			//마지막페이지
			$last_page = ceil($totalList/$listScale);
			if($totalList%$listScale==0) $last_page = (($last_page)*$listScale)-$listScale;
			else $last_page = ($last_page)*$listScale;
			$mv_data=$this->encode("startPage=".$last_page."&trade_stat=".$trade_stat."&table=".$table);
			echo "<a href='$_SERVER[PHP_SELF]?trade_data=$mv_data' title='제일뒤로' class='fa-angle-double-right item_page_number_np'>$lastImgName</a>";
		}
		if( $totalList <= $listScale) {
			echo "<font class='item_page_number_on'>1</font>";
		}
	}
	
	
	
	
	
	
	// base64_encode로 엔코딩
	/*function encode($data) {
		$data = str_replace("&","&_&",$data); //서버의 safe mode 시 링크오류해결
		$data = substr($data,0,strrpos($data,"="))."=".urlencode(str_replace("=","",strrchr($data,"="))); //search_order의 한글값 입력시 오류해결
		return base64_encode($data)."||";
	}*/

	function encode($data) {
		$data = str_replace("&","&_&",$data); //서버의 safe mode 시 링크오류해결
		return base64_encode($data)."||";
	}
		
	// $dateStr	: 날자 datetime 형
	// $day			: 시간
	// $imgStr		: 이미지
	function bbsNewImg( $dateStr, $h, $imgStr ) {
		$h		=	60 * 60 * $h;
		$today		=	time();
		$year		=	substr($dateStr, 0, 4);
		$mon		=	substr($dateStr, 5, 2);
		$day		=	substr($dateStr, 8, 2);
		$hour		=	substr($dateStr, 11, 2);
		$minute	=	substr($dateStr, 14, 2);
		$second	=	substr($dateStr, 17, 2);
		$regiDay	=	mktime($hour, $minute, $second, $mon, $day, $year);
		if($regiDay > ($today - $h)) {
			$img		= $imgStr; 
		} else {
			$img		= ""; 
		}
		return $img;
	}

	// $base		: 기본 숫자
	// $value		: 초과 숫자
	// $imgStr		: 이미지
	function bbsCoolImg( $base, $value, $imgStr ) {
		if( $base < $value) {
			$img		= $imgStr;
		} else {
			$img		= "";
		}
		return $img;
	}

	function newImg( $dateStr, $div=1, $img_num=1 ) {
		$img		= "";
		$div			=	60 * 60 * $div;
		$today		=	time();
		$year		=	substr($dateStr, 0, 4);
		$mon		=	substr($dateStr, 5, 2);
		$day		=	substr($dateStr, 8, 2);
		$hour		=	substr($dateStr, 11, 2);
		$minute	=	substr($dateStr, 14, 2);
		$second	=	substr($dateStr, 17, 2);
		$regiDay	=	mktime($hour, $minute, $second, $mon, $day, $year);

		if($regiDay > ($today - $div)) {
			if( $img_num==1 ){ 
				$img		= "<img src='./images/new1.gif' align='absmiddle' class='hitnew' border='0'>";
			} else if( $img_num==2 ){
				$img		= "<img src='./images/new2.gif' align='absmiddle' class='hitnew' border='0'>";
			} else if( $img_num==3 ){
				$img		= "<img src='./images/new3.gif' align='absmiddle' class='hitnew' border='0'>";
			}
		} else {
			$img		= ""; 
		}
		return $img;
	}
	function hitImg( $base, $value, $img_num=1 ) {
		$img		= "";
		if( $base < $value) {
			if( $img_num==1 ){ 
			$img		= "<img src='./images/hit1.gif' align='absmiddle' class='hitnew' border='0'>";
			} else if( $img_num==2 ){
			$img		= "<img src='./images/hit2.gif' align='absmiddle' class='hitnew' border='0'>";
			} else if( $img_num==3 ){
			$img		= "<img src='./images/hit3.gif' align='absmiddle' class='hitnew' border='0'>";
			}
		} else {
			$img		= "";
		}
		return $img;
	}
}
$page = new Page();
?>
