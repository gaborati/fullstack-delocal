<h1 align="center">Full-Stack WebApp</h1>

  <p align="center">

  </p>

<h2 id="about-the-project">About The Project</h2>

I had to make a web application where the user can log in and register and they can save their favorite links. I didn't use any framework for the task. I started the task with authentication where I used JWT tokens authentication, I connected the backend to the database so it communicates through  API-s with the frontend.Unfortunately, in the end, I noticed that my logic used to extract the data does not work for all links, because I solved this task from Frontend and so I can't get some link data due to Cors-Policy.In my code I left the console.logs() for informational reasons. The project run with the PHP built-in web sevrer.

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
        <li><a href="#implemented-features">Implemented features</a></li>
      </ul>
    </li>
     <li>
       <a href="#getting-started">Getting Started</a>
      <ul>
      <li><a href="#prerequisites">Prerequisites</a></li>
     </li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#contact-author">Contact Authors</a></li>
  </ol>
</details>

<h3 id="built-with">Built With</h3>

* [![PHP][PHP]][PHP-url]
* [![MySQL][MySQL]][MySQL-url]
* [![Javascript][Javascript]][Javascript-url]


<p align="right">(<a href="#about-the-project">back to top</a>)</p>

<h2 id="getting-started">Getting Started</h2>

0.**Create MySQL Database**
   - Install MySQL if its not already installed.
   - Create a new database on the MySQL server in your terminal using the following command:
   - ```sql
     mysql -u db_user -p
     ```
- ```sql
  CREATE DATABASE your_database_name;
  ```


1. Clone the repo
2. In backend folder copy and paste .env.example, rename to .env
3. Set database connection details in .env to desired values
4. In the backend you need to navigate the database folder , to create tables with the following commands.
- ```sql
     php create_link_table.php
     php create_user_table.php
     ```
   
5. Then you need to navigate back to the project root and run the following command in the terminal.
- ```sql
    php -S localhost:8000 
  ```
6. After that open the  following link in the browser.
- ```sql
   localhost:8000/frontend/view/register.html
  ```   
  

<h3 id="prerequisites">Prerequisites</h3>

PHP development environment: PHP,MySQL .

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

<h2 id="implemented-features">Implemented features</h2>

### Backend:

1. User registration
2. User login
3. User authentication and authorization
4. Add Link logic
5. Delete Link logic



### Frontend:


1. User signup
2. User login
3. User dashboard
4. Add Link
5. Delete Link




<p align="right">(<a href="#about-the-project">back to top</a>)</p>

<h2 id="contributing">Contributing</h2>

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any
contributions you make are **greatly appreciated**.

If you have a suggestion that would make this application better, please fork the repo and create a pull request.

1. Fork the Project
2. Create your Feature Branch (```git checkout -b feature/AmazingFeature```)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

<h2 id="contact-author">Contact Authors</h2>



### Attila Lajos Gábor (Ati)

[![Github Pages]](https://github.com/gaborati)
[![LinkedIn]](https://www.linkedin.com/in/attila-lajos-gabor/)
[![Gmail]](mailto:atidev1122gmail.com)

<p align="right">(<a href="#about-the-project">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->

[PHP]: https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white
[PHP-url]: https://www.php.net/
[MySQL]: https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white
[MySQL-url]: https://www.mysql.com/
[Javascript]: https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black
[Javascript-url]: https://www.javascript.com/



[Github Pages]: https://img.shields.io/badge/github-121013?style=for-the-badge&logo=github&logoColor=white
[LinkedIn]: https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white
[Gmail]: https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white
