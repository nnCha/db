<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$song_name = $_POST['song_name'];
$album_name = $_POST['album_name'];
$artist_name = $_POST['artist_name'];
$lyrics = $_POST['lyrics'];
$country = $_POST['country'];
$type = $_POST['type'];
$feat_name =$_POST['feat_name'];

$artist_id;
$album_id;

$ret_1 = mysql_query("select * from artist where artist_name ='$artist_name'", $conn);
$artist_1 = mysql_fetch_array($ret_1);
    if(!$artist_1) {
        mysql_query("insert into artist (artist_name) values ('$artist_name')",$conn);
        global $artist_id;
        $artist_id =mysql_insert_id();
    }
    else{
        global $artist_id;
        $artist_id =$artist_1['artist_id'];
    }

$ret_2 = mysql_query("select * from album where album_name ='$album_name'", $conn);
$album_1 = mysql_fetch_array($ret_2);
    if(!$album_1) {
        mysql_query("insert into album (album_name) values ('$album_name')",$conn);
        global $album_id;
        $album_id =mysql_insert_id();
    }
    else{
        global $album_id;
        $album_id =$album_1['album_id'];
    }
    
    
$ret = mysql_query("insert into song (song_name, artist_id, album_id, lyrics, feat_name, type, country)
values('$song_name', $artist_id, $album_id, '$lyrics','$feat_name','$type','$country')", $conn);

if(!$ret)
{
    msg('Query Error : '.mysql_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=music_list.php'>";
}

?>

﻿<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("song_id", $_GET)) {
    $song_id = $_GET["song_id"];
    $query =  "select * from song natural join artist natural join album where song_id = $song_id";
    $res = mysql_query($query, $conn);
    $song = mysql_fetch_array($res);
    if(!$song) {
        msg("해당 곡이 존재하지 않습니다.");
    }
}

?>
    <div class="container fullwidth">

        <h3>노래 정보 상세 보기</h3>

        <p>
            <label for="song_id">노래 코드 번호</label>
            <input readonly type="text" id="song_id" name="song_id" value="<?= $song['song_id'] ?>"/>
        </p>

        <p>
            <label for="artist_name">아티스트명드</label>
            <input readonly type="text" id="artist_name" name="artist_name" value="<?= $song['artist_name'] ?>"/>
        </p>

        <p>
            <label for="album_name">앨범명</label>
            <input readonly type="text" id="album_name" name="album_name" value="<?= $song['album_name'] ?>"/>
        </p>

        <p>
            <label for="date">발매일</label>
            <input readonly type="text" id="date" name="date" value="<?= $song['date'] ?>"/>
        </p>

        <p>
            <label for="feat_name">피쳐링</label>
            <input readonly type="text" id="feat_name" name="feat_name" value="<?= $song['feat_name'] ?>"/>
        </p>

        <p>
            <label for="type">장르</label>
            <input readonly type="text" id="type" name="type" value="<?= $song['type'] ?>"/>
        </p>
        <p>
            <label for="country">국가명</label>
            <input readonly type="text" id="country" name="country" value="<?= $song['country'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>