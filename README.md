## Description:

This app parses csv file and uploads it into MySQL Database.

It allows to upload csv file (sample transactions_sample.csv is provided).

## Installation of the project:

```bash
cp .env.example .env
```

```bash
cd docker && docker-compose up --build -d
```

Install dependencies
```bash
docker exec -it my-app bash 
```
```bash
composer install
```
```bash
exit
```

Copy database schema from database.sql into database (user: root, password: root)

## You can go to:
http://localhost:8000
