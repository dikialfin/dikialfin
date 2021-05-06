<?= $this->extend('template/template') ?>
<?= $this->section('content') ?>
    <div class="wrap col-lg-12">
        <form action="" method="POST">
            <div class="row mt-3">
                <div class="col-lg-6">
                    <h2>Simulasi Jika Superhero Menikah</h2>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3">
                    <a href="/home/menikah" class="btn btn-danger float-right ml-2">Hapus</a>
                    <button class="btn btn-primary float-right" type="submit">Edit</button>
                </div>
            </div>
            <table class="table table-bordered mt-2">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            Suami
                        </td>
                        <td style="width: 50%;">
                            <select name="suami" class="form-control">
                                <option>Pilih Suami</option>
                                <?php foreach ($suami as $data) :?>
                                <option <?= $data['id'] == $id_suami ? 'selected' : ''?> value="<?= $data['id']?>" ><?= $data['nama']?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">
                            Istri
                        </td>
                        <td style="width: 50%;">
                            <select name="istri" class="form-control">
                                <option>Pilih Istri</option>
                                <?php foreach ($istri as $data) :?>
                                <option <?= $data['id'] == $id_istri ? 'selected' : ''?>  value="<?= $data['id']?>" ><?= $data['nama']?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <h2>Maka Anaknya Kemungkinan Akan Memiliki Skill Berikut:</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Skill</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($anak == null) :?>
                    <tr class="text-center">
                        <td colspan="2">Tidak Memiliki Skill</td>
                    </tr>
                <?php else :?>
                    <?php $no = 1 ;?>
                    <?php foreach($anak as $data) :?>
                        <tr>
                            <td scope="row"><?= $no++?></td>
                            <td><?= $data['nama_skill']?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif;?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>