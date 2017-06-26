<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("artist_id", $_GET)) {
    $artist_id = $_GET["artist_id"];
    $query = "select * from artist where artist_id = $artist_id";
    $res = mysql_query($query, $conn);
    $artist = mysql_fetch_assoc($res);
    if (!$artist) {
        msg("아티스트가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>아티스트 정보 상세 보기</h3>

        <p>
            <label for="artist_id">아티스트 코드</label>
            <input readonly type="text" id="artist_id" name="artist_id" value="<?= $artist['artist_id'] ?>"/>
        </p>

        <p>
            <label for="artist_name">아티스트</label>
            <input readonly type="text" id="artist_name" name="artist_name" value="<?= $artist['artist_name'] ?>"/>
        </p>

        <p>
            <label for="sex">성별</label>
            <input readonly type="text" id="sex" name="sex" value="<?= $artist['sex'] ?>"/>
        </p>

        <p>
            <label for="birth_date">생년월일</label>
            <input readonly type="text" id="birth_date" name="birth_date" value="<?= $artist['birth_date'] ?>"/>
        </p>

    </div>
<? include("footer.php") ?>