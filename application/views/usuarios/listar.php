<div class="container">

    <div  ng-controller="usuarioCtl">

        <?php if ($this->session->flashdata('erro')): ?>
            <div class="alert alert-danger text-center" role="alert" ><?= $this->session->flashdata('erro'); ?></div>
            <?php
        endif;
        if ($this->session->flashdata('acerto')):
            ?>
            <div class="alert alert-success text-center" role="alert" ><?= $this->session->flashdata('acerto'); ?></div>
        <?php endif; ?>


        <div class="pull-right">
            <a href="<?= base_url('usuario/cadastrar'); ?>" class="btn btn-primary botaoNovoTelaUsuario"> <span class="glyphicon glyphicon-plus"></span> NOVO</a>
        </div>

        <h2> Relação de Usuários </h2>  <br>

        <div ng-show="listar">
            <div class="row">
                <div class="col-md-2">Exibir:
                    <select ng-model="entryLimit" class="form-control">
                        <option>5</option>
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
                <div class="col-md-3">Filtro:
                    <input type="text"  ng-model="search" ng-change="filter()" placeholder="Filtrar" class="form-control" />
                </div>
                <div class="col-md-4" ng-show="!search">
                    <h5> {{ totalItems}} usuário(s) cadastrado(s) </h5>
                </div>
                <div class="col-md-4" ng-show="search">
                    <h5>Filtrados {{ filtered.length}} de {{ totalItems}} usuário(s)</h5>
                </div>
            </div>

            <br/>
            <div class="alert alert-danger text-center" ng-if="error" role="alert" >{{error}}</div>
            <div class="alert alert-success text-center" ng-if="success" role="alert" >{{success}}</div>

            <div class="row">

                <div class="col-md-12" ng-show="filteredItems > 0">
                    <table class="table table-striped table-bordered table-hover">


                        <thead>
                            <tr>
                                <th>Nome <a ng-click="sort_by('nome');"> <i class="glyphicon glyphicon-sort"></i></a></th>
                                <th class="hidden-xs"> CPF/CNPJ<a ng-click="sort_by('cpf');"> <i class="glyphicon glyphicon-sort"></i></a></th>
                                <th class="hidden-xs"> Telefone<a ng-click="sort_by('telefone');"> <i class="glyphicon glyphicon-sort"></i></a></th>
                                <th class="hidden-xs"> Cidade<a ng-click="sort_by('nomeCidade');"> <i class="glyphicon glyphicon-sort"></i></a></th>
                                <th class="hidden-xs"> Estado<a ng-click="sort_by('sigla');"> <i class="glyphicon glyphicon-sort"></i></a></th>
                                <th class="hidden-xs"> Resposável<a ng-click="sort_by('responsavel');"> <i class="glyphicon glyphicon-sort"></i></a></th>

                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="usuario in filtered = (list| filter:search | orderBy : predicate :reverse) | startFrom:(currentPage - 1) * entryLimit | limitTo:entryLimit" >

                                <td><a class="tooltipUsuario" 
                                       href="<?= base_url('usuario/editar') ?>/{{usuario.id}}"
                                       data-toggle="tooltip" 
                                       data-placement="top" 
                                       data-original-title="{{usurio.nome}}">
                                        {{usuario.nome.toUpperCase()}}
                                    </a>
                                </td>


                                <td class="hidden-xs">{{usuario.cpf}}</td>
                                <td class="hidden-xs">{{usuario.telefone}}</td>
                                <td class="hidden-xs">{{usuario.nomeCidade.toUpperCase()}}</td>
                                <td class="hidden-xs">{{usuario.sigla.toUpperCase()}}</td>
                                <td class="hidden-xs">{{usuario.responsavel.toUpperCase()}}</td>

                                <td>
                                    <a href="<?= base_url('usuario/editar') ?>/{{usuario.id}}" class="tooltipUsuario" data-toggle="tooltip" data-placement="top" data-original-title="Editar"><img class="imagemIcons" src="<?= base_url('assets/img/document_edit.png') ?>"</a>
                                    <a href="<?= base_url('usuario/historico') ?>/{{usuario.id}}" class="tooltipUsuario" data-toggle="tooltip" data-placement="top" data-original-title="Histórico" target="_blank"><img class="imagemIcons" src="<?= base_url('assets/img/mi_scare_report.png') ?>"</a>

                                    <?php if ($this->session->userdata('tipoVoluntario') == 1) { ?>
                                        <a href="#" ng-click="deletarUsuario(usuario)" class="tooltipUsuario" data-toggle="tooltip" data-placement="top" data-original-title="Excluir"><img class="imagemIcons" src="<?= base_url('assets/img/recyclebin.png') ?>"</a>

                                        <?php
                                    }
                                    ?>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12" ng-show="filteredItems == 0">
                    <div class="col-md-12">
                        <h4>Nenhum usuário encontrado</h4>
                    </div>
                </div>
                <div class="col-md-12" ng-show="filteredItems > 0">    
                    <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>

                </div>
            </div> <!--fim da row-->
        </div>



    </div><!-- fim controller -->



</div> 
