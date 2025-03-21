<div class ="container">
    <?php if ($this->session->flashdata('erro')): ?>
        <div class="alert alert-danger text-center" role="alert"  ><?= $this->session->flashdata('erro'); ?></div>
    <?php elseif ($this->session->flashdata('logado')): ?>
        <div class="alert alert-warning text-center" role="alert"  ><?= $this->session->flashdata('logado'); ?></div>
    <?php elseif ($this->session->flashdata('acerto')): ?>
       
        <div class="alert alert-success text-center" role="alert"   ><?= $this->session->flashdata('acerto'); ?></div>
    <?php endif; ?>

</div>