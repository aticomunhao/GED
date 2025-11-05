 
<div class="container">
    <form role="form" method="POST"  action="<?= base_url('relatorio/historicoEntidades') ?>">
        <div class="form-group">
            <fieldset>

                <legend>Relatório Filtro das Entidades</legend>

                <?php if ($this->session->flashdata('erro')): ?>
                    <div class="alert alert-danger text-center" role="alert" ><?= $this->session->flashdata('erro'); ?></div>
                <?php endif;
                ?>

                 <p class="text-primary">Para obter de todo o período, basta não informar as datas </p>   

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <label for = "cpfcnpj">CNPJ</label>
                        <input id="cpfcnpj" name="cpfcnpj" placeholder="Insira o CNPJ" class="form-control"  title="Insira o CNPJ" type="text" 
                            value="<?= set_value('cpfcnpj') ?>" style="width: 300px;" maxlength="18"
                            onkeypress="mascaraMutuario(this,cpfCnpj)" onblur="mascaraMutuario(this,cpfCnpj)">
                        <?= form_error('cpfcnpj'); ?>
                    </div>                    
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
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 form-group">
                        <label for = "selEstado">Estado</label>                        
                        <select class="form-control" id="selEstado" name="selEstado">
                            <option value="">Selecione...</option>
                            <?php foreach ($estados->result() as $row): ?>
                                <option value="<?= $row->id ?>" <?php echo set_select('selEstado', $row->id, set_value('selEstado') == $row->id ? TRUE : FALSE); ?>><?= strtoupper($row->sigla); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('selEstado'); ?>
                    </div>
                    <div id="load"> </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 form-group">
                        <label for = "selCidade">Cidade</label>
                        <select class="form-control" id="selCidade" name="selCidade" disabled>
                            <option value="">Selecione...</option>
                            <?php foreach ($cidades->result() as $row): ?>
                                <option value="<?= $row->id ?>" <?php echo set_select('selCidade', $row->id, set_value('selCidade') == $row->id ? TRUE : FALSE); ?>><?= strtoupper($row->nome); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('selCidade'); ?>
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
