

<div class = "row">
    <div class = "col-md-6 mx-auto">
        <div class = "card card-body bg-light mt-5">
            <h2> Movies Similar to </h2>
            
            <p> Search Movie Names for recommendation </p>
            <form action="<?php echo URLROOT; ?>/Pages/search" method = "post" name = "mainSearch" id = "mainSearch">
                <div class ="form-group">
                    <input type = "text" name = "searchTerm" id = "search" class="form-control form-control-lg <?php echo (!empty($data['searchTerm_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['searchTerm']; ?>">
                    <div id = "livesearch"> 
                        
                     </div>
                    <span class="invalid-feedback"><?php echo $data['searchTerm_err']; ?></span>                    
                </div>
              
                <div class = "row">
                    <div class = "col">
                        <input type = "submit" name = 'searchSubmit' value = "Submit" class = "btn btn-success btn-block">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


<?php 
    if(isset($data['movieObj']) && !empty($data['movieObj'])){
       

        echo"<div class = 'searchHeadingContainer'>";
        echo "<h2 class= 'searchHeading'> Movies Like "; echo $data['searchTerm']."</h2>";
        echo"</div>";

        
        echo "<div class='alert alert-primary' role='alert'>";
        echo "<p> If you liked the movie "; echo $data['searchTerm'] .". The movies similar to "; echo $data['searchTerm'] ." are listed below: </p>";
        echo "</div>";
        foreach($data['movieObj'] as $obj){
            $movieTitle=$obj->originalTitle;
            $movieGenre = $obj->genres;
            $movieGenre = explode("|", $movieGenre);
            
            $re = "/\\(.*/"; 
           
            $filteredmovieTitle=preg_replace($re, "",$movieTitle);
            $filteredmovieTitle=preg_replace('/^([^,]*).*$/', '$1', $filteredmovieTitle);

            $movieFilteredSpace = preg_replace('/[[:space:]]+/', '-', $obj->originalTitle);
            //Make API Request each loop

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
<div class = "row">
    <div class = "col-md-12 mx-auto">
    
        <div class = "card card-body bg-light mt-5">
            <h3><a href="<?php echo URLROOT; ?>/pages/search/<?php echo $movieFilteredSpace; ?>"> <?php echo $obj->originalTitle; ?></a></h3><br>
            
            <div class="container">
                <div class="row">
                    <div class="col">
                        <img src = "<?php echo $image; ?> "><br><br>
                            <button type="button" class="btn btn-secondary btn-md ml-4">Watch Trailer</button>
                    </div>
                    <div class="col-6">
                        <b>Genres:</b> <?php
                         foreach($movieGenre as $genres){
                            echo $genres . ", "; 
                        }?> <br>
                        <b>Year:</b> <?php echo $year; ?> <br>
                        <b>Rated:</b> <?php echo $rated; ?> <br>
                        <b>RunTime(min):</b> <?php echo $runtime;?> <br>
                        <b>Director:</b> <?php echo $director;  ?> <br>

                        <b>Description:</b> <p><?php echo $plot; ?></p>
                    </div>
        
                    <div class="col">
                        <b> Imbd Rating: <?php echo $imbdrating; ?></b><br>
                        <b> Vote: Coming Soon </b>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
        }
    }
?>
 




