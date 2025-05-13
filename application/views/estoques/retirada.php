<div class="container">
    <form role="form" method="POST" action="<?= base_url('estoque/retirada') ?>" ng-controller="estoqueCtl">
        <fieldset>

            <legend>Retirada de Mercadoria - Pessoa Física</legend>

            <?php if ($this->session->flashdata('erro')): ?>
                <div class="alert alert-danger text-center" role="alert"><?= $this->session->flashdata('erro'); ?></div>
            <?php endif;
            ?>



            <div class="row">
                <div class="col-xs-12 col-md-8">

                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">
                                <label for="cpfcnpjRetirada">CPF/CNPJ do Usuário</label>
                                <input id="cpfcnpjRetirada" name="cpfcnpjRetirada" MAXLENGTH="18" onkeypress="mascaraMutuario(this,cpfCnpj)" onblur="mascaraMutuario(this,cpfCnpj)" class="form-control" required type="text" value="<?= set_value('cpfcnpjRetirada'); ?>">
                                <?= form_error('cpfcnpjRetirada'); ?>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 form-group">

                                <label for="selProduto">Produto</label>

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
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 form-group">
                                <label for="quantidadeR">Quantidade</label>
                                <input id="quantidadeR" name="quantidadeR" class="form-control" required type="number" value="<?= set_value('quantidadeR') ?>">
                                <?= form_error('quantidade'); ?>
                                <span class="messages" id="alertaQuantidade"></span>

                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                <label for="obs">Observações: </label>
                                <textarea rows="3" id="obs" name="obs" class="form-control" title="Preenchimento opicional" x-moz-errormessage="Preenchimento opicional"><?= set_value('obs') ?> </textarea>
                                <?= form_error('obs');
                                ?>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="col-xs-6 col-md-4">

                    <div class="informacoes">

                    </div>
                    <div class="erros">

                    </div>



                </div>
            </div>

            <div class="pull-right">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> GRAVAR</button>
                <a href="<?= base_url('sistema/inicio') ?>" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> CANCELAR</a>

            </div>
        </fieldset>

    </form>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Histórico de Retiradas</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>

                </div>
            </div>
        </div>
    </div>
</div>