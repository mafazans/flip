# Slightly Big Flip
Slightly Big Flip is an API for make disbursement request and check the status of disburstment.

# Postman Collection
`https://www.getpostman.com/collections/60e0a7ea3f60069ef4d2`

### Running Locally
To run in local environment you need to:
-   have `.env` file in your project root directory, or export all required Environment Variables via `export` command (Macos and Linux).
-   Running the Application with Docker Compose
    -  Build the app image with the following command
       - ```$ docker-compose build app```
    -  When the build finished, you can run the environtment in background with
       -  ```$ docker-compose up -d```
    -  Generate unique applicaiton key with artisan
       -  ```$ docker-compose exec app php artisan key:generate``` 
    -  Migrate database table into docker image mysql
       -  ```$ docker-compose exec app php artisan migrate```


Curl API Request Example

Disbursement request

```
curl --location --request POST 'localhost:8000/api/disburse' \
--header 'Authorization: Basic SHl6aW9ZN0xQNlpvTzduVFlLYkc4TzRJU2t5V25YMUp2QUVWQWh0V0tadW1vb0N6cXA0MTo=' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'bank_code=bca' \
--data-urlencode 'account_number=1234567890' \
--data-urlencode 'amount=100000' \
--data-urlencode 'remark=penarikan oleh zzz'
```

List of disbursement request
```
curl --location --request GET 'localhost:8000/api/disburses'
```

Check disbursement request status by disbursement id
```
curl --location --request GET 'localhost:8000/api/disburse/{id}'
```
