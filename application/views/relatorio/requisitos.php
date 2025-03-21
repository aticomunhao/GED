<div class="container">
    <form role="form" method="POST" action="<?= base_url('relatorio/relatorioMensal') ?>" >
        <fieldset>

            <legend>Filtro para Relatório</legend>

            <?php if ($this->session->flashdata('erro')): ?>
                <div class="alert alert-danger text-center" role="alert"><?= $this->session->flashdata('erro'); ?></div>
            <?php endif;
            ?>


            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 form-group">
                        <label for="mes">Mês</label>
                        <select class="form-control" id="selMes" name="selMes">
                            <option value="1">Janeiro</option>
                            <option value="2">Fevereiro</option>
                            <option value="3">Março</option>
                            <option value="4">Abril</option>
                            <option value="5">Maio</option>
                            <option value="6">Junho</option>
                            <option value="7">Julho</option>
                            <option value="8">Agosto</option>
                            <option value="9">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select>

                            <?= form_error('mes'); ?>
                    </div>

                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 form-group">
                        <label for="ano">Ano(xxxx)</label>
                        <input id="ano" maxlength="4" name="ano" class="form-control" required type="text"
                               value="<?= date("Y") ?>">
                        <?= form_error('ano'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 form-group">

                        <label for="selProduto">Produto</label>

                        <select class="form-control" id="selProduto" name="selProduto">
                            <?php foreach ($produtos->result() as $row): ?>
                                <option
                                    value="<?= $row->id ?>" <?php echo set_select('selProduto', $row->id, set_value('selProduto') == $row->id ? TRUE : FALSE); ?>><?= strtoupper($row->nome); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('selProduto');
                        ?>
                    </div>


                </div>
            </div>


            <div class="pull-right">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Pesquisar
                </button>
                <a href="<?= base_url('sistema/inicio') ?>" class="btn btn-danger"> <span
                        class="glyphicon glyphicon-remove"></span> CANCELAR</a>

            </div>
        </fieldset>

    </form>


</div>