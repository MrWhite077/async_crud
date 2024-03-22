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


<script src="./javaScriptfiles/insert.js"></script>
<script src="./javaScriptfiles/read.js"></script>
<script src="./javaScriptfiles/delete.js"></script>
<script src="./javaScriptfiles/update.js"></script>

<script>showData();</script>

<?php
include("./includes/footer.php");
?>