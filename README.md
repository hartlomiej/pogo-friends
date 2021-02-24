# pogo-friends
a tiny cute site for sharing pogo friendcodes in my local community

## Usage
1. Clone the repo to your webserver.
2. Set up a mysql database with a single table:
```sql
  CREATE TABLE `users` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `name` varchar(25) NOT NULL,
   `code` varchar(12) NOT NULL,
   `created_at` varchar(255) NOT NULL,
   PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1
```
3. Fill in the database credentials in the config.ini file.

## Features
- adding your nickname and code
- displaying others' codes (ordered by newest)
- copying to clipboard (with no spaces)

## Preview
![site screenshot](https://i.imgur.com/QzRk4bk.png)
