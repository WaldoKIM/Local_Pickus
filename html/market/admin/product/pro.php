<?
include('../../common.php'); 
$result		= $db->select( "cs_goods", "where 1 order by ranking asc" );
while( $row = mysqli_fetch_object($result)) {
	$query = "";
	if( $row->images1 ) {
		@rename( "../../data/goodsImages/".$row->images1, "../../data/goodsImages/".$row->images1.".jpg" );
		$query .= "images1='".$row->images1.".jpg'";
	}
	if( $row->images2 ) {
		@rename( "../../data/goodsImages/".$row->images2, "../../data/goodsImages/".$row->images2.".jpg" );
		$query .= ",images2='".$row->images2.".jpg'";
	}
	if( $row->add_images1 ) {
		@rename( "../../data/goodsImages/".$row->add_images1, "../../data/goodsImages/".$row->add_images1.".jpg" );
		$query .= ",add_images1='".$row->add_images1.".jpg'";
	}
	if( $row->add_images2 ) {
		@rename( "../../data/goodsImages/".$row->add_images2, "../../data/goodsImages/".$row->add_images2.".jpg" );
		$query .= ",add_images2='".$row->add_images2.".jpg'";
	}
	if( $row->add_images3 ) {
		@rename( "../../data/goodsImages/".$row->add_images3, "../../data/goodsImages/".$row->add_images3.".jpg" );
		$query .= ",add_images3='".$row->add_images3.".jpg'";
	}
	if( $row->add_images4 ) {
		@rename( "../../data/goodsImages/".$row->add_images4, "../../data/goodsImages/".$row->add_images4.".jpg" );
		$query .= ",add_images4='".$row->add_images4.".jpg'";
	}
	if( $row->add_images5 ) {
		@rename( "../../data/goodsImages/".$row->add_images5, "../../data/goodsImages/".$row->add_images5.".jpg" );
		$query .= ",add_images5='".$row->add_images5.".jpg'";
	}

	$db->update("cs_goods", "$query where idx='$row->idx'");
}
?>
