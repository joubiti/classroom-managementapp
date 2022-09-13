# classroom-managementapp

This project was done in the context of a 1-month summer internship at [Enhanced Technologies](http://www.enhanced-tech.ma/) in Rabat, in which I was asked to develop an application to manage students with PHP and PostgreSQL, a certain degree of flexbility was allowed for me to implement any additional functionalities for my design.

I later attempted to refactor this project as a CLI application using Python and OOP principles, which you'll find in the section below Overview for this repo.

## Overview
The following project presents a web-based application for managing a classroom, developed with vanilla PHP and Bootstrap using PostgreSQL as a database system.

![image](https://user-images.githubusercontent.com/104909670/189874447-f6578e4e-ae84-4abe-acfd-dd1c70db51c3.png)

The main objectives of the conception of such an application are to offer a set of tools to facilitate the process of managing students and their grades, along with professors:
- Administrator panel, allowing access to a dashboard which contains general information about the classroom, along with the ability to manage students and professors without restriction.
- Student panel, allowing access to the student's grades, as well as the curriculum spreadsheet, which is automatically updated via a Python script embedded in the page.
- Professor panel, through which the professor can deposit the grades for the courses he is in charge of.
- The student can also choose to subscribe to the notification system, upon which he'll be able to receive an email whenever grades are updated.

## CLI application
This projet is also available as a command line interface application for demo purposes, albeit without any database management system.

![image](https://user-images.githubusercontent.com/104909670/189879156-de78838e-d0c8-42be-98db-08548c455e15.png)

The source code is available in folder named "oop" and you can run the application as follow:

```
git clone https://github.com/joubiti/classroom-managementapp
```
You can then open CMD inside the oop folder and run:

```
python menu.py
```
Which will display a user menu that prompts for inputs..

![image](https://user-images.githubusercontent.com/104909670/189880077-0d1ffad7-d27d-45e6-9d31-9819c183db2d.png)
