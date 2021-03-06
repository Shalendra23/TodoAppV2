"# TodoAppV2" 

This project is an Advanced PHP & MySQL project for CodeSpace - using MySQL, PHP & AJAX to create ToDo App with persistant data.

Database Structure ❤
```
DB name : mydatabase.sql ( added in files , for import)
Table : users
+---------------+--------------+------+-----+---------+----------------+
| Field         | Type         | Null | Key | Default | Extra          |
+---------------+--------------+------+-----+---------+----------------+
| user_id       | int(11)      | NO   | PRI | NULL    | auto_increment |
| user_name     | varchar(60)  | NO   |     | NULL    |                |
| user_email    | varchar(60)  | NO   |     | NULL    |                |
| user_password | varchar(255) | NO   |     | NULL    |                |
+---------------+--------------+------+-----+---------+----------------+
```

```
Table : tasks
+---------------+--------------+------+-----+---------+----------------+
| Field         | Type         | Null | Key | Default | Extra          |
+---------------+--------------+------+-----+---------+----------------+
| id            | int(11)      | NO   | PRI | NULL    | auto_increment |
| task_desc     | varchar(255) | NO   |     | NULL    |                |
| task_created  | date         | NO   |     | NULL    |                |
| task_due      | date         | NO   |     | NULL    |                |
| users_id      | char(60)     | YES  |     | NULL    |                |
| task_complete | char(1)      | YES  |     | NULL    |                |
+---------------+--------------+------+-----+---------+----------------+

```



```
Sample Data

+----+---------------------+--------------+------------+----------+---------------+
| id | task_desc           | task_created | task_due   | users_id | task_complete |
+----+---------------------+--------------+------------+----------+---------------+
| 13 | user name           | 2019-05-22   | 2019-05-23 | 4        | NULL          |
| 10 | test                | 2019-05-18   | 2019-05-25 | 4        | NULL          |
| 26 | First Task New User | 2019-05-21   | 2019-05-21 | 6        | NULL          |


+---------+-----------+---------------------------+--------------------------------------------------------------+
| user_id | user_name | user_email                | user_password                                                |
+---------+-----------+---------------------------+--------------------------------------------------------------+
|       1 | Dra       | test@gmail.com            | $2y$10$tx9JBfz02eF1G2/gyNsNJutFrmX7/tKN/TIrOdxh4y89v3qMp8Ffi |
|       2 | shalendra | singh.shalendra@gmail.com | $2y$10$DQBcPF4LHlfjKdrMdmbWGeYOf8hSl.iOru2ZdqtL5ugdgLdNZ0Qc6 |
|       3 | urisha    | urisha@gmail.com          | $2y$10$3A/I1xoiA34p.V5jZGHYw.II.fk3zg8FWi2OgkTulwdKOEevC.xmi |
|       4 | test      | test@test.com             | $2y$10$6OY.hdcQAPFbvxEj7k1sfOk8hPoPpAfSqlqybfEz/LOx8vdpnqZ5G |

```

🤷‍ Why?

Project is an Advanced PHP project for CodeSapce - using database storage for PHP and JavaScript to create ToDo App
To enhance my MYSQL, AJAX, OOP & PHP skills

🤔 solution?
This ToDoApp uses HTML, CSS, AJAX, PHP and MYSQL
It is built as version 1 of a fully databased app.


🚀 Try out?
All you have to do is: 

1. Register & Login
2. Add a task and select Due Data
3. Complete / Edit / Delete the task

🚚 Roadmap
0.1.0
- 
- 
- 
