<?php
  include $_SERVER['DOCUMENT_ROOT']."/db.php";
  $sql = mq("INSERT INTO topic (title, hostaddress)
              VALUES(
                '{$_POST['title']}',
                '{$_POST['hostaddress']}')
                ");
  if($sql == false){
    echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해 주세요';
  } else {
    echo '성공했습니다. <a href="index.php">돌아가기</a>';
  }
?>