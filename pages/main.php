<?php
// Przykładowa podstrona - ona sie bedize wysiwetlac automatycznie jesli podasz w przegladarce samo / albo /index.php
//Dla tworzenia iinych podstron - wzor taki jak ta, w tym miejscu (miedzy tagami php) napierdalasz logike, zapytania i takie tam
//Jak dodasz do katalogu pages plik dupa.php to zobaczysz go w przegladarce wpisujac index.php?p=dupa
//Poniżej piszesz htmla i wpierdalsz do niego zmienne phpowe (stworzone w tym tagu) jak w przykladzie ponizej <h3>
//Generalnie nie robisz już żadnych zmian w index.php ( poza glownym szablonem strony ktory jest wsponly dla wsystkich
//// - bo wszystko masz w podstronach - bedizesz mial latwiej i przejrzysciej i nie bedziesz musial kopiowac tego samego
/// htmla 200 razy :-)
///
/// PDO (polaczenie z baza) masz dostepne tutaj w zmiennej $dbh, przyklad ponizej;

//$dbh->query('asdasdas');

$zmienna = 'cycki';
?>

<h1>DUPA</h1>
<h3><?php echo $zmienna;?></h3>