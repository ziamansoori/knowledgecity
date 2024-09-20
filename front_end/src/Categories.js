import React from 'react';

const Categories = ({ changeCourseCategory, categories }) => {
  if (categories.length === 0) {
    return <p>No categories found</p>;
  }

  return (
    <ul className="category">
      {categories.map((category) => (
        <li key={category.id} onClick={() => changeCourseCategory(category.id)}>{category.name} ({category.course_count})
        {category.children && 
            <Categories categories={category.children} changeCourseCategory={() => changeCourseCategory(category.id)} />
        }
        </li>
      ))}
    </ul>
  );
};

export default Categories;
