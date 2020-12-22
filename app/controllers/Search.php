<?php


    // class Search extends Controller{

    //     public function __construct(){

    //     }

    //     public function search(){
    //         //Check for POST
    //         if($_SERVER['REQUEST_METHOD']=='POST'){

    //             die('submitted');
    //             //SAnitize POST data
    //             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
    //             // INit data
    //             $data=['searchTerm'=>trim($_POST['searchTerm']), 'searchTerm_err' => ''];

    //             //Validate Data
    //             if(empty($data['searchTerm'])){
    //                 $data['searchTerm_err'] = "Please enter Search Term";
    //             }

    //             if(empty($data['searchTerm_err'])){
    //                 die('SUCESS');
    //             }else{
    //                 //Load view with errors
    //                 $this->view('pages/search', $data);
    //             }

    //         }else{
    //             //Init data
    //             $data=['searchTerm' => '', 'searchTerm_err' => ''];


    //             $this->view('pages/search', $data);
    //         }

        

    // }


    // }


?>