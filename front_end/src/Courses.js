import React from 'react';

const Courses = ({ courses }) => {
  if (courses.length === 0) {
    return <p>No Course found</p>;
  }

  return (
    <div className="row">
    {courses.map((course) => (
        <div className="col-md-12 col-xl-4 courses text-center">
            <figure className="figure">
                <span className="course_category">{course.category_name}</span>
                <img src={course.image_preview} width={200} className="figure-img img-fluid rounded" alt={course.title} />
                <figcaption className="figure-caption">{course.title}</figcaption>
            </figure>
        </div> 
    ))}
    </div>
  );
};

export default Courses;
