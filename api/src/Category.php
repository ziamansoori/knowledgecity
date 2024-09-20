<?php
namespace Src;

class Category
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $sql = "SELECT c.id, c.name from categories c where c.parent is null";
        $result = $this->db->query($sql);
        
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        for($i=0; $i<count($data); $i++)
        {
            $data[$i]["course_count"] = $this->getCourseCount($data[$i]["id"]);
            $child = $this->getChilds($data[$i]["id"]);
            if($child)
            {
                $data[$i]["children"] = $child;
            }
        }
        return json_encode($data);
    }

    private function getChilds($cat_id)
    {
        $sql = "SELECT c.id, c.name from categories c where c.parent = '".$cat_id."'";
        $result = $this->db->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(count($data) > 0)
        {
            for($i=0; $i<count($data); $i++)
            {
                $data[$i]["course_count"] = $this->getCourseCount($data[$i]["id"]);
                $child = $this->getChilds($data[$i]["id"]);
                if($child)
                {
                    $data[$i]["children"] = $child;
                }
            }
            return $data;
        }
        return false;
    }

    private function getCourseCount($cat_id)
    {
        $sql = "SELECT COUNT(*) as course_count from courses where category_id='".$cat_id."'";
        $result = $this->db->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data[0]["course_count"];
    }

    public function create($data)
    {
        try{
            $parent = trim($data->parent) == "" ? "NULL" : "'$data->parent'";
            $sql = "INSERT INTO categories (`id`, `name`, `parent`) VALUES ('".$data->id."', '".$data->name."', ".$parent.")";
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