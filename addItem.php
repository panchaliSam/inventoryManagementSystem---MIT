<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="styleSideBar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            padding-top: 80px;
            padding-bottom: 50px;
        }
        .form-control {
            border-radius: 0.25rem;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
        .btn-primary {
            border-radius: 0.25rem;
            font-weight: 600;
            padding: 10px 20px;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: linear-gradient(90deg, #007bff, #0056b3);
            border: 1px solid transparent;
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3, #004085);
            border-color: #004085;
            box-shadow: 0 6px 8px rgba(0,0,0,0.2);
        }
        h1 {
            margin-bottom: 2rem;
            font-weight: 500;
            font-style:bold;
        }
    
    </style>

</head>

<body>
    <div class="wrapper">
      
            <?php
            include "sideBar.php";

            ?>


        <!-- content-->
        <div class="main p-3">
            <div class="text-center">

                <div class="container">
                    <h1 class="mb-4">Add Item</h1> 
                    
                   
                        <div class="form-group row">
                            <label for="item-name" class="col-sm-2 col-form-label">Item Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter item name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                            <div class="col-sm-10">
                                <select id="brand" name="brand" class="form-control">
                                <option value="0">Select brand</option>
                                <?php

                                        require "connection.php";

                                        $brand_rs = Database::search("SELECT * FROM `brand`");
                                        $brand_num = $brand_rs->num_rows;

                                        for ($x = 0; $x < $brand_num; $x++) {
                                            $brand_data = $brand_rs->fetch_assoc();

                                        ?>

                                    <option value="<?php echo $brand_data["BrandID"]; ?>"><?php echo $brand_data["Name"]; ?></option>
                                        <?php
                                          }

                                     ?>
                                 
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="categ" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select id="categ"  name="categ" class="form-control">
                                <option value="0">Select category</option>
                                <?php


                                        $category_rs = Database::search("SELECT * FROM `category`");
                                        $category_num = $category_rs->num_rows;

                                        for ($x = 0; $x < $category_num; $x++) {
                                            $category_data = $category_rs->fetch_assoc();

                                        ?>

                                    <option value="<?php echo $category_data["CategoryID"]; ?>"><?php echo $category_data["Name"]; ?></option>
                                        <?php
                                          }

                                     ?>
                                 
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Purchase Price</label>
                            <div class="col-sm-10">
                                <input type="number" step="1" class="form-control" id="p_price" name="pp" placeholder="Enter price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Selling Price</label>
                            <div class="col-sm-10">
                                <input type="number" step="1" class="form-control" id="s_price" name="sp" placeholder="Enter price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="description" placeholder="Enter description" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button class="btn btn-primary" onclick="addItem();">Add Item</button>
                            </div>
                        </div>
                  
                </div>

            </div>
        </div>
    </div>
    <script src="script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
   
</body>

</html>