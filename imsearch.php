<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru" dir="ltr">
<head>
	<title>Поиск</title>

	<!-- Contents -->
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<meta http-equiv="Content-Language" content="ru" />
	<meta http-equiv="last-modified" content="23.03.2021 13:07:09" />
	<meta http-equiv="Content-Type-Script" content="text/javascript" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<!-- imCustomHead -->
	<meta http-equiv="Expires" content="0" />
	<meta name="Resource-Type" content="document" />
	<meta name="Distribution" content="global" />
	<meta name="Robots" content="index, follow" />
	<meta name="Revisit-After" content="21 days" />
	<meta name="Rating" content="general" />
	<!-- Others -->
	<meta name="Generator" content="Incomedia WebSite X5 Evolution 8.0.11 - www.websitex5.com" />
	<meta http-equiv="ImageToolbar" content="False" />
	<meta name="MSSmartTagsPreventParsing" content="True" />
	
	<!-- Parent -->
	<link rel="sitemap" href="imsitemap.html" title="Общая карта сайта" />
	<!-- Res -->
	<script type="text/javascript" src="res/x5engine.js"></script>
	<link rel="stylesheet" type="text/css" href="res/styles.css" media="screen, print" />
	<link rel="stylesheet" type="text/css" href="res/template.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="res/print.css" media="print" />
	<!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="res/iebehavior.css" media="screen" /><![endif]-->
	
	<link rel="stylesheet" type="text/css" href="res/handheld.css" media="handheld" />
	<link rel="alternate stylesheet" title="Высокий контраст - Доступность" type="text/css" href="res/accessibility.css" media="screen" />

</head>
<body>
<div id="imSite">
<div id="imHeader">
	<h1>Обладнення для компютерних мереж</h1>
</div>
<div class="imInvisible">
<hr />
<a href="#imGoToCont" title="Пропустить главное меню">Перейти к содержанию</a>
</div>
<div id="imBody">
	<div id="imMenuMain">

<!-- Menu START -->
<a name="imGoToMenu"></a><p class="imInvisible">Главное меню:</p>
<div id="imMnMn">
<ul>
	<li><a href="index.html" title="">Oбладнення для компютерних мереж</a></li>
	<li><a href="компютерні_мережі.html" title="">Компютерні мережі</a></li>
	<li><a href="види_компютерних_мереж.html" title="">Види компютерних мереж</a></li>
	<li><a href="мережеве_обладнення.html" title="">Мережеве обладнення</a></li>
</ul>
</div>
<!-- Menu END -->

	</div>
<hr class="imInvisible" />
<a name="imGoToCont"></a>
	<div id="imContent">
<?php 
$files = array("index.html","компютерні_мережі.html","види_компютерних_мереж.html","мережеве_обладнення.html");
?>
<div id="imSText">
<?php
	$domain = "";
	$search = trim($_GET['search']);
	$page = $_GET['page'];
	if($page == "")
		$page = 0;
	else
		$page--;
	if($search != "") {
		$queries = explode(" ",$search);
		foreach($files as $filename) {
			$count = 0;
			$weight = 0;
			$file_content = implode("\n",file($filename));
			$starttitle = strpos($file_content,"<title>") + 7;
			$endtitle = strpos($file_content,"</title>");
			if(($starttitle != false) && ($endtitle != false)) {
				foreach($queries as $query) {
					$title = substr($file_content,$starttitle,$endtitle-$starttitle);
					while (($title = stristr($title, $query)) !== false) {
						$weight += 4;
						$title = substr($title,strlen($query));
					}
				}
			}
			$page_pos = strpos($file_content,"<!-- Page START -->")+19;
			$page_end = strpos($file_content,"<!-- Page END -->");
			if($page_pos != false && $page_end != false)
				$file_content = substr($file_content,$page_pos, $page_end-$page_pos);
			$file_content = strip_tags($file_content);
			foreach($queries as $query) {
				$file = $file_content;
				while (($file = stristr($file, $query)) !== false) {
					$count++;
					$weight++;
					$file = substr($file,strlen($query));
				}
			}
			if($count > 0) {
				$found_count[$filename] = $count;
				$found_weight[$filename] = $weight;
			}
		}
		
		if($found_count != null) {
			arsort($found_weight);
			$i = 0;
			$pagine = ceil(count($found_count)/10);
			if(($page >= $pagine) || ($page < 0))
				$page = 0;
			echo "		<div class=\"imSLabel\"><div id=\"imSPageTitle\"><strong>Результат поиска</strong> for <i>". $search ."</i></div><strong>" . ($page*10+1) . "-" . (count($found_count)<($page+1)*10? count($found_count):($page+1)*10) . "</strong> В результате <strong>"  . count($found_count) . "</strong></div>\n";
			foreach($found_weight as $name => $weight) {
				$count = $found_count[$name];
				$i++;
				if(($i > $page*10) && ($i <= ($page+1)*10)) {
					$file = implode(" ",file($name));
					$starttitle = strpos($file,"<title>") + 7;
					$endtitle = strpos($file,"</title>");
					if(($starttitle != false) && ($endtitle != false))
						$title = substr($file,$starttitle,$endtitle-$starttitle);
					else
						$title = $name;
					$page_pos = strpos($file,"<!-- Page START -->")+19;
					$page_end = strpos($file,"<!-- Page END -->");
					if($page_pos != false && $page_end != false)
						$file = substr($file,$page_pos, $page_end-$page_pos);
					$file = strip_tags($file);
					$ap = 0;
					$filelen = strlen($file);
					$text = "";
					for($j=0;$j<($count > 6 ? 6 : $count);$j++) {
						$minpos = $filelen;
						foreach($queries as $query) {
							if(($pos = strpos(strtoupper($file),strtoupper($query),$ap)) !== false) {
								if($pos < $minpos) {
									$minpos = $pos;
									$word = $query;
								}
							}
						}
						$prev = explode(" ",substr($file,$ap,$minpos-$ap));
						if(count($prev) > ($ap > 0 ? 9 : 8))
							$prev = ($ap > 0 ? implode(" ",array_slice($prev,0,8)) : "") . " ... " . implode(" ",array_slice($prev,-8));
						else
							$prev = implode(" ",$prev);
						$text .= $prev . "<strong>" . substr($file,$minpos,strlen($word)) . "</strong> ";
						$ap = $minpos + strlen($word);
					}
					$next = explode(" ",substr($file,$ap));
					if(count($next) > 9)
						$text .= implode(" ",array_slice($next,0,8)) . "...";
					else
						$text .= implode(" ",$next);
					echo "			<div class=\"imSTitle\"><a href=\"" . $name . "\">" . $title . "</a> <span class=\"imSCount\">(" . $count . " " . ($count > 1 ? "Результаты" : "Результат") . ")</span></div>" . $text . "<div class=\"imSLink\"><a href=\"" . $name . "\">" . $domain . $name . "</a></div>\n";
				}
			}
			echo "  <div class=\"imSLabel\">&nbsp;</div>\n";
			if ($pagine > 1) {
				echo "			Страница ";
				for($i = 1; $i <= $pagine; $i++)
					if($i != $page+1)
						echo "<a href=\"imsearch.php?search=" . $search . "&page=" . $i . "\">" . $i . "</a> ";
					else
						echo "<strong>" . $i . "</strong> ";
				echo "\n";
			}
		}
		else
			echo "  <div style=\"text-align: center; font-weight: bold; \"><strong>Нет результатов</strong></div>\n";
	}
?>
</div>
<div id="imSBox">
<form action="imsearch.php" method="get"><fieldset>
	<input type="text" name="search" value="<?php echo $_GET['search']; ?>"/> <input id="imSButton" type="submit" value="Поиск" />
</fieldset></form>
</div>
<br />

	</div>
	<div id="imFooter">
	</div>
</div>
</div>
<div class="imInvisible">
<hr />
<a href="#imGoToCont" title="Просмотреть страницу еще раз">Назад к содержанию</a> | <a href="#imGoToMenu" title="Просмотреть сайт еще раз">Назад к главному меню</a>
</div>


<div id="imShowBoxBG" style="display: none;" onclick="imShowBoxHide()"></div>
<div id="imShowBoxContainer" style="display: none;" onclick="imShowBoxHide()"><div id="imShowBox" style="height: 200px; width: 200px;"></div></div>
<div id="imBGSound"></div>
<div id="imToolTip"><script type="text/javascript">var imt = new IMTip;</script></div>
</body>
</html>
