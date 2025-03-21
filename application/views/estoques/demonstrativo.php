
<div class="container">
    <div class="botoesHistoricoUsuario">
        <button id="btGerarPDFEstoque" class="btn btn-primary " ><span class="glyphicon glyphicon-print"></span> Imprimir</button>
    </div>
    <br>
    <fieldset>
        <legend><strong>Estoque Atual</strong>

        </legend>

        <div id="dadosImpressaoEstoque">

            <table id="tab_customers" class="table table-striped">
                <colgroup>
                    <col width="30%">
                    <col width="20%">
                    <col width="20%">
                    <col width="20%">

                </colgroup>
                <thead>
                    <tr class='warning'>
                        <th>Produto</th>
                        <th>Qtde Atual</th>
                        <th>Qtde Mínima</th>
                        <th>Qtde Máxima</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estoque->result() as $row): ?>
                        <tr>
                            <td><?= strtoupper($row->nome) ?></td>
                            <td><?= $row->qtde ?></td>
                            <td><?= $row->minimo ?></td>
                            <td><?= $row->maximo ?></td>

                        </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>
        </div>


    </fieldset>

</div>
<div id="editor"></div>
</div>

