 

<div id='cssmenu'   >
    <ul class="pull-right">
        <li><a href='<?= base_url('Sistema/inicio'); ?>'>Início</a></li>


        <li><a href='<?= base_url('Estoque/retirada'); ?>'><span class="glyphicon glyphicon-sort"></span> Retirada</a></li>
        <li><a href='<?= base_url('Produto/listar'); ?>'><span class="glyphicon glyphicon-barcode"></span> Produtos</a></li>
        <li><a href='<?= base_url('Voluntario/listar'); ?>'><span class="glyphicon glyphicon-globe"></span> Voluntários</a></li>
        <li><a href='<?= base_url('usuario/listar'); ?>'><span class="glyphicon glyphicon-user"></span> Usuários</a></li>
        <li><a href='<?= base_url('estoque/listar'); ?>'><span class="glyphicon glyphicon-equalizer"></span> Estoque</a></li>



        <li class='  has-sub'><a href='#'><span class="glyphicon glyphicon-signal"></span> Relatório</a>
            <ul>
                <li><a href='<?= base_url('estoque/demonstrativo'); ?>'>Estoque</a></li>
                <li><a href='<?= base_url('estoque/pesquisa'); ?>'>Retiradas por Períodos</a></li>
                <li><a href='<?= base_url('relatorio/relatorioMensal'); ?>'>Quantitativo Diário/Mês</a></li>
                <li><a href='<?= base_url('relatorio/relatorioAnual'); ?>'>Quantitativo Anual</a></li>
                <li><a href='<?= base_url('relatorio/historicoEntidades'); ?>'>Retiradas por Entidades</a></li>




            </ul>
        </li>
        
        
        <li></li>
        <li></li>
        <li class="pull-right"><a href="<?= base_url('login/logout') ?>"><span class="glyphicon glyphicon-off"></span> Sair</a></li>

    </ul>

</div> 


