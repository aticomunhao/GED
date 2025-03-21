<div class="container">
    <form role="form" method="POST" action="<?= base_url('estoque/adicionar') ?>">
        <fieldset>

            <legend>Adicionar Itens ao Estoque</legend>

            <?php if ($this->session->flashdata('erro')): ?>
                <div class="alert alert-danger text-center" role="alert" ><?= $this->session->flashdata('erro'); ?></div>
            <?php endif;
            ?>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        
                       <label for = "selProduto">Produto</label>
                         
                        <select class="form-control" id="selProduto" name="selProduto">
                            <?php foreach ($produtos->result() as $row): ?>
                                <option value="<?= $row->id ?>" <?php echo set_select('selProduto', $row->id, set_value('selProduto') == $row->id ? TRUE : FALSE); ?>><?= strtoupper($row->nome); ?></option>
                            <?php endforeach; ?>
                        </select>  
                    <?= form_error('selProduto');
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1 form-group">
                        <label for = "quantidade">Quantidade</label>
                        <input id = "minimo" name = "quantidade" class = "form-control" required type = "number" value = "<?= set_value('quantidade') ?>">
                        <?= form_error('quantidade'); ?>
                    </div>
                     
            </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <label for = "obs">Observações: </label>
                        <textarea  rows="3"  id="obs" name = "obs" class = "form-control"  title = "Preenchimento opicional" x-moz-errormessage = "Preenchimento opicional" ><?= set_value('obs') ?> </textarea>
                        <?= form_error('obs');
                        ?>
                    </div>
                </div>
            </div>



            <div class="pull-right">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> GRAVAR</button>
                <a href="<?= base_url('estoque/listar') ?>" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> CANCELAR</a>

            </div>
        </fieldset>

    </form>



</div>