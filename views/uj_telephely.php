<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telephely létrehozása</title>
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/creator.css">
    <style>
        body {
            background-image: url('../kepek/sites.jpg');
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
    <h1>Telephely létrehozása</h1>
    <div id="errDiv" style="color: red;"></div>
    <div id="msgDiv" style="font-weight: bolder;" ></div>

    <form id="ujTelephelyForm" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="azonosito">Azonosító</label></td>
                <td><input type="text" id="azonosito"/></td>
            </tr>
            <tr>
                <td><label for="telephely_nev">Telephely megnevezése</label></td>
                <td><input type="text" id="telephely_nev"/></td>
            </tr>
            <tr>
                <td><label for="cim">Cím</label></td>
                <td><input type="text" id="cim"/></td>
            </tr>
        </table>
        <input type="submit" value="Hozzáadás" id="submitBtn"/>
    </form>


    <script>
            document.getElementById('ujTelephelyForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const jsonData = JSON.stringify({
                tlph_id : document.getElementById('azonosito').value,
                nev : document.getElementById('telephely_nev').value,
                cim : document.getElementById('cim').value,
            });

            fetch("telephelyek.php", {
                method: "POST",
                header: {"Content-Type" : "application/json"},
                body: jsonData
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('errDiv').innerText = data.error;
                } else if (data.success) {
                    window.location.href = "telephelyek_lista.php";
                } else if (data.msg) {
                    document.getElementById('msgDiv').innerText = data.msg;
                }
            })
            .catch(err => {
                document.getElementById('errDiv').innerText = "Hiba történt a feltöltés során.";
                console.error(err);
            });
        });
    </script>
</body>
</html>