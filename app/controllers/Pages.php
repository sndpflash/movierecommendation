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
            if(!empty($liveSearchMovieRequest)){
                
            foreach($liveSearchMovieRequest as $obj){
                $counter = $counter + 1;
                
                if($counter < 5){
                  

                   ?>
                <a href = "#" onclick="return liveSearchTitle('<?php echo $obj->originalTitle; ?>');"> <?php echo $obj->originalTitle; ?><br> </a> <?php

                }
            }

        }else{
            $data['searchTerm_err'] = "No Movie Found";
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

                    //get the movieid from the database of user entered movie
                    
                    $movieId = $this->searchModel->fetchMovieIdFromGivenMovieTitle($data['searchTerm']);

                    if(!empty($movieId)){

                    //get tags that are in the movie id
                    $movieTags = $this->searchModel->fetchMovieTagsFromID($movieId->id);
                   
                    
                    //We have list of tags in the movie id of searched title, lets get movie id list based on the tags 
                    $listOfMovieIdObjectsWithSameTag = array();

                    foreach($movieTags as $tags){
                        $movieIdWithSameTags = $this->searchModel->fetchMovieIdRelatedToGivenTags($tags->tags);
                        $listOfMovieIdObjectsWithSameTag[] = $movieIdWithSameTags;    
                    }

                    

                    $listOfSingleMovieId = array();
                    foreach($listOfMovieIdObjectsWithSameTag as $obj){
                        foreach($obj as $singleMovieId){
                            $listOfSingleMovieId[]=$singleMovieId->id;
                        }   
                    }
                   
                    
                    $countReOccurance = array_count_values($listOfSingleMovieId);
                    arsort($countReOccurance);
                    
                    $finalMovieList = array();
                    $loopCount=0;
                    foreach($countReOccurance as $key => $value){
                        if($loopCount > 20){
                            break;
                        }
                        $finalMovies = $this->searchModel->fetchMovieById($key);
                        $finalMovieList[] = $finalMovies;
                        $loopCount++;
                    }

            
                  

                    $data['movieObj'] = $finalMovieList;
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