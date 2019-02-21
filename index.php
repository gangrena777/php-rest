<?php
include('db.php');
 session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME WORK</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body    onload="getTodolist()">
	 <div class="contaiter"   >

	 	
	 	<div class="main-block">
	 		<h1>ПРЕДСТОИТ ВЫПОЛНИТЬ</h1>
	 		<?php

	 		 if(isset($_SESSION['flash']))
    {
  echo "<div class='".$_SESSION['flash']['status']."'>".$_SESSION['flash']['text']." <p onclick='window.location.reload();'>delete</p></div>";
  unset($_SESSION['flash']);
    }
	 		?>
  
     <h3>СПИСОК ЗАДАЧ</h3>
    
     <div  id="main-block-cont" >
     	
     	 
            
            
            	 	
                <button  class='add_but'  onclick='sidebar_show()'>+ Добавить задачу</button>
                
             
            <table id='myTable' width='100%'>
                                    <thead>
                                    <tr>
                                     <th scope='col' style='width: 75px;'>id</th>
                                     <th scope='col' style='width: 305px;'>text</th>
                                     <th scope='col' style='width: 132px;'>date</th>
                                     <th scope='col' style='width: 130px;'>status</th>
                                     </tr>
                                      </thead>
     	                            <tbody id="listtodo">
            	
            	 		 
            	 	<!--	<tr>
                                   <td></td>
                                   <td  onmouseover='mOver(this)' onmouseout='mOut(this)' class='value' ><p  iid='".$row['id']."' onclick='modal_edit(this);'   style='display:none'  ><img  src='edit.png'  class='show-edit'></p></td>
                                   <td></td>
                                   <td  onmouseover='mOver(this)' onmouseout='mOut(this)'>
                                      <p class='status-img-box' iid='".$row['id']."' onclick='modal_delete(this);'  style='display:none'  >
                                        <img  src='basket.svg'  class='show-edit-status'  >
                                      </p>
                                   </td>
                          </tr>-->

           </tbody>
</table>
     	
     </div>
</div>
	 	<div class="sidebar">
	 		<button    onclick="sidebar_hide()">отмена</button>
	 		<h1>TOOLBAR</h1>
	 		   
	 		<div id="form-block">
	 			<form >
	 			  <label>ВЫПОЛНИТЬ:</label>
	 			  <input type="text"  id="new_deal" onFocus="document.getElementById('add_but').disabled=0" />
	 			  <button  type ="button" id="add_but" onclick="return validate()" disabled>+  ДОБАВИТЬ </button>
	 			</form>
	 		</div>
	 		<p id="error_message"></p>
	 		<p id="loading"><img src="./loading.gif" /></p>
	 
	 	</div>
	 
	               <div id="myModal" class="modal">
                          <div class="modal-content">
                                <span class="close">&times;</span>
                                 <form  id="modal_edit_form">
	 			                      <label>ИЗМЕНИТЬ ЗАДАЧУ:</label>
	 			                      <input type="text"  id="modal_edit_input" /><br>
	 			                      <label>ИЗМЕНИТЬ СТАТУС:</label>
	 			                      <input type="checkbox"  id="modal_edit_status" />( done)<br>
	 			                      <button  type ="button" id="modal_edit_but" onclick="validate2()" >изменить </button>
	 			                </form>
	 			                <p id="modal_error_message"></p>
	 		                    <p id="modal_loading"  style="display: none"><img src="./loading.gif" /></p>
                            </div>

                   </div>
                 
                   <div id="myModal-delete" class="modal">

  
                            <div class="modal-content">
                                <span class="close_del">&times;</span>
                                 <button type="button" id='del_but' onclick="delete_deal()">УВЕРЕНЫ ЧТО НЕОБХОДИМО УДАЛИТЬ ЗАДАЧУ?</button>
	 			               
	 		                    <p id="modal_del_loading"  style="display: none"><img src="./loading.gif" /></p>
                            </div>

                   </div>
     </div>
	
	 <script>
/*onload="start()"
	 	function start(){
                var start = document.getElementById('start-loading');
                var container = document.getElementById('main-block-cont');
                 setTimeout(function(){
                           start.style.display = 'none';
                           container.style.display = 'block';
                 },1000);

	 	}
*/
     function getTodolist(){
              var xhttp = new XMLHttpRequest();
                         

                          xhttp.open("GET", "action.php?todolist=all", true);
                          xhttp.send();

                            xhttp.onreadystatechange = function() {
                                 if (this.readyState == 4 && this.status == 200) {
                                     var lis = xhttp.responseText;
                                     var list = JSON.parse(lis)
                                    console.log(list);

                                  
                                       var td='';
                                      for (var i in list){
                                         td +="<tr><td   >" + list[i]['id']+"</td><td onmouseover='mOver(this)' onmouseout='mOut(this)' class='value' >"+list[i]['text']+"<p  iid='"+list[i]['id']+"' onclick='modal_edit(this);'   style='display:none'  ><img  src='edit.png'  class='show-edit'></p></td><td>"+list[i]['date']+"</td><td  onmouseover='mOver(this)' onmouseout='mOut(this)'>"+list[i]['status']+" <p class='status-img-box' iid='"+list[i]['id']+"' onclick='modal_delete(this);'  style='display:none'  ><img  src='basket.svg'  class='show-edit-status'  ></p></td></tr>";
                                      }
                                                    document.getElementById("listtodo").innerHTML = "<tr>"+td+"</tr>";
                                                                                 }
                                       else{

                                       }                                          
                                                                };
                   
     }

	 	 var elem = document.getElementsByClassName('sidebar');
	 	   var block = document.getElementsByClassName('main-block');
	 	  function sidebar_show(){
                                   elem[0].style.display = "block";
	 	                          block[0].style.width = "60%";
	 	                          block[0].style.float = "left";
	 	                         }
	 	   function sidebar_hide(){

	 	  	
	 	  	elem[0].style.display = "none";
	 	  	  block[0].style.width = "80%";
	 	     block[0].style.float = "none";
	 	
	 	  
	 	  }

	 	  /* valid   add new deal */
         function validate(){
	 	  var deal = document.getElementById('new_deal');
	 	  var error = document.getElementById('error_message');
	 	  if(!deal.value){
	 	  	                    deal.style.border ="2px solid red";
	 	  	                      error.innerHTML = "field are not  completed";
	 	  	 	                error.style.color ="red";
	 	  	           setTimeout(function(){
	 	  	                         error.innerHTML = "";
	 	                                     },1000);
	 	  	                     return false;
                           }
	      else if(deal.value.includes('!'))
	 	      {
	 	    	  deal.style.border ="2px solid red";
                  error.innerHTML = "dont cry here!!!you are not boss";
	 	  	      error.style.color="red";
	 	  	       setTimeout(function(){
	 	  	                   error.innerHTML = "";
	 	                                },1000);
	 	    	    return false;
	 	      }
           
        else{          var form = document.getElementById('form-block');
                        var load = document.getElementById('loading');  
        	           form.style.display = "none";
                       load.style.display = "block";
        	        
                       var xhttp = new XMLHttpRequest();
                          
                       xhttp.open("GET", "action.php?new_todo="+deal.value, false);
                       xhttp.send();
                        setTimeout(function(){
	 	  	                  
	 	  	                   form.style.display = "block";
                               load.style.display = "none";
                              sidebar_hide();
                              window.location.reload();
	 	                                },1000);
             }
            
            

        } 
        /*  end valid add new */ 
        function mOver(obj) {
                     obj.children[0].style.display = "block";
                          } 
       function mOut(obj) {
                    obj.children[0].style.display ="none";
                           }
 

 var modal = document.getElementById('myModal');
 var span = document.getElementsByClassName("close")[0];
 var id; 
 var status;
 var edit_value;

 var edit_input = document.getElementById('modal_edit_input');
  
	 	    
function modal_edit(obj){
     modal.style.display = "block";
     var num = obj.getAttribute("iid");
     id = num;
     var value = obj.previousSibling;
     
     edit_value = value.data;
   
     edit_input.value = edit_value;
    
}
span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 

///////
 function validate2(){
	 	  var deal2 = document.getElementById('modal_edit_input');
	 	 
	 	  var error2 = document.getElementById('modal_error_message');
          var state = document.getElementById('modal_edit_status');  

           if(state.checked){
	 	     	status = 'done';
	 	     }
	 	     else{
	 	     	status ='not done';
	 	     }

	 	  if(!deal2.value){
	 	  	deal2.style.border ="2px solid red";
	 	  	
	 	  	error2.innerHTML = "field are not  completed";
	 	  	 	error2.style.color="red";
	 	  	setTimeout(function(){
	 	  	error2.innerHTML = "";
	 	  
	 	  },1000);
	 	  	
            return false;

	  	  }
	  
	 	    
	 	  
	 	    else if(deal2.value.includes('!'))
	 	      {
	 	    	  deal2.style.border ="2px solid red";
                  error2.innerHTML = "dont cry here!!!you are not boss";
	 	  	      error2.style.color="red";
	 	  	       setTimeout(function(){
	 	  	                   error2.innerHTML = "";
	 	                                },1000);
	 	    	    return false;
	 	      }
           
        else{          var form2 = document.getElementById('modal_edit_form');
                        var load2 = document.getElementById('modal_loading');  
        	          form2.style.display = "none";
                       load2.style.display = "block";
        	          
                       var xhttp = new XMLHttpRequest();
                          
                       xhttp.open("GET", "action.php?id="+id+"&edit_todo="+deal2.value+"&status="+status, false);
                       xhttp.send();
                        setTimeout(function(){
	 	  	                  
	 	  	                   form2.style.display = "block";
                               load2.style.display = "none";
                            modal.style.display = "none";
                              window.location.reload();
	 	                                },1000);
              }
      } 

   var modal_del = document.getElementById('myModal-delete');
    var span_del = document.getElementsByClassName("close_del")[0];
    var del_id;


   function modal_delete(obj) {
   	    modal_del.style.display = "block";
   	    var num2 = obj.getAttribute("iid");
         del_id = num2;
     
   }  
   span_del.onclick = function() {
        modal_del.style.display = "none";
   } 
window.onclick = function(event) {
  if (event.target == modal_del) {
    modal_del.style.display = "none";
  }
}
function delete_deal(){
	 var load3 = document.getElementById('modal_del_loading');
	 var del_but = document.getElementById('del_but');
	 load3.style.display = 'block'; 
	 del_but.style.display = 'none';

	 var xhttp = new XMLHttpRequest();
                          
             xhttp.open("GET", "action.php?del_id="+del_id, false);
             xhttp.send();
                setTimeout(function()
                {
	 	  	          load3.style.display = "none";
                      modal_del.style.display = "none";
                       del_but.style.display = 'block';
                     window.location.reload();
	 	         },1000); 
}            	
	 
	 </script>

</body>
</html>