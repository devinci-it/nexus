
## SessionToken Class

Represents a utility for managing session tokens in a database.

### Summary
- **File:** [includes/Models/SessionToken.php](includes/Models/SessionToken.php)
- **Description:** Manages session tokens and their interaction with the database.

### Attributes

| Attribute              | Description                                         |
|------------------------|-----------------------------------------------------|
| $conn                  | The database connection.                            |
| $sessionToken          | The generated session token.                         |

### Methods

| Method                              | Description                                                                                   |
|-------------------------------------|-----------------------------------------------------------------------------------------------|
| __construct($databaseConnection)   | Constructor that initializes the database connection and generates a session token.         |
| generateToken($length = 32)         | Generates a random session token of the specified length.                                   |
| getSessionToken()                   | Retrieves the current session token.                                                       |
| addSessionToken($userId)            | Adds a session token to the database for the specified user ID.                             |
| isValidSessionToken($userId)        | Checks if a session token is valid for the specified user ID.                               |
| revokeSessionToken($userId)         | Revokes a session token for the specified user ID by setting its status to 'expired'.        |
| renewSessionToken($userId)          | Renews the expiration time of a session token for the specified user ID.                    |

