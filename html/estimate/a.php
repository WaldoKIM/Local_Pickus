<?php
  spl_autoload_register();
  use Bootpay\Rest\BootpayApi;
?>
<html>
  <head>
      <title>PHP 테스트</title>
  </head>
<body>
  <script type="text/javascript">
  </script>

    <form method="post" name="BOOTPAY_TEST" id="BOOTPAY_TEST">
        <?php
          $instance = BootpayApi::setConfig('rest application_id', 'pk');
          $responseConfirm = BootpayApi::confirm([
              'receipt_id' => 'receipt_id'
          ]);

          echo "status: {$responseConfirm->status}, code: {$responseConfirm->code}, message: {$responseConfirm->message}";
        ?>
    </form>
  </body>
</html>