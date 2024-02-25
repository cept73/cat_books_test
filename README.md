# Book Store

<img src="screen1.png" alt="">

### Live demo: https://pet-books.code73.ru

## Project description (ru)

```
Необходимо сделать на фреймворке Yii2 + MySQL каталог книг. Книга может иметь несколько авторов.

1. Книга - название, год выпуска, описание, isbn, фото главной страницы.
2. Авторы - ФИО.

Права на доступ:
1. Гость - только просмотр + подписка на новые книги автора.
2. Юзер - просмотр, добавление, редактирование, удаление.

Отчет - ТОП 10 авторов выпуствиших больше книг

ПЛЮСОМ БУДЕТ
Уведомление о поступлении книг из подписки должно отправляться на смс гостю.

https://smspilot.ru/
там "Для тестирования можно использовать ключ эмулятор (реальной отправки SMS не происходит)."
```

## Installation notes

### To run in docker:

`docker-compose up`

http://localhost:20080/

### To set up:

`./init`

`./init-roles-and-users`

### To seed demo-data:

`./init-demo-data`

### To activate profile after new user registration without email

```
php yii user/activate {login}
```

### To send SMS via SMSPilot

- Check local `.env` file and change `SMS_PILOT_API_KEY`
- Add to `/etc/cron`: `*\5 * * * * php /path/to/yii.php queue/send-notify`
