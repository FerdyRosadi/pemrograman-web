<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Mahasiswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eeeeee;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .kartu {
            width: 600px;
            min-height: 280px;
            background-color: white;

            border: 2px solid #333;
            border-radius: 10px;

            padding: 25px;
            box-sizing: border-box;

            display: flex;
            align-items: center;

            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .foto {
            width: 180px;
            height: 220px;
            border: 2px solid #333;
            margin-right: 30px;
            overflow: hidden;
        }

        .foto img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .data {
            flex: 1;
        }

        .data h1 {
            font-size: 26px;
            margin-top: 0;
            margin-bottom: 25px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .data p {
            font-size: 18px;
            margin: 15px 0;
        }

        .data p span {
            font-weight: bold;
            display: inline-block;
            width: 90px;
        }
    </style>
</head>

<body>

    <div class="kartu">

        <div class="foto">
            <img src="fotodiri.jpeg" alt="Foto Mahasiswa">
        </div>

        <div class="data">

            <h1>KARTU MAHASISWA</h1>

            <p>
                <span>Nama</span> : Ferdy Rosadi
            </p>

            <p>
                <span>NIM</span> : 2441016
            </p>

            <p>
                <span>Kampus</span> : STT MANDALA
            </p>

            <p>
                <span>Prodi</span> : Teknik Informatika
            </p>

        </div>

    </div>

</body>
</html>