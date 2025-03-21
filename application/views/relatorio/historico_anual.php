<div class="container">

    <fieldset>
        <legend>Quantitativo de Distribuição Anual do(a): <strong><?= $nomeProduto ?> - <?= $ano ?></strong>

        </legend>


        <div class="botoesHistoricoUsuario">
            <a href="<?= base_url('relatorio/relatorioAnual'); ?>" class="btn btn-success botaoNovoTelaUsuario"> <span
                    class="glyphicon glyphicon-arrow-left"></span> Voltar</a>

            <button id="btGerarPDFRelatorioAnual" class="btn btn-primary "><span
                    class="glyphicon glyphicon-print"></span> Imprimir
            </button>

        </div>
        <br>
        <div id="dadosImpressaoRelatorioAnual">

            <strong><?= $nomeProduto ?> - <?= $ano ?>  - Distribuídos <?=$geral?> itens</strong>

            <table id="tab_customers" class="table table-striped">
                <colgroup>
                    <col width="4%">
                    <col width="8%">
                    <col width="8%">
                    <col width="8%">
                    <col width="8%">
                    <col width="8%">
                    <col width="8%">
                    <col width="8%">
                    <col width="8%">
                    <col width="8%">
                    <col width="8%">
                    <col width="8%">
                    <col width="8%">


                </colgroup>
                <thead>
                <tr class='warning'>
                    <th>Dia</th>
                    <th><strong>Janeiro</strong></th>
                    <th><strong>Fevereiro</strong></th>
                    <th><strong>Março</strong></th>
                    <th><strong>Abril</strong></th>
                    <th><strong>Maio</strong></th>
                    <th><strong>Junho</strong></th>
                    <th><strong>Julho</strong></th>
                    <th><strong>Agosto</strong></th>
                    <th><strong>Setembro</strong></th>
                    <th><strong>Outubro</strong></th>
                    <th><strong>Novembro</strong></th>
                    <th><strong>Dezembro</strong></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td><strong>Total</strong></td>

                    <?php foreach ($total as $row): ?>
                        <td><center><strong><?= $row ?></strong></center></td>
                    <?php endforeach; ?>
                </tr>
                </tfoot>
                <tbody>

                <?php
                for ($i = 1; $i <= 31; $i++):?>
                    <tr>
                        <td><center><?= $i ?></center></td>
                        <?php for ($m = 1; $m <= 12; $m++): ?>
                            <td><center><?= $dados[$mes[$m]][$i]; ?></center></td>
                         <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
        </div>


    </fieldset>

</div>
<div id="editor"></div>
</div>

