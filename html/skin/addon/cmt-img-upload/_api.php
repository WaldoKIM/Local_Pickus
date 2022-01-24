<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 업로드 가능한 최대 파일크기(MB)
$is_max_upload = 64;

// 비회원 업로드 허용 : 상품댓글은 회원만 이미지 등록가능하도록 자동설정됨
$is_guest_upload = false;

// 이미지파일(JPG/GIF/PNG)만 업로드 허용 : false 설정시 이미지외 파일은 일반첨부로 서버에 등록됨(/data/editor 폴더)
$is_img_upload = true;

// Imgur 업로드 사용 : 미사용시 에디터 이미지와 동일하게 /data/editor 폴더에 직접첨부됨
$is_imgur_upload = false;

// Imgur Client ID 등록
$imgur_client_id = "";

?>