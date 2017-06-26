<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("album_id", $_GET)) {
    $album_id = $_GET["album_id"];
    $query = "select * from album where album_id = $album_id";
    $res = mysql_query($query, $conn);
    $album = mysql_fetch_assoc($res);
    if (!$album) {
        msg("앨범이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>상품 정보 상세 보기</h3>

        <p>
            <label for="album_id">앨범 코드</label>
            <input readonly type="text" id="album_id" name="album_id" value="<?= $album['album_id'] ?>"/>
        </p>

        <p>
            <label for="album_name">앨범명</label>
            <input readonly type="text" id="album_name" name="album_name" value="<?= $album['album_name'] ?>"/>
        </p>

        <p>
            <label for="date">발매일자</label>
            <input readonly type="text" id="date" name="date" value="<?= $album['date'] ?>"/>
        </p>

        <p>
            <label for="song_numb">수록곡</label>
            <input readonly type="text" id="song_numb" name="song_numb" value="<?= $album['song_numb'] ?>"/>
        </p>

    </div>
<? include("footer.php") ?>