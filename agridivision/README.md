# Agridivision

## Thesis of BSIS-4A (Group 3)

### **Researchers:**
- **AGUSTIN, ANDREA JOANE J.**  
- **FANTILAGA, BRYAN KYLE E.**  
- **MONREAL, CHARLES AGUSTIN C.**  
- **SANCHEZ, ADRIANNE BLU T.**  
- **TRINIDAD, ROYCE EMMANUEL A.**  

---

## Disclaimer

This software and hardware project, along with its documentation entitled **“AgriDivision: Agricultural Mapping System with Demand Forecasting and Allocation”**, is submitted to the **College of Information and Communications Technology, West Visayas State University**, in partial fulfillment of the requirements for the degree **Bachelor of Science in Information Systems**.  

The project is the result of the researchers’ own work, except where noted.  

### Permissions
The researchers grant the **College of Information and Communications Technology** the right to:  
- Freely use and publish the project in local or international journals/conferences.  
- Reproduce or distribute both the paper and electronic copies of the project (in whole or in part) provided that proper acknowledgment is given to the proponents.

### Accountability
By using this system, you agree to:  
- Properly utilize the system.  
- Respect the developers and copyright holders.  
- Hold accountability for any claims, liabilities, damages, or expenses arising from the use of the system.  

---

## Introduction

**AGRIDIVISION** is a **web-based Agricultural Mapping System with Demand Forecasting and Allocation**. The system includes a **marketplace platform** that bridges farmers, business owners, and government sectors, providing an efficient means to monitor market activities.  

### Key Features
- Consolidates information on market prices for **corn**, **coffee**, and **coconut**.  
- Enables price monitoring and demand forecasting.  
- Facilitates operations for the **Department of Agriculture** and **Philippine Coconut Authority**.  

### Target Users
- **Farmers**  
- **Business Owners**

### Evaluation Criteria
The system was evaluated based on the following aspects:
- Functional Suitability  
- Performance Efficiency  
- Compatibility  
- Usability  
- Reliability  
- Security  
- Maintainability  
- Portability  

# System Requirements

## Operating System
- Windows 10 Pro or later versions.

## Hardware Requirements
- **RAM**: Minimum 8 GB.

## Access
- The system can be accessed on any device with an internet connection.
- For optimal user experience, a computer or laptop is recommended for better visibility and access to system features.

---

# Software Specifications

## Development Tools
- **Visual Studio Code**: Version 4.0 or later.
- **Bootstrap Studio**: Version 4.0 or later.

## Mapping Tool
- **Google Maps API**: Integrated for location-based functionality.

## Network Requirements
- **Internet Speed**: At least 5 Mbps for download and upload.

## Supported Web Browsers
- Google Chrome
- Microsoft Edge
- Opera
- Mozilla Firefox
- Safari
- Other modern browsers

# Installation

The individuals who may utilize the system can be anyone with minimal to great knowledge towards technology and is computer literate. The users who have these qualities are needed in order for them to fully grasp the concept of the said system and work on it easily.

---

# User Specifications

---

# System Inputs and Outputs

For the completion of the study, the system is bound to project an output that would start from requiring the user to sign in or create an account based on what type of user they are assigned to (admin, farmer, municipal agriculturist, barangay technicians, business owner), and input the information required.

# Usage (SysAdmin)

## Dashboard Overview
After logging in, you’ll see the main dashboard. This is where you can view all registered system users, including:  
- Farmers  
- Business Owners  
- Municipal Agriculturists  
- Barangay Technicians  

### Tracking Commodities
The dashboard also displays commodities used for analysis and reporting, including:  
- **Corn, Coffee, and Coconut Supply**: Track available stocks and supply levels.  
- **Purchase Transactions**: Monitor all buying and selling activities.  
- **Land and Business Owner Maps**: View the locations of farms and business owners on a map.

---

## Log In or Sign Up
Start by entering your login credentials. If you’re new, sign up as a System Administrator to create an account.

---

## Municipal Agriculturist Information
Under the Dashboard tab, there’s a table showing detailed information about each Municipal Agriculturist.

### Registering a Municipal Agriculturist
To add a new Municipal Agriculturist, go to the **Table** tab and select **Register Municipal Agriculturist**. Here, you can input their details and assign them to their respective municipality.

---

# Usage (Business Owner)

## Log In or Sign Up
Start by entering your login credentials. If you’re new, you need to register as a Business Owner to create an account.

---

## Dashboard Overview
After logging in, you’ll see the main dashboard. This is where you can view all transactions, including:  
- **Total Amount of Crops Purchased**  
- **Total Amount Spent on Crops**  
- **Commodity Mapping**  
- **Commodity Demand Forecast**

---

## Marketplace Overview
Under the Dashboard tab, the Marketplace section allows you to view all transactions with crop details, including:  
- Pending, Approved, Declined, and Fulfilled transactions  
- Crop details  

This overview helps business owners decide on crop quality and quantity based on their needs.

---

# Usage (Farmer)

## Log In or Sign Up
Start by entering your login credentials. If you’re new, sign up as a Farmer to create an account. Farmers must provide complete credentials, including valid permits.

---

## Dashboard Overview
After logging in, you’ll see the main dashboard. This is where farmers can view all transactions, including:  
- **Total Amount of Harvested Crops**  
- **Total Amount of Crops Sold**  
- **Total Sales**  
- **Sales Forecast**  
- **Commodity Demand Forecast**

---

## Farmer’s Marketplace Overview
Under the Dashboard, the **Marketplace** tab provides farmers with a detailed view of transactions, including:  
- Pending, Approved, Declined, and Fulfilled transactions  
- Crops selling  
- Product Information  
- Pricing  

# Troubleshooting for Fixing Possible Bugs

1. **Check if the Website is Down**  
   Ensure that the local server is running. If it's down, restart the server (e.g., Apache, Nginx, or local development environment like XAMPP or MAMP).

2. **Check the Internet Connection**  
   Verify that your device is connected to the local network. A missing or weak Wi-Fi connection can prevent your browser from accessing the local server.

3. **Use a Different Device**  
   Try accessing your local website from another device on the same network. This helps confirm if the issue is with the server or just your current device's setup.

4. **Analyze the Error Message**  
   Look for specific error codes like "403 Forbidden" or "500 Internal Server Error" in your browser. These can help you pinpoint if it’s a permissions or server configuration issue.

5. **Switch to Another Web Browser**  
   Test the website in a different browser to rule out issues related to your current browser's settings, extensions, or cached data that may block the website.

6. **Verify the DNS Records**  
   Since you’re on localhost, make sure the hosts file points to `127.0.0.1` for your website’s domain.

7. **Check the Error Logs**  
   Review the logs for your web server (e.g., Apache) or application logs to identify errors such as missing files, database connection issues, or configuration problems.

8. **Use Developer Tools**  
   Open the browser’s Developer Tools (F12), check the "Network" tab for failed requests, and review the "Console" tab for JavaScript errors or network-related issues preventing the website from loading.

---

# FAQ (Frequently Asked Questions)

### **What is AgriDivision?**  
AgriDivision is a web-based platform that serves as a marketplace connecting farmers, business owners, and government agencies. It gathers and displays market prices for corn, coffee, and coconuts to help users track and monitor trends. The system is designed mainly for farmers and business owners. Experts, developers, and users tested it to ensure it is functional, user-friendly, secure, reliable, and compatible with the operations of the Department of Agriculture and the Philippine Coconut Authority.

### **What kind of agricultural materials can farmers input?**  
Farmers may input agricultural materials, including but not limited to Corn, Coffee, and Coconut.

### **What type of users can access the mapping features of AgriDivision?**  
Farmers and business owners can freely access the mapping features of the system.

### **Where does AgriDivision get all the data?**  
The data is provided and validated by the Municipal Agriculturist, Barangay Technicians, and Farmers.

### **Is AgriDivision available for use nationwide?**  
No, AgriDivision is currently limited to Region VI, Western Visayas, in terms of features and access. Nationwide features may be added in future updates.

### **Can farmers input their livestock such as cows, chickens, etc.?**  
No, only agricultural materials, specifically the "3Cs" (Corn, Coffee, and Coconut), are supported.
