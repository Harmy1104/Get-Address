let displayJSON = document.getElementById('display');
let msg = document.getElementById('msg');
let input = document.querySelector('input')

// TimeOut function
function empytErr(){
  msg.style.transform = 'scale(0)';
}

// Function run fetchAddress() on pressing Enter key
input.addEventListener("keyup", event => {
  if(event.keyCode === 13){
    fetchAddress();
  }
});

// Fucntion to be called when SEND is pressed
async function fetchAddress(){
  // Check for empty input box
  if(!input.value){
    msg.innerHTML = 'EMPYT INPUT!'
    msg.style.transform = 'scale(1)';
    setTimeout(empytErr, 3000);
  }
  // Local server port number. Change if needed
  let port = '8080'
  // API call to a local server running at port 8080
  let url = 'http://localhost:' + port + '/api/' + input.value;
  // fetching the response
  let response = await fetch(url);
  // Storing json in data
  let data = await response.json();
  // Adding the data to HTML to be displayed
  displayJSON.innerText = JSON.stringify(data, null, 4);
  // adding css padding
  displayJSON.style.padding = '1vh 1vw';
}

// Fucntion to be called when CLEAR is pressed
function removeText(){
  //Removing values
  displayJSON.innerText = ''; 
  input.value = '';
  // removing css padding
  displayJSON.style.padding = '0 0';
}

