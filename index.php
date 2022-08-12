<?php
$token = file_get_contents('token.txt'); //токен личный 100 попыток
$url = urlCreator();
if(!empty($_GET))
{
	if($_COOKIE['url'] != $url || !file_exists("movie.json"))
	{
		setcookie("url", $url, time()+3600*24);
		$getJSON = file_get_contents($url);
		file_put_contents("movie.json", $getJSON,LOCK_EX);
	}
	$json = file_get_contents("movie.json");
	if(!empty($json))
	{
		$str = json_decode($json);
		$count = count($str->{'docs'});
		$randFilmID = random_int(0, $count);
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap-slider.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1 align="center">Генератор случайных фильмов</h1>

<div class="frm">
	<form method="GET" id="film-form" action="index.php">

    
        <div class="container">
            <div align="center"><input type="submit" class="random-button" id="random-button" value="СГЕНЕРИРОВАТЬ" ></div>

            <div class="film-type" align="center">
                <select name="type">
                    <option value="1" <?php if($_GET['type'] == '1') echo 'selected="selected"';?>>фильм</option>
                    <option value="2" <?php if($_GET['type'] == '2') echo 'selected="selected"';?>>сериал</option>
                    <option value="3" <?php if($_GET['type'] == '3') echo 'selected="selected"';?>>мультфильм</option>
                    <option value="4" <?php if($_GET['type'] == '4') echo 'selected="selected"';?>>аниме</option>
                    <option value="5" <?php if($_GET['type'] == '5') echo 'selected="selected"';?>>аниме сериал</option>
                    <option value="6" <?php if($_GET['type'] == '6') echo 'selected="selected"';?>>тв-шоу</option>
                </select>
            </div>
        </div>		

			<div class="film-genres[]">
				<table width="500" align="center">
				
				<tbody><tr>
					<td align="left"><input class="check" type="checkbox" id="check-boevik" name="genres[]" value="боевик" <?php if(checked('боевик')) echo ' checked';?>> Боевик 
					<td align="left"><input class="check" type="checkbox" id="check-fentezi" name="genres[]" value="фэнтези" <?php if(checked('фэнтези')) echo ' checked';?>> Фэнтези
					<td align="left"><input class="check" type="checkbox" id="check-fantastika" name="genres[]" value="фантастика" <?php if(checked('фантастика')) echo ' checked';?>> Фантастика
				</tr>
				
				<tr> 
					<td align="left"><input class="check" type="checkbox" id="check-triller" name="genres[]" value="триллер" <?php if(checked('триллер')) echo ' checked';?>> Триллер
					<td align="left"><input class="check" type="checkbox" id="check-voennyj" name="genres[]" value="военный" <?php if(checked('военный')) echo ' checked';?>> Военный
					<td align="left"><input class="check" type="checkbox" id="check-detektiv" name="genres[]" value="детектив" <?php if(checked('детектив')) echo ' checked';?>> Детектив
				</tr>

				<tr> 
					<td align="left"><input class="check" type="checkbox" id="check-komediya" name="genres[]" value="комедия" <?php if(checked('комедия')) echo ' checked';?>> Комедия
					<td align="left"><input class="check" type="checkbox" id="check-drama" name="genres[]" value="драма" <?php if(checked('драма')) echo ' checked';?>> Драма
					<td align="left"><input class="check" type="checkbox" id="check-uzhasy" name="genres[]" value="ужасы" <?php if(checked('ужасы')) echo ' checked';?>> Ужасы
				</tr>

				<tr> 
					<td align="left"><input class="check" type="checkbox" id="check-kriminal" name="genres[]" value="криминал" <?php if(checked('криминал')) echo ' checked';?>> Криминал
					<td align="left"><input class="check" type="checkbox" id="check-melodrama" name="genres[]" value="мелодрама" <?php if(checked('мелодрама')) echo ' checked';?>> Мелодрама
					<td align="left"><input class="check" type="checkbox" id="check-vestern" name="genres[]" value="вестерн" <?php if(checked('вестерн')) echo ' checked';?>> Вестерн
				</tr>

				<tr> 
					<td align="left"><input class="check" type="checkbox" id="check-biografiya" name="genres[]" value="биография" <?php if(checked('биография')) echo ' checked';?>> Биография
					<td align="left"><input class="check" type="checkbox" id="check-anime" name="genres[]" value="аниме" <?php if(checked('аниме')) echo ' checked';?>> Аниме
					<td align="left"><input class="check" type="checkbox" id="check-detskij" name="genres[]" value="детский" <?php if(checked('детский')) echo ' checked';?>> Детский
				</tr>

				<tr> 
					<td align="left"><input class="check" type="checkbox" id="check-multfilm" name="genres[]" value="мультфильм" <?php if(checked('мультфильм')) echo ' checked';?>> Мультфильм
					<td align="left"><input class="check" type="checkbox" id="check-film-nuar" name="genres[]" value="фильм-нуар" <?php if(checked('фильм-нуар')) echo ' checked';?>> Фильм-нуар
					<td align="left"><input class="check" type="checkbox" id="check-dlya-vzroslyh" name="genres[]" value="для взрослых" <?php if(checked('для взрослых')) echo ' checked';?>> Для взрослых
				</tr>

				<tr> 
					<td align="left"><input class="check" type="checkbox" id="dokumentalnyj" name="genres[]" value="документальный" <?php if(checked('документальный')) echo ' checked';?>> Документальный
					<td align="left"><input class="check" type="checkbox" id="check-igra" name="genres[]" value="игра" <?php if(checked('игра')) echo ' checked';?>> Игра
					<td align="left"><input class="check" type="checkbox" id="check-istoriya" name="genres[]" value="история" <?php if(checked('история')) echo ' checked';?>> История
				</tr>

				<tr> 
					<td align="left"><input class="check" type="checkbox" id="check-koncert" name="genres[]" value="концерт" <?php if(checked('концерт')) echo ' checked';?>> Концерт
					<td align="left"><input class="check" type="checkbox" id="check-korotkometrazhka" name="genres[]" value="короткометражка" <?php if(checked('короткометражка')) echo ' checked';?>> Короткометражка
					<td align="left"><input class="check" type="checkbox" id="check-muzyka" name="genres[]" value="музыка" <?php if(checked('музыка')) echo ' checked';?>> Музыка
				</tr>

                <tr> 
					<td align="left"><input class="check" type="checkbox" id="check-myuzikl" name="genres[]" value="мюзикл" <?php if(checked('мюзикл')) echo ' checked';?>> Мюзикл
					<td align="left"><input class="check" type="checkbox" id="check-novosti" name="genres[]" value="новости" <?php if(checked('новости')) echo ' checked';?>> Новости
					<td align="left"><input class="check" type="checkbox" id="check-priklyucheniya" name="genres[]" value="приключения" <?php if(checked('приключения')) echo ' checked';?>> Приключения
				</tr>

                <tr> 
					<td align="left"><input class="check" type="checkbox" id="check-realnoe-tv" name="genres[]" value="реальное ТВ" <?php if(checked('реальное ТВ')) echo ' checked';?>> Реальное ТВ
					<td align="left"><input class="check" type="checkbox" id="check-semejnyj" name="genres[]" value="семейный" <?php if(checked('семейный')) echo ' checked';?>> Семейный
					<td align="left"><input class="check" type="checkbox" id="check-sport" name="genres[]" value="спорт" <?php if(checked('спорт')) echo ' checked';?>> Спорт
				</tr>

                <tr> 
					<td align="left"><input class="check" type="checkbox" id="check-tok-shou" name="genres[]" value="ток-шоу" <?php if(checked('ток-шоу')) echo ' checked';?>> Ток-шоу
					<td align="left"><input class="check" type="checkbox" id="check-ceremoniya" name="genres[]" value="церемония" <?php if(checked('церемония')) echo ' checked';?>> Церемония
				</tr>

				</tbody></table>
			</div>

            <div class="slidecontainer">
                Интервал:  
                <b class="slide-start-years">1950</b> 
                <input id="slide-years" type="text" name="years" class="span2" value="" data-slider-min="1950" data-slider-max="2022" data-slider-step="1" data-slider-value="[<?=!empty($_GET['years'])? $_GET['years'] : '1950,2022';?>]"/> 
                <b class="slide-end-years">2022</b>
            </div>

            <div class="slidecontainer">
                Рейтинг:  
                <b class="slide-start-rating">0</b> 
                <input id="slide-rating" type="text" name="rating" class="span2" value="2" data-slider-min="0" data-slider-max="10" data-slider-step="0.5" data-slider-value="[<?=!empty($_GET['rating'])? $_GET['rating'] : '0,10';?>]"/> 
                <b class="slide-end-rating">10</b>
            </div>

			<?php if(!empty($json)): ?>
				<div class="poster">
					<img alt="Постер" src="<?=$str->{'docs'}[$randFilmID]->{'poster'}->{'previewUrl'};?>">
				</div>
				<div class="film">
					<h1>
						<?=$str->{'docs'}[$randFilmID]->{'name'};?> (
						<?=$str->{'docs'}[$randFilmID]->{'year'};?>)
					</h1>
				</div>
				<div class="rating">
					<span>Рейтинг Кинопоиск:
						<?=$str->{'docs'}[$randFilmID]->{'rating'}->{'kp'};?>
					</span><br>
					<span>Рейтинг IMDb:
						<?=$str->{'docs'}[$randFilmID]->{'rating'}->{'imdb'};?>
					</span>
				</div>
				<div class="description">
					<p><b>Описание:</b>
						<?=$str->{'docs'}[$randFilmID]->{'description'};?>
					</p>
				</div>
				<div class="player">
					<!-- Можно искать онлайн фильмы по ID КиноПоиск -->
					<div id="yohoho" data-kinopoisk="<?=$str->{'docs'}[$randFilmID]->{'id'};?>"></div>
					<script src="//yohoho.cc/yo.js"></script>
				</div>
			<?endif;?>

	</form>
</div>	
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="bootstrap-slider.min.js"></script>
    <script src="script.js"></script>
</body>
</html>


<?php

/* $token = 'FNMNH1E-KGJMXVF-Q8S5M7K-E683QC0'; //токен личный 100 попыток
$urlStart = 'https://api.kinopoisk.dev/movie'; */

/* 
Представим что нам нужно найти сериалы typeNumber - 2 с рейтингом kp от 7 до 10 которые были выпущены с 2017 по 2020 год.
При этом мы ходим чтобы они были осортированы по году в порядке возрастания, но при этом были отсортированы по голосам на imdb в порядке убывания.
Для этого нам придется подготовить параметры

/movie
?field=rating.kp    //поиск по рейтингу КП
&search=7-10

&field=year     //поиск по годам
&search=2017-2020

&field=typeNumber   // typeNumber: 1 (movie) | 2 (tv-series) | 3 (cartoon) | 4 (anime) | 5 (animated-series) | 6 (tv-show)
&search=2

&sortField=year
&sortType=1

&sortField=votes.imdb
&sortType=-1

&token=ZQQ8GMN-TN54SGK-NB3MKEC-ZKB8V06 

https://api.kinopoisk.dev/movie?field=typeNumber&search=2&token=FNMNH1E-KGJMXVF-Q8S5M7K-E683QC0

***
&limit=20
***
ЖАНРЫ: 
Пример: genres.name=Драма

export const getAllGenres = {
  boevik: "боевик",
  fentezi: "фэнтези",
  fantastika: "фантастика",
  triller: "триллер",
  voennyj: "военный",
  detektiv: "детектив",
  komediya: "комедия",
  drama: "драма",
  uzhasy: "ужасы",
  kriminal: "криминал",
  melodrama: "мелодрама",
  vestern: "вестерн",
  biografiya: "биография",
  anime: "аниме",
  detskij: "детский",
  multfilm: "мультфильм",
  "film-nuar": "фильм-нуар",
  "dlya-vzroslyh": "для взрослых",
  dokumentalnyj: "документальный",
  igra: "игра",
  istoriya: "история",
  koncert: "концерт",
  korotkometrazhka: "короткометражка",
  muzyka: "музыка",
  myuzikl: "мюзикл",
  novosti: "новости",
  priklyucheniya: "приключения",
  "realnoe-tv": "реальное ТВ",
  semejnyj: "семейный",
  sport: "спорт",
  "tok-shou": "ток-шоу",
  ceremoniya: "церемония",
};

https://api.kinopoisk.dev/movie
?search[]=movie
&search[]=%D0%BF%D1%80%D0%B8%D0%BA%D0%BB%D1%8E%D1%87%D0%B5%D0%BD%D0%B8%D1%8F
&search[]=1990-2021&search[]=2-10
&search[]=!null
&search[]=!null
&field[]=type
&field[]=genres.name
&field[]=year
&field[]=rating.kp
&field[]=name
&field[]=votes.kp
&limit=20
&sortField[]=premiere.world
&sortField[]=votes.kp
&sortType[]=-1
&sortType[]=-1


*/

function urlCreator()
{
	$token = 'FNMNH1E-KGJMXVF-Q8S5M7K-E683QC0'; 
	$urlStart = 'https://api.kinopoisk.dev/movie';
	$years = str_replace(",", "-", $_GET['years']);
	$rating = str_replace(",", "-", $_GET['rating']);
	$limit = '1000';
	$url = $urlStart . '?token=' . $token . '&field=typeNumber&search=' . $_GET['type'] . '&field=year&search=' . $years . '&field=rating.kp&search=' . $rating . '&limit=' . $limit . '&sortField=votes.imdb&sortType=-1';
	if(!empty($_GET['genres']))
	{
		foreach ($_GET['genres'] as $value)
		{
			$url .= '&field=genres.name&search=' . urlencode($value);
		}
	}
	return $url; 
}

function checked($str, $key = 'genres')
{
	if(isset($_GET[$key])) 
	{
		if(in_array($str, $_GET[$key]))
		{
			return TRUE;
		}
	}
	return FALSE;
}
?>