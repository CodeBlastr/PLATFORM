<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Wholesale360 Signup
    </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
    <section class="container clearfix">

        <?= $this->Flash->render() ?>
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
    </section>
    <footer>
    </footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>
</html>