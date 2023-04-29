<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Listings</title>
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <script>
    function updateListings(str){
        fields = str.children
        sortby = fields[0].children
        ordering = fields[1].children
        output = document.getElementById('results')
        var xmlhttp = new XMLHttpRequest();
        
        var isave = 0
        for(i = 0; i < sortby.length; i++){
            if(sortby[i].nodeName == "INPUT" && sortby[i].checked)
                isave = i
        }
        var jsave = 0
        for(j = 0; j < ordering.length; j++){
            if(ordering[j].nodeName == "INPUT" && ordering[j].checked)
                jsave = j
        }
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                output.innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "php/showalllistings.php?"+"sortby="+sortby[isave].value+"&ordering="+ordering[jsave].value, true);
        xmlhttp.send();
    }
    </script>
  </head>
  <body>
    <?php
      include 'header.php';

    ?>
    <style>
    #inline{display: inline;}
    #sort, #order {
  margin-bottom: 10px;
  margin-top: 10px;
}
    </style>
    <div class="searchBar">
      <form action="php/searchRedirect.php" method="post">
        <input type="text" placeholder="Search Listings..." name="search">
        <input type="submit" value="Search" name="submit">
      </form>
    </div>

    <br>
    <form id ='form' onsubmit="updateListings(this);return false;" method="post">
    <fieldset id = 'sort'>
    <label for = "name" id ='inline'>Name</label>
    <input type = "radio" name = "sortby" id = "name" value ="Name" checked>
    <label for ='start' id ='inline'>Start Date</label>
    <input type = "radio" name = "sortby" id = "start" value ="StartDate">
    <label for ='post' id ='inline'>Post Date</label>
    <input type = "radio" name = "sortby" id = "post" value ="PostDate">
    <label for ='salary' id ='inline'>Salary</label>
    <input type = "radio" name = "sortby" id = "salary" value ="Salary">
    </fieldset>
    <fieldset id = 'order'>
    <label for ='asc' id ='inline'>Ascending order</label>
    <input type='radio' name='ordering' id='asc' value ='ASC' checked>
    <label for='desc' id ='inline'>Descending order</label>
    <input type='radio' name='ordering' id='desc' value ='DESC'>
    </fieldset>
    <input type='submit' value='Sort'>
    </form>

    <br>
    <hr>
    
    <button class="create_listing" type="button">
        <a href="createListing.php"> Create Listing </a> 
    </button>
    <button class="update_listing" type="button">
        <a href="updateListing.php"> Update Listing </a> 
    </button>

    <button class="delete_listing" type="button">
              <a href="deleteListing.php"> Delete Listing </a>
          </button>

    <p id='results'>
    <?php
        $_GET['sortby'] = "Name";
        $_GET['ordering'] = "ASC";
        include('php/showalllistings.php');
        ?>
    </p>
    


    <?php
      include 'footer.php';
    ?>



  </body>
</html>
