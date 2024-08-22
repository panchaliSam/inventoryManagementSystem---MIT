# inventoryManagementSystem---MIT

Simple inventory management sytem for technical shop

#Guide to handle the web application

#How to download and run the app

1. You have to insatll xampp into your machine.
2. Then you can download this "inventoryManagementSystem---MIT" zip folder from the repositary into your machine.
3. Extract the zip folder into the htdocs folder of the xampp.
4. Open the folder from necessary IDE. (Visual Studio Code)
5. Then open "Database" folder copy the query inside "InventoryMgt.sql".
6. Open MySql Workbench and run the query and create the databse "inventorymgt".
7. Then open "Config" folder inside the code and open "config.php". You can change the configuration according to system.
8. Then run "Apache" service from the xampp.
9. Open the browser and type "http://localhost/inventoryManagementSystem---MIT/".

#Procee of the app

1. First, you have to log in to the system.
2. Only authorized people can access the system. If you want to add new users, you have to process that through the database.
3. After a successful login, you will navigate to the "Category" page.
   - Category Page : Click "Manage Categories"
   - View categories
   - Edit categories
   - Delete categories (You can delete only if the quantity is 0.)
   - Add new categories (If the supplier is new, you must add a new supplier first. Otherwise, you can select a supplier from the dropdown if the supplier is already registered.)
   - Download CSV file
   - Search categories
4. You can use the side navbar to navigate to other sections.
5. Brand Page : You can create, view, edit, delete, search, and download CSV files.

- You cannot add an existing brand name to the system.
- You can edit and delete existing brand names.
- You cannot edit a brand name to match an existing brand name.
- Search brands

6.  Supplier Page :

- View suppliers
- Edit suppliers
- Delete suppliers
- Add new suppliers
- Download CSV file
- Search suppliers

7.  Customer Page :

- View customers
- Edit customers
- Delete customers
- Add new customers
- Download CSV file
- Search customers

8.  Item Page :

- View items
- Edit items
- Delete items (When you click the delete icon, you can decrease the quantity. When the quantity reaches 0, you can delete the entire row. Similarly, if you click the add icon in each row, you can increase the quantity.)
- Add new items (When adding a new item, first ensure that the category or brand has been entered. Otherwise, the system will display only the list of brands and categories that already exist in the database.)
- Download CSV file
- Search items

9.  Order Page : You must add a customer first. However, if the customer already exists in the database, you can select that customer from the list.

- View orders
- Edit orders
- Delete orders
- Add new orders
- Download CSV file
- Search orders by customer name
