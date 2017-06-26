<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from song natural join artist natural join album";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where song_name like '%$search_keyword%' or artist_name like 
        '%$search_keyword%' or album_name like '%$search_keyword%'";
    }
    $res = mysql_query($query, $conn);
    if (!$res) {
        die('Query Error : ' . mysql_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>제목</th>
            <th>가수</th>
            <th>Feat.</th>
            <th>앨범명</th>
            <th>장르</th>
            <th>가사보기</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysql_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['song_name']}</td>";
            echo "<td><a href='artist_view.php?artist_id={$row['artist_id']}'>{$row['artist_name']}</a></td>";
            echo "<td>{$row['feat_name']}</td>";
            echo "<td><a href='album_view.php?artist_id={$row['album_id']}'>{$row['album_name']}</a></td>";
            echo "<td>{$row['type']}</td>";
            echo "<td><a href='javascript:view_lyrics({$row['lyrics']})'>가사보기</a></td>";
            echo "<td width='17%'>
                <a href='product_form.php?product_id={$row['product_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['product_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(product_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "product_delete.php?product_id=" + product_id;
            }else{   //취소
                return;
            }
        }
        
        function view_lyrics(lyrics){
        	if(confirm(lyrics)==true){
        		return;
        	}else{
        		return;
        	}
        }
    </script>
</div>
<? include("footer.php") ?>
