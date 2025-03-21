<div class="container" ng-controller="RegistrationController">



    <form role="form" method="POST" action="<?= base_url('senha/cadastrar/' . $voluntario->id) ?>" name="registrationForm" novalidate >
        <fieldset>

            <legend>Cadastramento de Senha de <span class="nomeMaiusculoNegrito"><?= strtoupper($voluntario->nome) ?></span></legend>


            <p class="bg-info">Senha deve possuir no mínimo 8 caracteres e deve conter pelo menos uma letra 
                minúscula, uma letra maiúscula e um número </p>
            <br><br>

            <?php if ($this->session->flashdata('erro')): ?>
                <div class="alert alert-danger text-center" role="alert" ><?= $this->session->flashdata('erro'); ?></div>
            <?php endif;
            ?>  
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">
                        <label for = "password">Nova Senha</label>
                         <input type="password" name="password" class="form-control" ng-model="registration.user.password" required value = "<?= set_value('password') ?>"
                             ng-pattern="regex">
                        <div ng-messages="registrationForm.password.$error">
                            <div class="messages">
                                <div ng-message="required">Obrigatório</div>
                                <div ng-message="compareTo">Senha informada é diferente da informada antes</div>
                            </div>
                        </div>
                         <?= form_error('password');
                        ?>
                         <span ng-show="registrationForm.password.$error.pattern" class="messages">Fora do padrão das senhas</span>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 form-group">
                        <label for = "confirmPassword">Redigite a Senha</label>
                        <input type="password" name="confirmPassword" class="form-control" 
                               ng-model="registration.user.confirmPassword" 
                               required compare-to="registration.user.password" value = "<?= set_value('confirmPassword') ?>"
                                 ng-pattern="regex"/>
                        <div ng-messages="registrationForm.confirmPassword.$error" >
                            <div class="messages">
                                <div ng-message="required">Obrigatório</div>
                                <div ng-message="compareTo">Senha informada é diferente da informada antes</div>
                            </div>
                        </div>
                        <?= form_error('confirmPassword');
                        ?>
                          <span ng-show="registrationForm.confirmPassword.$error.pattern" class="messages">Fora do padrão das senhas</span>

                    </div>

                </div>  

            </div>

            <div class="pull-right">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> GRAVAR</button>
                <a href="<?= base_url('sistema/inicio') ?>" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> CANCELAR</a>

            </div>
        </fieldset>

    </form>



</div>