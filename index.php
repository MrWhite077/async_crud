<?php
include("./includes/header.php");
?>

<h2>Enter Data</h2>

<div class="container">

<div class="alert alert-success alert-dismissible fade show d-none" role="alert">
  <strong>success!</strong> data saves successfully in database.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<div class="spinner-border spinner d-none" role="status">
  <span class="visually-hidden">Loading...</span>
</div>


<div class="alert alert-warning alert-dismissible fade show d-none" id="errorAlert" role="alert">
  <strong>ERRORS!</strong> 
  <ul id="errorList"></ul>
  <button type="button" class="btn-close" data-bs-dismiss="alert" id="errorAlert" aria-label="Close"></button>
</div>



<form id="insertForm">
  <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" id="productName" class="form-control" name="productName">
        </div>
        <div class="form-group">
            <label for="productQuantity">Product Quantity</label>
            <input type="text" id="productQuantity" class="form-control" name="productQuantity">
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-control">
                <option value="">select</option>
                <option value="Electronics">Electronics</option>
                <option value="Fashion and Apparel">Fashion and Apparel</option>
                <option value="Health and Wellness">Health and Wellness</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" class="form-control" name="price">
        </div>
        <input type="submit" name="submit" class="btn btn-primary mt-3">
    </form>
</div>

<div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">product Name</th>
          <th scope="col">product Quantity</th>
          <th scope="col">category</th>
          <th scope="col">price</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="readData">
      </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="dltModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete data !
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger modalBtn" onclick="dltData(this)" data-bs-dismiss="modal">yes</button>
      </div>
    </div>
  </div>
</div>


<!-- update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3>Update Data</h3>
        <div class="alert alert-warning alert-dismissible fade show d-none" id="up_errorAlert" role="alert">
  <strong>ERRORS!</strong> 
  <ul id="up_errorList"></ul>
  <button type="button" class="btn-close" data-bs-dismiss="alert" id="errorAlert" aria-label="Close"></button>
</div>
        <form id="update_from">
        <input type="hidden" id="up_id">
        <div class="form-group">
            <label for="up_productName">ProductName</label>
            <input type="text" id="up_productName" class="form-control" name="productName">
        </div>
        <div class="form-group">
            <label for="up_productQuantity">ProductQuantity</label>
            <input type="text" id="up_productQuantity" class="form-control" name="productQuantity">
        </div>
        <div class="form-group">
            <label for="up_category">Category</label>
            <select name="category" id="up_category" class="form-control">
                <option value="">select</option>
                <option value="Electronics">Electronics</option>
                <option value="Fashion and Apparel">Fashion and Apparel</option>
                <option value="Health and Wellness">Health and Wellness</option>
            </select>
        </div>
        <div class="form-group">
            <label for="up_price">Price</label>
            <input type="text" id="up_price" class="form-control" name="price">
        </div>
        <input type="submit" name="submit" id="up_sub" class="btn btn-primary mt-3">
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModalBtn">Close</button>
      </div>  
    </div>
  </div>
</div>

<!-- Errors Alert -->





<script>
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

          // Handle other error cases
        }
        for (let i = 0; i < e.target.length; i++) {
            if (e.target[i].name !== 'submit') {
                e.target[i].value = '';
            }
        } 
        
        
        
        
        
    
    });


    async function showData(){
    document.querySelector("#readData").innerHTML="";
    let res = await fetch('./api/read.php');
        res = await res.json();

        for (const data of res) {
            // console.log(data);
            let tr=document.createElement("tr");

            for(let key in data){
                // console.log(data[key]);
                let td=document.createElement("td");
                td.innerText=data[key];
                tr.append(td)
            }
            document.querySelector('#readData').append(tr);
            let btnTd= document.createElement("td");
            let update= document.createElement("button");
            update.classList.add("btn");
            update.classList.add("btn-primary");
            update.setAttribute("data-bs-toggle","modal")
            update.setAttribute("data-bs-target","#updateModal")
            update.setAttribute("onclick","updateData(this)")
            update.innerText="update";
    
    
            let dltbtn= document.createElement("button");
            dltbtn.classList.add("btn");
            dltbtn.classList.add("btn-danger");
            dltbtn.setAttribute('onclick', 'deleteModal(this)');
            dltbtn.setAttribute("data-bs-toggle","modal")
            dltbtn.setAttribute("data-bs-target","#dltModal")
            dltbtn.innerText="delete";
    
            btnTd.append(update,dltbtn);
    
            tr.append(btnTd);
            
        }

    }
    

    function deleteModal(dltBtn){
        let id= dltBtn.parentElement.parentElement.children[0].innerText;
        let dltModalBtn = document.querySelector('.modalBtn').id=id;

    }

    async function dltData(dltBtn) {
    let res = await fetch('./api/delete.php', {
        method: 'POST',
        body: dltBtn.id
    });
        
        res= await res.json();
        console.log(res);
        showData()
    }


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
          
        } else if (res.status === 200) {
          document.getElementById('up_errorAlert').classList.add('d-none'); // Hide the alert
          let sub_button=document.getElementById("up_sub");
          // sub_button.setAttribute("data-bs-dismiss","modal");
          // alert(res.result);
          showData();
          document.querySelector('#closeModalBtn').click();
        } else {
          document.getElementById('errorAlert').classList.add('d-none'); // Hide the alert
          // sub_button.setAttribute("data-bs-dismiss","modal");
          // Handle other error cases
        }
        
        // if (res.status==200) {
        //     alert(res.result);
        //     showData();
            
        // }
    });

</script>

<?php
include("./includes/footer.php");
?>