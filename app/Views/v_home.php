<!-- Main content -->
<div class="content">
      <div class="container">
        <div class="row">
            <div class="col-md-12 mb-2 text-center">
            <?php 
            if(!empty(session()->getFlashdata('success'))){ ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php }
            ?>
            </div>
            <?php foreach ($barang as $key => $value) { ?>
                <div class="col-lg-3">
                    <?php 
                    echo form_open('home/addToCart');
                    echo form_hidden('id',$value['id_barang']);
                    echo form_hidden('price',$value['harga']);
                    echo form_hidden('name',$value['nama_barang']);
                    echo form_hidden('gambar',$value['gambar']);
                    echo form_hidden('berat',$value['berat']);
                    ?>
                    <div class="card">
                        <div class="card-body text-center">
                            <h5><?= $value['nama_barang'] ?></h5>
                            <p class="card-text">
                            Berat : <?= $value['berat'] ?> Gr
                            <img src="<?= base_url('gambar/'.$value['gambar']); ?>" width="200px" height="200px">
                            </p>
                            <label>
                            <?= number_to_currency($value['harga'], 'IDR'); ?>
                            </label>
                            <br>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-shopping-basket"></i> Add</button>
                        </div>
                    <?php echo form_close(); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
      </div>
</div>