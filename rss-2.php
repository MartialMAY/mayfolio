<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .items1 {
  display: flex;
  flex-flow: column;
  align-items: flex-start;
  max-width: 850px;
  width: 100%;
  margin: 0 auto;
  padding: 0 15px;
}
.items1 .item1 {
  display: flex;
  text-decoration: none;
  margin-bottom: 40px;
}
.items1 .item1 .image1 {
  border-radius: 15px;
 width: 60px;
    height: 60px;
} 
.items1 .item1 .details1 {
  padding-left: 30px;
  font-size: 13px;
}
.items1 .item1 .details1 .title1 {
  margin: 0;
  padding: 10px 0;
  color: #556071;
  font-size: 16px;
}
.items1 .item1 .details1 .date1 {
  display: block;
  color: #b3bac6;
  font-size: 11px;
  font-weight: 500;
  padding-top: 10px;
}
.items1 .item1 .details1 .description1 {
  color: #8792a5;
  font-size: 13px;
  margin: 0;
  padding: 5px 0;
}
</style>
<body>
    
</body>
</html>
<?php
include 'rss_reader-1.php';

// URL du flux RSS
$rss_feed_urls1 = ['https://www.developpez.com/index/rss'];

// Appel de la fonction pour lire le flux RSS
$items1 = [];
foreach ($rss_feed_urls1 as $url) {
    $items1 = array_merge($items1, read_rss_feed1($url));
}

// Limite du nombre d'éléments à afficher
$limit1 = 3;

// Compteur d'éléments
$item_count1 = 0;

// Affichage des éléments
foreach ($items1 as $item1) {
    // Vérifier si le nombre maximum d'éléments est atteint
    if ($item_count1 >= $limit1) {
        break;
    }

   
   

    // Affichage des éléments avec la structure HTML
    echo '<main class="items1" id="item1' . ($item_count1 + 1) . '">';
    echo '<a href="' . $item1['link'] . '" class="item1">';
    echo '<img src="' . $item1['image'] . '" alt="' . $item1['title'] . '"  class="image1">';
    echo '<div class="details1">';
    echo '<span class="date1">' . $item1['date'] . '</span>';
    echo '<h2 class="title1">' . $item1['title'] . '</h2>';
    echo '<p class="description1">' .$item1['description'] . '</p>';
    echo '</div>';
    echo '</a>';
    echo '</main>';

    // Incrémenter le compteur
    $item_count1++;
}
?>
