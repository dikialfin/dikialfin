<?= $this->extend('template/template') ?>
<?= $this->section('content') ?>
        <form action="/home/editSkill/<?= $detail_skill['id']?>" method="GET">
            <div class="row mt-3">
                <div class="col-lg-6">
                    <h2>Detail Skill : <?= $detail_skill['nama']?></h2>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3">
                    <button class="btn btn-primary float-right" type="submit">Edit</button>
                </div>
            </div>
            <?php if ($session->getFlashdata('failed')) :?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $session->getFlashdata('failed')?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php elseif ($session->getFlashdata('success')) :?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $session->getFlashdata('success')?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>
            <table class="table table-bordered mt-2">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            ID
                        </td>
                        <td style="width: 50%;">
                            <?= $detail_skill['id']?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">
                            Nama
                        </td>
                        <td style="width: 50%;">
                            <input type="text" name="nama" class="form-control" value="<?= $detail_skill['nama']?>">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Heroes</th>
                <th scope="col" style="width: 30%;">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addHero">Tambah Hero</button>
                </th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($list_heroes) < 1) : ?>
                    <tr class="text-center">
                        <td colspan="3">Belum ada superhero yang memiliki skill ini</td>
                    </tr>
                <?php else : ?>
                <?php $no = 1;?>
                <?php foreach ($list_heroes as $data) :?>
                    <tr>
                        <td scope="row">
                            <?= $no++?>
                        </td>
                        <td><?=$data['nama_superhero']?></td>
                        <td>
                        <a href="/home/removeHeroSkill/<?= $data['id_superhero'] . "/" . $detail_skill['id']?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach;?>
                <?php endif ?>
            </tbody>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="addHero" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Skill Superhero</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/home/addHeroSkill" method="POST">
                <div class="modal-body">
                    <?php 
                        $total_data = count($list_heroes2);
                        $total_row = ceil($total_data/2);
                        $index = 0
                    ?>
                    <?php for($i = 1; $i <= $total_row; $i++) :?>
                        <div class="row">
                            <?php if ($i == $total_row && $total_data%2 == 1) :?>
                                <?php for ($j = 1; $j <= $total_data%2; $j++) :?>
                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input type="hidden" name="id_skill" value="<?= $detail_skill['id']?>">
                                            <input class="form-check-input" type="checkbox" value="<?= $list_heroes2[$index]['id']?>" name="id_superhero[]">
                                            <label class="form-check-label">
                                                <?= $list_heroes2[$index]['nama']?>
                                                <?php $index++?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endfor;?>
                            <?php else :?>
                                <?php for ($j = 1; $j <= 2; $j++) :?>
                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input type="hidden" name="id_skill" value="<?= $detail_skill['id']?>">
                                            <input name="id_superhero[]" class="form-check-input" type="checkbox" value="<?= $list_heroes2[$index]['id']?>">
                                            <label class="form-check-label">
                                                <?= $list_heroes2[$index]['nama']?>
                                                <?php $index++?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endfor;?>
                            <?php endif;?>
                        </div>
                    <?php endfor;?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
        </div>
<?= $this->endSection() ?>