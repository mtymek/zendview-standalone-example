<?php

use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\TemplatePathStack;

include __DIR__ . '/../bootstrap.php';

$resolver = new TemplatePathStack(array(
    'script_paths' => array('view')
));
$phpRenderer = new PhpRenderer();
$phpRenderer->setResolver($resolver);

$viewModel = new ViewModel(array('userName' => 'John Doe'));
$viewModel->setTemplate('index.phtml');

echo $phpRenderer->render($viewModel);