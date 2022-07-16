<?php
  require_once('lib/print_list.php');
?>
<?php
  require_once('view/top.php');
?>
    <div id="board_area">
     <h3>토목도면 리스트</h3>
       
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
                      <th width="150">비 고</th>
                  </tr>
              </thead>
              <?php
              
                  if(isset($_GET['page'])){
                    $page = $_GET['page'];
                      }else{
                        $page = 1;
                      }
                        $sql = mq("SELECT id, title, IFA_P, IFA_A, IFA_R, AFC_P, AFC_A, AFC_R, TR_No, TR_Date, Dwg_R, Subcon, Re_Date, Remark FROM cv ORDER BY time");
                        $row_num = mysqli_num_rows($sql); //게시판 총 레코드 수
                        $list = 10; //한 페이지에 보여줄 개수
                        $block_ct = 10; //블록당 보여줄 페이지 개수

                        $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
                        $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
                        $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

                        $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
                        if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
                        $total_block = ceil($total_page/$block_ct); //블럭 총 개수
                        $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

                        $sql2 = mq("SELECT id, title, IFA_P, IFA_A, IFA_R, AFC_P, AFC_A, AFC_R, TR_No, TR_Date, Dwg_R, Subcon, Re_Date, Remark FROM cv ORDER BY time LIMIT $start_num, $list");  
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
    <div id="page_num">
        <?php
          if($page <= 1)
          { //만약 page가 1보다 크거나 같다면
            echo "<span class='fo_re'>처음</span>"; //처음이라는 글자에 빨간색 표시 
          }else{
            echo "<a href='?page=1'>처음</a>"; //알니라면 처음글자에 1번페이지로 갈 수있게 링크
          }
          if($page <= 1)
          { //만약 page가 1보다 크거나 같다면 빈값
            
          }else{
          $pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
            echo "<a href='?page=$pre'>이전</a>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
          }
          for($i=$block_start; $i<=$block_end; $i++){ 
            //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
            if($page == $i){ //만약 page가 $i와 같다면 
              echo "<span class='fo_re'>[$i]</span>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
            }else{
              echo "<a href='?page=$i'>[$i]</a>"; //아니라면 $i
            }
          }
          if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
          }else{
            $next = $page + 1; //next변수에 page + 1을 해준다.
            echo "<a href='?page=$next'>다음</a>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
          }
          if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
            echo "<span class='fo_re'>마지막</span>"; //마지막 글자에 긁은 빨간색을 적용한다.
          }else{
            echo "<a href='?page=$total_page'>마지막</a>"; //아니라면 마지막글자에 total_page를 링크한다.
          }
        ?>
      
  </div>
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
 require_once('view/bottom.php');
?>