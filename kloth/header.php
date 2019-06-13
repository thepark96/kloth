<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>Kloth</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="styles.css">
   

</head>

<body>
	
            
<form  id="form1"action=""  method="post">
    <div class='navbar fixed'>
        <div class='container'>
            <a class='pull-left title' href="index.php">Kloth</a>
            <ul class='pull-right'>
                <li>
                	<select  name="search" id="search">
						<option value="-1">검색할 카테고리를 선택해 주십시오.</option>
						<option value="/115.68.231.165/~2017320151/kloth/cloth_list.php">Cloth </option>
						<option value="/115.68.231.165/~2017320151/kloth/brand_list.php">Brand </option>
						<option value="/115.68.231.165/~2017320151/kloth/issue_list.php">Issue</option>
						<option value="/115.68.231.165/~2017320151/kloth/daily_list.php">Daily </option>
					</select>
					
                </li>
        		
                <li>
                  
                  <input type="text" name="search_keyword" placeholder="Kloth 통합검색">
                	
                </li>
                	
                	<li>
                		<div class="menubar">
							<ul>
							
								<li><a href="#" id="current">등록!</a>
									<ul>
    									<li><a href="cloth_form.php">cloth등록</a></li>
    									<li><a href="issue_form.php">issue등록</a></li>
    									<li><a href="daily_form.php">daily등록</a></li>
    								</ul>
								</li>
								
							</ul>
						</div>

					</li>
				
                <li><a href='cloth_list.php'>Cloth </a>
                	
                </li>
                
                
                <li><a href='brand_list.php'>Brand</a>
                
                </li>
                <li><a href='issue_list.php'>Issue</a>
                	
                </li>
                <li><a href='daily_list.php'>Daily</a>
            		
                </li>
                
                
     
        </div>
        
    </div>
</form>
<script type="text/javascript">
document.getElementById('search').onchange = function(){
    document.getElementById('form1').action = '/'+this.value;
}
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
 window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
} 
</script>
