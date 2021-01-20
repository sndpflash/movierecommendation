<?php


class Upload{

    private $db;


    public function __construct(){
        $this->db = new Database;

    }


    public function insertNewMovie($data){
        $this->db->query('INSERT INTO `moviedataset`(`originalTitle`, `genres`, `chance`) VALUES (:title, :genres, :chance)');
        $this->db->bind(':title', $data['fullTitle']);
        $this->db->bind(':genres', $data['genres']);

        $this->db->bind(':chance', $data['chance']);

        if($this->db->execute()){
            return true;
          } else {
            return false;
          }


    }

    public function insertNewMoviesTag($data){
        $this->db->query('INSERT INTO `movietags`(`id`, `tags`) VALUES (:id, :tags)');
        $this->db->bind(':id', $data['movieId']);
        $this->db->bind(':tags', $data['tags']);

        if($this->db->execute()){
            return true;
          } else {
            return false;
          }


    }





}






?>