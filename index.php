<?php
require_once "Filma.php";
require_once "Filmak.php";

// Sortu filmen zerrenda
$filmak = new Filmak();

// Hasierako filmak gehitu
$filmak->gehitu(new Filma("Superman", "12345678", 1978, 5));
$filmak->gehitu(new Filma("Batman", "23456789", 2022, 4));
?>

<html>
<head>
    <title>TOP MOVIES</title>
</head>
<body>

<h1>TOP MOVIES</h1>

<!-- Filmen zerrenda erakutsi -->
<?php
foreach ($filmak->getFilmak() as $filma) {
    echo $filma->getIzena() . " - ";
    echo $filma->getISAN() . " - ";
    echo $filma->getUrtea() . " - ";
    echo $filma->getPuntuazioa() . "<br>";
}
?>

<br>

<!-- Filmak sartzeko formularioa -->
<form method="POST">

    <input type="hidden" name="filmak" value="">

    <label>Izena:</label>
    <input type="text" name="izena">
    <br><br>

    <label>ISAN:</label>
    <input type="text" name="ISAN">
    <br><br>

    <label>Urtea:</label>
    <input type="text" name="urtea">
    <br><br>

    <label>Puntuazioa:</label>
    <select name="puntuazioa">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <br><br>

    <input type="submit" value="Bidali">

</form>

</body>
</html>
