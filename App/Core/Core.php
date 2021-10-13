<?php

    class Core
    {
        public function start($urlGet) //Recebe url que o usuário está tentando acessar
        {

            if (isset($urlGet['metodo'])) {
                $acao = $urlGet['metodo'];
            } else {
                $acao = 'index';
            }

            if (isset($urlGet['pagina'])) {
                $controller = ucFirst($urlGet['pagina'].'Controller'); //Se tiver o parametro pagina na url, redirecionará o usuário para os controllers adequados
            }else {
                $controller = 'HomeController'; //Se não tiver o parametro 'pagina' redirecionará automaticamnte para a Home
            }

            if (!class_exists($controller)) {
                $controller = 'ErroController';
            }

            if (isset($urlGet['id']) && $urlGet['id'] != null) {
                $id = $urlGet['id'];
            }else {
                $id = null;
            }

            $teste = array();
            array_push($teste, $id);

            call_user_func_array(array(new $controller, $acao), $teste);
        }
    }