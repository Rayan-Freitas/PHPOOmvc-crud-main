<?php

    class Postagem
    {
        public static function retornaPostagens()
        {
            $con = Connection::getConn();
        
            $sql = "SELECT * FROM posts ORDER BY id DESC";
            $sql = $con->prepare($sql);
            $sql->execute();

            $resultado = array();

            while ($row = $sql->fetchObject('Postagem')){
                $resultado[] = $row;
            }

            if (!$resultado) {
                $erro = "Não foi encontrado nenhum registro no Banco de dados!";
                throw new Exception("Não foi encontrado nenhum registro no Banco de dados!");           
            }

            return $resultado;
        }

        public static function retornaPostId($idPost)
        {
            $con = Connection::getConn();

            $sql = "SELECT * FROM posts WHERE id = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();

            $resultado = $sql->fetchObject('Postagem');

            if (!$resultado) {
                throw new Exception("Não foi encontrado nenhum registro no Banco de dados!");         
            } else {
                $resultado->comentarios = Comentario::retornaComentarios($resultado->id);
            }
            
            return $resultado;

        }

        public static function insert($dadosPost)
        {
            if (empty($dadosPost['titulo']) or empty($dadosPost['mensagem'])) {
                throw new Exception("Preencha todos os campos!");
            
                return false;
            }

            $con = Connection::getConn();

            $sql = "INSERT INTO posts (titulo, conteudo) VALUES (:tit, :cont)";
            $sql = $con->prepare($sql);
            $sql->bindValue(':tit', $dadosPost['titulo']);
            $sql->bindValue(':cont', $dadosPost['mensagem']);
            $result = $sql->execute();

            if ($result == false) {
                throw new Exception("Falha ao inserir publicação!");
            
                return false;
            }

            return true;
        }

        public static function update($params)
        {
            $con = Connection::getConn();

            $sql = "UPDATE posts SET titulo = :tit, conteudo = :cont WHERE id = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':tit', $params['titulo']);
            $sql->bindValue(':cont', $params['conteudo']);
            $sql->bindValue(':id', $params['id']);
            
            $result = $sql->execute();

            if ($result == 0) {
                throw new Exception("Falha ao alterar a publicação!");

                return false;
            } 

            return true;
        }

        public static function delete($id)
        {
            $con = Connection::getConn();

            $sql = "DELETE FROM posts WHERE id = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $id);
            $result = $sql->execute();

            if ($result == 0) {
                throw new Exception("Falha ao deletar a publicação!");

                return false;
            } 

            return true;
        }
    }