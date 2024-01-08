<?php    
public function SemuaData()
    {
        $this->db->select('periksa.tgl_periksa, pasien.no_rm, pasien.nama as nama_pasien, periksa.catatan, obat.nama_obat,(periksa.biaya_periksa + obat.harga) as total');
        $this->db->from('periksa');
        $this->db->join('daftar_poli', 'periksa.id_daftar_poli = daftar_poli.id');
        $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
        $this->db->join('detail_periksa', 'periksa.id = detail_periksa.id_periksa');
        $this->db->join('obat', 'detail_periksa.id_obat = obat.id');

        $query = $this->db->get();

        return $query->result();
    }
?>

<form action="<?= base_url('pasien/pasien/register_poli'); ?>" method="post">
    <div class="mb-3">
        <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
        <input type="text" class="form-control" id="no_rm" placeholder="Nomor Rekam Medis"
            value="<?= isset($no_rm) ? $no_rm : ''; ?>" readonly>
    </div>

    <div class="mb-3">
        <label for="input-poli" class="form-label">Pilih Poli</label>
        <select name="id_poli" id="input_poli" class="form-control">
            <option value="0">Open This Select Menu</option>
            <?php
                                                $data = $this->db->get('poli')->result_array();
                                                if (empty($data)) {
                                                    echo "<option value=''>Tidak Ada Poli</option>";
                                                } else {
                                                    foreach ($data as $d) {
                                                ?>
            <option value="<?= $d['id'] ?>"><?= $d['nama_poli'] ?></option>
            <?php
                                                    }
                                                }
                                                ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="input-jadwal" class="form-label">Pilih Jadwal</label>
        <select name="id_jadwal" id="input_jadwal" class="form-control">
        </select>
    </div>
    <div class="mb3">
        <label for="keluhan" class="form-label">Keluhan</label>
        <textarea class="form-control" id="keluhan" rows="3" placeholder="Tulis Keluhan disini" name="keluhan"
            required></textarea>
    </div>
    <button type="submit" class="btn btn-primary float-end">Daftar</button>
</form>


<!-- Detail Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Detail Periksa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Periksa</th>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Keluhan</th>
                            <th>Catatan</th>
                            <th>Obat</th>
                            <th>Biaya Periksa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($riwayat_periksa as $key => $history) : ?>
                        <tr>
                            <!-- Display other columns as needed -->
                            <td><?= $key + 1 ?></td>
                            <td><?= $history['nama_pasien'] ?></td>
                            <td><?= $history['nama_dokter'] ?></td>
                            <td><?= $history['tanggal_periksa'] ?></td>
                            <td><?= $history['keluhan'] ?></td>
                            <td><?= $history['catatan'] ?></td>
                            <td><?= $history['biaya_periksa'] ?></td>
                            <td><?= $history['nama_obat'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>