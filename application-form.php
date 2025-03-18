<?php
session_start();

// Retrieve messages from the session, if available
$formMessage = isset($_SESSION['formMessage']) ? $_SESSION['formMessage'] : '';
$errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : '';
$emailErrorMessage = isset($_SESSION['emailErrorMessage']) ? $_SESSION['emailErrorMessage'] : '';

// Unset session messages after they're displayed
unset($_SESSION['formMessage']);
unset($_SESSION['errorMessage']);
unset($_SESSION['emailErrorMessage'])
?>
<?php
// Get today's date
$today = date('Y-m-d');
?>


   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Application Form</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <style>
         @media screen and (min-width: 992px) {
         .container{
         width: 800px;
         }
         }
         body {
            font-family: "poppins", sans-serif;

         }
      
      </style>
   </head>
   <body>
   <div class="container mt-3">
         <?php if(!$formMessage == ""):?>
            <div class="alert alert-success" id="message-container" style="display: none;">
               <span id="messageText">
                  <?php echo $formMessage; ?>
               </span>
            </div>   
         <?php endif; ?>

         <?php if(!$emailErrorMessage == ""):?>
            <div class="alert alert-danger" id="email-message-container" style="display: none;">
               <span id="emailMessageText">
                  <?php echo $emailErrorMessage; ?>
               </span>
            </div>   
         <?php endif; ?>


     
      


            <div class="bg-dark text-center p-3">
               <img src="./logo.png" alt="" class="img-fluid img-responsive">
            </div>
            <div  class="border p-3">
               <h1 class="text-center ">Job Application Form</h1>
               <p>
                  Thank you for considering a career at Yoanone Solutions. Please take a minute 
                  to fill out the following form. After you have completed your 
                  application you will be contacted by our recruiter to discuss the further process. 
               </p>
            </div>
            <form class="border p-3" action="./insert-form-data.php" id="applicationForm" name="applicationForm" onsubmit="return validateForm()" method="POST" enctype="multipart/form-data">
               <div class="mb-3">
                  <label for="email" class="form-label">Email Address<span class="text-danger"> *</span></label>
                  <input type="email" class="form-control" id="email" name="email">

                  <span class="text-danger" id="emailError"></span>
               
               </div>
               <div class="mb-3">
                  <label for="date" class="form-label">Date<span class="text-danger"> *</span></label>
                  <!-- <input type="date" class="form-control" id="date" name="date" value="<?php echo $today; ?>"> -->
                  <input type="date" class="form-control" id="date" name="date" value="<?php echo $today; ?>" readonly>
                  <span class="text-danger" id="dateError"></span>
               </div>
               <div class="mb-3">
                  <label for="fname" class="form-label">Full Name (as per Aadhar Card)<span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" id="fname" name="fname">
                  <span class="text-danger" id="fnameError"></span>
               </div>
               <div class="mb-3">
                  <label for="mobile_no" class="form-label">Mobile Number (10 digits)<span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" id="mobile_no" name="mobile_no">
                  <span class="text-danger" id="mobileNoError"></span>
               </div>
               <div class="mb-3">
                  <label for="experience" class="form-label">Overall Experience (in years)<span class="text-danger"> *</span></label>
                  <input type="number" class="form-control" id="experience" name="experience">
                  <span class="text-danger" id="experienceError"></span>
               </div>
               <div class="mb-3">
                  <label for="current_company_name" class="form-label">Name of Current / Last Company<span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" id="current_company_name" name="current_company_name">
                  <span class="text-danger" id="currentCompanyNameError"></span>
               </div>
               <div class="mb-3">
                  <label for="current_salary" class="form-label">Current Monthly Salary (fixed salary excluding variables)
                  <span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" id="current_salary" name="current_salary">
                  <span class="text-danger" id="currentSalaryError"></span>
               </div>
               <div class="mb-3">
                  <label for="expected_salary" class="form-label">Expected CTC<span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" id="expected_salary" name="expected_salary">
                  <span class="text-danger" id="expectedSalaryError"></span>
               </div>
               <div class="mb-3">
                  <label for="notice_period" class="form-label">Notice Period<span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" id="notice_period" placeholder="Notice period in days" name="notice_period">
                  <span class="text-danger" id="noticePeriodError"></span>
               </div>
               <!-- Position section starts -->
               <div class="mb-3">
                  <label for="position" class="form-label">Role Applied For<span class="text-danger"> *</span></label> <br>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="email_marketing" value="Email Marketing">
                     <label class="form-check-label" for="email_marketing">
                     Email Marketing
                     </label>
                  </div>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="social_verification" value="Social Verification">
                     <label class="form-check-label" for="social_verification">
                     Social Verification
                     </label>
                  </div>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="contact_discovery" value="Contact Discovery">
                     <label class="form-check-label" for="contact_discovery">
                     Contact Discovery
                     </label>
                  </div>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="tele_verification" value="Tele Verification"> 
                     <label class="form-check-label" for="tele_verification">
                     Tele Verification
                     </label>
                  </div>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="lead_generation" value="Lead Generation (Tele Marketing)">
                     <label class="form-check-label" for="lead_generation">
                     Lead Generation (Tele Marketing)
                     </label>
                  </div>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="hql_bant" value="HQL/BANT">
                     <label class="form-check-label" for="hql_bant">
                     HQL/BANT
                     </label>
                  </div>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="appointment_generation" value="Appointment Generation">
                     <label class="form-check-label" for="appointment_generation">
                     Appointment Generation
                     </label>
                  </div>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="mis_executive" value="MIS Executive - Data Extraction">
                     <label class="form-check-label" for="mis_executive">
                     MIS Executive - Data Extraction
                     </label>
                  </div>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="customer_success" value="Customer Success">
                     <label class="form-check-label" for="customer_success">
                     Customer Success
                     </label>
                  </div>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="sales" value="Sales / Business Development">
                     <label class="form-check-label" for="sales">
                     Sales / Business Development
                     </label>
                  </div>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="quality_analyst_tele" value=" Quality Analyst (Tele)">
                     <label class="form-check-label" for="quality_analyst_tele">
                     Quality Analyst (Tele)
                     </label>
                  </div>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="quality_analyst_data" value="Quality Analyst (Data)">
                     <label class="form-check-label" for="quality_analyst_data">
                     Quality Analyst (Data)
                     </label>
                  </div>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="WFM" value="WFM">
                     <label class="form-check-label" for="wfm">
                     WFM
                     </label>
                  </div>
                  <div class="mb-2">
                     <input class="form-check-input" type="radio" name="position" id="research_analyst" value="Research Analyst">
                     <label class="form-check-label" for="research_analyst">
                     Research Analyst
                     </label>
                  </div>
                  <div class="d-flex">
                     <input class="form-check-input" type="radio" name="position" id="other" value="Other">
                     <label class="form-check-label" for="other" >Other</label>

                     <input class="form-control" type="text" name="other_position" id="other_position">
                  </div>
                  <span class="text-danger" id="positionError"></span>
               </div>
               <!-- Position section ends -->
               
                  <div class="mb-3">
                     <label class="form-check-label" for="work_before">
                        Did you ever work with - Yoanone Solutions before ? <span class="text-danger"> *</span>
                     </label><br>
                     <select name="work_before" id="work_before" class="form-select" name="work_before">
                        <option value="">Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                     </select>
                  
                     
                  </div>
                  
                  <div>
                     <span class="text-danger" id="workBeforeError"></span>
                  </div>
                              
                  <div class="mb-3">
                     <label class="form-check-label" for="about_opportunity">
                        Where did you hear about this opportunity? <span class="text-danger"> *</span>
                     </label><br>
                     <select name="about_opportunity" id="about_opportunity" class="form-select" onchange="showOtherField();">
                        <option value="">Select</option>
                        <option value="Our recruiter contacted you">Our recruiter contacted you</option>
                        <option value="Company Website">Company Website</option>
                        <option value="LinkedIn">LinkedIn</option>
                        <option value="Referred by an employee of Yoanone Solutions">Referred by an employee of Yoanone Solutions</option>
                        <option value="Job Consultant">Job Consultant</option>
                        <option value="Other">Other</option>
                     </select>
               </div>
               
               
               <div class="mb-2" id="about_opportunity_other" style="display: none;">
                     <label for="other_opportunity">Please Specify</label>
                     <input type="text" id="other_opportunity" name="other_opportunity" class="form-control">
               </div>
               <div>
                  <span class="text-danger" id="aboutOpportunityError"></span>
            </div>
            
            
                  <div class="mb-3">
                     <label for="referral" class="form-label">Mention the Yoanone Solutions Employee Name & Employee ID in case of referral</label>
                     <input type="text" class="form-control" id="referral" name="referral">
                  </div>
                  
                  
                  
               <div class="mb-3">
                  <label for="cv" class="form-label">Upload CV</label>
                  <input type="file" class="form-control" id="cv" name="cv" required accept=".pdf,.docx,.doc">
               </div>
            
               <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
           
      </div>
  <br> <br>


  <!-- Script file -->
  <script src="script.js"></script>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </body>
   </html>

