RestAPI with get_user and update_user

RestAPI insert_product

You can test the user related rest calls using 

/testapi

Rest API credentials test/test for company1 and test1/test1 for company2.

To test the product api 

testapi/products

Actual rest api calls for user
/rest/get_user/2 - To list the information for the user with id 2 
/rest/get_user - To list all users
/rest/update_user - To update the user information

Update User API format

Need to pass json data as input with all the required fields. 
Sample JSON array - 
{
	"givenname": "altafhussian1",
	"surname": "Altaf11",
	"middlename": "m",
	"email": "altaf.visolve@gmail.com",
	"birthdate":"1991-05-14",
	"id" : "1"
}

Note: All the api call should include the auth-key and auth-secret for authentication in header section.

Rest call for product api

/rest/insert_product

Sample JSON array - 
{
	"product_key": "333",
	"brand_name": "test",
	"color": "#tasdf",
	"barcode": "['test']"
}
