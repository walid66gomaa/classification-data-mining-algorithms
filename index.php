<!DOCTYPE html>

<html>
    <head>
        <title>your calculator  </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>


            
            body {
  background: #EAEBEC;
}
         .div1 
         {
             width: 60%;
             font-family: "Andale Mono",monospace;
             margin: 40px auto;
             font-size: 20px;
             border: 1px solid red;
              color: #fff;
             padding: 10px;
             
             border: solid 1px #3A4655;
  box-shadow: 0 8px 50px -7px black;
   background: #3A4655;
         }
          .divimg
            {
                width: 200px;
                height: 200px;
              margin:36px auto;
            }
            img
            {
               border-radius:50%;
                width: 200px; 
                height: 200px; 
                 box-shadow: 0 8px 50px -7px ;
            }
            
            input[type='submit'] {
  width: 30%;
  background: #425062;
  color: #fff;
  padding: 4px;
  display: inline-block;
  font-size: 25px;
  text-align: center;
  vertical-align: middle;
  /*! margin-right: -4px; */
              margin-left:-11px;
                margin-bottom:4px;
               border: none;
            box-shadow: 0 8px 50px -7px black;
 
  
}
            input[type='text']
            {
                width: 66%;
                height: 36px;
                border: none;
              margin-bottom:30px;
                color: #3A4655;
             font-size: 20px;
              
                box-shadow: 0 8px 50px -7px black;
            }
            input[type='submit']:hover
{
  color: black;
}
            
        
            
            
        
            
            
        
        </style>
    </head>
    <body>    
        <div class="div1">
            <div class="divimg">
                <img src="images.jpg">
            </div>
            
                <form action="classification.php" method="post">
               
                
                
            <input type="submit" value="Solve">
        </form>
       </div>
    </body>
</html>
