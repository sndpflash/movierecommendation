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

<div class = "row">

<?php
                        if(isset($data['movieObj']) && !empty($data['movieObj'])){

                        
                            foreach($data['movieObj'] as $obj){
                                echo $obj->originalTitle . "<br>";
    
                                
                            
                        }
                        }
                        ?>


</div>


<?php// require APPROOT . '/views/inc/footer.php'; ?>

