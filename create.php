<?php
  require_once('lib/print_list.php');
?>
<?php
  require_once('view/top.php');
?>
    <div id="content">
        <h2>견적업무 DB</h2>
        <p>
          한화건설/플랜트사업본부/플랜트지원팀 견적파트 Database 활용 웹사이트!!
        </p>
        <br><br>
        <form action="/make_create.php" method="POST">
          <p><input type="text" name="title" placeholder="추가항목 이름"></p>
          <p><input type="text" name="hostaddress" placeholder="PHP 파일명"></p>
          <p><input type="submit"></p>
        </form>
    </div>

  </body>
</html>