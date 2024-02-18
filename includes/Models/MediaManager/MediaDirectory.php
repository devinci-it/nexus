<?php

namespace Models\MediaManager;

class MediaDirectory
{
    private $id;
    private $user_id;
    private $directory_id;
    private $directory_name;
    private $date_added;
    private $last_modified;
    private $last_accessed;
    private $directory_path;
    private $username;

    public function __construct($id, $user_id, $directory_id, $directory_name, $date_added, $last_modified, $last_accessed, $directory_path, $username)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->directory_id = $directory_id;
        $this->directory_name = $directory_name;
        $this->date_added = $date_added;
        $this->last_modified = $last_modified;
        $this->last_accessed = $last_accessed;
        $this->directory_path = $directory_path;
        $this->username = $username;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setDirectoryId($directory_id)
    {
        $this->directory_id = $directory_id;
    }

    public function setDirectoryName($directory_name)
    {
        $this->directory_name = $directory_name;
    }

    public function setDateAdded($date_added)
    {
        $this->date_added = $date_added;
    }

    public function setLastModified($last_modified)
    {
        $this->last_modified = $last_modified;
    }

    public function setLastAccessed($last_accessed)
    {
        $this->last_accessed = $last_accessed;
    }

    public function setDirectoryPath($directory_path)
    {
        $this->directory_path = $directory_path;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getDirectoryId()
    {
        return $this->directory_id;
    }

    public function getDirectoryName()
    {
        return $this->directory_name;
    }

    public function getDateAdded()
    {
        return $this->date_added;
    }

    public function getLastModified()
    {
        return $this->last_modified;
    }

    public function getLastAccessed()
    {
        return $this->last_accessed;
    }

    public function getDirectoryPath()
    {
        return $this->directory_path;
    }

    public function getUsername()
    {
        return $this->username;
    }
}