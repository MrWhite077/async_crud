showData();
let insertForm = document.querySelector("#insertForm");
insertForm.addEventListener("submit",async function(e) {
  e.preventDefault();
  
  document.querySelector('.spinner').classList.remove('d-none');
  
  
  let obj = {};
  
  for (let i = 0; i < e.target.length; i++) {
    if (e.target[i].name !== 'submit') {
      obj[e.target[i].name] = e.target[i].value;
    }
  }
  let res = await fetch('./api/create.php', {
          method: 'POST',
          body: JSON.stringify(obj)
      });

      // res = await res.text();
      // res = JSON.parse(res);
      res =await res.json();
      document.querySelector('.spinner').classList.add('d-none');         
      // In the insertForm submit event listener


      if (res.status === 400 && res.errors) {
        let errorMessage = '<ul>';
        for (let key in res.errors) {  
          errorMessage += '<li>' + res.errors[key] + '</li>';
        }
        errorMessage += '</ul>';
        document.getElementById('errorList').innerHTML = errorMessage;
        document.getElementById('errorAlert').classList.remove('d-none'); // Show the alert
      } else if (res.status === 200) {
        document.getElementById('errorAlert').classList.add('d-none'); // Hide the alert
        document.querySelector('.alert').classList.remove('d-none');
        showData();
      } else {
        document.getElementById('errorAlert').classList.add('d-none'); // Hide the alert
        document.querySelector('.alert').classList.remove('d-none');


        // Handle other error cases
      }
      for (let i = 0; i < e.target.length; i++) {
          if (e.target[i].name !== 'submit') {
              e.target[i].value = '';
          }
      } 
      showData();
      
      
      
      
      
  
  });