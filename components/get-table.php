<?php 
    // GET Books
    $url="http://localhost/book_catalog/v1/books";
    
    //Initiate cURL.
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,$url);
    $result=curl_exec($ch);

    $json = json_decode ($result, true);
?>
    
<!-- Header Navigation -->
<?php include '../constants/header.php' ?>

<div class="container mt-5 col-12 d-flex justify-content-around">
        <button role="button" class="btn btn-info">Get Books</button>
        <a href="../components/add-form.php"><button role="button" class="btn btn-light">Add Book</button></a>
        <a href="../components/update-form.php"><button role="button" class="btn btn-light">Update Book</button></a>
        <a href="../components/delete-form.php"><button role="button" class="btn btn-light">Delete Book</button></a>
</div>

<!-- Book Table -->
<div class="container mt-5">
    <div id="dataTable" class=" container table-responsive tabcontent">
            
        <table class="table table-bordered text-xsmall">
            <thead>
                <tr>
                <th style='display:none;' scope="col">ID</th>
                    <th scope="col">ID</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($json["data"]["books"] as $book) {
                        echo "<tr>";
                        echo "<td scope='col'>" . $book["id"] . "</td>";
                        echo "<td scope='col'>" . $book["isbn"] . "</td>";
                        echo "<td scope='col'>" . $book["name"] . "</td>";
                        echo "<td scope='col'>" . $book["author"] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Footer -->
<?php include '../constants/footer.php' ?>

