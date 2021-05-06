<?= $this->extend('template/template') ?>
<?= $this->section('content') ?>
    <div class="row mt-3">
        <div class="col-lg-6">
            <h2>Daftar Superhero</h2>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3">
            <form action="" method="GET">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
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
    <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col" style="width: 30%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;?>
            <?php foreach($superhero as $data) :?>
                <tr>
                    <td scope="row">
                        <?= $no ++;?>
                    </td>
                    <td>
                        <?= $data['nama']?>
                    </td>
                    <td>
                        <?= $data['jenis_kelamin']?>
                    </td>
                    <td>
                        <a href="/home/detailSuperhero/<?= $data['id']?>" class="btn btn-primary">View Detail</a>
                        <a href="/home/hapusSuperhero/<?= $data['id']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<?= $this->endSection() ?>