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

        public function liveSearch(){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data=['liveSearchTerm'=>trim($_POST['name']), 'searchTerm_err' => '', 'returnedMovieTitle'=>''];
            if(strlen($data['liveSearchTerm'] )>= 2){
            $liveSearchMovieRequest = $this->searchModel->liveFetchMovie($data['liveSearchTerm']);
            $counter = 0;
            foreach($liveSearchMovieRequest as $obj){
                $counter = $counter + 1;
                if($counter < 5){
                  echo "<a href = ''> ";  echo $obj->originalTitle . "</a><br>";
                  
                }
            }
        }
            
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
                    //Returns the genre of the customer searched movie title
                    $customerSearchTitleGenre = $this->searchModel->fetchMovieobj($data['searchTerm']);
                    
                    if(!empty($customerSearchTitleGenre)){
                    //Breaks the genre into array eg. Action|Comedy {action, Comedy}
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
                    
                    $data['movieObj'] = $movieobj;
                    $this->view('pages/index', $data);

                }else{
                    $data['searchTerm_err'] = "No Movie Found";
                    $this->view('pages/index', $data);

                }


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

               
    }



?>