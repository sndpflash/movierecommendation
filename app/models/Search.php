<?php

    class Search{

        private $db;


        public function __construct(){
            $this->db = new Database;

        }

        //live search fetch movie
        public function liveFetchMovie($title){
            
            $this->db->query('SELECT * FROM moviedataset WHERE originalTitle LIKE :title');
            $this->db->bind(':title', "%".$title."%");
            $row=$this->db->resultSet();
            
            if($this->db->rowCount() > 0) {
               
                return $row;
            }
        }

        public function fetchAll(){
            require_once APPROOT . '/models/Movies.php';

            $this->db->query('SELECT * FROM moviedataset');
            $row = $this->db->resultSetClass("Movies");
            return $row;
        }

        //Suggest Movie

      

        public function fetchMovieobj($title){
            
            $this->db->query('SELECT * FROM moviedataset WHERE originalTitle = :title');
            $this->db->bind(':title', $title);
            $row = $this->db->single();



            if($this->db->rowCount() > 0) {

                $returnedTitleGenres = $row->genres;
                
              //  $moviesobj = $this->searchGenreFromReturnedTitleGenres($returnedTitleGenres);
                //array of classes
                //return $moviesobj;
                //var_dump($moviesobj);
                //return $moviesobj;

                return $returnedTitleGenres;
            }
            
        }

        public function searchGenreFromReturnedTitleGenres($returnedTitleGenres){
            require_once APPROOT . '/models/Movies.php';
            $this->db->query('SELECT * FROM moviedataset WHERE genres = :genres');
            $this->db->bind(':genres', $returnedTitleGenres);
            $row = $this->db->single;

            if($this->db->rowCount()>0){
                return $row;
            }
        }

    }







?>