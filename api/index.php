<?php
require 'bootstrap.php';

use Src\Course;
use Src\Category;


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = $_SERVER['REQUEST_URI'];
if(preg_match('/\/courses\/category\/[a-z0-9_-]/', $uri))
{
    $params = explode("/", $uri);
    $categoryId = $params[3];
    $uri = "courses/category/id";
}
switch($uri)
{
    // Route to get all Courses
    case "/courses":
        $course = new Course($dbConnection);
        echo $course->findAll();
    break;

    //Route to get all categories
    case "/categories":
        $category = new Category($dbConnection);
        echo $category->findAll();
    break;

    case "/seeder/course":
        $contents = json_decode(file_get_contents("data/course_list.json"));
        $course = new Course($dbConnection);
        foreach($contents as $data)
        {
            $response = $course->create($data);
            echo $response." Rows Affected <BR />";
        }
    break;

    case "/seeder/category":
        $contents = json_decode(file_get_contents("data/categories.json"));
        $category = new Category($dbConnection);
        foreach($contents as $data)
        {
            $response = $category->create($data);
            echo $response." Rows Affected <BR />";
        }
    break;

    // Route to get Categories by ID
    case "courses/category/id":
        $course = new Course($dbConnection);
        echo $course->getCoursesByCategory($categoryId);
    break;

    default:
        echo "Invalid Url";
    break;
}
?>