
<div class="container">

    <fieldset>
        <legend>Histórico do Retiradas das Entidades

        </legend>


        <div class="botoesHistoricoUsuario">
            <a href="<?= base_url('relatorio/historicoEntidades'); ?>" class="btn btn-success botaoNovoTelaUsuario"> <span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
       
            <button id="btGerarPDFRetiradasEntides" class="btn btn-primary " ><span class="glyphicon glyphicon-print"></span> Imprimir</button>
            
        </div>
        <br>
        <div id="dadosImpressaoHistoricoRetiradasEntidades">
            <?php if($dataI && $dataF):?>
            <strong>Período entre <?= ($dataI . ' e ' . $dataF);?></strong>
            <?php endif;?>
            <table id="tab_customers" class="table table-striped">
                <colgroup>
                    <col width="20%">
                    <col width="35%">
                    <col width="25%">
                    <col width="20%">

                </colgroup>
                <thead>
                    <tr class='warning'>
                        <th>CNPJ</th>
                        <th>Entidade</th>
                        <th>Produto</th>
                        <th>Quantidade</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historico as $row): ?>
                        <tr>
                             <td><?= $row['identificador'] ?></td>
                            <td><?= $row['nomeEntidade'] ?></td>
                            <td><?= $row['nomeProduto'] ?></td>
                            <td><?= $row['quantidade'] ?></td>

                        </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>
        </div>


    </fieldset>

</div>
<div id="editor"></div>
</div>

