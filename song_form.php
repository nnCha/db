﻿<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "등록";
$action = "song_insert.php";

if (array_key_exists("song_id", $_GET)) {
    $song_id = $_GET["song_id"];
    $query =  "select * from song natural join artist natural join album where song_id = $song_id";
    $res = mysql_query($query, $conn);
    $song = mysql_fetch_array($res);
    if(!$song) {
        msg("노래가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "song_modify.php";
}

$type =array("DANCE", "POP", "HIPHOP","JAZZ", "CLASSIC", "ROCK", "R&B");
$country = array("KOREA", "JAPAN", "CHINA", "USA", "UK");

$query = "select * from manufacturer";
$res = mysql_query($query, $conn);


?>
    <div class="container">
        <form name="song_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="song_id" value="<?=$song['song_id']?>"/>
            <h3>노래 정보 <?=$mode?></h3>
            <p>
                <label for="type">장르</label>
                <select name="type" id="type">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($type as $value) {
                            if($value == $song['type']){
                                echo "<option value='{$value}' selected>{$value}</option>";
                            } else {
                                echo "<option value='{$value}'>{$value}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            <p>
                <label for="country">국가</label>
                <select name="country" id="country">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($country as $value) {
                            if($value == $song['country']){
                                echo "<option value='{$value}' selected>{$value}</option>";
                            } else {
                                echo "<option value='{$value}'>{$value}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            <p>
                <label for="song_name">노래명</label>
                <input type="text" placeholder="제목" id="song_name" name="song_name" value="<?=$song['song_name']?>"/>
            </p>
            <p>
                <label for="lyrics">가사</label>
                <textarea placeholder="가사 입력" id="lyrics" name="lyrics" rows="10"><?=$song['lyrics']?></textarea>
            </p>
            <p>
                <label for="alubm">앨범</label>
                <input type="text" placeholder="앨범명" id="album_name" name="album_name" value="<?=$song['album_name']?>" />
            </p>
            
            <p>
                <label for="featuring">Featuring</label>
                <input type="text" placeholder="피쳐링" id="feat_name" name="feat_name" value="<?=$song['feat_name']?>" />
            </p>
            <p>
                <label for="artist">아티스트</label>
                <input type="text" placeholder="아티스트명" id="artist_name" name="artist_name" value="<?=$song['artist_name']?>" />
            </p>


            <p align="center">
                <button class="button primary large" onclick="javascript:return validate();"><?=$mode?>
                </button>
            </p>
            <script>
                function validate() {
                    if(document.getElementById("type").value == "-1") {
                        alert ("장르를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("country").value == "-1") {
                        alert ("국가를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("song_name").value == "") {
                        alert ("노래명 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("artist_name").value == "") {
                        alert ("아티스트명 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("album_name").value == "") {
                        alert ("앨범명 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>