# 🛒 Localkart

**Localkart** is a GPS-based local e-commerce platform built for street vendors and Kirana store owners. It connects nearby buyers with local sellers for convenient and fast product delivery.

---

## 🚀 Features

### 👤 User (Flutter App)
- Register & Login
- View products with animations
- Add to cart, place orders
- View past orders
- Contact Us & About Us pages

### 🧑‍🍳 Vendor Panel (Web)
- Vendor registration/login
- Dashboard access
- Add new products with image
- View & delete products
- View received orders

### 🛡️ Admin Panel (Web)
- Admin login
- View & manage all vendors
- View & manage all products
- View & manage all orders

---

## 🛠️ Tech Stack

- **Frontend:** Flutter (User App), HTML/CSS/JS (Vendor & Admin Panel)
- **Backend:** PHP (REST APIs)
- **Database:** MySQL
- **Storage:** Local `/uploads/` folder for product images
- **Server:** XAMPP (Apache & MySQL)

---

## 📁 Folder Structure
ocalkart/
├── backend/
│ ├── api/ # All PHP APIs
│ ├── db.php # DB Connection
│ └── uploads/ # Uploaded product images
│
├── user-app/
│ └── lib/
│ └── screens/ # Register, Login, Menu, Cart, etc.
│
├── vendor-panel/
│ ├── index.php # Login/Register
│ ├── dashboard.php
│ ├── add_product.php
│ ├── view_products.php
│ └── view_orders.php
│
└── admin-panel/
├── login.php
├── dashboard.php
├── manage_vendors.php
├── manage_products.php
└── manage_orders.php

yaml
Copy
Edit

---

## ⚙️ Local Setup

### 1. Clone the Repository
git clone https://github.com/your-username/localkart.git

markdown
Copy
Edit

### 2. Start XAMPP
- Run Apache & MySQL

### 3. Import Database
- Go to phpMyAdmin
- Import `localkart.sql` file from `/backend/`

### 4. Flutter Setup
cd user-app
flutter pub get
flutter run

yaml
Copy
Edit

### 5. Web Panels
- Place `vendor-panel` and `admin-panel` inside `htdocs/`
- Access via:
  - Vendor: `http://localhost/localkart/vendor-panel/`
  - Admin: `http://localhost/localkart/admin-panel/`

---

## 🔐 Default Credentials

| Role   | Username | Password   |
|--------|----------|------------|
| Admin  | admin    | admin123   |
| Vendor | Register yourself |
| User   | Register via app   |

---

## 🤝 Contributing

Pull requests are welcome!  
1. Fork the repo  
2. Create a new branch  
3. Make changes & commit  
4. Push and create a PR

---

## 📄 License

This project is open-source under the [MIT License](LICENSE).

---

Made with ❤️ by [hastipatel404](https://github.com/hastipatel404) and team 🚀