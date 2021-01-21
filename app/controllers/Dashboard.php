<?php

class Dashboard extends Controller{

    public function __construct(){
        if(!isset($_SESSION['user_id'])){
          redirect('users/login');
        }

        $this->dashboardModel = $this->model('Upload');
        $this->searchModel=$this->model('Search');
    }

    
    
    public function index(){


        $data=['movieTitle'=>'','fullTitle'=>'', 'genres'=>'', 'chance'=>'0','movieYear'=>'', 'successmsg'=>'', 'errormsg'=>'', 'movieId'=>'', 'tags'=>'', 'title'=>'Add New Movies'];
        
        
       $this->view('users/dashboard', $data);
    

       
    }

    public function liveSearchForChooseMovie(){
            
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data=['liveSearchTerm'=>trim($_POST['name']), 'searchTerm_err' => '', 'returnedMovieTitle'=>''];
        if(strlen($data['liveSearchTerm'] )>= 0){
        $liveSearchMovieRequest = $this->searchModel->liveFetchMovie($data['liveSearchTerm']);
        $counter = 0;
        if(!empty($liveSearchMovieRequest)){
        
        ?>
        <select id="selectLiveSearch" name="returnValueForLiveSearch" onchange ="loadMovies();"multiple >

        <?php
        foreach($liveSearchMovieRequest as $obj){
            $counter = $counter + 1;
            
            if($counter < 8){
                $movieFilteredSpace = preg_replace('/[[:space:]]+/', '-', $obj->originalTitle);

               ?>
               
               
                <option id = "returnValueForLiveSearch"  value="<?php echo $obj->originalTitle;  ?>"><?php echo $obj->originalTitle; ?> </br></option>

             <?php
            
            }
        }
?>
        </select>
<?php

    }else{
        $data['searchTerm_err'] = "No Movie Found";
    }
    }
        
    }

    public function getTags(){
        
        $movieid = $this->searchModel->fetchMovieIdFromGivenMovieTitle($_GET['movie']);
        $tags=$this->searchModel->fetchMovieTagsFromID($movieid->id);
        
        echo json_encode($tags);

        
      //  //Ajax call expecting html to be returned
      //  echo "<label for='returnedtags'>Tags</label>";
       // echo "<select size='8' class='form-control' id = 'returnedtags'>";
        
        //   if(!empty($tags)){
        //     foreach($tags as $obj){
        //        echo "<option>".$obj->tags."</option>";
        //     }

        // }
         
        //echo "</select>";
        

        

    }

    public function addMovie(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data=['movieTitle'=>'','fullTitle'=>'', 'genres'=>'', 'chance'=>'0','movieYear'=>'', 'successmsg'=>'', 'errormsg'=>'', 'movieId'=>'', 'tags'=>'', 'title'=>'Add New Movies'];

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // $movietitle = $_GET['movieTitle'];
            // $movieYear = $_GET['movieYear'];
            // $tags = $_GET['tags'];

           

            if(empty($_POST['movieTitle'])){
                $data['errormsg'] = 'Please enter Movie Title';
                $this->view('users/dashboard', $data);

            }else{
                $movietitle=$_POST['movieTitle'];
                $data['movieTitle'] = $movietitle;
            }

            if(empty($_POST['movieYear'])){
                $data['errormsg'] = 'Please enter Movie Year';
                $this->view('users/dashboard', $data);


            }else{
                $movieyear=$_POST['movieYear'];
                $data['movieYear'] = $movieyear;

            }

            if(empty($_POST['moviesGenre'])){
                $data['errormsg'] = 'Please select Movie Genre';
                $this->view('users/dashboard', $data);


            }else{
                $moviegenres=$_POST['moviesGenre'];
                $data['genres'] = $moviegenres;

            }

            if(empty($_POST['moviesTag'])){
                $data['errormsg'] = 'Please Select Movie Tags';
                $this->view('users/dashboard', $data);


            }else{
                $tags=$_POST['moviesTag'];
                $data['tags'] = $tags;


            }
            
            if(!empty($movietitle) && !empty($movieyear)){
            $fulltitle=$movietitle." (".$movieyear.")";
            }

            if(empty($data['errormsg'])){
                $attachedGenre="";

            foreach($moviegenres as $item){
                if(empty($attachedGenre)){
                $attachedGenre = $attachedGenre."$item";
                }else{
                  $attachedGenre= $attachedGenre."|"."$item";
                }
            }

            $data=['fullTitle'=> $fulltitle, 'genres'=>$attachedGenre, 'chance'=>'0'];

            if(!empty($data['fullTitle'] && $data['genres'])){

               $result =  $this->dashboardModel->insertNewMovie($data);
                if($result){
                    $data['successmsg'] = 'Movie Has been Added Successfully';
                }else{
                    $data['errormsg']='Make sure all the fields are filled properly';
                }

            }

            

            $newMovieid=$this->searchModel->fetchMovieIdFromGivenMovieTitle($data['fullTitle']);
            $data['movieId']=$newMovieid->id;

            if(!empty($data['movieId'])){
                
                foreach($tags as $item)
            {
                $data['tags'] = $item;
                 $result = $this->dashboardModel->insertNewMoviesTag($data);

                 if($result){
                    $data['successmsg'] = 'Movie Has been Added Successfully';
                    $this->view('users/dashboard', $data);

                }else{
                    $data['errormsg']='Make sure all the fields are filled properly';
                    $this->view('users/dashboard', $data);

                }
            }

            
            }
            
            
            
    }else{
        $this->view('users/dashboard', $data);
    }
}

else{
//no post request init data
    $data=['movieTitle'=>'','fullTitle'=>'', 'genres'=>'', 'chance'=>'0','movieYear'=>'', 'successmsg'=>'', 'errormsg'=>'', 'movieId'=>'', 'tags'=>'', 'title'=>'Add New Movies'];

    $this->view('users/dashboard', $data);
}



} 



}



?>