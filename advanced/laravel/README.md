INSTALL
-----
Run the following commands
```
docker-compose up -d --build
```
```
php artisan migrate
```
```
php artisan api:populateDatabase
```


API ENDPOINTS
-----
GET users 
```
http://127.0.0.1:888/api/user
```
GET users By Id
```
http://127.0.0.1:888/api/user/1
```
GET user Posts by Id
```
http://127.0.0.1:888/api/user/1/post
```
GET Posts
```
http://127.0.0.1:888/api/post
```
GET Posts Comments by PostId
```
http://127.0.0.1:888/api/post/1/comment
```
GET Posts By title
```
http://127.0.0.1:888/api/post/?title=laboriosam%20odio
```
