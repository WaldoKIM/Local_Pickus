<?php
if (!defined('_GNUBOARD_')) exit;

include_once(G5_PHPMAILER_PATH.'/PHPMailerAutoload.php');

// 메일 보내기 (파일 여러개 첨부 가능)
// type : text=0, html=1, text+html=2
function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $cc="", $bcc="")
{
    global $config;
    global $g5;

    // 메일발송 사용을 하지 않는다면
    if (!$config['cf_email_use']) return;

    if ($type != 1)
        $content = nl2br($content);

       $mail->Encoding = 'base64'; // 기본값이 8bit 이므로, base64로 변경함.

    $mail->SMTPDebug = (@constant('G5_SMTP_DEBUG') ? G5_SMTP_DEBUG : 1);

    $mail->Debugoutput = 'html';

    $mail->Timeout = 3; // 타임아웃 3초로 변경(기본값 10초)


    if (defined('G5_SMTP') && G5_SMTP) {
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->Host = G5_SMTP; // SMTP server
        if(defined('G5_SMTP_PORT') && G5_SMTP_PORT)
            $mail->Port = G5_SMTP_PORT;
        if(@constant('G5_SMTP_SECURE')) $mail->SMTPSecure = G5_SMTP_SECURE;

        if(@constant('G5_SMTP_ID') && @constant('G5_SMTP_PW')) {

            $mail->SMTPAuth = true; // enable SMTP authentication

            $mail->Username = G5_SMTP_ID;

            $mail->Password = G5_SMTP_PW; // 비번은 가급적 암/복호화 모듈을 이용해서 암호화 해줄것


            // 웍스의 경우 발송메일주소가 로그인아이디와 같아야 함

            //$mail->SetFrom(G5_SMTP_ID, $fname);

            //$mail->AddReplyTo(G5_SMTP_ID, $fname);

            $fmail = G5_SMTP_ID;

        }

    }
    $mail->CharSet = 'UTF-8';
    $mail->From = $fmail;
    $mail->FromName = $fname;
    $mail->Subject = $subject;
    $mail->AltBody = ""; // optional, comment out and test
    $mail->msgHTML($content);
    $mail->addAddress($to);
    if ($cc)
        $mail->addCC($cc);
    if ($bcc)
        $mail->addBCC($bcc);
    //print_r2($file); exit;
    if ($file != "") {
        foreach ($file as $f) {
            $mail->addAttachment($f['path'], $f['name']);
        }
    }
    return $mail->send();
}

// 파일을 첨부함
function attach_file($filename, $tmp_name)
{
    // 서버에 업로드 되는 파일은 확장자를 주지 않는다. (보안 취약점)
    $dest_file = G5_DATA_PATH.'/tmp/'.str_replace('/', '_', $tmp_name);
    move_uploaded_file($tmp_name, $dest_file);
    $tmpfile = array("name" => $filename, "path" => $dest_file);
    return $tmpfile;
}
?>