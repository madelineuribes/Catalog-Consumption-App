<?php
    function deleteBook() {
        //Get book id
        $id = $_POST['id'];

        //API Url
        $url = "http://localhost/book_catalog/v1/books/$id";

        //Initiate cURL.    
        $ch = curl_init($url);

        //Set the CURLOPT_RETURNTRANSFER option to true
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //Tell cURL that we want to send a DELETE request
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

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
        <a href="../components/update-form.php"><button role="button" class="btn btn-light">Update Book</button></a>
        <button role="button" class="btn btn-info">Delete Book</button>
</div>

<div id="addForm" class="tabcontent">
<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <form action="delete-form.php" method="POST">
                <div class="form-group">
                    <label for="id">Book ID</label>
                    <input type="text" name="id" id="id" class="form-control">
                </div>
                <input role="button" id="deletebtn" class="btn btn-info" type="submit" name="deletebtn" value="Delete">
            </form>
        </div>
        
        <div class="col-6">
            <table class="table text-xsmall">
            <tbody>
            <tr>
            <th scope='row'>Status</th>
            <?php 
                if(array_key_exists('deletebtn', $_POST)) { 
                    $json = deleteBook(); 
                    showResults($json);
                } 

                function showResults($json) {
                    echo"<td>" . $json["statusCode"] . "</td>";
                    if ($json["statusCode"] === 200) {
                        echo"<td> Book deleted </td>";
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