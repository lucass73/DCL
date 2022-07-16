<?php
  require_once('../../lib/print_list.php');
?>
<?php
  require_once('../../view/top.php');
?>
    <div id="board_area">

    <?php
          /* 검색 변수 */
        $catagory = $_GET['catgo'];
        $search_con = $_GET['search'];
      ?>

     <h3>도면 검색</h3>
     <h3><?php echo $catagory; ?>에서 '<?php echo $search_con; ?>'검색결과</h3>
     <table class="list-table">
            <thead>
                <tr>
                    <th width="150">도면번호</th>
                      <th width="200">도면이름</th>
                      <th width="70">IFA(Plan)</th>
                      <th width="70">IFA(Actual)</th>
                      <th width="70">IFA(rev)</th>
                      <th width="70">AFC(Plan)</th>
                      <th width="70">AFC(Actual)</th>
                      <th width="70">AFC(rev)</th>
                      <th width="120">TR No.</th>
                      <th width="70">송부일자</th>
                      <th width="70">도면 Rev.</th>
                      <th width="100">협력업체명</th>
                      <th width="100">접수회신</th>
                      <th width="150">비고</th>
                  </tr>
              </thead>
              <?php
                        $sql2 = mq("SELECT id, title, IFA_P, IFA_A, IFA_R, AFC_P, AFC_A, AFC_R, TR_No, TR_Date, Dwg_R, Subcon, Re_Date, Remark FROM cv where $catagory like '%$search_con%' ORDER BY time");  
                        while($board = $sql2->fetch_array()){
                          $title = $board['title']; 
//                          if(strlen($pj)>30)
//                         { 
//                            $pj=str_replace($board['pj'],mb_substr($board['pj'],0,30,"utf-8")."...",$board['pj']);
//                          }
                          /* $sql3 = mq("select * from reply where con_num='".$board['idx']."'");
                          $rep_count = mysqli_num_rows($sql3);*/
                        ?>
            <tbody>
              <tr>
                <td><?php echo $board['id']; ?></td>
                <td><?php echo $board['title']; ?></td>
                <td><?php echo $board['IFA_P']?></td>
                <td><?php echo $board['IFA_A']?></td>
                <td><?php echo $board['IFA_R']?></td>
                <td><?php echo $board['AFC_P']?></td>
                <td><?php echo $board['AFC_A']?></td>
                <td><?php echo $board['AFC_R']?></td>
                <td><?php echo $board['TR_No']; ?></td>
                <td><?php echo $board['TR_Date']; ?></td>
                <td><?php echo $board['Dwg_R']; ?></td>
                <td><?php echo $board['Subcon']; ?></td>
                <td><?php echo $board['Re_Date']; ?></td>
                <td><?php echo $board['Remark']; ?></td>
                
                <!--<td><a href="/page/board/modify_project.php?id=<?=$board['ID']?>">수정</a>
                <a href="/page/board/delete_project_ok.php?id=<?=$board['ID']?>">삭제</a></td> -->
              </tr>
            </tbody>
            <?php } ?>
          </table>
 
  <div id="search_box">
    <form action="/page/board/search_result_cv.php" method="get">
      <select name="catgo">
        <option value="title">도면이름</option>
        <option value="id">도면번호</option>
        <option value="TR_No">TR No.</option>
        <option value="Subcon">업체명</option>
      </select>
      <input type="text" name="search" size="40" required="required" /> <button>검색</button>
    </form>
    </div>
<!-- </div>  -->
<?php
 require_once('../../view/bottom.php');
?>
<br>
<br>