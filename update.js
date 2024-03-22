async function updateData(updateBtn){
    let id=updateBtn.parentElement.parentElement.children[0].innerText;

    let res =await fetch('./api/get.php',{
        method:'POST',
        body :id
    })
    res =await res.json();
    // res =await res.json;
    // console.log(res);
    // const up_id = document.querySelector('#up_id');
    const up_id = document.querySelector('#up_id');
    const up_productName = document.querySelector('#up_productName');
    const up_Quantity = document.querySelector('#up_productQuantity');
    const up_category = document.querySelector('#up_category');
    const up_price = document.querySelector('#up_price');

    let updateData = JSON.parse(res.result);
    // console.log(res);
    up_id.value=updateData.id;
    up_productName.value=updateData.name;
    up_Quantity.value=updateData.qty;
    up_category.value=updateData.category;
    up_price.value=updateData.price;
}
let updateForm= document.querySelector("#update_from");
updateForm.addEventListener("submit", async function(e){
    e.preventDefault();
    const up_id = document.querySelector('#up_id').value;
    const up_productName = document.querySelector('#up_productName').value;
    const up_Quantity = document.querySelector('#up_productQuantity').value;
    const up_category = document.querySelector('#up_category').value;
    const up_price = document.querySelector('#up_price').value;

    let obj={
        up_id,
        up_productName,
        up_Quantity ,
        up_category,
        up_price
    }
    console.log(obj);

    let res = await fetch('./api/update.php',{
        method: 'POST',
        body: JSON.stringify(obj)
    }) 
    res= await res.json();
    // res= await res.text();
    console.log(res);
    if (res.status === 400 && res.errors) {
      let errorMessage = '<ul>';
      for (let key in res.errors) {  
        errorMessage += '<li>' + res.errors[key] + '</li>';
      }
      errorMessage += '</ul>';
      document.getElementById('up_errorList').innerHTML = errorMessage;
      document.getElementById('up_errorAlert').classList.remove('d-none'); // Show the alert
      sub_button.setAttribute("data-bs-dismiss","modal");

    } else if (res.status === 200) {
      document.getElementById('up_errorAlert').classList.add('d-none'); // Hide the alert
      let sub_button=document.getElementById("up_sub");
      sub_button.setAttribute("data-bs-dismiss","modal");
      alert(res.result);
      showData();
    } else {
      document.getElementById('errorAlert').classList.add('d-none'); // Hide the alert
      sub_button.setAttribute("data-bs-dismiss","modal");

      // Handle other error cases
    }
    
    // if (res.status==200) {
    //     alert(res.result);
    //     showData();
        
    // }
});