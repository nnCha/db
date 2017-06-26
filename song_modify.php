<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$song_id = $_POST['song_id'];
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


$ret = mysql_query("update song set song_name = '$song_name', 
artist_id = $artist_id, album_id = $album_id, country = '$country', type = '$type',
lyrics = '$lyrics' , feat_name = '$feat_name' where song_id = $song_id", $conn);

if(!$ret)
{
    msg('Query Error : '.mysql_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=music_list.php'>";
}

?>

