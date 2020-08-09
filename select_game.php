
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
    <link rel="stylesheet" type="text/css" href="game.css">
  
 </head>
 <body>
 
    <section>
        <div class="container">
            <header>
               <div class="game_name">
                <!-- <i class="fa fa-eye"></i> -->
                    <h1>Shuffle_Game</h1>
               </div>
               <div class="score">
                   <h3>Total Score : <?php 
                    if(isset($_COOKIE['score']))
                    {
                        echo  $_COOKIE['score'];
                    }
                    else{
                      
                    }
                   ?></h3>
               </div>
            </header>
            
            <main class="selection_part">
                <form method="post">

                    <div class="select">
                        <div class="select_name">
                            <h3>1. Actors Name</h3>
                        </div>
                        <div class="select_btn">
                            <button type="submit" name="actors">SELECT</button>
                        </div>
                    </div>

                    <div class="select">
                        <div class="select_name">
                            <h3>2. Cricketers Name</h3>
                        </div>
                        <div class="select_btn">
                            <button type="submit" name="Cricketers">SELECT</button>
                        </div>
                    </div>

                    <div class="select">
                        <div class="select_name">
                            <h3>3. Movies Name</h3>
                        </div>
                        <div class="select_btn">
                            <button type="submit" name="movies">SELECT</button>
                        </div>
                    </div>

                    <div class="select">
                        <div class="select_name">
                            <h3>4. Songs Name</h3>
                        </div>
                        <div class="select_btn">
                            <button type="submit" name="songs">SELECT</button>
                        </div>
                    </div>

                    <div class="select">
                        <div class="select_name">
                            <h3>5. Actresses Name</h3>
                        </div>
                        <div class="select_btn">
                            <button type="submit" name="actresses">SELECT</button>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </section>
   

     
 <?php
    include 'fetchdb.php';
    $category='';
    
    if(isset($_POST['actors']))
    {
        $category='Actors';
        header('location:shuffle.php');

    }
    if(isset($_POST['Cricketers']))
    {
        $category='Cricketers';
        header('location:shuffle.php');

    }
    if(isset($_POST['movies']))
    {
        $category='Movies';
        header('location:shuffle.php');

    }
    if(isset($_POST['songs']))
    {
        $category='Songs';
        header('location:shuffle.php');

    }
    if(isset($_POST['actresses']))
    {
        $category='Actresses';
        header('location:shuffle.php');

    }
   
    $select="select name_pdf from name_pdf where name='$category'";
    $query=mysqli_query($con,$select);
    $result=mysqli_fetch_assoc($query);
    $data= $result['name_pdf'];
    setcookie('data',$data);

?>
 </body>
 </html>   
       
