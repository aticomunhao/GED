 


<div class="container" ng-controller="loginCtl">

    <div class="row" id="pwd-container">
        <div class="col-md-4">

        </div>

        <div class="col-md-4">
            <section class="login-form">
                <form method="post" action="<?= base_url('login/logar') ?> " role="login">
                    <img src="<?= base_url('assets/img/logotipo.png') ?>" class="img-responsive" alt="" width="240" height="240" />
                    <h3 class="form-signin-heading form-text"><strong>GED</strong></h3>
                    <h4 class="form-signin-heading form-text"><strong> Gestão de Estoque e Distribuição</strong></h4>
                    <input type="text" name="cpf" ng-model="cpf" id="cpf" placeholder="CPF" ng-blur="validarCpf()" required class="form-control input-lg" />
                    <span class="text-warning" ng-show="exibirC">CPF Inválido</span>
                    <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Senha" required=""  />
                    <br>
                    
                    <?php  
                    if ($this->session->flashdata('erro')):
                        ?>
                        <div class="alert alert-danger text-center" role="alert" ng-show="mensagem"><?= $this->session->flashdata('erro'); ?></div>
                        <?php
                    elseif ($this->session->flashdata('logado')):
                        ?>
                        <div class="alert alert-warning text-center" role="alert"  ng-show="mensagem" ><?= $this->session->flashdata('logado'); ?></div>
                        <?php
                    endif;
                    ?>

                    <button type="submit" name="go" class="btn btn-lg btn-inverse btn-block btn-raised">Acessar</button>

                </form>


            </section>  
        </div>


    </div>




</div>