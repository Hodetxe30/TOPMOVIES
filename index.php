<html>
<head>
    <title>TOP MOVIES</title>
</head>
<body>

    <h1>TOP MOVIES</h1>

    <form method="POST">

        <input type="hidden" name="filmak"
               value="<?php echo $_POST['filmak'] ?? ''; ?>">

        <label>Izena:</label>
        <input type="text" name="izena"
               value="<?php echo $_POST['izena'] ?? ''; ?>">
        <br><br>

        <label>ISAN:</label>
        <input type="text" name="ISAN"
               value="<?php echo $_POST['ISAN'] ?? ''; ?>">
        <br><br>

        <label>Urtea:</label>
        <input type="text" name="urtea"
               value="<?php echo $_POST['urtea'] ?? ''; ?>">
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