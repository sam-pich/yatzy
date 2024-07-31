# Set Up PostgreSQL Sever

You will need pgAdmin4.  Install pgAdmin4 and create a database called "YatzyGameUsers".  In the dbconnect.php file, you can change the host, port, dbname, user, and password you want to use to connect.  This server is hosted on 5433, however most likely the host you need would be on 5432.  To fix this, either go to the properties on the pgAdmin4 server and change the port to 5433, or simply go to the dbconnect.php file and change the port to 5422.  



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

```php -S 127.0.0.1:8080```

After that go to the URL 127.0.0.1:8080 to run it.

