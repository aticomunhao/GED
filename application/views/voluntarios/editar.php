<div class="container" ng-controller="voluntarioCtl">
    <form role="form" method="POST" action="<?= base_url('voluntario/editar/' . $voluntario->id) ?>">
        <fieldset>

            <legend>Atualizar dados do(a) Voluntário(a) - <span class="nomeMaiusculoNegrito"><?= $voluntario->nome ?></span></legend>

            <?php if ($this->session->flashdata('erro')): ?>
                <div class="alert alert-danger text-center" role="alert" ><?= $this->session->flashdata('erro'); ?></div>
            <?php endif;
            ?>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <label for = "nome">Nome</label>
                        <input id = "nome" name = "nome" class = "form-control "  required type = "text" value = "<?= $voluntario->nome ?>">
                        <?= form_error('nome');
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">
                        <label for = "cpf">CPF</label>
                        <input id="cpf" name ="cpf"   class = "form-control" required type = "text" value = "<?= $voluntario->cpf ?>">
                        <?= form_error('cpf'); ?>
                        
                    </div>

                </div>  


            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">
                        <label for = "selPefil">Perfil</label>
                        <select class="form-control" id="selPefil" name="selPefil">
                            <?php foreach ($perfis->result() as $row): ?>
                                <option value="<?= $row->id ?>" <?php echo set_select('selPefil', $row->id, set_value('selPefil') == $row->id ? TRUE : FALSE); ?>><?= strtoupper($row->descricao); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('selPefil');
                        ?> 
                    </div>
                </div>
            </div>


            <div class="pull-right">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> GRAVAR</button>
                <a href="<?= base_url('voluntario/listar') ?>" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> CANCELAR</a>

            </div>
        </fieldset>

    </form>



</div>