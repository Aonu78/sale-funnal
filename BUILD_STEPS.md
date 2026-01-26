# Laravel Site Development Plan (Manual Creation)

This document outlines the step-by-step process for building the Laravel site as per the `layout.md` specifications, with a strict focus on *manual* creation of files (migrations, models, controllers, etc.) and *no* usage of `php artisan` commands.

---

### **Overall Project Architecture & Flow Steps**

**I. Core Setup & Foundation (Initial Laravel Project assumed)**
    *   **A. Manual Database Configuration:** Setting up `.env` for database connection.
    *   **B. Core Layouts & Assets:** Establishing a base Blade layout and basic CSS/JS inclusion.
    *   **C. Routing Strategy:** Defining how routes will be structured for different pages/sections.

**II. Homepage Development (Following `layout.md`'s section order)**
    *   **✅ Step 1: Hero Section**
        *   **Action:** Created `resources/views/home.blade.php` and added basic HTML structure, header, main, footer, and the Hero Section headline.
        *   **Action:** Modified `routes/web.php` to include `Route::get('/', function () { return view('home'); });`.
    *   **✅ Step 2: Social Proof / Trust Indicators Section**
        *   **Action:** Integrated Bootstrap CSS and JS CDNs into `resources/views/home.blade.php`.
        *   **Action:** Added Bootstrap-styled HTML for 3 testimonial cards and "As Seen On" logos to `resources/views/home.blade.php`.
    *   **✅ Step 3: Core Value Proposition Section**
        *   **Action:** Added Bootstrap-styled HTML for 3 key benefits with placeholder icons and a "Learn More" CTA to `resources/views/home.blade.php`.
    *   **✅ Step 4: Finance Tools Preview Section**
        *   **Action:** Added Bootstrap-styled HTML for 4 tool cards (Budget Planner, Debt Tracker, Savings Calculator, Bill Organizer) to `resources/views/home.blade.php`.
    *   **✅ Step 5: Side Hustle Ideas Showcase**
        *   **Action:** Added Bootstrap-styled HTML for 3 hustle buckets (Quick Start, Weekend Projects, Long-Term Builders) to `resources/views/home.blade.php`.
    *   **✅ Step 6: Free Resources Section (Preview)**
        *   **Action:** Added Bootstrap-styled HTML for 3 resource columns (Downloadables, Guides, Calculators) to `resources/views/home.blade.php`.

**III. Secondary Pages Development (Following `layout.md`'s "Best Build Order")**
    *   **✅ Step 7: Free Resources Page**
        *   **Action:** Created `ResourceItem` model and migration.
        *   **Action:** Created `ResourceController` with static data for demonstration.
        *   **Action:** Created `resources/views/resources/index.blade.php` with Bootstrap styling and filters.
        *   **Action:** Added `/resources` route to `routes/web.php`.
    *   **Step 8: Finance Tools Page**
        *   **8.1: Model & Migration for Tools (if dynamic)**
        *   **8.2: Controller for data handling**
        *   **8.3: View integration with Bootstrap (including filters)**
        *   **8.4: Routing**
    *   **Step 9: Side Hustles Page**
        *   **9.1: Model & Migration for detailed Hustle entries**
        *   **9.2: Controller for data handling**
        *   **9.3: View integration with Bootstrap (including filters and "Getting Started Guides")**
        *   **9.4: Routing**
    *   **Step 10: Blog Page**
        *   **10.1: Model & Migration for Blog Posts, Categories, Tags**
        *   **10.2: Controller for data handling**
        *   **10.3: View integration with Bootstrap (including search, filters, featured post)**
        *   **10.4: Routing**

**IV. Global Components & Enhancements**
    *   **Step 11: Navigation Bar & Footer**
        *   **11.1: Integrate into base layout**
        *   **11.2: Bootstrap styling**
    *   **Step 12: Contact/About/Privacy Pages (Static)**
        *   **12.1: Simple views and routes**

---

**Progress:**

*   **Step 1: Hero Section - COMPLETED**
*   **Step 2: Social Proof / Trust Indicators Section - COMPLETED**
*   **Step 3: Core Value Proposition Section - COMPLETED**
*   **Step 4: Finance Tools Preview Section - COMPLETED**
*   **Step 5: Side Hustle Ideas Showcase - COMPLETED**
*   **Step 6: Free Resources Section (Preview) - COMPLETED**
*   **Step 7: Free Resources Page - COMPLETED**

---
