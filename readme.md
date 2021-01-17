# Backend 
### Configure .env, install packages and serve
1. composer install
2. php artisan migrate
3. php artisan passport:install --uuids
4. php artisan passport:keys
5. php artisan serve

### Endpoints
http://localhost:8000/api/employees (Resource controller)

# Frontend
1. npm install
2. configure ajax in nuxt.config.js
3. npm run dev

##Features and used patterns:
Models with primary key Uuid, softdeletes

Repository pattern, Services, Requests, Resources.

