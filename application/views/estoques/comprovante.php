<div class="container">
    
     <?php if ($this->session->flashdata('erro')): ?>
        <div class="alert alert-danger text-center" role="alert"  ><?= $this->session->flashdata('erro'); ?></div>
    <?php elseif ($this->session->flashdata('logado')): ?>
        <div class="alert alert-warning text-center" role="alert"  ><?= $this->session->flashdata('logado'); ?></div>
    <?php elseif ($this->session->flashdata('acerto')): ?>
       
        <div class="alert alert-success text-center" role="alert"   ><?= $this->session->flashdata('acerto'); ?></div>
    <?php endif; ?>
        
        
    <button id="btGerarPDF" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
     


    <fieldset>

        <legend><strong>Comprovante de Retirada</strong></legend>


        <div id="dadosImpressao">
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">
                        <p><strong>Data:</strong> <?= $data_hora ?></p>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 form-group">
                        <p><strong>Nome do Usuário:</strong> <?= strtoupper($nomeUsuario) ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">
                        <p><strong>Quantidade:</strong> <?= strtoupper($quantidade) ?>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 form-group">
                        <p><strong>Item retirado: </strong><?= strtoupper($nomeProduto) ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <p><strong>Observação:</strong><?= strtoupper($obs) ?>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                        <p><strong>Voluntário: </strong><?= strtoupper($this->session->userdata('nome')) ?>

                    </div>

                </div>
            </div>




        </div>



    </fieldset>

</div>
<div id="editor"></div>
