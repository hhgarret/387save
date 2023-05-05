<!DOCTYPE html>
<html lang="en">
<?php
      include('header.php');
      
    ?>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Listings</title>
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <style>
      .allthalistings{
        display: flex;
        flex-direction: column;
  background-color: #E8E8E8;
  
  /* margin-bottom: 10px; */
  padding: 10px;
  margin-left: 20px;
  margin-right: 20px;
  margin-top: 10px;
  border: 1px solid #ccc;
  border-radius: 17px;
  /* justify-content: center; */
  text-align: left;
      }

     
            #createButton,
            #updateButton,
            #deleteButton,
            #archiveButton {
              display: inline-flex;
              flex-direction: row;
              background-color: #E8E8E8;
              padding: 15px;
              margin-left: 20px;
              margin-top: 10px;
              border: 1px solid #ccc;
              border-radius: 17px;
              
            }

            .showButtons {
              display: inline;
            }
    #inline{display: inline;}
    #sort, #order {
  margin-bottom: 10px;
  margin-top: 10px;
}
    

    #bar {
      background-color: white;
      padding: 15px;
      margin-left: 20px;
      margin-top: 20px;
      margin-right: 20px;
      border: 1px solid #ccc;
      border-radius: 17px;
      width: 700px;
    }

    #but {
      padding: 15px;
      /* margin-left: 20px; */
      margin-top: 20px;
      /* margin-right: 0px; */
      border: 1px solid #ccc;
      border-radius: 17px;
      
    }

    .searchBar {
      display: inline;
    }

    .sorting {
      display: flex;
      margin-left: 20px;
      justify-content: center;
      margin-top: 60px;
    }

    .sorti {
      border: 1px solid #ccc;
      border-radius: 17px;
      width:fit-content;
      background-color: #E8E8E8;
      /* margin-left: 20px; */
    }

    .sortin {
      
      /* margin-top: -20px; */
      border: 1px solid #ccc;
      border-radius: 17px;
      width:fit-content;
      background-color: #E8E8E8;
    }

    #sor {
      padding: 15px;
      margin-left: 20px;
      margin-top: -20px;
      margin-right: 20px;
      border: 1px solid #ccc;
      border-radius: 17px;
    }

    #sort {
      margin-top: -10px;
      border: none;
    }

    #order {
      margin-top: -20px;
      border: none;
      margin-left: 0px;
      margin-bottom: -10px;
    }

    .opptype {
      display: inline-flex;
      margin-left: 65px;
    }

    ::selection {
  color: #fff;
  background: #0078D7;
}

.wrapper {
  /* max-width: 450px; */
  width: 16%;
  /* margin: 150px auto; */
  margin-top: 20px;
  /* margin-left: 700px; */
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.wrapper .search-input {
  background: #fff;
  /* width: 100%; */
  border-radius: 5px;
  position: absolute;
  box-shadow: 0px 1px 5px 3px rgba(0, 0, 0, 0.12);
  
}

.search-input input {
  height: 55px;
  width: 100%;
  outline: none;
  border: none;
  border-radius: 5px;
  padding: 0 60px 0 20px;
  font-size: 18px;
  box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
}

.search-input.active input {
  border-radius: 5px 5px 0 0;
}

.search-input .autocom-box {
  padding: 0;
  opacity: 0;
  pointer-events: none;
  max-height: 280px;
  overflow-y: auto;
}

.search-input.active .autocom-box {
  padding: 10px 8px;
  opacity: 1;
  pointer-events: auto;
}

.autocom-box li {
  list-style: none;
  padding: 8px 12px;
  display: none;
  width: 100%;
  cursor: default;
  border-radius: 3px;
}

.search-input.active .autocom-box li {
  display: block;
}
.autocom-box li:hover {
  background: #efefef;
}

.search-input .icon {
  position: absolute;
  right: 0px;
  top: 0px;
  height: 55px;
  width: 55px;
  text-align: center;
  line-height: 55px;
  font-size: 20px;
  color: #14213d;
  cursor: pointer;
}


    </style>
    <script>
    function updateListings(str){
        fields = str.children
        sortby = fields[0].children
        ordering = fields[1].children
        output = document.getElementById('results')
        position = document.getElementById('position')
        value = position.value
        selected = position.options[position.selectedIndex].text;

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
        xmlhttp.open("GET", "php/showalllistings.php?"+"sortby="+sortby[isave].value+"&ordering="+ordering[jsave].value+"&position="+selected, true);
        xmlhttp.send();
    }
    </script> 
    
  </head>
  <body>
   
    
    <center>
    
    <div class="searchBar">
      <form action="php/searchRedirect.php" method="post" id ='search'>
        <div class="wrapper">
      <div class="search-input">
        <a href="" target="_blank" hidden></a>
        <input type="text" name = "search" placeholder="Search Listings..." />
        <div class="autocom-box">
          <!-- here list are inserted from javascript -->
        </div>
      </div>
    </div>
      </form>
    </div>
  <script>
// getting all required elements
const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
const icon = searchWrapper.querySelector(".icon");
let linkTag = searchWrapper.querySelector("a");
let webLink;

// if user press any key and release
inputBox.onkeyup = (e) => {
  let userData = e.target.value; //user enetered data
  let emptyArray = [];
  if (userData) {
    
    emptyArray = suggestions.filter((data) => {
      //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
      return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
    });
    emptyArray = emptyArray.map((data) => {
      // passing return data inside li tag
      return (data = `<li>${data}</li>`);
    });
    searchWrapper.classList.add("active"); //show autocomplete box
    showSuggestions(emptyArray);
    let allList = suggBox.querySelectorAll("li");
    for (let i = 0; i < allList.length; i++) {
      //adding onclick attribute in all li tag
      allList[i].setAttribute("onclick", "select(this)");
    }
  } else {
    searchWrapper.classList.remove("active"); //hide autocomplete box
  }
};

function select(element) {
  let selectData = element.textContent;
  inputBox.value = selectData;
  document.getElementById('search').submit()
  searchWrapper.classList.remove("active");
}

function showSuggestions(list) {
  let listData;
  if (!list.length) {
    userValue = inputBox.value;
    listData = `<li>${userValue}</li>`;
  } else {
    listData = list.join("");
  }
  suggBox.innerHTML = listData;
}
    </script>

    <script>
      let suggestions = [

  <?php
   $sql = "Select Name from Listings where archived != 1";
   $result = $conn -> execute_query($sql, []);
   while($row = $result -> fetch_row()){
          echo("\"".$row[0]."\", ");
   }
  ?>
];

      </script>

    <br>
    <div class="sorting">
    <form id ='form' onsubmit="updateListings(this);return false;" onchange='updateListings(this);return false;'method="post">
    <!---<div class="sorti">-->
    <fieldset id = 'sort'>
    <label for = "name" id ='inline'>Name</label>
    <input type = "radio" name = "sortby" id = "name" value ="Name" checked>
    &nbsp; &nbsp; 
    <label for ='start' id ='inline'>Start Date</label>
    <input type = "radio" name = "sortby" id = "start" value ="StartDate">
    &nbsp; &nbsp; 
    <label for ='post' id ='inline'>Post Date</label>
    <input type = "radio" name = "sortby" id = "post" value ="PostDate">
    &nbsp; &nbsp; 
    <label for ='salary' id ='inline'>Salary</label>
    <input type = "radio" name = "sortby" id = "salary" value ="Salary">
    </fieldset>
  <!--</div>-->
  <!--<div class="sortin">-->
    <fieldset id = 'order'>
    <label for ='asc' id ='inline'>Ascending order</label>
    <input type='radio' name='ordering' id='asc' value ='ASC' checked>
    &nbsp; &nbsp; 
    <label for='desc' id ='inline'>Descending order</label>
    <input type='radio' name='ordering' id='desc' value ='DESC'>
    </fieldset>

    <div class="opptype">
    <label for='optype'>Opportunity Type:</label>
    &nbsp; &nbsp;
    <select name = "position" id = 'position'>
          <option>All</option>
            <option>Internship</option>
            <option>Job</option>
            <option>Research</option>
          </select>
  </div>
  
  <!--</div>-->
    <!--<input type='submit' value='Sort' id="sort">-->
    </form>
  </div>
  </center>
    <br>
    <hr>
    
    <center>
    <div class="showButtons">
    
    
    <button class="create_listing" id="createButton" type="button">
        <a href="createListing.php"> Create Listing </a> 
    </button>
    
    <button class="update_listing" id="updateButton" type="button">
        <a href="updateListing.php"> Update Listing </a> 
    </button>
    
    <button class="delete_listing" id="deleteButton" type="button">
              <a href="deleteListing.php"> Delete Listing </a>
          </button>

      <button class="archiveListings" id="archiveButton" type="button">
          <a href="archive.php"> View Archive </a> 
      </button>
    </div>


          </center>

    <div id='results'>
    <?php
        $_GET['sortby'] = "Name";
        $_GET['ordering'] = "ASC";
        $_GET['position'] = "All";
        include('php/showalllistings.php');
        ?>
    </div>



    <?php
      include 'footer.php';
    ?>



  </body>
</html>
