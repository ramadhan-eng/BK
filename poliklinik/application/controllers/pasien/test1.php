<?php
$poliId = isset($_GET['poli_id']) ? $_GET['polid_id'] : null;

$datajadwal = $pdo->prepare("SELECT a.nama as nama_dokter, b.hari as hari, b.id as id_jp, b.jam_mulai as jam_mulai, b.jam_selesai as jam_selesai
                            FROM dokter as a

                            INNER JOIN jadwal_periksa as b
                            ON a.id =b.id_dokter
                            WHERE a.id_poli =:poli_id
");

$datajadwal->bindParam(':poli_id', $poliId);
$datajadwal->execute();

//opsi jadwal dokter
if ($datajadwal->rowCount() == 0) {
    echo '<option>Tidak ada jadwal<?option>';
} else {
    while ($jadwal = $datajadwal->FETCH()) {
        echo '<option value"' . $jadwal['id_jp'] . '">Dokter' . $jadwal['nama_dokter'] . '|' . $jadwal['hari'] . '|' . $jadwal['jam_mulai'] . '|' . $jadwal['jam_selesai'] . '</option>';
    }
}

?>

<script>
document.getElementById('input_poli').addEventListener('change', function() {
    var poliId = this.value;
    loadjadwal(poliId);
});

function loadjadwal(poliId) {
    var xhr = new XMLHttpRequest();

    xhr.open('GET', '' + poliId, true);

    xhr.setRequestHeader('Content-Type', 'text/html');

    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('input_jadwal').innerHTML = xhr.responseText;
        }
    };

    xhr.send();
}
</script>