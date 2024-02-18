# NEXUS  Database Overview

## Table 1: de_torres_vincent_users

This table is designed to store user information including their personal details, access level, and account status.

- `id`: Unique identifier for each user.
- `firstname` and `lastname`: First and last names of the user.
- `username`: User's chosen username.
- `email`: User's email address (unique constraint).
- `password`: Hashed password for user authentication.
- `contact_number`: User's contact number.
- `address`: User's address.
- `access_level`: User's access level, default is 'user'.
- `status`: User's account status, default is 'pending'.
- `access_code`: Access code for special purposes.
- `created_at` and `updated_at`: Timestamps for creation and last update.
- `session_token`: Token for user session management.

## Table 2: de_torres_vincent_session_tokens

This table manages user session tokens and their status.

- `id`: Unique identifier for each session token.
- `user_id`: Foreign key referencing `de_torres_vincent_users` table.
- `session_token`: Token for user session (not null).
- `expiration`: Date and time when the session token expires.
- `status`: Status of the session token (either 'active' or 'expired').

## Table 3: de_torres_vincent_user_directories

This table is designed to store user-specific directories and their details.

- `id`: Unique identifier for each directory.
- `user_id`: Foreign key referencing `de_torres_vincent_users` table.
- `directory_id`: Unique identifier for each directory (not null).
- `directory_name`: Name of the directory (not null).
- `date_added` and `last_modified`: Timestamps for directory creation and last modification.
- `last_accessed`: Timestamp for the last time the directory was accessed.
- `directory_path`: Path to the directory (not null).
- `username`: Username associated with the directory.

### Foreign Key Relationships

- `de_torres_vincent_session_tokens.user_id` references `de_torres_vincent_users.id`.
- `de_torres_vincent_user_directories.user_id` references `de_torres_vincent_users.id`.

### Indexes

- `de_torres_vincent_session_tokens.user_id`: Index on the `user_id` column for optimization.
- `de_torres_vincent_user_directories.user_id`: Index on the `user_id` column for optimization.

