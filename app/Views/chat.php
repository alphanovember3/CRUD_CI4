
<head>
<link rel="stylesheet" href="assets/css/chat.css">
</head>
<body>
    
<div class="container clearfix">
    <div class="people-list" id="people-list">
      <div>Welcome  <span ><?= $user?> </span> </div>

      <div class="search">
        <input type="text" placeholder="search" />
        <i class="fa fa-search"></i>
      </div>
      <ul class="list">
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />
          <div class="about">
            <div class="name" ><button id="vincent"> Vincent</button> </div>
            <div class="status">
              <i class="fa fa-circle online"></i> online
            </div>
          </div>
        </li>
        
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_02.jpg" alt="avatar" />
          <div class="about">
            <div class="name"><button id="aiden">Aiden</button></div>
            <div class="status">
              <i class="fa fa-circle offline"></i> left 7 mins ago
            </div>
          </div>
        </li>
        
    
      
       
        
        <!-- <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_10.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Peyton Mckinney</div>
            <div class="status">
              <i class="fa fa-circle online"></i> online
            </div>
          </div>
        </li> -->
      </ul>
    </div>
    
    <div class="chat" >
      <div class="chat-header clearfix">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01_green.jpg" alt="avatar" />
        
        <div class="chat-about">
          <div class="chat-with" id="tochat">vincent</div>
          <div class="chat-num-messages">already 1 902 messages</div>
        </div>
        <i class="fa fa-star"></i>
      </div> <!-- end chat-header -->
      
      <div class="chat-history" >
        <!-- New chats will be append here -->
        <ul id="newMsg">
          <li class="clearfix">
            
            <div class="message other-message float-right">
              Hi Vincent, how are you? How is the project coming along?
            </div>
          </li>
          
          <li>
           
            <div class="message my-message">
              Are we meeting today? Project has been already finished and I have results to show you.
            </div>
          </li>
          
          <li class="clearfix">
          
            <div class="message other-message float-right">
              Well I am not sure. The rest of the team is not here yet. Maybe in an hour or so? Have you faced any problems at the last phase of the project?
            </div>
          </li>
          
          <li>
           
            <div class="message my-message">
              Actually everything was fine. I'm very excited to show this to our team.
            </div>
            
           
          </li>
          
         
          
        </ul>
        
      </div> <!-- end chat-history -->
      
      <div class="chat-message clearfix">
        <textarea name="message-to-send" id="msg" placeholder ="Type your message" rows="3"></textarea>
                
        <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
        <i class="fa fa-file-image-o"></i>
        
        <button id="btn">Send</button>

      </div> <!-- end chat-message -->
      
    </div> <!-- end chat -->
    
  </div> <!-- end container -->

<script src="https://cdn.socket.io/4.8.1/socket.io.min.js" integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+" crossorigin="anonymous"></script>
<script>
    const socket = io("http://localhost:3000");
    
    const msg = document.getElementById('msg');
    const btn = document.getElementById('btn');
    const msgDiv = document.getElementById('newMsg');

    const btnvin = document.getElementById('vincent');
    const aiden = document.getElementById('aiden');

    const tochatwith = document.getElementById('tochat');
   

    // console.log(tochatwith.innerText);

    window.onload = async () => { await getSessionData(); };
    let sendername;
    let getSessionData = async()=>{

      const response = await fetch('http://localhost:8080/getChatUsername');
      
      const data = await response.json();

      sendername = data.username;

    }

     getSessionData();

     
     
     
     
     
     aiden.addEventListener("click",(e)=>{
       e.preventDefault();
       
       tochatwith.innerText= "aiden";
    // let data1 = "aiden";


    
    let chatdata ={

    'receiver': tochatwith.innerText,
    'sender': sendername

  }
 


socket.emit("getData",chatdata);

    // socket.emit("getData",data1);


  })





  //to get the data from mongo of chat

  btnvin.addEventListener("click",(e)=>{

    e.preventDefault();

    // let data1 = "vincent";
    tochatwith.innerText= "vincent";

      let chatdata ={

      'receiver': tochatwith.innerText,
      'sender': sendername

        }

 

    socket.emit("getData",chatdata);


  })

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             


  socket.on('sendChat',async(data)=>{
    
    msgDiv.innerHTML= "";
    jsonData = await JSON.parse(data);
    jsonData.forEach(doc => { 
      
      const p = document.createElement('li');
      const d = document.createElement('div');

      d.innerText = doc.timestamp;
      p.innerText = doc.message;
      console.log(sendername)
      if(doc.sender== sendername && doc.receiver == tochatwith.innerText){
        p.classList.add("message","other-message","float-right");
        msgDiv.appendChild(d);
        msgDiv.appendChild(p);
        
      }
      else if(doc.receiver== sendername && doc.sender == tochatwith.innerText){
        p.classList.add("message","my-message","float-left");
        msgDiv.appendChild(d);
        msgDiv.appendChild(p);
        
      }


    
  })
    
  })





  // socket.on("newmsgupdate",(data)={
    

  //   socket.emit("getData",chatdata1);
  // })

  

    btn.addEventListener("click",(e)=>{

      console.log(sendername);
      e.preventDefault();

        const message ={
          'msgdata':msg.value,
          'sender': sendername,
          'receiver':tochatwith.innerText,

        };

        let chatdata ={

          'receiver': tochatwith.innerText,
          'sender': sendername

        }


        socket.emit("userMsg",message);

        socket.emit("getData",chatdata);
        // //printing the message in window
        msg.value ='';

        // const p = document.createElement('li');

        // p.innerText = message.msgdata;
        // p.classList.add("message","other-message","float-right");

        msgDiv.appendChild(p);
      
        

        
    })
    

    
</script>
</body>