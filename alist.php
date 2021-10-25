<?php 

include 'head.php';

$smap= "SELECT * FROM `a_index` ORDER BY `id` DESC";

$mapres= $conn->query($smap);

while ($maprow= mysqli_fetch_assoc($mapres)){
    echo '<a href="article.php?aid=' . $maprow['id'] . '&atitle=' . $maprow['title'] . '" style="color: inherit;">' . $maprow['title'] . '</a><br>';
}

?>

