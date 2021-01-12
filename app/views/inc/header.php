<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/842bd56ec1.js" crossorigin="anonymous"></script>
    <link rel = "stylesheet" href = "<?php echo URLROOT;?>/css/style.css">
    <title>Similar Movies Like <?php echo $data['searchTerm']; ?> </title>
	<meta name="description" content="If you liked <?php echo $data['searchTerm']; ?> ,here are list of similar movies like <?php echo $data['searchTerm'];?> 
	you can watch. This list of curated movies recommendation helps you to save your time in finding similar movie.">
	<meta name="robots" content="index, follow" />

	<meta name="keywords" content="movies like <?php echo $data['searchTerm']; ?>, movies similar to <?php echo $data['searchTerm']; ?>, films like <?php echo $data['searchTerm']; ?>, <?php echo $data['searchTerm']; ?> related movies, <?php echo $data['searchTerm']; ?> similar movies"/>

    <?php require APPROOT .'/views/inc/navbar.php'; ?>
</head>
<body>
<div class = "container">
    
