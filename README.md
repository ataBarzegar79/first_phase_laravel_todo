Task Description: Todo Task
## Overview:
-   Implement a simple Todo System with the following features.
# Features
## User Authentication
-   Implement appropriate user authentication method.
-   Users can Sign up
-   Users can Log in
-   Users can Log out

## Task Management
### Tasks Create
-   Users can add new tasks.
-   When creating a task, they should provide a title and an optional description.

### Tasks Read
-   Users can view a paginated list of all tasks.
-   Include the task title, description, creation date, and completion status
-   Impelement:
    -   Pagination
    -   Sort by date
    -   Filter complete and incomplete tasks
    -   Do not display tasks completed more than 1 week ago

### Tasks Update
-   Users should be able to edit the title and description of existing tasks plus its completion and completion time .
-   Include an option to mark a task as complete or incomplete.

# Code Implementation
## Controller
-   Create a TaskController with methods for handling Create, Read and Update operations.
-   Utilize Laravel's resourceful routing for cleaner code.

## View Layer
-   Develop Blade views for listing tasks, creating tasks, updating tasks, and viewing task details.
-   It is better to use a ready-made view template
-   No involvement with JS or other front-end tools is required.

## DataBase Layer
-   Use Laravel's Eloquent ORM for task model creation and database interaction.
-   Implement a migration for the tasks table with columns for title, description, and timestamps.

## Validation
-   Implement appropriate validation rules for the operations.

# Attention! 
Firstly fork project from github and develop your project, finally be ready to make a pull request to return back your changes into main project.
Don't forget , this step is crucial for you and your project won't be accepted unless yu do details of this section! 
