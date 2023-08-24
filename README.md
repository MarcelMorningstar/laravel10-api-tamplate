## Setup
 1. Set your DB environment variables in .env file as in .env.expample file
 2. Run command `php artisan migrate` to migrate tables
 3. Run command `php artisan serve` to start a server

## Usage

 **- Bearer Token**
Use http://domain/api/register to register new user with authorization token
Header - Accept: application/json
Body - x-www-form-urlencoded:
	 - name
	 - email
	 - password
	 - password_confirmation

	Given authorization token use in all requests below

 **- POST**
Use http://domain/api/add-product to add item to products table
Header - Accept: application/json
Body - x-www-form-urlencoded:
	 - name (TV)
	 - description (Labs TV)
	 - attributes ([{"key": "svars", "value": "4"}, ...])

 **- GET all items**
 To get all items with attributes from products table use http://domain/api/products
 
 **- GET single item**
 To get single item with attributes from products table use http://domain/api/product/{id}

 **- PUT**
 To update an item and it's attributes use http://domain/api/update-product/{id}
 Header - Accept: application/json
 Body - x-www-form-urlencoded:
	 - name (TV) 
	 - description (Loti Labs TV) 
	 - attributes ([{"key": "svars", "value": "5"}, {"key": "platums", "value": "42"}, ...])
	   
 **- DELETE**
 To delete an item with attributes use http://domain/api/delete-product/{id}