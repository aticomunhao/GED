<div class="container" ng-controller="usuarioCtl">
    <form role="form" method="POST" action="<?= base_url('usuario/cadastrar') ?>">
        <fieldset>

            <legend>Cadastro de Usuários</legend>

            <?php if ($this->session->flashdata('erro')): ?>
                <div class="alert alert-danger text-center" role="alert" ><?= $this->session->flashdata('erro'); ?></div>
            <?php endif;
            ?>

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                    <label for = "selTipoDocumento">Ecolha o tipo de documento para cadastrar</label>
                    <p>
                        <input type="radio" id="selTipoDocumentoCpfCnpj" name="selTipoDocumento" 
                            value="cpfCnpj" ng-model="docType" ng-change="docByType(docType)"
                            ng-checked="docType == 'cpfCnpj'" required
                            ng-init="docType = '<?= set_value('selTipoDocumento') ?>'">&nbsp;CPF/CNPJ
                        &nbsp;
                        <input type="radio" id="selTipoDocumentoCpfCnpj" name="selTipoDocumento" 
                            value="passaporte" ng-model="docType" ng-change="docByType(docType)"
                            ng-checked="docType == 'passaporte'">&nbsp;Passaporte
                        <?= form_error('selTipoDocumento'); ?>
                    </p>
                </div>

            </div>

            <div class="row" ng-show="docType=='cpfCnpj'">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">
                    <label for = "cpfcnpj">CPF/CNPJ</label>
                    <input type = "text" id="cpfcnpj" name ="cpfcnpj" maxlength="18" 
                        onkeypress="mascaraMutuario(this,cpfCnpj)" onblur="mascaraMutuario(this,cpfCnpj)" 
                        class="form-control" value="<?= set_value('cpfcnpj') ?>" ng-required="docType == 'cpfCnpj'">
                    <?= form_error('cpfcnpj'); ?>
                </div>
            </div>

            <div class="row" ng-show="docType=='passaporte'">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">
                    <label for = "passaporte">Passaporte</label>
                    <input type="text" id="passaporte" name ="passaporte" maxlength="8"
                        class="form-control" value="<?= set_value('passaporte') ?>" ng-required="docType == 'passaporte'">
                    <?= form_error('passaporte'); ?>
                </div>
            </div>

            <div class="row" ng-show="docType">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <label for = "nome">Nome do Usuário / Empresa</label>
                        <input id = "nome" name = "nome" class = "form-control "  required type = "text" value = "<?= set_value('nome') ?>">
                        <?= form_error('nome');
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <label for = "responsavel">Nome do Responsável </label><small>   (opcional)</small>
                        <input id = "responsavel" name = "responsavel" class = "form-control " type = "text" value = "<?= set_value('responsavel') ?>">
                        <?= form_error('responsavel');
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <label for = "responsavel">Observações  </label><small>   (opcional)</small>
                        <textarea id = "observacoes" name = "observacoes" class = "form-control" rows="3" maxlength="255"><?= set_value('observacoes') ?></textarea>
                        <?= form_error('responsavel');
                        ?>
                    </div>
                </div>
            </div>
            <div class="row" ng-show="docType">
                <div class="form-group">

                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">
                        <label for = "telefone">Telefone</label>
                        <input id="telefone" name ="telefone"   class = "form-control"   type = "text" value = "<?= set_value('telefone') ?>">
                        <?= form_error('telefone'); ?>
                    </div>
                </div>
            </div>
            <div class="row" ng-show="docType">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <label for = "cep">CEP</label>
                        <input id="cep" name="cep" class="form-control" type="text" value="<?= set_value('cep') ?>" 
                            style="width: 200px;" ng-model="cep" ng-change="addressByCep(cep)" maxlength="11">
                        <?= form_error('cep'); ?>
                    </div>
                    <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1 form-group">
                        <label for = "selEstado">Estado</label>                        
                        <select class="form-control" id="selEstado" name="selEstado">
                            <?php foreach ($estados->result() as $row): ?>
                                <option value="<?= $row->id ?>" <?php echo set_select('selEstado', $row->id, set_value('selEstado') == $row->id ? TRUE : FALSE); ?>><?= strtoupper($row->sigla); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('selEstado'); ?>
                    </div>
                    <div id="load"> </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">
                        <label for = "selCidade">Cidade</label>
                        <select class="form-control" id="selCidade" name="selCidade">
                            <?php foreach ($cidades->result() as $row): ?>
                                <option value="<?= $row->id ?>" <?php echo set_select('selCidade', $row->id, set_value('selCidade') == $row->id ? TRUE : FALSE); ?>><?= strtoupper($row->nome); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('selCidade'); ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <label for = "endereco">Endereço</label>
                        <input id="endereco" name="endereco" class="form-control" type="text" value="<?= set_value('endereco') ?>" ng-model="endereco">
                        <?= form_error('endereco'); ?>
                    </div>                    
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
                        <label for = "bairro">Bairro</label>
                        <input id="bairro" name="bairro" class="form-control" type="text" value="<?= set_value('bairro') ?>" ng-model="bairro">
                        <?= form_error('bairro'); ?>
                    </div>
                </div>
            </div>

            <div class="pull-right" ng-show="docType">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> GRAVAR</button>
                <a href="<?= base_url('usuario/listar') ?>" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> CANCELAR</a>

            </div>
        </fieldset>

    </form>



</div>