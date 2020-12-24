<?php// require APPROOT . '/views/inc/header.php'; ?>
<?php //require APPROOT . '/views/inc/noticeindex.php'; ?>

<div class = "row">
    <div class = "col-md-6 mx-auto">
        <div class = "card card-body bg-light mt-5">
            <h2> Movies Similar to </h2>
            
            <p> Search Movie Names for recommendation </p>
            <form action ="<?php echo URLROOT; ?>/pages/search" method = "post">
                <div class ="form-group">
                    <input type = "text" name = "searchTerm"  class="form-control form-control-lg <?php echo (!empty($data['searchTerm_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['searchTerm']; ?>">
                    <span class="invalid-feedback"><?php echo $data['searchTerm_err']; ?></span>                    
                </div>
              
                <div class = "row">
                    <div class = "col">
                        <input type = "submit" value = "Submit" class = "btn btn-success btn-block">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<?php 
    if(isset($data['movieObj']) && !empty($data['movieObj'])){
        foreach($data['movieObj'] as $obj){
?>
<div class = "row">
    <div class = "col-md-12 mx-auto">
        <div class = "card card-body bg-light mt-5">
            <h3> <?php echo $obj->originalTitle; ?></h3><br>
            
            <div class="container">
                <div class="row">
                    <div class="col">
                        <img src = "<?php echo URLROOT; ?>/public/images/placeholder.jpg"> <br><br>
                            <button type="button" class="btn btn-secondary btn-md ml-4">Watch Trailer</button>
                    </div>
                    <div class="col-6">
                        <b>Genres:</b> <?php echo $obj->genres; ?> <br>
                        <b>Video Type:</b> <?php echo $obj->titleType; ?> <br>
                        <b>Release Year:</b> <?php echo $obj->startYear; ?> <br>
                        <b>RunTime(min):</b> <?php echo $obj->runtimeMinutes; ?> <br>
                        <b>isAdult:</b> <?php if($obj->isAdult == '0'){
                            echo "All Age";
                        }else{
                            echo "Age Restricted";
                        }  ?> <br>

                        <b>Description:</b> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra consequat sapien vitae ullamcorper. Nunc in auctor urna. Fusce tempor bibendum orci, eget suscipit purus egestas laoreet. Pellentesque metus augue, blandit in elit non, viverra ultricies erat. Donec iaculis risus ac ultrices ultrices. Sed dapibus, velit at condimentum rhoncus, ex libero facilisis mauris, sit amet egestas metus leo sit amet neque. Duis vitae iaculis magna. Sed accumsan laoreet congue.</p>
                    </div>
        
                    <div class="col">
                        <b> Imbd Rating: Coming Soon</b>
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
 




<?php// require APPROOT . '/views/inc/footer.php'; ?>

