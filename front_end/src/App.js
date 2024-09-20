import React, { useState, useEffect } from 'react';
import Categories from './Categories';
import Courses from './Courses';

const App = () => {
  const [categories, setCategories] = useState([]);
  const [courses, setCourses] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [courseCategory, setCourseCategory] = useState(false);

  // Example API URL (replace it with your actual API endpoint)
  const apiUrl = 'http://api.cc.localhost/';

  useEffect(() => {
    const fetchCategories = async () => {
      try {
        const response = await fetch(apiUrl+"categories");
        if (!response.ok) {
          throw new Error('Failed to fetch');
        }
        const data = await response.json();
        setCategories(data);
        setLoading(false);
      } catch (error) {
        setError(error.message);
        setLoading(false);
      }
    };
    fetchCategories();
  }, []);

  useEffect(() => {
    let url = courseCategory ? apiUrl+"courses/category/"+courseCategory : apiUrl+"courses";
    const fetchCourses = async () => {
      try {
        const response = await fetch(url);
        if (!response.ok) {
          throw new Error('Failed to fetch');
        }
        const data = await response.json();
        setCourses(data);
        setLoading(false);
      } catch (error) {
        setError(error.message);
        setLoading(false);
      }
    };
    fetchCourses();
  }, [courseCategory]);

  if (loading) return <p>Loading...</p>;
  if (error) return <p>Error: {error}</p>;
console.log(courseCategory);
  return (
    <div className="container">
      <div className="row">
        <div className="col-4"></div>
        <div className="col-8">
          <h1>Course Catalogue</h1>
        </div>
      </div>
      <div class="row">
        <div className="col-4">
          <Categories categories={categories} changeCourseCategory={setCourseCategory} />
        </div>
        <div className="col-8">
          <Courses courses={courses}/>
        </div>
      </div>
    </div>
  );
};

export default App;
