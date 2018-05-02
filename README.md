# WebApi
Thiết kế, lập trình Web API cho phép lấy, cập nhật thông tin người sử dụng đối với hệ thống web có chức năng login/logout

## Getting Started
- Require env: Linux/Apache/MySQL/PHP
- config for apache: DocumentRoot point to WebApi/public 
- config for database: db/config.php 
- run file users_table.sql to init users table.
### Api Document
- This application provided two apis:
1. Get user information
- Request:
```
+ url:127.0.0.1/
+ Method: GET
+ Params: id (require)
```
- Response:
```
http code 200 and user information in the application found an user.
http code 400 and user information in the application not found any user.
```
2. Get user information
- Request:
```
+ url:127.0.0.1/
+ Method: POST
+ Params: 
id (required)
data[name](required)
data[tel](required)
data[address](required)
data[email](required)
```
- Response:
```
http code 200 for update successful.
http code 400 for update unsuccessful.
```