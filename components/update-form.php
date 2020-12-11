<?php
    function updateBook() {
        //Get book id
        $id = $_POST['id'];

        //API Url
        $url = "http://localhost/book_catalog/v1/books/$id";

        //The JSON data.
        $jsonData = array(
            'isbn' =>  $_POST['isbn'],
            'name' =>  $_POST['name'],
            'author' => $_POST['author']
        );

        //Initiate cURL.
        $ch = curl_init($url);

        //Encode the array into JSON.
        $jsonDataEncoded = json_encode($jsonData);

        //Set the CURLOPT_RETURNTRANSFER option to true
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //Tell cURL that we want to send a DELETE request
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");

        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

        //Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

        //Execute the request
        $result = curl_exec($ch);

        $json = json_decode($result, true);

        return $json;
    }   
?> 

<!-- Header Navigation -->
<?php include '../constants/header.php' ?>

<div class="container mt-5 col-12 d-flex justify-content-around">
        <a href="../components/get-table.php"><button role="button" class="btn btn-light">Get Books</button></a>
        <a href="../components/add-form.php"><button role="button" class="btn btn-light">Add Book</button></a>
        <button role="button" class="btn btn-info">Update Book</button>
        <a href="../components/delete-form.php"><button role="button" class="btn btn-light">Delete Book</button></a>
</div>

<div id="addForm" class="tabcontent">
<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <form action="update-form.php" method="POST">
                <div class="form-group">
                    <label for="id">Book ID</label>
                    <input type="text" name="id" id="id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" name="isbn" id="isbn" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" name="author" id="author" class="form-control">
                </div>
                <input role="button" id="updatebtn" class="btn btn-info" type="submit" name="updatebtn" value="Update">
            </form>
        </div>
        
        <div class="col-6">
            <table class="table text-xsmall">
            <tbody>
            <tr>
            <th scope='row'>Status</th>
            <?php 
                if(array_key_exists('updatebtn', $_POST)) { 
                    $json = updateBook(); 
                    showResults($json);
                } 

                function showResults($json) {
                    echo"<td>" . $json["statusCode"] . "</td>";
                    if ($json["statusCode"] === 200) {
                        echo"<td> Book updated </td>";
                    } else {
                        echo"<td> Error </td>";
                    }
                }
            ?>
            </tr>
            </tbody>
            </table>
        </div>
    </div>    
</div>
</div>

<!-- Footer -->
<?php include '../constants/footer.php' ?>