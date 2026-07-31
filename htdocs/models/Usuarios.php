<?php
    class Usuarios extends Model{

        public function comprobarLogin($email,$pass){

            if(strlen($email)>150) throw new ValidacionException('El email introducido supera el limite de caracteres permitidos.');
            if(strlen($email)<6) throw new ValidacionException('El email introducido es demaciado corto.');
            if(strlen($pass)>30) throw new ValidacionException('La contraseña introducida supera el limite de caracteres permitidos.');
            if(strlen($pass)<5) throw new ValidacionException('La contraseña introducida es demaciado corta.');
            $email=$this->db->escapeString($email);
            $pass=$this->db->escapeString($pass);

            $this->db->query("SELECT * FROM usuarios
                                WHERE email = '$email' AND
                                contrasenia = SHA1('$pass')");
            if($this->db->numRows()==1){
                return $this->db->fetch();
            }else{
                return false;
            }
        }   
        
        public function updatePass($id,$newPass,$actualPass){
            if(!ctype_digit($id))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($id<=0) throw new ValidacionException("Usuario inexistente.");
            $this->db->query("SELECT contrasenia FROM usuarios WHERE id_usuario = $id");
    		
            if($this->db->numRows()!=1) throw new ValidacionException("Error interno: La consulta no devuelve una fila.");
            if(strlen($newPass)<5) throw new ValidacionException("La nueva contraseña es demaciado corta.");
            if(strlen($newPass)>30) throw new ValidacionException("La nueva contraseña es demaciado larga.");
            $newPass = $this->db->escapeString($newPass);
			
            $us = $this->db->fetch();
    		if ($us['contrasenia'] !== sha1($actualPass)) {
        		throw new ValidacionException("La contraseña actual es incorrecta.");
    		}
            
            $this->db->query("UPDATE usuarios
                                SET contrasenia = SHA1('$newPass')
                                WHERE id_usuario = '$id'");
        }

        public function crearUsuario($nombre, $email, $pass){
            if(strlen($nombre)>60) throw new ValidacionException("El nombre es demaciado largo.");
            if(strlen($nombre)<3) throw new ValidacionException("El nombre es demaciado corto.");
            if(strlen($email)>150) throw new ValidacionException("El email es demaciado largo.");
            if(strlen($email)<6) throw new ValidacionException("El email es demaciado corto.");
            if(strlen($pass)>30) throw new ValidacionException("La contraseña es demaciado larga.");
            if(strlen($pass)<5) throw new ValidacionException("La contraseña es demaciado corta.");
            $nombre = $this->db->escapeString($nombre);
            $email = $this->db->escapeString($email);
            $pass = $this->db->escapeString($pass);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new ValidacionException("El email no es valido.");

            $this->db->query("SELECT id_usuario FROM usuarios WHERE email='$email'");
            if($this->db->numRows()==1)throw new ValidacionException("El email ya se encuentra registrado.");

            $this->db->query("SELECT id_usuario FROM usuarios WHERE nombre='$nombre'");
            if($this->db->numRows()==1)throw new ValidacionException("El usuario ya se encuentra registrado.");

            $this->db->query("INSERT INTO usuarios (nombre, email, contrasenia, tipo_usuario)
                                VALUES ('$nombre', '$email' , SHA1('$pass'), 'User')");
        }

        public function getCompras($id_usuario){

            if(!ctype_digit($id_usuario))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($id_usuario<=0) throw new ValidacionException("Usuario inexistente");
            $this->db->query("SELECT id_usuario FROM usuarios WHERE id_usuario=$id_usuario");
            if($this->db->numRows()!=1)throw new ValidacionException("Error interno: La consulta no devuelve una fila.");

            $this->db->query("  SELECT * FROM juegos j
                                JOIN compras_juego cj ON cj.id_juego = j.id_juego
                                WHERE cj.id_usuario = $id_usuario");
            if($this->db->numRows()>=1)
                return $this->db->fetchAll();
            else{
                return 0;
            }    
        }
        
        function addToWishlist($id_usuario, $id_producto, $tipo_producto){

            if($tipo_producto!='juego' && $tipo_producto!='expansion')throw new ValidacionException("El producto no es valido.");

            if(!ctype_digit($id_usuario))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            $this->db->query("SELECT id_usuario FROM usuarios WHERE id_usuario=$id_usuario");
            if($this->db->numRows()!=1)throw new ValidacionException("Error interno: La consulta no devuelve una fila.");
            
            if($tipo_producto=='juego'){
                if(!ctype_digit($id_producto))throw new ValidacionException("El ID de producto contiene caracteres no permitidos.");
                $this->db->query("SELECT * FROM juegos WHERE id_juego=$id_producto");
                if($this->db->numRows()!=1)throw new ValidacionException("Error interno: La consulta no devuelve una fila.");

                $this->db->query("SELECT id_juego FROM juegos_wishlist WHERE id_usuario=$id_usuario AND id_juego=$id_producto");
                if($this->db->numRows())throw new ValidacionException("El juego ya se encontraba en la wishlist");
                
                $this->db->query("INSERT INTO juegos_wishlist (id_juego, id_usuario) VALUES ($id_producto, $id_usuario)");
            }
            if($tipo_producto=='expansion'){
                if(!ctype_digit($id_producto))throw new ValidacionException("El ID de producto contiene caracteres no permitidos.");
                $this->db->query("SELECT * FROM expansiones WHERE id_expansion=$id_producto");
                if($this->db->numRows()!=1)throw new ValidacionException("Error interno: La consulta no devuelve una fila.");

                $this->db->query("SELECT id_expansion FROM expansiones_wishlist WHERE id_usuario=$id_usuario AND id_expansion=$id_producto");
                if($this->db->numRows())throw new ValidacionException("La expansion ya se encontraba en la wishlist");

                $this->db->query("INSERT INTO expansiones_wishlist (id_expansion, id_usuario) VALUES ($id_producto, $id_usuario)");
            }
        }
        function removeFromWishlist($id_usuario, $id_producto, $tipo_producto){

            if($tipo_producto!='juego' && $tipo_producto!='expansion')throw new ValidacionException("El producto no es valido.");

            if(!ctype_digit($id_usuario))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            $this->db->query("SELECT id_usuario FROM usuarios WHERE id_usuario=$id_usuario");
            if($this->db->numRows()!=1)throw new ValidacionException();

            if($tipo_producto=='juego'){
                if(!ctype_digit($id_producto))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
                $this->db->query("SELECT * FROM juegos WHERE id_juego=$id_producto");
                if($this->db->numRows()!=1)throw new ValidacionException("Error interno: La consulta no devuelve una fila.");
                
                $this->db->query("SELECT id_juego FROM juegos_wishlist WHERE id_usuario=$id_usuario AND id_juego=$id_producto");
                if($this->db->numRows()!=1)throw new ValidacionException("Error interno: La consulta no devuelve una fila.");

                $this->db->query("DELETE FROM juegos_wishlist WHERE id_usuario=$id_usuario AND id_juego=$id_producto");
            }
            if($tipo_producto=='expansion'){
                if(!ctype_digit($id_producto))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
                $this->db->query("SELECT * FROM expansiones WHERE id_expansion=$id_producto");
                if($this->db->numRows()!=1)throw new ValidacionException("Error interno: La consulta no devuelve una fila.");

                $this->db->query("SELECT id_expansion FROM expansiones_wishlist WHERE id_usuario=$id_usuario AND id_expansion=$id_producto");
                if($this->db->numRows()!=1)throw new ValidacionException("Error interno: La consulta no devuelve una fila.");

                $this->db->query("DELETE FROM expansiones_wishlist WHERE id_usuario=$id_usuario AND id_expansion=$id_producto");
            }
        }

        public function getComprasTotales($id_usuario){

            if(!ctype_digit($id_usuario))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            $this->db->query("SELECT id_usuario FROM usuarios WHERE id_usuario=$id_usuario");
            if($this->db->numRows()!=1)throw new ValidacionException("Error interno: La consulta no devuelve una fila.");

            $this->db->query("SELECT 'juego' AS tipo,j.id_juego AS id_producto,j.nombre,cj.id_usuario,j.precio 
                              FROM compras_juego cj 
                              LEFT JOIN juegos j ON cj.id_juego=j.id_juego 
                              WHERE cj.id_usuario=$id_usuario
                            UNION
                              SELECT 'expansion' AS tipo,e.id_expansion AS id_producto,e.nombre,ce.id_usuario,e.precio  
                              FROM compras_expansion ce 
                              LEFT JOIN expansiones e ON ce.id_expansion=e.id_expansion 
                              WHERE ce.id_usuario=$id_usuario
                            ORDER BY nombre");

            return $this->db->fetchAll();
        }

        public function getWishlist($id_usuario){

            if(!ctype_digit($id_usuario))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($id_usuario <= 0) throw new ValidacionException("Usuario inexistente");
            $this->db->query("SELECT id_usuario FROM usuarios WHERE id_usuario=$id_usuario");
            if($this->db->numRows()!=1)throw new ValidacionException("Error interno: La consulta no devuelve una fila.");

            $this->db->query("SELECT 'juego' AS tipo,j.id_juego AS id_producto,j.nombre,jw.id_usuario,j.precio 
                              FROM juegos_wishlist jw 
                              LEFT JOIN juegos j ON jw.id_juego=j.id_juego 
                              WHERE jw.id_usuario=$id_usuario
                            UNION
                              SELECT 'expansion' AS tipo,e.id_expansion AS id_producto,e.nombre,ew.id_usuario,e.precio  
                              FROM expansiones_wishlist ew
                              LEFT JOIN expansiones e ON ew.id_expansion=e.id_expansion 
                              WHERE ew.id_usuario=$id_usuario
                            ORDER BY nombre");

            return $this->db->fetchAll();
        }
        
        public function comprobarJuegoWhishlist($idUser, $idJuego){
            if(!ctype_digit($idUser))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($idUser <= 0) throw new ValidacionException("Usuario inexistente");
            if(!ctype_digit($idJuego))throw new ValidacionException("El ID de juego contiene caracteres no permitidos.");
            if($idJuego <= 0) throw new ValidacionException("Juego inexistente");
            $this->db->query("  SELECT * FROM juegos_wishlist jw 
                                WHERE jw.id_usuario = $idUser AND jw.id_juego = $idJuego;");
            
            return $this->db->numRows();
        }
        public function comprobarExpansionWhishlist($idUser, $idExpansion){
            if(!ctype_digit($idUser))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($idUser <= 0) throw new ValidacionException("Usuario inexistente");
            if(!ctype_digit($idExpansion))throw new ValidacionException("El ID de expansion contiene caracteres no permitidos.");
            if($idExpansion <= 0) throw new ValidacionException("Expansion inexistente");
            $this->db->query("  SELECT * FROM expansiones_wishlist jw 
                                WHERE jw.id_usuario = $idUser AND jw.id_expansion = $idExpansion;");
            
            return $this->db->numRows();
        }

        public function comprobarJuegoComprado($idUser, $idJuego){
            if(!ctype_digit($idUser))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($idUser <= 0) throw new ValidacionException("Usuario inexistente");
            if(!ctype_digit($idJuego))throw new ValidacionException("El ID de juego contiene caracteres no permitidos.");
            if($idJuego <= 0) throw new ValidacionException("Juego inexistente");
            $this->db->query("  SELECT * FROM compras_juego cj 
                                WHERE cj.id_usuario = $idUser AND cj.id_juego = $idJuego;");
            
            return $this->db->numRows();
        }

        public function comprobarExpansionComprado($idUser, $idExpansion){
            if(!ctype_digit($idUser))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($idUser <= 0) throw new ValidacionException("Usuario inexistente");
            if(!ctype_digit($idExpansion))throw new ValidacionException("El ID de expansion contiene caracteres no permitidos.");
            if($idExpansion <= 0) throw new ValidacionException("Expansion inexistente");
            $this->db->query("  SELECT * FROM compras_expansion cj 
                                WHERE cj.id_usuario = $idUser AND cj.id_expansion = $idExpansion;");
            
            return $this->db->numRows();
        }
        
        public function comprarJuego($id_juego,$id_usuario){
            if(!ctype_digit($id_usuario))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($id_usuario <= 0) throw new ValidacionException("Usuario inexistente");
            if(!ctype_digit($id_juego))throw new ValidacionException("El ID de juego contiene caracteres no permitidos.");
            if($id_juego <= 0) throw new ValidacionException("Juego inexistente");
            $this->db->query("INSERT INTO compras_juego (id_juego, id_usuario)
                                VALUES($id_juego, $id_usuario)");
        }
        
        
        public function comprarExpansion($id_expansion,$id_usuario){
            if(!ctype_digit($id_usuario))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($id_usuario <= 0) throw new ValidacionException("Usuario inexistente");
            if(!ctype_digit($id_expansion))throw new ValidacionException("El ID de expansion contiene caracteres no permitidos.");
            if($id_expansion <= 0) throw new ValidacionException("Expansion inexistente");
            $this->db->query("INSERT INTO compras_expansion (id_expansion, id_usuario)
                                VALUES($id_expansion, $id_usuario)");
        }

        public function getUsuario($idUsu){
            if(!ctype_digit($idUsu))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($idUsu <= 0) throw new ValidacionException("Usuario inexistente");
            $this->db->query("SELECT * FROM usuarios u
                            WHERE u.id_usuario = $idUsu
                            LIMIT 1");
            return $this->db->fetchAll();
        }

        public function comprobarJuegoCarrito($idUsu, $idJuego){
            if(!ctype_digit($idUsu))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($idUsu <= 0) throw new ValidacionException("Usuario inexistente");
            if(!ctype_digit($idJuego))throw new ValidacionException("El ID de juego contiene caracteres no permitidos.");
            if($idJuego <= 0) throw new ValidacionException("Juego inexistente");
            $this->db->query("  SELECT * FROM carrito_juego c 
                                WHERE c.id_usuario = $idUsu AND c.id_juego = $idJuego");
            return $this->db->numRows();
        }

        public function agregarJuegoCarrito($idUsu, $idJuego){
            if(!ctype_digit($idUsu))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($idUsu <= 0) throw new ValidacionException("Usuario inexistente");
            if(!ctype_digit($idJuego))throw new ValidacionException("El ID de juego contiene caracteres no permitidos.");
            if($idJuego <= 0) throw new ValidacionException("Juego inexistente");
            $this->db->query("  INSERT INTO carrito_juego (id_usuario, id_juego)
                                VALUES($idUsu, $idJuego)");
        }

        public function quitarJuegoCarrito($idUsu, $idJuego){
            if(!ctype_digit($idUsu))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($idUsu <= 0) throw new ValidacionException("Usuario inexistente");
            if(!ctype_digit($idJuego))throw new ValidacionException("El ID de juego contiene caracteres no permitidos.");
            if($idJuego <= 0) throw new ValidacionException("Juego inexistente");
            $this->db->query("  DELETE FROM carrito_juego
                                WHERE id_usuario = $idUsu AND id_juego = $idJuego");
        }

        public function getCarritoJuego($idUsu){
            if(!ctype_digit($idUsu))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($idUsu <= 0) throw new ValidacionException("Usuario inexistente");
            $this->db->query("  SELECT * FROM carrito_juego c
                                JOIN juegos j ON j.id_juego = c.id_juego
                                WHERE c.id_usuario = $idUsu");
            if($this->db->numRows()!=0)
                return $this->db->fetchAll();
            else
                return 0;
        }
        public function comprobarExpansionCarrito($idUsu, $idExpansion){
            if(!ctype_digit($idUsu))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($idUsu <= 0) throw new ValidacionException("Usuario inexistente");
            if(!ctype_digit($idExpansion))throw new ValidacionException("El ID de expansion contiene caracteres no permitidos.");
            if($idExpansion <= 0) throw new ValidacionException("Expansion inexistente");
            $this->db->query("  SELECT * FROM carrito_expansion c 
                                WHERE c.id_usuario = $idUsu AND c.id_expansion = $idExpansion");
            return $this->db->numRows();
        }

        public function agregarExpansionCarrito($idUsu, $idExpansion){
            if(!ctype_digit($idUsu))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($idUsu <= 0) throw new ValidacionException("Usuario inexistente");
            if(!ctype_digit($idExpansion))throw new ValidacionException("El ID de expansion contiene caracteres no permitidos.");
            if($idExpansion <= 0) throw new ValidacionException("Expansion inexistente");
            $this->db->query("  INSERT INTO carrito_expansion (id_usuario, id_expansion)
                                VALUES($idUsu, $idExpansion)");
        }

        public function quitarExpansionCarrito($idUsu, $idExpansion){
            if(!ctype_digit($idUsu))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($idUsu <= 0) throw new ValidacionException("Usuario inexistente");
            if(!ctype_digit($idExpansion))throw new ValidacionException("El ID de expansion contiene caracteres no permitidos.");
            if($idExpansion <= 0) throw new ValidacionException("Expansion inexistente");
            $this->db->query("  DELETE FROM carrito_expansion
                                WHERE id_usuario = $idUsu AND id_expansion = $idExpansion");
        }

        public function getCarritoExpansion($idUsu){
            if(!ctype_digit($idUsu))throw new ValidacionException("El ID de usuario contiene caracteres no permitidos.");
            if($idUsu <= 0) throw new ValidacionException("Usuario inexistente");
            $this->db->query("  SELECT * FROM carrito_expansion c
                                JOIN expansiones e ON e.id_expansion = c.id_expansion
                                WHERE c.id_usuario = $idUsu");
            if($this->db->numRows()!=0)
                return $this->db->fetchAll();
            else
                return 0;
        }     
    }
?>