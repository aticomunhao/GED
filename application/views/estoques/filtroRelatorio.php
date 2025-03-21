 
<div class="container">
    <form role="form" method="POST"  action="<?= base_url('estoque/pesquisa') ?>">
        <div class="form-group">
            <fieldset>

                <legend>Relatório Filtro</legend>

                <?php if ($this->session->flashdata('erro')): ?>
                    <div class="alert alert-danger text-center" role="alert" ><?= $this->session->flashdata('erro'); ?></div>
                <?php endif;
                ?>

                 <p class="text-primary">Para obter de todo o período, basta não informar as datas </p>   

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 form-group">
                        <label for = "peridoInicial">Inicio</label>
                        <div class="input-group date datas">
                            <input id="peridoInicial" name="peridoInicial" placeholder="Insira a Data Inicial" class="form-control"  title="Insira a Data" data-date-format="DD/MM/YYYY"   type="text" value="<?= set_value('peridoInicial') ?>">
                            <span class="input-group-addon  ">
                                <span class="glyphicon glyphicon-calendar "></span>
                            </span>
                        </div>
                        <?= form_error('peridoInicial'); ?>
                    </div>



                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 form-group">
                        <label for = "peridoFinal"> Fim</label>
                        <div class="input-group date datas">
                            <input id="peridoFinal" name="peridoFinal" placeholder="Insira a Data Final" class="form-control"  title="Insira a Data"  data-date-format="DD/MM/YYYY"  type="text" value="<?= set_value('peridoFinal') ?>">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar "></span>
                            </span>
                        </div>
                        <?= form_error('peridoFinal'); ?>
                    </div>
                </div>

                <div class="botoesPesquisaAvancada">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> PESQUISAR</button>
                    <a href="<?= base_url('sistema/inicio') ?>" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> CANCELAR</a>

                </div>
            </fieldset>
        </div>
    </form>
</div>
