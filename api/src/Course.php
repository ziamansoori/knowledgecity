<?php
namespace Src;

class Course
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $sql = "SELECT c.course_id as id, c.title, c.description, c.image_preview, ca.name as category_name FROM courses c inner join categories ca on c.category_id=ca.id;";
        $result = $this->db->query($sql);

        $data = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($data);
    }

    public function getCoursesByCategory($cat_id)
    {
        $sql = "SELECT c.course_id as id, c.title, c.description, c.image_preview from courses c where c.category_id='".$cat_id."'";
        $result = $this->db->query($sql);

        $data = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($data);
    }

    public function create($data)
    {
        try{
            $sql = "INSERT INTO courses (`course_id`, `title`, `description`, `image_preview`, `category_id`) VALUES ('".$data->course_id."', '".$data->title."', '".addslashes($data->description)."', '".$data->image_preview."', '".$data->category_id."')";
            $result = $this->db->query($sql);
            return $result;
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
}

?>