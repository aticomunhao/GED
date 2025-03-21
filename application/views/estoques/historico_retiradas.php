
<div class="container">

    <fieldset>
        <legend>Histórico do Retiradas 

        </legend>


        <div class="botoesHistoricoUsuario">
            <a href="<?= base_url('estoque/pesquisa'); ?>" class="btn btn-success botaoNovoTelaUsuario"> <span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
       
            <button id="btGerarPDFRetiradas" class="btn btn-primary " ><span class="glyphicon glyphicon-print"></span> Imprimir</button>
            
        </div>
        <br>
        <div id="dadosImpressaoHistoricoRetiradas">

            <table id="tab_customers" class="table table-striped">
                <colgroup>
                    <col width="20%">
                    <col width="10%">
                    <col width="5%">
                    <col width="20%">
                    <col width="10%">
                    <col width="20%">
                </colgroup>
                <thead>
                    <tr class='warning'>
                        <th>Usuário</th>
                        <th>Produto</th>
                        <th>Qtde</th>
                        <th>Observação</th>
                        <th>Data</th>
                        <th>Voluntário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historico as $row): ?>
                        <tr>
                             <td><?= $row['nomeUsuario'] ?></td>
                            <td><?= $row['nomeProduto'] ?></td>
                            <td><?= $row['quantidade'] ?></td>
                            <td><?= $row['obs'] ?></td>
                            <td><?= $row['data'] ?></td>
                            <td><?= $row['nomeVoluntario'] ?></td>
                        </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>
        </div>


    </fieldset>

</div>
<div id="editor"></div>
</div>

