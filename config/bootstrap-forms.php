<?php
/**
 * Created to work with bootstrap 3 css
 * Also with bootstrap form validator js
 *
 */
return [
    // customized default templates
    'inputContainer' => '<div class="form-group has-feedback input {{type}}{{required}}">{{before}}{{content}}{{after}}<div class="help-block with-errors"></div></div>',
    'inputContainerError' => '<div class="input {{type}}{{required}} has-error">{{content}}{{error}}</div>',
    'label' => '<label class="control-label" {{attrs}}>{{text}}</label>',
    'error' => '<div class="help-block with-errors">{{content}}</div>',
    'errorList' => '<ul class="list-unstyled">{{content}}</ul>',
];