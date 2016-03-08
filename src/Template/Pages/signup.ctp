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

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="text-center">
                    <h1>Wholesale360</h1>
                    <p>Your trial is fully featured and totally free for 30 days - no credit card required.
                        Fill out the form below — you'll be ready to accept your first order in less than 5 minutes!</p>
                </div>

                <hr>

                <?= $this->Flash->render() ?>

                <?=$this->Form->create($user, ['data-toggle' => 'validator']) ?>
                    <?=$this->Form->input('name', ['placeholder' => 'Your full name', 'templateVars' => ['after' => '<span class="glyphicon form-control-feedback" aria-hidden="true"></span>'], 'class' => 'form-control', 'required' => true]) ?>
                    <?=$this->Form->input('username', ['placeholder' => 'Your email address (will also be your username)', 'label' => 'Email', 'templateVars' => ['after' => '<span class="glyphicon form-control-feedback" aria-hidden="true"></span>'], 'class' => 'form-control', 'type' => 'email']) ?>
                    <?=$this->Form->input('password', ['data-delay' => '20000', 'placeholder' => 'Choose a secure password',  'data-error' => 'Ah weak... how \'bout at least six characters, some numbers, and different cased letters. We are storing financial data here folks :)', 'templateVars' => ['after' => '<span class="glyphicon form-control-feedback" aria-hidden="true"></span>'],  'div' => ['class' => 'input-group'], 'pattern' => '^((?=.*[^a-zA-Z])(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{6,})$', 'title' => 'Please enter at least six characters, with capital, lowercase, and numeric characters.', 'class' => 'form-control', 'type' => 'password']) ?>
                    <hr>
                    <?=$this->Form->input('data.company', ['placeholder' => 'Your company name', 'templateVars' => ['after' => '<span class="glyphicon form-control-feedback" aria-hidden="true"></span>'], 'class' => 'form-control', 'required' => true]) ?>
                    <?=$this->Form->input('data.subdomain', ['templateVars' => ['before' => '<label for="subdomain">Sub domain <span class="glyphicon glyphicon-info-sign" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Tooltip on right"></span></label><div class="input-group">', 'after' => '<span class="input-group-addon">.wholesale360.co</span></div>'], 'label' => false, 'class' => 'form-control', 'required' => true]) ?>
                    <?=$this->Form->input('tos', ['label' => ['escape' => false, 'text' => '<span class="text-muted">I agree to the ' . $this->Html->link('Terms of Service', '/terms', ['escape' => false]) . '<span class="text-danger">*</span><span>'], 'type' => 'checkbox', 'required' => true]) ?>
                    <hr>
                    <?=$this->Form->button('All set, create my FREE account!', ['type' => 'submit', 'class' => 'btn btn-success btn-block']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </section>
    <footer>
    </footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="/js/bootstrap-validator.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>
</html>