# Vomychat_Assignment
This is a backend implementation for a simple user registration, login, reset password, referrals. 

## **Overview**  
VomyChat is a web application with user authentication, referral tracking, and password management functionalities. This backend is built using PHP and MySQL, with JWT-based authentication and email services.  

## **Features**  
- **User Authentication**: Register, login, forgot password, and reset password.  
- **JWT Authentication**: Secure token-based authentication.  
- **Referrals System**: Users can refer others and track referral statistics.  
- **Email System**: Sends verification and password reset emails using PHPMailer.  

## **Installation**  

### **Prerequisites**  
- XAMPP (or any PHP and MySQL environment)  
- Composer (for PHPMailer)  
- Git  

### **Setup**  
1. Clone the repository:  
   ```bash
   git clone https://github.com/your-username/vomychat-backend.git
   cd vomychat-backend
   ```  
2. Install dependencies:  
   ```bash
   composer install
   ```  
3. Create a `.env` file (or update `config/database.php`) with your database details.  
4. Import the SQL schema (`database.sql`) into MySQL.  
5. Start the server using XAMPP or PHP built-in server:  
   ```bash
   php -S localhost:8000 -t public
   ```  

## **API Endpoints**  

### **Authentication**  
| Endpoint            | Method | Description             |
|---------------------|--------|-------------------------|
| `/api/register.php` | POST   | Register a new user    |
| `/api/login.php`    | POST   | User login             |
| `/api/forgot_password.php` | POST | Send password reset email |
| `/api/reset_password.php` | POST | Reset user password |

### **Referrals**  
| Endpoint                | Method | Description                     |
|-------------------------|--------|---------------------------------|
| `/api/referral_stats.php` | GET  | Get referral statistics for user |
