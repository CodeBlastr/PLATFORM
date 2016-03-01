
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="text-center">
            <h1>Wholesale360</h1>
            <p>Your trial is fully featured and totally free for 30 days - no credit card required.
                Fill out the form below — you'll be ready to accept your first order in less than 5 minutes!</p>
        </div>
        <?=$this->Form->create('Signup') ?>
        <?=$this->Form->input('name', ['placeholder' => 'Your full name', 'class' => 'form-control']) ?>
        <?=$this->Form->input('email', ['placeholder' => 'Your email address (will also be your username)', 'class' => 'form-control']) ?>
        <?=$this->Form->input('password', ['placeholder' => 'Choose a secure password', 'div' => ['class' => 'input-group'], 'class' => 'form-control', 'type' => 'password']) ?>
        <hr>
        <?=$this->Form->input('company', ['placeholder' => 'Your company name', 'class' => 'form-control']) ?>

        <div class="form-group">
            <label for="subdomain">Sub domain <span class="glyphicon glyphicon-info-sign" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Tooltip on right"></span></label>
            <div class="input-group">
                <?=$this->Form->input('subdomain', ['class' => 'form-control', 'div' => false, 'label' => false]) ?>
                <span class="input-group-addon" id="basic-addon2">.wholesale360.co</span>
            </div>
        </div>


        <?=$this->Form->input('tos', ['label' => ['escape' => false, 'text' => '<span class="text-muted">I agree to the ' . $this->Html->link('Terms of Service', '/terms', ['escape' => false]) . '<span class="text-danger">*</span><span>'], 'type' => 'checkbox']) ?>

        <hr>

        <div class="text-center">
            <?=$this->Form->button('All set, create my FREE account!', ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>
