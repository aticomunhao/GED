
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
            <?php if($filtros):?>
                <strong> <?php echo implode(", ", $filtros);?> </strong>
            <?php endif;?>
            <table id="tab_customers" class="table table-striped">                
                <thead>
                    <tr class='warning'>
                        <th width="15%">CNPJ</th>
                        <th width="30%">Entidade</th>
                        <th width="15%">Cidade</th>
                        <th width="15%">Produto</th>
                        <th width="15%">Data de Retirada</th>
                        <th width="10%">Quantidade</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $totalQtde=0; ?>
                    <?php foreach ($historico as $row): ?>
                        <tr>
                             <td><?= $row['identificador'] ?></td>
                            <td><?= $row['nomeEntidade'] ?></td>
                            <td><?= $row['cidade'] ?></td>
                            <td><?= $row['nomeProduto'] ?></td>
                            <td><?= $row['dataSaida'] ?></td>
                            <td><?= $row['quantidade'] ?></td>
                            <?php $totalQtde=$totalQtde+$row['quantidade']; ?>
                        </tr>
                    <?php endforeach; ?>    
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $totalQtde; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>


    </fieldset>

</div>
<div id="editor"></div>
</div>

