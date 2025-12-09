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
                <th>Művelet(ek)</th>
            </tr>
        </table>
    </div>

    <div id="formSection" style="display: none;">
        <form id="updateForm">
            <table>
                <input type="hidden" id="updateDolgId">
                <tr>
                    <td><label for="updateNev">Név:</label></td>
                    <td><input type="text" id="updateNev" required></td>
                </tr>
                <tr>
                    <td><label for="updateEmail">E-mail:</label></td>
                    <td><input type="text" id="updateEmail"></td>
                </tr>
                <tr>
                    <td><label for="updateOsztalyId">Osztály ID:</label></td>
                    <td><input type="text" id="updateOsztalyId"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit">Mentés</button>
                        <button type="button" id="cancelBtn">Mégse</button>
                    </td>
                </tr>
            </table>
        </form>
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

                    const muveletekTD = row.insertCell(3);
                    muveletekTD.innerHTML = `
                        <button class="update"
                                data-dolg_id="${u.dolg_id}"
                                data-nev="${u.nev}"
                                data-email="${u.email ?? ''}"
                                data-osztaly_id="${u.osztaly_id ?? ''}">
                            Módosítás
                        </button>
                        <button class="delete"
                                data-dolg_id="${u.dolg_id}">
                            Törlés
                        </button>
                    `;
                });
                document.querySelectorAll('.delete').forEach(button => {
                    button.addEventListener('click', function () {
                        const id = this.dataset.dolg_id;

                        fetch("felhasznalok.php", {
                            method: "DELETE",
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({ dolg_id: id })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('msgDiv').innerText = data.success;
                                this.closest('tr').remove();
                            } else {
                                document.getElementById('errDiv').innerText = data.error || data.msg || "Hiba történt.";
                            }
                        });
                    });
                });

                document.querySelectorAll('.update').forEach(button => {
                    button.addEventListener('click', function () {
                        const id = this.dataset.dolg_id;
                        const nev = this.dataset.nev;
                        const email = this.dataset.email || '';
                        const osztalyId = this.dataset.osztaly_id || '';

                        document.getElementById('updateDolgId').value = id;
                        document.getElementById('updateNev').value = nev;
                        document.getElementById('updateEmail').value = email;
                        document.getElementById('updateOsztalyId').value = osztalyId;

                        document.getElementById('tableSection').style.display = 'none';
                        document.getElementById('formSection').style.display = 'block';
                    });
                });

                document.getElementById('cancelBtn').addEventListener('click', function () {
                    document.getElementById('formSection').style.display = 'none';
                    document.getElementById('tableSection').style.display = 'block';
                });

                document.getElementById('updateForm').addEventListener('submit', function (e) {
                    e.preventDefault();

                    const dolg_id = document.getElementById('updateDolgId').value;
                    const nev = document.getElementById('updateNev').value;
                    const email = document.getElementById('updateEmail').value;
                    const osztaly_id = document.getElementById('updateOsztalyId').value;

                    fetch("felhasznalok.php", {
                        method: "PUT",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({
                            dolg_id: dolg_id,
                            nev: nev,
                            email: email,
                            osztaly_id: osztaly_id
                        })
                    })
                    .then(res => res.json())
                    .then(resp => {
                        if (resp.success) {
                            document.getElementById('msgDiv').innerText = resp.success || "Sikeres módosítás.";
                            document.getElementById('formSection').style.display = 'none';
                            document.getElementById('tableSection').style.display = 'block';
                            
                            location.reload();
                        } else {
                            document.getElementById('errDiv').innerText = resp.error || resp.msg || "Hiba történt.";
                        }
                    });
                });
            }
            else if (data.msg) {
                document.getElementById('msgDiv').innerText = data.msg;
            }
        });
    </script>
</body>
</html>
