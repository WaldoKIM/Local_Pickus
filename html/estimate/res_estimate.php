<?php

 header("Content-Type: text/html; charset=utf-8");
 
 require_once('../libs/INIStdPayUtil.php');
 require_once('../libs/HttpClient.php');
 require_once('../libs/sha256.inc.php');
 require_once('../libs/json_lib.php');

 $util = new INIStdPayUtil();

        

        //#######################################

        // 인증결과 파라미터 일괄 수신, 인증이 성공일 경우만
        //#######################################
 
        if (strcmp("0000", $_REQUEST["resultCode"]) == 0) {            
        
            echo "####인증성공 승인데이터 만들기####"."<br/>";
            //echo print_r($_POST);   //인증 데이터 확인