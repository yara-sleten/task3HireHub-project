# HireHub API

Backend API لمشروع منصة فريلانسرز (Freelancers & Clients) باستخدام Laravel.

---

## API Collection

The project includes an Insomnia collection for testing APIs.

Location:
/docs/Insomnia_2026-04-23.yaml

Import it into Insomnia to use all endpoints.

---

## فكرة المشروع

منصة بتسمح لـ:

* **Clients** ينشروا مشاريع
*  **Freelancers** يقدموا عروض (Offers)
*  إضافة تقييمات (Reviews)
*  إدارة مهارات (Skills) ووسوم (Tags)

---

##  التقنيات المستخدمة

* Laravel
* Laravel Sanctum (Authentication)
* MySQL
* RESTful API

---

## خطوات التشغيل

### 1. Clone المشروع

```bash
git clone https://github.com/your-username/hirehub.git
cd hirehub
```

### 2. تثبيت الحزم

```bash
composer install
```

### 3. إعداد البيئة

```bash
cp .env.example .env
php artisan key:generate
```

### 4. إعداد قاعدة البيانات

عدّل `.env`:

```env
DB_DATABASE=hirehub
DB_USERNAME=root
DB_PASSWORD=
```

ثم:

```bash
php artisan migrate
php artisan db:seed
```

### 5. تشغيل السيرفر

```bash
php artisan serve
```

---

##  Authentication

###  Register

```
POST /api/register
```

###  Login

```
POST /api/login
```

 يرجع Token لازم تستخدمه بكل الطلبات:

```
Authorization: Bearer {token}
```

---

## Endpoints

---

###  Users

| Method | Endpoint       |
| ------ | -------------- |
| GET    | /api/user      |
| GET    | /api/user/{id} |
| POST   | /api/user      |
| PUT    | /api/user/{id} |
| DELETE | /api/user/{id} |

---

###  Freelancer Profile

| Method | Endpoint                    |
| ------ | --------------------------- |
| GET    | /api/freelancerProfile      |
| GET    | /api/freelancerProfile/{id} |
| POST   | /api/freelancerProfile      |
| PUT    | /api/freelancerProfile/{id} |

 فقط Freelancer يقدر:

* ينشئ بروفايل
* يعدل بروفايله (إذا verified)

---

###  Projects

| Method | Endpoint           |
| ------ | ------------------ |
| GET    | /api/projects      |
| GET    | /api/projects/{id} |
| POST   | /api/projects      |

فقط Client يقدر ينشر مشروع

---

###  Offers

| Method | Endpoint    |
| ------ | ----------- |
| GET    | /api/offers |
| POST   | /api/offers |

 فقط Freelancer (verified) يقدر:

* يقدم عرض
* المشروع لازم يكون مفتوح

---

###  Reviews

| Method | Endpoint    |
| ------ | ----------- |
| GET    | /api/review |
| POST   | /api/review |

---

### Skills

| Method | Endpoint   |
| ------ | ---------- |
| GET    | /api/skill |
| POST   | /api/skill |

---

###  Tags

| Method | Endpoint |
| ------ | -------- |
| GET    | /api/tag |
| POST   | /api/tag |

---

## الصلاحيات (Authorization Rules)

*  لا يمكن للـ Client تقديم عرض
*  لا يمكن للـ Freelancer نشر مشروع
*  لا يمكن تقديم عرض على مشروع مغلق
*  لا يمكن التقديم مرتين على نفس المشروع
*  لا يمكن تعديل بروفايل غير موثّق (verified)

---

##  الاختبار

تم اختبار المشروع باستخدام:

* Postman

---

##  ملاحظات

* تم استخدام Service Layer لتنظيم الكود
* تم استخدام Resources لتنسيق الـ JSON
* تم استخدام Middleware للتحقق من الصلاحيات

---

##  Author

* Yara Sleten

---

