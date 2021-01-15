<?php

class Movies extends Controller{

    public function __construct(){
        $this->searchModel = $this->model('Search');
    }

    public function index(){

        $this->moviesList();  

       
    }

    public function moviesList($page=0){
        $data=['allmovies'=>'', 'searchTerm' => 'All Movies', 'pages'=>''];
        $moviesList = $this->searchModel->fetchAllMovies();
        $data['pages']=$page;
        $finalMovieList = array();
        $min=$page*20;
        $max=($page+1)*20;
        while($min<$max){
            $finalMovieList[] = $moviesList[$min];
            $min++;
        }
            
            


        
        
        $data['allmovies'] = $finalMovieList;
        $this->view('pages/movies', $data);

    }


}


?>