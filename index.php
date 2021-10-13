<?php
require_once 'app/Core/Core.php';
require_once 'app/Controller/HomeController.php';
require_once 'app/Controller/ErroController.php';
require_once 'app/Controller/PostController.php';
require_once 'app/Controller/SobreController.php';
require_once 'app/Model/Postagem.php';
require_once 'app/Model/Comentario.php';
require_once 'lib/Database/Connection.php';
require_once 'vendor/autoload.php';

$template = file_get_contents('app/template/estrutura.html');

ob_start();
    $core = new Core;
    $core->start($_GET);    //Iniciando função start e recuperando a URL do navegador, que passa por um processo de verificação pra ver se a página existe

    $conteudo = ob_get_contents();
ob_end_clean();

$templatePronto = str_replace('{{conteudo}}', $conteudo, $template);
echo $templatePronto;

echo $template;