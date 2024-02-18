# PHP | SERVER-SIDE IMPLEMENTATION (Proof-Of-Concept) 
## NEXUS MEDIA SERVER 
```txt
.
├── dashboard.php
├── includes
│   ├── LoginHandler.php
│   ├── MEDIA
│   │   └── 00027_JOHN_DOE001
│   │       ├── Audios
│   │       ├── Favorites
│   │       ├── Photos
│   │       ├── Recents
│   │       ├── Trash
│   │       ├── Uploads
│   │       ├── Videos
│   │       └── user_icon.svg
│   ├── Models
│   │   ├── Database.php
│   │   ├── FileManager.php
│   │   ├── Sanitizer.php
│   │   ├── SessionToken.php
│   │   ├── User.php
│   │   ├── constants.php
│   │   └── user_icon.svg
│   ├── RegistrationHandler.php
│   ├── UploadHandler.php
│   ├── config.php
│   ├── functions.php
│   └── session_token.php
├── index.php
├── oobe.php
├── pages
│   ├── 404.php
│   ├── home.php
│   ├── login.php
│   ├── logout.php
│   └── register.php
├── static
│   ├── assets
│   ├── css
│   │   ├── forms.css
│   │   ├── reset.css
│   │   ├── styles.css
│   │   └── typography.css
│   ├── js
│   │   └── script.js
│   ├── test
│   └── user_icon.svg
├── template
│   ├── footer.php
│   └── header.php
├── test.php
├── upload.php
└── vendor
    └── autoloader.php
   
```
# DATABASE
## Table 1: de_torres_vincent_users

The `de_torres_vincent_users` table serves as a repository for user information, encompassing personal details, access levels, and account status.

- `id`: Unique identifier for each user.
- `firstname` and `lastname`: User's first and last names.
- `username`: Chosen username for authentication.
- `email`: User's unique email address (subject to a unique constraint).
- `password`: Hashed password ensuring secure user authentication.
- `contact_number`: User's contact number for communication.
- `address`: Physical address of the user.
- `access_level`: User's access level, defaulting to 'user'.
- `status`: Account status, defaulting to 'pending'.
- `access_code`: Special access code for specific purposes.
- `created_at` and `updated_at`: Timestamps indicating creation and last update.
- `session_token`: Token facilitating user session management.

## Table 2: de_torres_vincent_session_tokens

The `de_torres_vincent_session_tokens` table oversees user session tokens and their corresponding status.

- `id`: Unique identifier for each session token.
- `user_id`: Foreign key referencing the `de_torres_vincent_users` table.
- `session_token`: Token managing user sessions (non-null).
- `expiration`: Date and time signifying session token expiry.
- `status`: Status of the session token, either 'active' or 'expired'.

## Table 3: de_torres_vincent_user_directories

The `de_torres_vincent_user_directories` table is dedicated to storing user-specific directories and their attributes.

- `id`: Unique identifier for each directory.
- `user_id`: Foreign key referencing the `de_torres_vincent_users` table.
- `directory_id`: Unique identifier for each directory (non-null).
- `directory_name`: Name assigned to the directory (non-null).
- `date_added` and `last_modified`: Timestamps indicating directory creation and last modification.
- `last_accessed`: Timestamp for the last access of the directory.
- `directory_path`: Path to the directory (non-null).
- `username`: Username associated with the directory.

### Foreign Key Relationships

- `de_torres_vincent_session_tokens.user_id` references `de_torres_vincent_users.id`.
- `de_torres_vincent_user_directories.user_id` references `de_torres_vincent_users.id`.

### Indexes

- `de_torres_vincent_session_tokens.user_id`: Index on the `user_id` column for optimization.
- `de_torres_vincent_user_directories.user_id`: Index on the `user_id` column for optimization.

For more detailed information, please refer to the [Database Documentation](includes/Database/README.md).

# PHP Objects
For more detailed information, please refer to the [Class Documentation](includes/Models/Documentation).
