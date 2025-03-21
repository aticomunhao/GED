
<div class="container">

    <fieldset>
        <legend>Histórico do Retiradas: 
            <span class="nomeMaiusculoNegrito" id="nome">
                <?= $nomeUsuario ?>
            </span>
        </legend>


        <div class="botoesHistoricoUsuario">
            <button id="btGerarPDFHistorico" class="btn btn-primary " ><span class="glyphicon glyphicon-print"></span> Imprimir</button>

            <button type="button" class="btn btn-danger " value="Fechar" onclick="javascript:window.close()"><span class="glyphicon glyphicon-remove"></span> Fechar</button>
        </div>
        <br>
        <div id="dadosImpressaoHistorico">

            <table id="tab_customers" class="table table-striped">
                <colgroup>
                    <col width="20%">
                    <col width="20%">
                    <col width="20%">
                    <col width="20%">
                    <col width="20%">
                </colgroup>
                <thead>
                    <tr class='warning'>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Observação</th>
                        <th>Data</th>
                        <th>Voluntário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historico as $row): ?>
                        <tr>
                            <td><?=$row['nomeProduto']?></td>
                            <td><?=$row['quantidade']?></td>
                            <td><?=$row['obs']?></td>
                            <td><?=$row['data']?></td>
                            <td><?=$row['nomeVoluntario']?></td>
                        </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>
        </div>
         

    </fieldset>

</div>
<div id="editor"></div>
</div>

