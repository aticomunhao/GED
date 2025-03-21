<div class="container">
    <form role="form" method="POST" action="<?= base_url("produto/editar/".$produto->id) ?>">
        <fieldset>

            <legend>Edição do Produto - <span class="nomeMaiusculoNegrito"><?= $produto->nome?></span></legend>

            <?php if ($this->session->flashdata('erro')): ?>
                <div class="alert alert-danger text-center" role="alert" ><?= $this->session->flashdata('erro'); ?></div>
            <?php endif;
            ?>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <label for = "nomeProduto">Nome do Produto</label>
                        <input id = "nomeProduto" name = "nomeProduto" class = "form-control "  required type = "text" value = "<?= $produto->nome ?>">
                        <?= form_error('nomeProduto');
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 form-group">
                        <label for = "minimo">Quantidade Mínima </label>
                        <input id = "minimo" name = "minimo" class = "form-control" required type = "number" value = "<?=$produto->minimo ?>">
                        <?= form_error('minimo'); ?>
                    </div>
                    
            
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 form-group">
                        <label for = "maximo">Quantidade Máxima </label>
                        <input id = "maximo" name = "maximo" class = "form-control" required type = "number" value = "<?=$produto->maximo?>">
                        <?= form_error('maximo'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <label for = "obs">Observações: </label>
                        <textarea  rows="3"  id="obs" name = "obs" class = "form-control"  title = "Preenchimento opicional" x-moz-errormessage = "Preenchimento opicional" ><?=$produto->obs ?> </textarea>
                        <?= form_error('obs');
                        ?>
                    </div>
                </div>
            </div>

               
            <div class="pull-right">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> GRAVAR</button>
                <a href="<?= base_url('produto/listar') ?>" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> CANCELAR</a>

            </div>
        </fieldset>

    </form>



</div>