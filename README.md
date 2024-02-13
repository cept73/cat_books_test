# Book Store

## Installation notes

### To run in docker:

`docker-compose up`

http://localhost:20080/

### To set up:

`init`

`php yii migrate`

### To seed demo-data:

```
php yii seeder/seed book 
php yii seeder/seed author 
php yii seeder/seed author_book
```

