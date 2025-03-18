Applicant Management System Documentation
This report provides an overview of the functionality and implementation of an Applicant Management System built using PHP, MySQL, HTML, and Bootstrap. The system includes features for displaying a list of applicants, searching, deleting records, and enabling applicants to apply through a web form.

1. Overview
The Applicant Management System enables the following:
•	Applicants can apply for job openings by submitting their personal information and resume.
•	Admin can view a list of applicants, delete records (including records older than 3 months), and delete all records.
•	The system supports searching and pagination for easy browsing of applicants.

2. Core Functionality
The system is comprised of multiple PHP files that work together to provide the required functionality. Below is a breakdown of the main features:

2.1. Application Form (application-form.php)
The application-form.php allows applicants to submit their details, including personal information and a resume (CV). This data is saved into a MySQL database, where it can be reviewed by the admin.
Key Features:
•	Personal Information: Applicants provide details like name, email, experience, salary expectations, current job position, notice period, etc.
•	Resume Upload: Applicants can upload their CVs as part of the application process.
•	Database Storage: Upon submission, all the data is stored in the database (contact_form table).

2.2. View Applicants (display-applicants.php)
The display-applicants.php file is used by the admin to view the list of applicants. The file displays the applicant information stored in the database in a paginated table.
Key Features:
•	Pagination: The applicants are shown with pagination to avoid a long list on a single page.
•	Search Functionality: The admin can search applicants by their name or email.
•	Delete Records: Admin can delete specific records or all records with a confirmation.

3. Advantages of the System
•	Time-Saving: The system saves admins time by providing easy access to applicant data with features like search, pagination, and delete functions.
•	User-Friendly: Applicants can easily apply for openings with the provided form, and the admin interface is simple and intuitive.
•	Secure: The system uses prepared statements to prevent SQL injection attacks and ensures secure data handling.
•	Free and Accessible: The system is web-based, so it is easily accessible via a browser with no need for additional software.

4. Conclusion
•	This Applicant Management System provides a comprehensive solution for handling applicant data. It simplifies the process for both applicants and admins by using PHP, MySQL, and Bootstrap. The system allows applicants to apply online, and admins can manage the records efficiently with pagination, search, and deletion features.

