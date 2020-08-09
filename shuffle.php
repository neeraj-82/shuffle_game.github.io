<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="shuffle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="game.css">
    <style>
        h2{
            display:none;
        }
        .hidden
        {
            display: none;
        }
        .play_field{
            display: none;
        }
    </style>
</head>
<body>

    <section class="section">
        <div class="game_area">
            <h2><?php echo file_get_contents($_COOKIE['data']) ?></h2>
            <!-- <div class="time">

            </div> -->
            <div class="result">
                <div class="intro">
                    <h1 class="first">
                        <span>S</span>
                        <span>h</span>
                        <span>u</span>
                        <span>f</span>
                        <span>f</span>
                        <span>l</span>
                        <span>e</span>

                    </h1>
                    <h1 class="sec">
                        <span>T</span>
                        <span>h</span>
                        <span>e</span>
                    </h1>
                    <h1 class="third">
                        <span>W</span>
                        <span>o</span>
                        <span>r</span>
                        <span>d</span>
                    </h1>
                </div>
                <div class="play_field">
                    <div class="word_area">
                        
                       <div class="time">
                            <div class="timer">
                                80
                            </div>
                       </div>
                       <div class="word">
                         
                        <h1 class="msg"></h1>
                       </div>
                    </div>
                    <div class="input_area">
                        <input type="text" class="answer" placeholder="Enter Answer.....">
                    </div>
                </div>
            </div>
            <div class="click">
                <button class="play">Play_Game</button>
            </div>
          
        </div>
    </section>
    <!-- <section>
        <div class="area">
            <h1 class="msg"></h1>
            <h2><?php echo file_get_contents($_COOKIE['data']) ?></h2>
            <input type="text" class="hidden">
            <button class="btn">click here to play</button>
            
        </div>
    </section> -->

    <script>

            // get all data from html-part
        let intro=document.querySelector('.intro');
        let msg=document.querySelector('.msg');
        let start=document.querySelector('.play');
        let play_field=document.querySelector('.play_field');
        let clock=document.querySelector('.timer');
        let answer=document.querySelector('.answer');
        let input_area=document.querySelector('.input_area');
        let data=document.querySelector('h2').innerHTML;
        let section=document.querySelector(".section");
      
        let arr=(data.split(","));

        //     // declare the variables
        let arr_word='';
        let rand_words='';
        let play=false;
        let ti="";
        let score="";
        let Inc=0;
        
            
        // // generate word function
        const CreateWord=(word)=>
        {
            let random_word=Math.floor(Math.random()*word.length);
            let catch_word=word[random_word];
            return catch_word;
        }

        // // shuffle the word in this function
        const shuffle=(shuffle)=>
        {
            for(let i=shuffle.length-1;i>=0;i--)
            {
                let temp=shuffle[i];
                let j=Math.floor(Math.random()*(i+1));
                shuffle[i]=shuffle[j];
                shuffle[j]=temp;
            }return shuffle;
        }
             

        // //  time-interval function
        const time=()=>
        {
            let i=80;
           let timer= setInterval(() => { 

            clock.innerHTML=i;
            i-=1;
            if(i==-1){
                let won=document.createElement('h1');
                msg.innerHTML=`${arr_word}`;
                start.style="display:none";
               won.innerHTML="loose! loose! loose!  ";
              won.style="color:#f7b71d";
               input_area.appendChild(won);
               answer.style="display:none";
                clearInterval(timer);
                loose();
            }
            else if(i===20)
            {
               clock.style="color:red";

              

            }
            },1000)
            return (timer);
        }
        //     //loose the game functionu
        const loose=()=>
        {
            

            setTimeout(() => {
                location.replace('http://localhost/againsass/shuffle_game/select_game.php');
            }, 5000);
        }

        // // score function
        const count=()=>
        {
            let score=5;
            return score;
        }

        start.addEventListener('click',
        
        function()
        {
            // debugger;

            section.style.background='#2b580c';
            start.style.marginTop='5px';
            play_field.style="display:block";
            intro.style="display:none";
            // start.style="color:palegoldenrod";
            if(!play)
            {
                play=true;
                start.innerHTML='GUESS';
                
               answer.style="display:block";
                arr_word= CreateWord(arr);
                rand_words= shuffle(arr_word.split("")).join("");
                msg.innerHTML=rand_words;
                ti=time();
            }
            else
            {
                let temp_value=answer.value;
                   
                //win the game
                if(temp_value===arr_word)
                {
                    play=false;
                    msg.innerHTML="won! won! won!";
                   
                    start.innerHTML="Next";
                   answer.style="display:none";
                    answer.value="";
                    clearInterval(ti);
                    score1=count();
                    Inc=score1+Inc;
                    
                    player={};
                    player.cur_score=score1;
                    player.score=Inc;
                   
                    $.ajax({
                        url:"score.php",
                        method:"post",
                        data: player,
                        success:function(res)
                        {
                            console.log(res);
                        }
                    })
                   
                 
                  
                   
                                    
                }
            //     // incorrect answer
             
                else
                {
                    Inc-=2;
                    msg.innerHTML=`Wrong ${rand_words}`;
                    answer.value='';
                   
                }
            }
        });

      
        </script>


</body>
</html>