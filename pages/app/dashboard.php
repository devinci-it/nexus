<?php
use Frontend\Directory;
use Frontend\FileRenderer;
use Frontend\Sidebar\Sidebar;
use Frontend\Sidebar\SidebarItem;
use Frontend\Header;


$titleLibrary = 'Libraries';
$titleRecent = 'Recently Added';

$lastModified=  date('F j, Y H:i:s');
$breadcrumb = '<a class="caption-text" href="#">Home</a> / <a class="caption-text" href="#">Dashboard</a>';
$breadcrumbRecent = '<a class="caption-text" href="#">Home</a> / <a class="caption-text" href="#">Recents</a>';
$headerLibraries = new Header($titleLibrary, $lastModified, $breadcrumb);
$headerRecents = new Header($titleRecent, $lastModified, $breadcrumbRecent);
?>


<div class=" page-container">
<?php
echo $headerLibraries->render();

$directories_array=$loggedInUser->getDirectoryArray();
$_SESSION['directories']=$directories_array;
$uiDirectory=new Directory($directories_array);
echo $uiDirectory->render();

echo $headerRecents->render();
echo $fileRenderer->render();


?>
    </div>
