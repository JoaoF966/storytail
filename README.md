# StoryTail: A Website for Children's Books

<div style="text-align: center">
<img src="public/images/logotop.png" alt="storytail" width="300" height="300">
</div>

Welcome to __StoryTail__, a project created for the Laboratório de Programação course. This repository contains a web application designed to host and manage children's books, encouraging young readers to explore the world of storytelling.

This project follows Agile methodologies, specifically the Scrum framework, to ensure iterative development and
collaboration throughout the course.

___

## Project Overview

### 🛠️ Project Objectives

Develop a functional and user-friendly website for children's books.
Apply Agile and Scrum practices for team collaboration and iterative progress.
Implement the Model-View-Controller (MVC) architectural pattern to separate concerns and enhance maintainability.
Utilize Docker for containerization, ensuring a consistent development and deployment environment.

___

### 🏗️ Tech Stack

- __Backend:__ [PHP(Laravel)]
- __Frontend:__ [Vite,HTML/CSS(TailwindCSS)/JavaScript]
- __Database:__ [MySQL]
- __Containerization:__ Docker
- __Architecture:__ MVC

___

### 📋 Agile & Scrum Implementation

- __Sprints:__ Weekly sprints to define, develop, and deliver features incrementally.
- __Roles:__
    - __Product Owner:__ Defines requirements and priorities.
    - __Scrum Master:__ Facilitates Scrum practices and removes blockers.
    - __Development Team:__ Implements features and tests functionality.
- __Ceremonies:__
    - Sprint Planning
    - Daily Standups
    - Sprint Review
    - Sprint Retrospective

Repository Structure

___

### 🚀 Getting Started

#### Prerequisites

- __Docker__ and __Docker Compose__ installed

### Setup

1. Clone the repository:

```bash
  git clone https://github.com/JoaoF966/storytail 
  cd storytail
```

2. Start the application using Docker Compose:

```bash
  docker compose up --build
```

3. Enter the storytail container and execute migrations

```bash
   docker exec -it storytail bash
   php artisan migrate
```

4. Enter the storytail container and start vite in dev mode

```bash
  docker exec -it storytail bash
  npm run dev
```

5. Access the application in your browser:
   http://localhost:8080 <- main app
   http://localhost:8001 <- phpmyadmin

___

### 📝 Documentation

Detailed documentation, including user stories, diagrams, and Scrum artifacts, is available in the docs/ directory.

___

### 🌟 Contributing

- [Joao](https://github.com/JoaoF966)
- [Pedro Martelo](https://github.com/xuuba)
- [Ricardo Castro](https://github.com/riccycastro)

This project is developed collaboratively as part of the Laboratório de Programação subject
at [ISLAGaia](https://www.islagaia.pt/pt/). Contributions and discussions are guided by Agile principles and Scrum
ceremonies.

#### Let’s build a magical place for young readers to explore stories! 📚✨
