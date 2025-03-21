
<div class="container">

    <fieldset>
        <legend>Quantitativo de Distribuição Mensal do(a): <strong><?=$nomeProduto?> - <?=$mes.'/'.$ano?></strong>

        </legend>


        <div class="botoesHistoricoUsuario">
            <a href="<?= base_url('relatorio/relatorioMensal'); ?>" class="btn btn-success botaoNovoTelaUsuario"> <span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
       
            <button id="btGerarPDFRelatorioMensal" class="btn btn-primary " ><span class="glyphicon glyphicon-print"></span> Imprimir</button>
            
        </div>
        <br>
        <div id="dadosImpressaoRelatorioMensal">

            <strong><?=$nomeProduto?> - <?=$mes.'/'.$ano?></strong>

            <table id="tab_customers" class="table table-striped">
                <colgroup>
                    <col width="40%">
                    <col width="60%">

                </colgroup>
                <thead>
                    <tr class='warning'>
                        <th>Dia</th>
                        <th><?=$mes?></th>
                    </tr>
                </thead>
                <tfoot>
                <tr>
                    <td><strong>Total</strong></td>
                    <td> <strong><?=$total[$mes]?></strong></td>
                </tr>
                </tfoot>
                <tbody>
                    <?php for( $i=1; $i<= 31 ; $i++): ?>
                        <tr>
                             <td><?=$i ?></td>
                            <td><?=$dados[$mes][$i]; ?></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>


    </fieldset>

</div>
<div id="editor"></div>
</div>

