<?php
function getNews()
{
	return getAssocResult("SELECT * FROM news");
}

function getNewsContent($id)
{
	$id = (int)$id;
	$sql = "SELECT * FROM news WHERE id = {$id}";
	$news = getAssocResult($sql);
	return $news[0];
}
