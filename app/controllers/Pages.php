<?php

    class Pages extends Controller{

        public function __construct(){
            $this->searchModel = $this->model('Search');
        }

        public function index(){

            $data = ['title' => 'Welcome'];
           //Load Search
           $this->search();
          //  $this->genrestoarray();
           //$this->view('pages/index', $data);
           
        }

        public function about(){
            $data = ['title' => 'About'];
            $this->view('pages/about', $data);
        }

        public function search(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=['searchTerm'=>trim($_POST['searchTerm']), 'searchTerm_err' => '', 'movieTitle'=>'', 'movieObj'=>''];

                if(empty($data['searchTerm'])){
                    $data['searchTerm_err'] = "Please enter Search Term";
                }
     
                

                if(empty($data['searchTerm_err'])){
                    $customerSearchTitleGenre = $this->searchModel->fetchMovieobj($data['searchTerm']);
                    
                    $customerSearchTitleGenre = explode('|', $customerSearchTitleGenre);
                    
                    $movieobj = $this->searchModel->fetchAll();
                    foreach($movieobj as $obj){

                        $obj->genres = explode('|', $obj->genres);
                        
                        foreach($obj->genres as $genres){
                            
                            foreach($customerSearchTitleGenre as $searchTitleGenre){
                                if($genres == $searchTitleGenre){
                                    $obj->chance = $obj->chance + 1;
                                }
                            }
                            
                        }
                        
                    }

                
                    usort($movieobj, function($a, $b){
                    return strcmp($b->chance, $a->chance);
                    }); 

                    
                    /*foreach($movieobj as $obj){
                       
                        echo '<pre>', print_r($obj), '</pre>';
                    }

                    */
                    
                    $data['movieObj'] = $movieobj;
                    $this->view('pages/index', $data);


                }else{
                    //Load view with errors
                    $this->view('pages/index', $data);
                }

            }else{
                //Init data
                $data=['searchTerm' => '', 'searchTerm_err' => ''];


                $this->view('pages/index', $data);
            }
            
        }

        /*public function search(){

            //Check for POST
            if($_SERVER['REQUEST_METHOD']=='POST'){

                // die('submitted');
                //SAnitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                // INit data
                $data=['searchTerm'=>trim($_POST['searchTerm']), 'searchTerm_err' => '', 'movieTitle'=>'', 'movieObj'=>''];

                //Validate Data
                if(empty($data['searchTerm'])){
                    $data['searchTerm_err'] = "Please enter Search Term";
                }

                if(empty($data['searchTerm_err'])){
                   $movieobj = $this->searchModel->fetchMovieobj($data['searchTerm']);
                   
                   $data['movieObj'] = $movieobj;
                                 
                   //require_once APPROOT . '/models/Movies.php';
                  // $movies = new Movies();
                  // $data['movieTitle'] = $movieobj->originalTitle;

                   //print_r($movieobj);
                   //$data['movieTitle'] = $movieobj->genres;
                   $this->view('pages/index', $data);
                }else{
                    //Load view with errors
                    $this->view('pages/index', $data);
                }

            }else{
                //Init data
                $data=['searchTerm' => '', 'searchTerm_err' => ''];


                $this->view('pages/index', $data);
            }


        }
*/
        
    }



?>