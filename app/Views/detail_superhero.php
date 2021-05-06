<?= $this->extend('template/template') ?>
<?= $this->section('content') ?>
        <form action="/home/editSuperhero/<?= $superhero['detail_superhero']['id']?>" method="GET">
            <div class="row mt-3">
                <div class="col-lg-6">
                    <h2>Detail Superhero : <?= $superhero['detail_superhero']['nama']?></h2>
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
                            <?= $superhero['detail_superhero']['id']?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">
                            Nama
                        </td>
                        <td style="width: 50%;">
                            <input type="text" name="nama" class="form-control" value="<?= $superhero['detail_superhero']['nama']?>">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">
                            Jenis Kelamin
                        </td>
                        <td style="width: 50%;">
                            <select name="jenis_kelamin" class="form-control">
                                <option value="Laki Laki" <?= $superhero['detail_superhero']['jenis_kelamin'] == 'Laki Laki' ? 'selected' : ''?> >Laki Laki</option>
                                <option value="Perempuan" <?= $superhero['detail_superhero']['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''?> >Perempuan</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Skill</th>
                <th scope="col" style="width: 30%;">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addSkill">Tambah Skill</button>
                </th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($superhero['detail_skill']) < 1) : ?>
                    <tr class="text-center">
                        <td colspan="3">Superhero Belum Mempunyai Skill</td>
                    </tr>
                <?php else : ?>
                <?php $no = 1;?>
                <?php foreach ($superhero['detail_skill'] as $data) :?>
                    <tr>
                        <td scope="row">
                            <?= $no++?>
                        </td>
                        <td><?=$data['skill_superhero']?></td>
                        <td><a href="/home/hapusSkillHeroes/<?=$superhero['detail_superhero']['id'] . "/" .$data['id']?>" class="btn btn-danger">Hapus</a></td>
                    </tr>
                <?php endforeach;?>
                <?php endif ?>
            </tbody>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="addSkill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Skill Superhero</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/home/addSkillSuperhero" method="POST">
                <div class="modal-body">
                    <?php 
                        $total_data = count($skill);
                        $total_row = ceil($total_data/2);
                        $index = 0
                    ?>
                    <?php for($i = 1; $i <= $total_row; $i++) :?>
                        <div class="row">
                            <?php if ($i == $total_row && $total_data%2 == 1) :?>
                                <?php for ($j = 1; $j <= $total_data%2; $j++) :?>
                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input type="hidden" name="id_superhero" value="<?= $superhero['detail_superhero']['id']?>">
                                            <input class="form-check-input" type="checkbox" value="<?= $skill[$index]['id']?>" name="id_skill[]">
                                            <label class="form-check-label">
                                                <?= $skill[$index]['nama']?>
                                                <?php $index++?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endfor;?>
                            <?php else :?>
                                <?php for ($j = 1; $j <= 2; $j++) :?>
                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input type="hidden" name="id_superhero" value="<?= $superhero['detail_superhero']['id']?>">
                                            <input name="id_skill[]" class="form-check-input" type="checkbox" value="<?= $skill[$index]['id']?>">
                                            <label class="form-check-label">
                                                <?= $skill[$index]['nama']?>
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