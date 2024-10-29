<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coblosan Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php
    // Inisialisasi beberapa variabel
    $kandidat = [
        1 => 'Anies Rasyid Baswedan - Muhaimin Iskandar',
        2 => 'Ganjar Pranowo - Mahfud MD',
        3 => 'Prabowo Subianto - Gibran Rakabuming Raka'
    ];

    // Cek jika data suara tersedia di session
    session_start();
    if (!isset($_SESSION['suara'])) {
        $_SESSION['suara'] = [
            1 => 35,
            2 => 42,
            3 => 23
        ];
    }
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="./">Coblosan Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="#inputCoblos">Input untuk Coblos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#lihatHasil">Hasil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#grafikSuarascroll">Grafik Suara</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1>Selamat Datang di Coblosan Online</h1>
            <p>Silakan pilih menu di bawah ini untuk memulai pemungutan suara atau melihat hasil coblosan.</p>
        </div>

        <!-- Input untuk Coblos -->
        <div id="inputCoblos" class="card mb-5">
            <div class="card-header bg-success text-white">
                <h2>Input untuk Coblos</h2>
            </div>
            <div class="card-body">
                <form onsubmit="handleSubmit(event)">
                    <div class="mb-3">
                        <label for="pilihan" class="form-label">Pilih Kandidat</label>
                        <select class="form-select" id="pilihan" required>
                            <option value="" disabled selected>Pilih salah satu...</option>
                            <?php foreach ($kandidat as $key => $value): ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" id="coblos">Coblos</button>
                </form>
            </div>
        </div>

        <!-- Gambar Kandidat -->
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card">
                    <img height="500" src="https://upload.wikimedia.org/wikipedia/commons/7/72/Anies_Baswedan%2C_Candidate_for_Indonesia%27s_President_in_2024.jpg" class="card-img-top" alt="Anies Rasyid Baswedan">
                    <div class="card-body">
                        <h5 class="card-title">Anies Rasyid Baswedan</h5>
                        <p class="card-text">Kandidat Presiden.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3 mt-md-0">
                <div class="card">
                    <img height="500" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/Ganjar_Pranowo%2C_Gubernur_Jateng_Periode_II.jpg/640px-Ganjar_Pranowo%2C_Gubernur_Jateng_Periode_II.jpg" class="card-img-top" alt="Ganjar Pranowo">
                    <div class="card-body">
                        <h5 class="card-title">Ganjar Pranowo</h5>
                        <p class="card-text">Kandidat Presiden.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3 mt-md-0">
                <div class="card">
                    <img height="500" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Prabowo_Subianto_2024_official_portrait.jpg/220px-Prabowo_Subianto_2024_official_portrait.jpg" class="card-img-top" alt="Prabowo Subianto">
                    <div class="card-body">
                        <h5 class="card-title">Prabowo Subianto</h5>
                        <p class="card-text">Kandidat Presiden.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hasil -->
        <div id="lihatHasil" class="card mb-5">
            <div class="card-header bg-info text-white">
                <h2>Hasil</h2>
            </div>
            <div class="card-body">
                <p>Lihat hasil sementara dari pemungutan suara di bawah ini:</p>
                <ul class="list-group">
                    <li class="list-group-item" id="kandidat1">Anies Rasyid Baswedan - Muhaimin Iskandar: <span id="suara1"><?php echo $_SESSION['suara'][1]; ?></span> suara</li>
                    <li class="list-group-item" id="kandidat2">Ganjar Pranowo - Mahfud MD: <span id="suara2"><?php echo $_SESSION['suara'][2]; ?></span> suara</li>
                    <li class="list-group-item" id="kandidat3">Prabowo Subianto - Gibran Rakabuming Raka: <span id="suara3"><?php echo $_SESSION['suara'][3]; ?></span> suara</li>
                </ul>
            </div>
        </div>

        <!-- Grafik Suara -->
        <div class="card mb-5" id="grafikSuarascroll">
            <div class="card-header bg-warning text-white">
                <h2>Grafik Suara</h2>
            </div>
            <div class="card-body">
                <canvas id="grafikSuara" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <footer class="text-center py-3 bg-light">
        <p>&copy; 2024 Coblosan Online. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Inisialisasi suara dan status dari localStorage atau nilai default
        let suara = JSON.parse(localStorage.getItem("suara")) || {
            1: <?php echo $_SESSION['suara'][1]; ?>,
            2: <?php echo $_SESSION['suara'][2]; ?>,
            3: <?php echo $_SESSION['suara'][3]; ?>
        };
        let pertama = localStorage.getItem("pertama") !== "false";

        // Update tampilan suara di halaman
        function updateVotesDisplay() {
            document.getElementById("suara1").textContent = suara[1];
            document.getElementById("suara2").textContent = suara[2];
            document.getElementById("suara3").textContent = suara[3];
        }

        // Update grafik suara
        function updateChart() {
            suaraChart.data.datasets[0].data = [suara[1], suara[2], suara[3]];
            suaraChart.update();
        }

        // Fungsi untuk menangani submit form
        function handleSubmit(event) {
            event.preventDefault();
            const pilihan = document.getElementById("pilihan").value;
            if (pilihan) {
                if (!pertama) {
                    alert("Anda sudah memilih kandidat.");
                } else {
                    suara[pilihan]++;
                    updateVotesDisplay();
                    updateChart();
                    alert("Terima kasih sudah memilih!");
                    document.getElementById("pilihan").value = "";
                    document.getElementById("coblos").disabled = true;
                    pertama = false;

                    // Simpan data suara dan status ke localStorage
                    localStorage.setItem("suara", JSON.stringify(suara));
                    localStorage.setItem("pertama", pertama);
                }
            } else {
                alert("Silakan pilih kandidat terlebih dahulu.");
            }
        }

        // Fungsi untuk menambah suara secara acak
        function tambahSuaraAcak() {
            // Pilih kandidat secara acak (1, 2, atau 3)
            const kandidatAcak = Math.floor(Math.random() * 3) + 1; // 1-3
            suara[kandidatAcak]++; // Tambah suara untuk kandidat yang dipilih secara acak

            // Update tampilan suara dan grafik
            updateVotesDisplay();
            updateChart();
        }

        // Set interval untuk menambah 3 suara secara acak setiap menit (60000 ms)
        setInterval(tambahSuaraAcak, 10000);

        // Perbarui tampilan dan grafik saat halaman dimuat
        updateVotesDisplay();
        if (!pertama) {
            document.getElementById("coblos").disabled = true;
        }

        // Inisialisasi Chart.js
        const ctx = document.getElementById('grafikSuara').getContext('2d');
        const suaraChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Anies Rasyid Baswedan - Muhaimin Iskandar',
                    'Ganjar Pranowo - Mahfud MD',
                    'Prabowo Subianto - Gibran Rakabuming Raka'
                ],
                datasets: [{
                    label: 'Jumlah Suara',
                    data: [suara[1], suara[2], suara[3]],
                    backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(255, 159, 64, 0.5)', 'rgba(54, 162, 235, 0.5)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 159, 64, 1)', 'rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>