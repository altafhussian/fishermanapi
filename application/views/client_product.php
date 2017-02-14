<!DOCTYPE html>
<html lang="en">
<head>
  <title>API Client | Altaf</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="col-md-7 col-md-offset-2">
  <form id="form" action="client_product/insert/" method="post">
    <h3>Insert Product</h3>
    <div class="form-group">
      <label for="company">Compaany list:</label>
      <select class="form-control" id="company" name="company">
        <option value="company1">Company 1</option>
        <option value="company2">Company 2</option>
      </select>
    </div>
    <div class="form-group">
      <label for="productKey">Product Key</label>
      <input type="text" class="form-control" id="productKey" name="product_key" placeholder="Enter Product Key">
    </div>
   <div class="form-group">
      <label for="brandName">Brand Name</label>
      <input type="text" class="form-control" id="brandName" name="brand_name" placeholder="Enter Brand Name">
    </div>
    <div class="form-group">
      <label for="color">color</label>
      <input type="text" class="form-control" id="color" name="color" placeholder="Enter color">
    </div>
    <div class="form-group">
      <label for="barcode">Barcode</label>
      <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Enter Barcode">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</body>
</html>