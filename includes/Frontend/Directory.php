<?php
namespace Frontend;
class Directory
{
    private $directories;

    public function __construct($directories)
    {
        $this->directories = $directories;
    }

    public function render()
    {
        $html = '<div class="directory-grid">';
        $appendTrash='';
        foreach ($this->directories as $directory) {
            if (empty($directory['parent_directory_id'])||$directory['directory_name']==='Favorites') {
                continue;
            }
            if ($directory['directory_name']==='Trash'){
                $appendTrash .= $this->renderDirectory($directory);
                continue;
            }
            $html .= $this->renderDirectory($directory);
        }

        $html .= $appendTrash.'</div>';

        return $html;
    }

    private function renderDirectory($directory)
    {
        $directoryName = $directory['directory_name'];
        $directoryPath = $directory['directory_path'];
        $lastModified = $directory['last_modified'];
        $directoryId = $directory['directory_id'];

        $iconFileName = strtolower($directoryName) . '.svg';
        $iconPath = file_exists('public/assets/icons/dash/' . $iconFileName) ?
            'public/assets/icons/dash/' . $iconFileName :
            'public/assets/icons/dash/directory.svg';
        $html = '<a class="caption-text" href="?path=' . $directoryPath . '&id=' . $directory['id'] . '">';
        $html .= '<div class="directory-item">';
        $html .= '<img class="directory-icon" src="' . $iconPath . '" alt="' . $directoryName . '">';
        $html .= '<span class="directory-name body-medium-text">' . $directoryName . '</span>';
        $html .= '<span class="last-modified">' . $lastModified . '</span>';
        $html .= '</div>';
        $html .= '</a>';

//            [parent_directory_id] =>
        return $html;
    }
}


/*
 *             [userDirectories:Models\AuthUser:private] => Array
                (
                    [0] => Array
                        (
                            [id] => 89
                            [user_id] => 37
                            [directory_id] => 19b9c20e746e6bbf8e465dd56c85821e
                            [directory_name] => Photos
                            [date_added] => 2024-02-15 12:33:26
                            [last_modified] => 2024-02-15 12:33:26
                            [last_accessed] =>
                            [directory_path] => ../MEDIA/00037_TESTROOTUSER1/Photos
                            [username] =>
                        )

                    [1] => Array
                        (
                            [id] => 90
                            [user_id] => 37
                            [directory_id] => faf67a92b88118b59c13826ef750cbf1
                            [directory_name] => Videos
                            [date_added] => 2024-02-15 12:33:26
                            [last_modified] => 2024-02-15 12:33:26
                            [last_accessed] =>
                            [directory_path] => ../MEDIA/00037_TESTROOTUSER1/Videos
                            [username] =>
                        )

                    [2] => Array
                        (
                            [id] => 91
                            [user_id] => 37
                            [directory_id] => cf0a27abff9f77e8507525948e4d03df
                            [directory_name] => Audios
                            [date_added] => 2024-02-15 12:33:26
                            [last_modified] => 2024-02-15 12:33:26
                            [last_accessed] =>
                            [directory_path] => ../MEDIA/00037_TESTROOTUSER1/Audios
                            [username] =>
                        )

                    [3] => Array
                        (
                            [id] => 92
                            [user_id] => 37
                            [directory_id] => dd701b3f43202635ae79da4eb835729b
                            [directory_name] => Recents
                            [date_added] => 2024-02-15 12:33:26
                            [last_modified] => 2024-02-15 12:33:26
                            [last_accessed] =>
                            [directory_path] => ../MEDIA/00037_TESTROOTUSER1/Recents
                            [username] =>
                        )

                    [4] => Array
                        (
                            [id] => 93
                            [user_id] => 37
                            [directory_id] => af0348a6b5456bcbe4cec6f084f4b107
                            [directory_name] => Trash
                            [date_added] => 2024-02-15 12:33:26
                            [last_modified] => 2024-02-15 12:33:26
                            [last_accessed] =>
                            [directory_path] => ../MEDIA/00037_TESTROOTUSER1/Trash
                            [username] =>
                        )

                    [5] => Array
                        (
                            [id] => 94
                            [user_id] => 37
                            [directory_id] => afeac2b8c3dc8f54f9fd7365c729ae9e
                            [directory_name] => Favorites
                            [date_added] => 2024-02-15 12:33:26
                            [last_modified] => 2024-02-15 12:33:26
                            [last_accessed] =>
                            [directory_path] => ../MEDIA/00037_TESTROOTUSER1/Favorites
                            [username] =>
                        )

                    [6] => Array
                        (
                            [id] => 95
                            [user_id] => 37
                            [directory_id] => e0e95ea96519e987b218d604af5ea593
                            [directory_name] => Uploads
                            [date_added] => 2024-02-15 12:33:26
                            [last_modified] => 2024-02-15 12:33:26
                            [last_accessed] =>
                            [directory_path] => ../MEDIA/00037_TESTROOTUSER1/Uploads
                            [username] =>
                        )

                )
 */