<?php

    class AdminController
    {
        public function index()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('admin.html');
            
            $objPostagens = Postagem::retornaPostagens();

            $parametros = array();
            $parametros['postagens'] = $objPostagens;

            $conteudo = $template->render($parametros);
            echo $conteudo;
        }

        public function create()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('create.html');
            
            $parametros = array();

            $conteudo = $template->render($parametros);
            echo $conteudo;
        }

        public function insert()
        {
            try{
                Postagem::insert($_POST);

                echo '<script>alert("Publicação inserida com sucesso!")</script>';
                echo '<script>location.href="?pagina=admin&metodo=index"</script>';
            } catch(Exception $e) {
                echo '<script>alert("'.$e->getMessage().'")</script>';
                echo '<script>location.href="?pagina=admin&metodo=create"</script>';
            }
        }

        public function alterar($paramId)
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('update.html');

            $post = Postagem::retornaPostId($paramId);

            $parametros = array();
            $parametros['id'] = $post->id;
            $parametros['titulo'] = $post->titulo;
            $parametros['mensagem'] = $post->conteudo;


            $conteudo = $template->render($parametros);
            echo $conteudo;
        }

        public function update()
        {
            try {
                Postagem::update($_POST);

                echo '<script>alert("Publicação alterada com sucesso!")</script>';
                echo '<script>location.href="?pagina=admin&metodo=index"</script>';

            } catch (Exception $e) {

                echo '<script>alert("'.$e->getMessage().'")</script>';
                echo '<script>location.href="?pagina=admin&metodo=alterar&id='.$_POST['id'].'"</script>';
            }

            //var_dump($_POST);
            Postagem::update($_POST);

        }

        public function deletar($paramId)
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('delete.html');

            $post = Postagem::retornaPostId($paramId);

            $parametros = array();
            $parametros['id'] = $post->id;
            $parametros['titulo'] = $post->titulo;
            $parametros['mensagem'] = $post->conteudo;


            $conteudo = $template->render($parametros);
            echo $conteudo;
        }

        public function delete($paramId)
        {
            try {
                Postagem::delete($paramId);

                echo '<script>alert("Publicação DELETADA com sucesso!")</script>';
                echo '<script>location.href="?pagina=admin&metodo=index"</script>';

            } catch (Exception $e) {

                echo '<script>alert("FALHA AO DELETAR PUBLICAÇÃO: '.$e->getMessage().'")</script>';
                echo '<script>location.href="?pagina=admin&metodo=index"</script>';
            }

        }
    }