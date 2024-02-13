# Book Store

<img src="screen1.png" alt="">

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

### To activate profile after registration

```
php yii user/activate {login}
```
