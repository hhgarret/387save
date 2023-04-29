<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Listing</title>
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
  </head>
  <body>
    <?php
    include 'header.php';
  ?>
    <div class="newListing">
      <div class="listingInfo">
        <div class="listingText">
          <strong>Create Listing</strong>
        </div>
        <form action="temp.php" method="post">
          Company Name:
          <input type="string" name="companyName" required>
          Opportunity Type:
          <select name = "position" >
            <option>Internship</option>
            <option>Job</option>
            <option>Research</option>
          </select>

          <!-- Start Date and End Date -->
          Date: 
          from
          <input type="date" name="opStartDate" required>
          to
          <input type="date" name="opEndDate" required>

          <!-- Recurring? -->
          Is this opportunity recurring?
          <label for="Yes">Yes
          <input type="radio" name="recurring" value="Yes" required>
          </label>
          
          <label for="No">No
          <input type="radio" name="recurring" value="No" required>
          </label>
          
          <!-- Location -->
          Location:
          <input type="string" name="location" required>

          <!-- Salary -->
          Salary: $ (Per Hour)
          <input type="number" name="salary" max="10000000" step=".1" required>
          
          <!-- Opportunity Qualifications -->
            <p><label for="opQual">Opportunity Description:</label></p>
            <textarea id="opQual" name="opQual" rows="4" cols="50"></textarea>
          
        
          <!-- Opportunity Description
            <p><label for="opDesc">Opportunity Description:</label></p>
            <textarea id="opDesc" name="opDesc" rows="4" cols="50"></textarea> -->

          <!-- Company's Link to Apply -->
          <label for="application">Link to Apply:</label>
          <input type="url" name="application" > 

          <!-- Company Description
            <p><label for="comDesc">Company Description:</label></p>
            <textarea id="comDesc" name="comDesc" rows="4" cols="50"></textarea> -->
          

          <input class="newListing" type="submit" value = "Add Listing">
            <a href="listings.php"></a> 
          </input>
          
        </input>
        </form>
      </div>
    </div>
    <?php
      include 'footer.php';
    ?>
  </body>
</html>
