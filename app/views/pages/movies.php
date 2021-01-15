<?php require APPROOT . '/views/inc/header.php'; ?>

<br>
<br>
<div class="alert alert-primary alert-dismissible fade show" role="alert">

<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    <h1> Browse all Movies and Search for Similar ones </h1>
    <p>Don't know what movies to search, use our exclusive list of all the movies and get the similar movies to watch. Just click on the title to search for similar movies.  </p>
</div>

<div class="container mt-3">
  <div class="row">
<?php
    
    foreach($data['allmovies'] as $obj){
                    //Make API Request each loop
        $movieTitle=$obj->originalTitle;

        $re = "/\\(.*/"; 

        $filteredmovieTitle=preg_replace($re, "",$movieTitle);
        $filteredmovieTitle=preg_replace('/^([^,]*).*$/', '$1', $filteredmovieTitle);

        $movieFilteredSpace = preg_replace('/[[:space:]]+/', '-', $obj->originalTitle);       
        $reqdataURL = 'http://www.omdbapi.com/?apikey=b5081197&t=' .urlencode($filteredmovieTitle).'&plot=full';
        $reqJson = file_get_contents($reqdataURL);
        $reqdataarray = json_decode($reqJson, true);

        $year = $reqdataarray['Year'];
        $rated = $reqdataarray['Rated'];
        $runtime=$reqdataarray['Runtime'];
        $director=$reqdataarray['Director'];
        $plot=$reqdataarray['Plot'];
        $imbdrating =$reqdataarray['imdbRating'];
        $image=$reqdataarray['Poster'];
        
        

?>


    <div class="col-4 border border-info text-center">
            <img class = "img-fluid mt-4" src = "<?php echo $image; ?> "><br><br>
            
            <a href="<?php echo URLROOT; ?>/pages/search/<?php echo $movieFilteredSpace; ?>"> <?php echo $obj->originalTitle; ?></a><br>

    </div>
    



<?php

    }


?>

  </div>
</div>

<div class="row justify-content-center mt-3">
<a class="btn btn-primary btn-lg active" role="button" aria-pressed="true" href="<?php echo URLROOT; ?>/movies/movieslist/<?php echo $data['pages'] +1; ?>"> Show More</a><br>

</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>