<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felhasználók</title>

    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/content.css">

    <style>
        body {
            background-image: url('../kepek/profil.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            overflow: hidden;
            margin: 0;
        }
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.7);
            z-index: -1;
        }
    </style>
</head>

<body>
    <?php require_once "ellenoriz.php"; ?>
    <?php require_once "menu.php"; ?>

    <h1>Felhasználók</h1>

    <div id="errDiv" style="color: red;"></div>
    <div id="msgDiv" style="font-weight: bolder;"></div>

    <div id="tableSection">
        <table id="contentTable">
            <tr>
                <th>Név</th>
                <th>E-mail</th>
                <th>Osztály</th>
            </tr>
        </table>
    </div>

    <script>
        fetch("felhasznalok.php", {
            method: "GET",
            headers: { "Content-Type": "application/json" }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('errDiv').innerText = data.error;
            }
            else if (data.success) {
                const table = document.getElementById("contentTable");

                data.success.forEach(u => {
                    const row = table.insertRow(-1);

                    row.insertCell(0).innerText = u.nev;
                    row.insertCell(1).innerText = u.email ? u.email : '';
                    row.insertCell(2).innerText = u.osztaly_nev ? u.osztaly_nev : '';
                });
            }
            else if (data.msg) {
                document.getElementById('msgDiv').innerText = data.msg;
            }
        });
    </script>
</body>
</html>
