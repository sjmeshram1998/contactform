<?php
   //  include('session.php');
   // echo "Welcome, " . $_SESSION['email']; 
   
   include('header.php');
   include('db.php');
 
   ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Navbar items on the left -->
    <div class="d-flex">
      <!-- Delete records form -->
      <form action="delete-records-more-than-three-months.php" method="post" class="me-3">
        <button class="btn btn-danger" name="delete" onclick="return confirm('Do you really want to delete records older than 3 months?')">Delete Records More Than 3 Months</button>
      </form>
    </div>

 
    <!-- Navbar items on the right -->
    <div class="ms-auto d-flex align-items-center">
      <!-- Delete all records button -->
      <form action="delete-all.php" method="POST" id="deleteForm" class="me-2">
        <button class="btn btn-danger" name="delete_all" onclick="return confirm('Are you sure you want to delete all applications? This action cannot be undone.')" aria-label="Delete all records">
          <i class="bi bi-trash3-fill"></i> Delete All Records
        </button>
      </form>

      <!-- Logout button -->
      <a href="logout.php" class="btn btn-info" aria-label="Logout">
        <i class="bi bi-box-arrow-right"></i>
      </a>
    </div>
  </div>
</nav>

<div class="container-fluid">
   <?php
      if(isset($_SESSION['deleteMessage'])){
              $deleteMessage = $_SESSION['deleteMessage'];
              $msgType = $_SESSION['msgType'];
      
      
                  // $alertClass = ($msgType == "success") ? "alert-success" : "alert-danger";
                  echo "<br>";
                  echo "
                          <div class='alert alert-$msgType' id='flashMessage'>
                              $deleteMessage
      
                          </div>
                  ";
      
          
              // Unset variables
              unset($_SESSION['deleteMessage']);
              unset($_SESSION['msgType']);
      }
      
      
      ?>

      <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
            <div>
            <h3>List Of Applicants</h3>
            </div>

            <div>
                    <!-- Centered Search form -->
                    <div class="justify-content-center w-100">
                    <form action="" method="GET" class="d-flex w-100">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search applicants..." aria-label="Search applicants">
                        <button class="btn btn-primary ms-2" type="submit">Search</button>
                    </form>
                    </div>


            </div>


      </div>

   <div class="table-responsive ">
         <?php
           $records_per_page = 10;

           // Get the current page number from the query string (if available), default to page 1
           $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
           
           // Calculate the starting record for the current page
           $start_from = ($page - 1) * $records_per_page;
           
           // Get the search query if present
           $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
           
           // Start building the SQL query
           $sql = "SELECT * FROM contact_form";
           
           // Add the WHERE clause if there is a search query
           if (!empty($searchQuery)) {
               $sql .= " WHERE fname LIKE ? OR email LIKE ?";
           }
           
           // Always order the results for consistency
           $sql .= " ORDER BY created_at DESC LIMIT ?, ?";
           
           // Prepare the statement to prevent SQL injection
           $stmt = $conn->prepare($sql);
           
           // If there's a search term, bind it to the SQL query
           if (!empty($searchQuery)) {
               // Assign the search term to variables for binding
               $searchTerm = "%" . $searchQuery . "%";  // Use % for LIKE wildcards
               $stmt->bind_param("ssii", $searchTerm, $searchTerm, $start_from, $records_per_page);
           } else {
               // If no search term, bind only the LIMIT parameters
               $stmt->bind_param("ii", $start_from, $records_per_page);
           }
           
           // Execute the query
           $stmt->execute();
           $result = $stmt->get_result();
           
           // Check if results are found
           if ($result->num_rows > 0) {
               ?>
               <div class="table-responsive">
                   <table class="table table-sm table-bordered caption-top">
                       <!-- <caption>
                           <h3>List Of Applicants</h3>
                       </caption> -->
                       <thead class="align-top table-success">
                           <tr>
                               <th >Sr_No</th>
                               <th>Full Name</th>
                               <th>Email</th>
                               <th style="min-width: 80px;">Date</th>
                               <th>Experience</th>
                               <th style="white-space: nowrap;">Name Of Last Company</th>
                               <th style="min-width: 120px;">Current Monthly Salary</th>
                               <th style="min-width: 120px;">Expected Monthly Salary</th>
                               <th style="min-width: 100px;">Notice Period</th>
                               <th>Position</th>
                               <th>Position if other</th>
                               <th>Work before</th>
                               <th style="min-width: 180px;">About Opportunity</th>
                               <th>Other Opportunity</th>
                               <th>Referral</th>
                               <th>View CV</th>
                               <th style="white-space: nowrap;">Contact No</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php
                           $sr_no = 1 + $start_from; // Set Sr No based on page and start position
                           while ($row = $result->fetch_assoc()) {
                               $resume_path = 'uploads/' . $row["cv"];
                               ?>
                               <tr>
                                   <td><?php echo $sr_no++; ?></td>
                                   <td style="white-space: nowrap;"><?php echo htmlspecialchars($row["fname"]); ?></td>
                                   <td style="white-space: nowrap;"><?php echo htmlspecialchars($row["email"]); ?></td>
                                   <td><?php echo htmlspecialchars($row["date"]); ?></td>
                                   <td><?php echo htmlspecialchars($row["experience"]); ?></td>
                                   <td><?php echo htmlspecialchars($row["current_company_name"]); ?></td>
                                   <td><?php echo htmlspecialchars($row["current_salary"]); ?></td>
                                   <td><?php echo htmlspecialchars($row["expected_salary"]); ?></td>
                                   <td><?php echo htmlspecialchars($row["notice_period"]); ?></td>
                                   <td style="white-space: nowrap;"><?php echo htmlspecialchars($row["position"]); ?></td>
                                   <td><?php echo htmlspecialchars($row["other_position"]); ?></td>
                                   <td><?php echo htmlspecialchars($row["work_before"]); ?></td>
                                   <td><?php echo htmlspecialchars($row["about_opportunity"]); ?>
                                   <?php echo htmlspecialchars($row["other_opportunity"]); ?></td>
                                   <td></td>
                                   <td style="white-space: nowrap;"><?php echo htmlspecialchars($row["referral"]); ?></td>
                                   <td>
                                       <?php
                                       if (file_exists($resume_path)) {
                                           echo "<a href='$resume_path' download>Download CV</a>";
                                       } else {
                                           echo "No CV available";
                                       }
                                       ?>
                                   </td>
                                   <td><?php echo htmlspecialchars($row["mobile_no"]); ?></td>
                               </tr>
                               <?php
                           }
                           ?>
                       </tbody>
                   </table>
               </div>
               <?php
           } else {
               echo "No Applicants Found";
           }
           
           // Now, for pagination controls, calculate total number of pages
           $total_sql = "SELECT COUNT(*) FROM contact_form";
           if (!empty($searchQuery)) {
               $total_sql .= " WHERE fname LIKE ? OR email LIKE ?";
           }
           $total_stmt = $conn->prepare($total_sql);
           
           if (!empty($searchQuery)) {
               $totalTerm = "%" . $searchQuery . "%";
               $total_stmt->bind_param("ss", $totalTerm, $totalTerm);
           }
           
           $total_stmt->execute();
           $total_result = $total_stmt->get_result();
           $total_row = $total_result->fetch_row();
           $total_records = $total_row[0];
           
           // Calculate total pages
           $total_pages = ceil($total_records / $records_per_page);
           
           // Display pagination links
           echo "<div class='d-flex justify-content-center'>";
           echo "<nav aria-label='Page navigation'>";
           echo "<ul class='pagination'>";
           
           for ($i = 1; $i <= $total_pages; $i++) {
               echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'>";
               echo "<a class='page-link' href='?page=$i&search=" . urlencode($searchQuery) . "'>$i</a>";
               echo "</li>";
           }
           
           echo "</ul>";
           echo "</nav>";
           
           echo "</div>";
         //   container close
           // Close the prepared statement and the connection
           $stmt->close();
           $total_stmt->close();
           $conn->close();
           ?>
     
   </div>
</div>
<?php
   include('footer.php')
?>