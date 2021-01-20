<?php require APPROOT . '/views/inc/header2.php'; ?>

<div class="align-self-center mt-5">

<?php
if(!empty($data['successmsg'])){
echo "<div class='alert alert-success' role='alert'>";
    echo $data['successmsg'];
echo "</div>";
}
?>
<?php
if(!empty($data['errormsg'])){
echo "<div class='alert alert-danger' role='alert'>";
    echo $data['errormsg'];
echo "</div>";
}
?>

<form action="<?php echo URLROOT;?>/dashboard/addmovie" method="post">
    <div class="form-group">
        <!-- <label for="movieTitle">Movie Title</label> -->
        <ul class = "list-group">
            <li class="list-group-item active">Movie Title:</li>
        </ul>
        <input type="text" class="form-control" id="movieTitle" name ="movieTitle" value="<?php if(!empty($data['movieTitle'])){ echo $data['movieTitle'];}?>" placeholder="Enter Movie Title">
    </div>

    <div class="form-group">
        <!-- <label for="movieYear">Movie Year</label> -->
        <ul class = "list-group">
            <li class="list-group-item active">Movie Year:</li>
        </ul>

        <input type="text" class="form-control" value="<?php if(!empty($data['movieTitle'])){ echo $data['movieYear'];}?>" id="movieYear" name = "movieYear" placeholder="Enter Movie Year">
    </div>

    <div class ="form-group">
        <ul class = "list-group">
            <li class="list-group-item active">Search for Similar Movies</li>
        </ul>
        <input type = "text" placeholder="Search Movie Name"name = "chooseMovie" id = "chooseMovie" class="form-control">
    
        <div id = "liveSearchForChooseMovie"> 

        </div>
    
        <span class="invalid-feedback"><?php echo $data['searchTerm_err']; ?></span>   

    </div>


    <div class="form-group">
        <!-- <label for="selectedMovies">selectedMovies</label> -->
        <ul class = "list-group">
            <li class="list-group-item active">Selected Movies will Appear Here:</li>
        </ul>
        <select size="8" class="form-control" id="selectedMovies">
       
        </select>
    </div>
    
    <div class = "form-group">
    <ul class = "list-group">
      <li class="list-group-item active">Select Genres</li>
    </ul>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input ' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox1"value = "Action"> 
        <label class="form-check-label" for="inlineCheckbox1">Action</label>
    </div>

    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox2"value = "Adventure"> 
        <label class="form-check-label" for="inlineCheckbox2">Adventure</label>
    </div>

    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox3"value = "Children's"> 
        <label class="form-check-label" for="inlineCheckbox3">Children's</label>
    </div>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox4"value = "Comedy"> 
        <label class="form-check-label" for="inlineCheckbox4">Comedy</label>
    </div>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox5"value = "Crime"> 
        <label class="form-check-label" for="inlineCheckbox5">Crime</label>
    </div>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox6"value = "Documentary"> 
        <label class="form-check-label" for="inlineCheckbox6">Documentary</label>
    </div>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox7"value = "Drama"> 
        <label class="form-check-label" for="inlineCheckbox7">Drama</label>
    </div>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox8"value = "Animation"> 
        <label class="form-check-label" for="inlineCheckbox8">Animation</label>
    </div>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox9"value = "Animation"> 
        <label class="form-check-label" for="inlineCheckbox9">Animation</label>
    </div>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox10"value = "Film-Noir"> 
        <label class="form-check-label" for="inlineCheckbox10">Film-Noir</label>
    </div>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox11"value = "Horror"> 
        <label class="form-check-label" for="inlineCheckbox11">Horror</label>
    </div>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox12"value = "Mystery"> 
        <label class="form-check-label" for="inlineCheckbox12">Mystery</label>
    </div>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox13"value = "Romance"> 
        <label class="form-check-label" for="inlineCheckbox13">Romance</label>
    </div>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox14"value = "Sci-Fi"> 
        <label class="form-check-label" for="inlineCheckbox14">Sci-Fi</label>
    </div>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox15"value = "Thriller"> 
        <label class="form-check-label" for="inlineCheckbox15">Thriller</label>   
    </div>
    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox16"value = "War"> 
        <label class="form-check-label" for="inlineCheckbox16">War</label>   
    </div>

    <div class = "form-check form-check-inline" >
        <input class='form-check-input' type = 'checkbox' name = 'moviesGenre[]'id="inlineCheckbox17"value = "Western"> 
        <label class="form-check-label" for="inlineCheckbox17">Western</label>   
    </div>




    </div>
       
    <!-- <div class="form-group" id="tags" name = "tags">

    <select size='8' class='form-control' id = 'returnedtags'>

    </select>
    <input type ="button" onclick = "removeSelected();" value = "Remove Selected Item">

    </div> -->

    <div class = "form-group" id = "tags">
    <ul class = "list-group">
      <li class="list-group-item active">Select Related Tags</li>
    </ul>

    <div class = "form-check" id="returnedtags" name= "tags">

    </div>

    </div>


    
     <div class = "form-group">
     <button type="submit" name ="newMovie"class="btn btn-primary btn-lg">Submit</button>

     </div> 

     
       
    </form>     
    </div>



<?php require APPROOT . '/views/inc/footer.php'; ?>
