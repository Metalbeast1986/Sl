# Sl

1. create database named "localdb" and set collation: utf8mb4_unicode_ci and set this database name in .env file
2. In terminal run commands:
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
php artisan migrate
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"
3. create new user
4. MANUAL USER SETUP. 
A. Insert manually into permissions table record with following values:
'name'=>'Administer roles & permissions'
'guard_name'=>'web'
//id by default will be 1

B. Insert role in same way named 'Admin':
'name'=>'Admin'
'guard_name'=>'web'
//id by default will be 1

C. Set role has permission by setting permission_id and role_id accordingly of previous inserts.
D. Set model_has_roles by inserting:
'role_id'=>'1' (or accordingly of one in Roles table)
'model_type'=>'App\User'
'model_id'=>'1' (or accordingly id from users table of previously created user)

Now You can go to /users or (http://127.0.0.1:8000/users) and setup all other remaining permissions and assign roles. Default permissions are named:

Administer roles & permissions
Create Post
Edit Post
Delete Post
