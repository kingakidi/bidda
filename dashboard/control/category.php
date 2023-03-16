<div class="item" id="item">
    
    <div class="item-link-container" id="item-link-container">
        <div>
            <a class="item-link" name="category-link" id="viewcat">View Category</a>
        </div>
        <div>
            <a class="item-link" name="category-link" id="addcat">Add Category</a>
        </div>
       
       
    </div>
    <div class="show-item mt-3" id="show-item">
    <?php 
                    // SELECT ALL CATEGORY 
            $category_query = mysqli_query($conn, "SELECT * FROM category");
            if (!$category_query) {
                die(error("CATEGORY QUERY FAILED ").mysqli_error($conn));
            }else if(mysqli_num_rows($category_query) < 1){
                echo ("<h2>NO CATEGORY</h2>");
            }else{
                echo '<table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>NAME</th>
                        <th>NO OF PRODUCTS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>';
                $sn = 1;
              while ($row = mysqli_fetch_assoc($category_query)) {
                  $id = $row['id'];
                  $title = ucwords($row['title']);

                echo "<tr>
                        <td>$sn</td>
                        <td>$title</td>
                        <td>78</td>
                        <td>Action</td>
                    </tr>";
                $sn++;
              } 
              echo '</tbody>
              </table>';
            }
        

           ?>
    </div>
</div>