# Chrive - Luxury Ride Booking Website

Chrive is a luxury ride booking website designed to provide users with a seamless and convenient way to reserve luxury rides. The platform caters to a diverse range of users, including companies, VIPs, and visitors to NYC, offering advanced reservations for luxury vehicles.

## Project Overview

Chrive boasts the following core features:

- **User Registration and Login:** A secure authentication system allowing users to create accounts and log in using hashed passwords. Session management ensures a safe and seamless experience.

- **New Trip Booking:** An intuitive and user-friendly interface that empowers users to effortlessly book new trips by completing a straightforward form. Form validation, both client-side and server-side, ensures accurate and consistent data entry.

- **Trips History:** Users can access a comprehensive list of their past trips. Leveraging PHP, the system queries the database to retrieve trip history based on the user's unique identifier.

- **User Profile:** The platform enables users to manage their profile information. PHP scripts facilitate the retrieval and updating of user details, enhancing personalization and control.

## Project Timeline

### Day 1

- **Homepage, Landing Page, User Authentication, and Database Setup:**
  - Create an engaging homepage and a compelling landing page. The initial HTML and CSS layout will lay the foundation for the user interface.
  - Implement robust user authentication using PHP and MySQL. Passwords are securely hashed and sessions managed for enhanced security.
  - Devise and implement a well-structured database schema. Establish the necessary tables, including 'user' and 'trip_history,' with appropriate columns to ensure data integrity and normalization.

### Day 2

- **Frontend-Backend Connection, Trip Booking, Trip History, and User Profile:**
  - Establish seamless communication between the frontend and backend components of the application, enabling efficient data transmission.
  - Design and create an intuitive 'New Trip' form, allowing users to make bookings with ease. Implement JavaScript and PHP for comprehensive form validation, ensuring accurate data submission.
  - Develop the 'Trips History' page, leveraging PHP to retrieve and present users with a clear and organized list of their past trips.
  - Craft the 'User Profile' section, enabling users to view and modify their profile information. Backend functionality in PHP facilitates the seamless update of user details.

## Project Architecture

### Frontend

- **Homepage and Landing Page:** Provide users with an introduction to the luxury car service and streamline navigation options.
- **User Authentication:** Facilitate secure user account creation and login through dedicated pages.
- **New Trip Booking:** Develop an intuitive and user-friendly form that simplifies the process of booking luxury rides.
- **Trips History:** Display a comprehensive list of previous trip records, enhancing user engagement.
- **User Profile:** Empower users to view and update their profile information seamlessly.

### Backend

- **User Authentication:** Implement robust user authentication using PHP and MySQL. Passwords are securely hashed, and session management ensures secure user interactions.
- **Database Interaction:** Develop PHP scripts to facilitate seamless communication between the application and the MySQL database.
- **Form Validation:** Leverage JavaScript and PHP to enforce data consistency and accuracy through client-side and server-side form validation.

### Database

- **User Table:** Store essential user information, including username, securely hashed password, and email.
- **Trip History Table:** Capture and organize trip records, including user ID, pickup and dropoff locations, trip date and time, passenger count, and phone number.

## Navigation

- Users navigate effortlessly through the application using intuitive links and buttons.
- Access to the 'New Trip,' 'Trips History,' and 'User Profile' sections is streamlined following successful login.
- Form submissions trigger corresponding backend API requests, enabling seamless data interaction.
- User-friendly error messages guide users based on the outcome of backend interactions.

## Data Flow

1. Users interact with the frontend, either by completing forms or engaging with interface elements.
2. Frontend validates user inputs, subsequently initiating requests to backend APIs.
3. The backend processes incoming requests, facilitating communication with the MySQL database and generating relevant responses.
4. Frontend updates its interface based on the response from the backend, ensuring a dynamic and responsive user experience.

![Wireframes](https://github.com/naa7/chrive/blob/main/wireframes.png)

## User Interface (UI) Design

- The platform boasts a visually appealing, user-centric UI design.
- A carefully curated color scheme, featuring soothing hues of yellow, green, and blue, fosters an atmosphere of trust and relaxation.
- Typography choices, including the "Oswald" font for headings and "Raleway" for content, ensure optimal readability and aesthetic appeal.
- Interactive elements, such as button hover effects, smooth transitions, subtle animations, and thorough form validation, contribute to an engaging user journey.

## Database Design

### Users Table

- **user_id (Primary Key)**
- **username**
- **password (hashed)**
- **email**

### Trip History Table

- **trip_id (Primary Key)**
- **user_id (Foreign Key referencing Users Table)**
- **pickup_location**
- **dropoff_location**
- **trip_date**
- **trip_time**
- **passengers**
- **Phone**
  
![ER Diagram](https://github.com/naa7/chrive/blob/main/ER_diagram.png)

## Functionality & Features

### User Registration and Login

- **Purpose:** Enable secure account creation and login for users.
- **Implementation:** Utilize PHP for robust user authentication, implement password hashing, and manage user sessions.

### New Trip Booking

- **Purpose:** Provide users with a streamlined method to book new trips.
- **Implementation:** Develop HTML forms, facilitate form handling using PHP, and enforce client-side validation through JavaScript.

### Trips History

- **Purpose:** Empower users to access and review their historical trip records.
- **Implementation:** Leverage PHP to query the database based on the user's unique identifier, enhancing the user experience.

### User Profile

- **Purpose:** Allow users to manage their profile details effectively.
- **Implementation:** Utilize PHP for seamless retrieval and updating of user information, enhancing personalization and engagement.

## Technology Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP 8.2.8
- **Database:** MySQL 11.0.2
- **Additional Tools:** Visual Studio Code, Terminal

## Challenges & Mitigation

- **Security:** Implement stringent security measures, including password hashing, prepared statements, and session management, to ensure robust protection against potential threats.
- **Responsive Design:** Employ CSS media queries to create a consistent and engaging user experience across various devices, conducting thorough testing to ensure optimal responsiveness.
- **Data Validation:** Implement comprehensive data validation mechanisms, both on the client and server sides, to prevent the entry of invalid or malicious data.

## References

- [W3Schools](https://www.w3schools.com/)
- [Stack Overflow](https://stackoverflow.com/) for troubleshooting and community support.

---
