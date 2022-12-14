b1: copy file env.example
b2. tao file .env (chinh sua 1 so thong tin : DB_DATABASE=project-thmnm
DB_USERNAME=root) tao ten DB_DATABASE tren mysql
b3. run lenh php artisan migrate(lenh tao bang de hien len db)
b4. run lenh php artisan key:generate(sau do save lai file .env)
b5. php artisan serve
--- cac url login:http://127.0.0.1:8000/admin/login
-------------bo qua
git config --global core.autocrlf false