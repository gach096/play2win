<?php

Class Expansiones extends Model{

    public function getOnlyExpansion($id){
        if(!ctype_digit($id)) throw new ValidacionException('No es un numero'); //die("noes num");
        if($id<=0) throw new ValidacionException('id no valido'); //die("id invalido");
        $this->db->query("  SELECT * FROM expansiones e
                            JOIN generos_expansion ge ON e.id_expansion = ge.id_expansion 
                            JOIN generos g ON g.id_genero = ge.id_genero 
                            JOIN devs_expansion de ON e.id_expansion = de.id_expansion 
                            JOIN desarrolladores d ON de.id_dev = d.id_dev 
                            JOIN editores_expansion ee ON ee.id_expansion = e.id_expansion 
                            JOIN editores ed ON ee.id_editor = ed.id_editor 
                            WHERE e.id_juego = '$id' 
                            GROUP BY e.id_expansion
                            ");
        return $this->db->fetchAll();
    }
    
    public function getExpansionById($id){
        if(!ctype_digit($id)) throw new ValidacionException('No es un numero'); //die("noes num");
        if($id<=0) throw new ValidacionException('id no valido'); //die("id invalido");
        $this->db->query("  SELECT * FROM expansiones e 
                            JOIN generos_expansion ge ON e.id_expansion = ge.id_expansion
                            JOIN generos g ON g.id_genero = ge.id_genero
                            JOIN devs_expansion de ON e.id_expansion = de.id_expansion
                            JOIN desarrolladores d ON  de.id_dev = d.id_dev
                            JOIN editores_expansion ee ON ee.id_expansion = e.id_expansion
                            JOIN editores ed ON ee.id_editor = ed.id_editor
                            WHERE e.id_expansion = '$id';
                            ");
        return $this->db->fetchAll();
    }

    public function getGenerosById($id){
        if(!ctype_digit($id)) throw new ValidacionException('No es un numero'); //die("noes num");
        if($id<=0) throw new ValidacionException('id no valido'); //die("id invalido");
        $this->db->query("  SELECT g.nombre_genero FROM expansiones e 
                            JOIN generos_expansion ge ON ge.id_expansion = e.id_expansion
                            JOIN generos g ON ge.id_genero = g.id_genero
                            WHERE e.id_expansion = '$id'            
        ");
        return $this->db->fetchAll();
    }
}

//class ValidacionException extends Exception{}

?>