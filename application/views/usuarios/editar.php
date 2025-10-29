<div class="container" ng-controller="usuarioCtl">
     
    <form role="form" method="POST" action="<?= base_url('usuario/editar/' . $usuario->id) ?>">
        <fieldset>

            <legend>Atualizar dados do(a) usuário(a) - <span class="nomeMaiusculoNegrito"><?= $usuario->nome ?></span></legend>

            <?php if ($this->session->flashdata('erro')): ?>
                <div class="alert alert-danger text-center" role="alert" ><?= $this->session->flashdata('erro'); ?></div>
            <?php endif;
            ?>

            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">

                    <label for = "cpfcnpj">CPF/CNPJ</label>
                    <input id="cpfcnpj" name ="cpfcnpj"  MAXLENGTH="18"  onkeypress="mascaraMutuario(this,cpfCnpj)" onblur="mascaraMutuario(this,cpfCnpj)" class = "form-control" required type = "text" value = "<?=  $usuario->cpf  ?>">
                    <?= form_error('cpfcnpj'); ?>
                </div>

            </div>


            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <label for = "nome">Nome</label>
                        <input id = "nome" name = "nome" class = "form-control "  required type = "text" value = "<?= $usuario->nome ?>">
                        <?= form_error('nome');
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <label for = "responsavel">Nome do Responsável </label><small>   (opcional)</small>
                        <input id = "responsavel" name = "responsavel" class = "form-control " type = "text" value = "<?= $usuario->responsavel ?>">
                        <?= form_error('responsavel');
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <label for = "responsavel">Observações  </label><small>   (opcional)</small>
                        <textarea id = "observacoes" name = "observacoes" class = "form-control" rows="3" maxlength="255"><?= $usuario->observacoes ?></textarea>
                        <?= form_error('responsavel');
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">

                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">
                        <label for = "telefone">Telefone</label>
                        <input id="telefone" name ="telefone"   class = "form-control"   type = "text" value = "<?= $usuario->telefone ?>">
                        <?= form_error('telefone'); ?>
                    </div>
                </div>  
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1 form-group">
                        <label for = "selEstado">Estado</label>
<!--                         <select class="form-control" id="selEstado" name="selEstado" ng-model="selEstado" ng-change="listarcity()">
                        -->
                        <select class="form-control" id="selEstado" name="selEstado">
                            <?php foreach ($estados->result() as $row): ?>
                                <option value="<?= $row->id ?>" <?php echo set_select('selEstado', $row->id, $usuario->idEstados == $row->id ? TRUE : FALSE); ?>><?= strtoupper($row->sigla); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('selEstado');
                        ?> 
                    </div>
                    <div id="load"> </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">
                        <label for = "selCidade">Cidade</label>
                        <select class="form-control" id="selCidade" name="selCidade">
                            <?php foreach ($cidades->result() as $row): ?>
                                <option value="<?= $row->id ?>" <?php echo set_select('selCidade', $row->id, $usuario->cod_cidades == $row->id ? TRUE : FALSE); ?>><?= strtoupper($row->nome); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('selCidade');
                        ?> 
                    </div>
                </div>
            </div>


            <div class="pull-right">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> GRAVAR</button>
                <a href="<?= base_url('usuario/listar') ?>" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> CANCELAR</a>

            </div>
        </fieldset>

    </form>



</div>