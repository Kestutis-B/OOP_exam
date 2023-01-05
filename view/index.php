<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8"/>
    <title>Elektros apskaitos sistema</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>

<h1>Mokesčiai už elektrą</h1>

<fieldset>

    <legend>Įveskite savo duomenis</legend>

    <form method="POST" action="./index.php">
        <input type="hidden" name="id" value="">
        <input class="user_input" type="text" name='data' placeholder="Čia įveskite duomenis">
        <input type="submit" value="Įvesti duomenis">
        <p>Nurodykite savo duomenis:</p>
        <p>Per mėnesį suvartotų elektros kilovatvalandžių kiekį, tarifą ir dieninį ar naktinį tarifą, mėnesį
            už kurį yra
            mokama. Darykite tai kaip pavyzdyje:</p>
        <p class="pvz">2000 0.56 diena 9</p>
        <p>arba</p>
        <p class="pvz">2000 0.56 naktis 9</p>
    </form>

</fieldset>



</body>

</html>


