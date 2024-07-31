# Set Up PostgreSQL Sever

You will need pgAdmin4.  Install pgAdmin4 and create a database called "YatzyGameUsers".  In the dbconnect.php file, you can change the host, port, dbname, user, and password you want to use to connect.  This server is hosted on 5433. To change this, either go to the properties on the pgAdmin4 server and change the port to 5433, or simply go to the dbconnect.php file and change the port to the port the server is hosted on.  

# Verify Database Connection

To ensure the database is set up correctly, go to the dbconnect.php file and run it.  If it echo’s “Connected to the database!”, the database is set up correctly. 

# Create YatzyGameUsers Table

In the SQL queries run the command 

```
CREATE TABLE users ( 
    userID SERIAL PRIMARY KEY, 
    firstName VARCHAR(60), 
    username VARCHAR(60), 
    locations VARCHAR(60) 
);
```

# Run locally

Open up the parent directory "yatzy".  Then go into the public directory.  This is done with the following command.

```cd public```

Then run it locally with:

```php -S 127.0.0.1:8000```

After that go to the URL 127.0.0.1:8080 to run it.

# Screenshots of the game 
![image](https://github.com/user-attachments/assets/201f5fbb-fb80-4430-b9d3-be023269a53a)
![image](https://github.com/user-attachments/assets/8942d3c0-9642-41ea-8764-492bebc57747)

# Leaderboard
![image](https://github.com/user-attachments/assets/1b913167-2f1b-479a-89ad-2b6b01b047e2)

Note the leaderboard only shows the top 10 scores.  As soon as the eleventh score is added, the lowest score is omitted, to ensure ten scores are on the leaderboard at all times.  This event is shown in the screenshot, as the first user has been removed as they had the lowest score.

# User Data Insertion
To insert user data, put a username, a first name, and a location.  Then hit, "Add Data".  After that, go back to the page to keep playing the game.
![image](https://github.com/user-attachments/assets/5826d1d3-84d2-40a6-a110-e94c26f9b052)

