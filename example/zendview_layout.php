<?php

use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\View;
use Zend\View\ViewEvent;

include __DIR__ . '/../bootstrap.php';

// configuration
$resolver = new TemplatePathStack(array(
    'script_paths' => array('view')
));
$phpRenderer = new PhpRenderer();
$phpRenderer->setResolver($resolver);

$view = new View();
$view->getEventManager()
    ->attach(ViewEvent::EVENT_RENDERER, function () use ($phpRenderer) {
        return $phpRenderer;
    });

// example usage
$viewModel = new ViewModel(array('userName' => 'John Doe'));
$viewModel->setTemplate('index.phtml');

$layout = new ViewModel();
$layout->setTemplate('layout.phtml');
$layout->addChild($viewModel);

$layout->setOption('has_parent', true);
echo $view->render($layout);