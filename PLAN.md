# Digital Invitation Website — Development Plan

## 1. Project Overview

**Project Name:** Digital Invitation Website

**Framework:** Laravel 12

**Frontend:** Blade, HTML, CSS, JavaScript

**Database:** MySQL

**Development Environment:** Debian (WSL), PHP, Composer, Docker

### 1.1 Project Goals

Build a modern, elegant, responsive digital invitation platform where:

- Visitors can browse invitation templates without creating an account.
- Visitors can preview sample invitations before ordering.
- Customers can order invitations by contacting the administrator through WhatsApp.
- The administrator can manage templates and create personalized invitations for customers.
- Each published invitation has a unique public URL that can be shared with guests.

### 1.2 Target Users

1. **Visitors:** Browse templates and explore demos.
2. **Customers:** Request personalized invitations through WhatsApp.
3. **Administrator:** Manage templates, customer invitations, and publication status.

### 1.3 Initial Invitation Categories

- Elegant Javanese
- Modern Minimalist
- Islamic

### 1.4 Development Principles

- Implement the project incrementally, one phase and one task at a time.
- Keep the implementation beginner-friendly and maintainable.
- Use Laravel conventions and existing project architecture.
- Use Indonesian for all visitor-facing website content.
- Use English for code comments and technical documentation when appropriate.
- Prioritize mobile-first responsive design, accessibility, performance, and security.
- Avoid unnecessary dependencies.
- Do not implement future phases prematurely.
- Do not mark tasks complete until they have been implemented and verified.

---

# 2. Phase 0 — Project Inspection and Preparation

**Goal:** Understand the existing Laravel project before making changes.

## Task 0.1 — Inspect the Project

- [x] Inspect the Laravel version and project structure.
- [x] Inspect `routes/web.php`.
- [x] Inspect existing Blade views.
- [x] Inspect existing CSS and JavaScript assets.
- [x] Inspect `composer.json` and `package.json`.
- [x] Identify existing layouts, components, and reusable styles.
- [x] Identify existing tests and available development commands.

## Task 0.2 — Establish Project Conventions

- [x] Determine the best location for the public landing page.
- [x] Determine how CSS and JavaScript are loaded.
- [x] Identify reusable Blade layout and component opportunities.
- [x] Document important findings and implementation constraints.

## Phase 0 Acceptance Criteria

- [x] The current application structure is understood.
- [x] The existing homepage and route behavior are documented.
- [x] No unrelated files have been modified.
- [x] The development environment remains functional.

**Restriction:** Do not modify Docker configuration, `.env`, database settings, or unrelated project files.

### Cleanup Notes

The previous project was a "Virtual Try-On" (frame try-on) application unrelated to the digital invitation website. The following legacy files were removed during cleanup:

- `app/Http/Controllers/VirtualTryOnController.php`
- `app/Http/Controllers/Admin/FrameController.php`
- `app/Http/Controllers/Api/FrameApiController.php`
- `app/Http/Controllers/Api/CaptureController.php`
- `app/Models/Frame.php`
- `app/Http/Resources/FrameResource.php`
- `app/Console/Commands/GenerateFrames.php`
- `database/seeders/FrameSeeder.php`
- `database/migrations/2026_07_07_113508_create_frames_table.php`
- `resources/views/virtual-try-on/index.blade.php`
- `resources/views/admin/frames/index.blade.php`
- `resources/views/admin/frames/form.blade.php`
- `public/js/modules/*.js` (6 try-on JS modules)
- `public/css/virtual-try-on.css`
- `public/frames/*.png` (5 sample frames)
- `routes/web.php` — cleaned to only the homepage route
- `routes/api.php` — cleaned to empty file with only the Route import

Preserved:
- Core Laravel structure, `User` model, authentication, `composer.json`, `.env`, Docker configuration, database settings, existing uploads, Git history
- `resources/views/welcome.blade.php` (default Laravel welcome page — will be replaced in Phase 1)
- `resources/js/app.js`, `resources/js/bootstrap.js` (Laravel Vite bootstrap)
- `routes/console.php`
- Core database migrations (`users`, `sessions`, `cache`, `jobs`, `password_resets`)

---

# 3. Phase 1 — Public Landing Page

**Goal:** Replace the default Laravel welcome page with a polished digital invitation landing page.

## Task 1.1 — Design Direction

- [x] Establish a consistent visual style.
- [x] Choose a refined color palette suitable for an elegant invitation business.
- [x] Define typography, spacing, border radii, and shadows.
- [x] Define reusable button, card, and section styles.
- [x] Ensure sufficient contrast and readable typography.
- [x] Keep the design lightweight and responsive.

### Design Decisions (Task 1.1)

**Brand Name:** "Ruang Undang" (temporary, text-only, no image logo)

**Color Palette:**
- Primary: #6B4E3D (Warm Brown) / #C9A68C (Dark mode)
- Secondary: #D4A574 (Champagne Gold) / #E8C9A0
- Background: #FAF8F5 (Light) / #1A1612 (Dark — ditunda)
- Surface: #FFFFFF / #24201C
- Text Primary: #1C1813 / #F5F0E8
- Text Secondary: #5C5248 / #C4B8A8
- Text Muted: #9D8F7F / #8A7D6A
- Borders: #E5DFD6 / #3D352B
- WhatsApp Green: #128C7E / #25D366

**Typography:** Instrument Sans (existing via Bunny Fonts, weights: 400/500/600)
- Heading 1: 36px→56px, weight 600
- Body: 16px, weight 400, line-height 1.6
- Caption: 12px, weight 500

**Layout Structure:**
- Navigation Bar (sticky)
- Hero Section (SVG illustration + headline + CTA)
- Template Catalog (3 cards: Javanese, Minimalist, Islamic)
- How It Works (5 steps)
- Contact/WhSection (configurable WHATSAPP_NUMBER)
- Footer

**Visual Elements:**
- Hero: SVG illustration lokal (ringan)
- Template cards: consistent dimensions, spacing, hover effects
- Buttons: primary (filled), secondary (outline), WhatsApp (brand green)
- Sections: py-16 sm:py-20 lg:py-24, max-w-3xl mx-auto

**Responsive Strategy:**
- Mobile (<640px): Single column, stacked hero, hamburger menu
- Tablet (640-1023px): 2-col grid, hero side-by-side
- Desktop (≥1024px): 3-col grid, full navigation

**Dark Mode:** Terang dulu (light mode default), dark mode ditunda ke Phase 2+
- Currently using system `prefers-color-scheme` will be added later

**Accessibility:**
- Semantic HTML, heading hierarchy, color contrast ≥ 4.5:1
- Focus visible states, ARIA labels, alt text
- Reduced motion preferences

**Component Reusability:**
- Button (primary/secondary/ghost)
- Template card
- Section wrapper
- Nav link

**Configuration:**
- WHATSAPP_NUMBER from .env (tidak diganggu/explicit tidak diubah)
- All existing configs (.env, Docker, database) DISUNTUH

### Cleanup Notes (Updated)
- Removed 11 legacy Virtual Try-On files
- Cleaned routes/web.php and routes/api.php
- Preserved Laravel core infrastructure
- Framework Laravel 12 (match composer.json)

### Files Changed in This Task
- `PLAN.md` — updated framework version, design decisions, task status
- `resources/views/welcome.blade.php` — will be replaced with landing page
- `resources/css/app.css` — design tokens added
- `resources/js/app.js` — may add minimal JS
- `routes/web.php` — named routes for sections

## Task 1.2 — Navigation Bar

- [x] Create a website logo or text-based brand identity.
- [x] Add Home navigation.
- [x] Add Templates navigation.
- [x] Add How It Works navigation.
- [x] Add Contact navigation.
- [ ] Link navigation items to the correct page sections.
- [x] Add a clear WhatsApp ordering button.
- [x] Implement a mobile navigation menu if necessary.
- [x] Ensure navigation remains usable on small screens.

## Task 1.3 — Hero Section

- [x] Create an attractive headline in Indonesian.
- [x] Add supporting text explaining the service.
- [x] Add an "Explore Templates" button.
- [x] Add a secondary WhatsApp contact button.
- [x] Include a relevant visual preview or invitation mockup.
- [x] Ensure the hero section looks polished on desktop and mobile.

## Task 1.4 — Template Catalog

- [x] Create a dedicated Templates section.
- [x] Display the Elegant Javanese template.
- [x] Display the Modern Minimalist template.
- [x] Display the Islamic template.
- [x] Give each template a preview image or visual mockup.
- [x] Add a short description for each template.
- [x] Add a "View Demo" button to each template.
- [x] Use consistent card dimensions and spacing.
- [x] Ensure the catalog adapts to different screen sizes.
- [x] Use locally stored assets or properly licensed images where practical.

**Important:** Demo buttons may initially point to planned demo routes, but must not lead to broken pages. If demo pages do not exist yet, use a temporary, clearly handled placeholder or disabled state.

## Task 1.5 — How It Works Section

- [ ] Explain the ordering process in simple steps.
- [ ] Step 1: Choose a template.
- [ ] Step 2: Contact the administrator through WhatsApp.
- [ ] Step 3: Submit event and invitation details.
- [ ] Step 4: Review and approve the invitation.
- [ ] Step 5: Receive the published invitation link.
- [ ] Use clear visual indicators for each step.

## Task 1.6 — Contact and WhatsApp Section

- [ ] Create a contact section.
- [ ] Add a WhatsApp call-to-action.
- [ ] Use a configurable placeholder for the administrator's WhatsApp number.
- [ ] Generate a valid WhatsApp link with an optional prefilled message.
- [ ] Avoid inventing a real phone number.
- [ ] Make it easy to replace the placeholder with the actual business number.

## Task 1.7 — Footer

- [ ] Add the website brand.
- [ ] Add relevant navigation links.
- [ ] Add a contact link.
- [ ] Add a copyright notice.
- [ ] Keep the footer consistent with the overall visual design.

## Task 1.8 — Landing Page Quality Assurance

- [ ] Check all navigation links.
- [ ] Check all buttons and calls to action.
- [ ] Test mobile, tablet, and desktop layouts.
- [ ] Check for horizontal overflow.
- [ ] Check image loading and alternative text.
- [ ] Check browser console errors.
- [ ] Run relevant Laravel tests or checks.
- [ ] Confirm the existing database and Docker configuration were not changed.

## Phase 1 Acceptance Criteria

- [ ] The homepage no longer displays the default Laravel welcome screen.
- [ ] All required landing page sections are present.
- [ ] The three initial template cards are displayed.
- [ ] WhatsApp links use a configurable placeholder.
- [ ] The page is responsive and accessible.
- [ ] Navigation and buttons behave as intended.
- [ ] The homepage works at the local development URL.
- [ ] The implementation has been reviewed and tested.

---

# 4. Phase 2 — Interactive Invitation Templates

**Goal:** Build individual invitation demo pages with distinctive designs and interactive features.

## Task 2.1 — Shared Invitation Structure

- [ ] Plan a reusable invitation layout where appropriate.
- [ ] Separate template-specific styling from shared functionality.
- [ ] Define a consistent structure for invitation content.
- [ ] Support mobile-first design.
- [ ] Ensure the invitation remains readable without unnecessary animation.
- [ ] Avoid adding a database dependency before it is needed.

## Task 2.2 — Elegant Javanese Template

- [ ] Create a dedicated demo page.
- [ ] Use an elegant Javanese-inspired visual identity.
- [ ] Include an invitation cover or opening screen.
- [ ] Add a button to open the invitation.
- [ ] Display sample couple names.
- [ ] Display sample event date, time, and location.
- [ ] Add a photo gallery.
- [ ] Add a map or location link when appropriate.
- [ ] Add an optional background music control.
- [ ] Test the layout on mobile and desktop.

## Task 2.3 — Modern Minimalist Template

- [ ] Create a dedicated demo page.
- [ ] Use clean typography and generous spacing.
- [ ] Include an invitation cover.
- [ ] Add couple names and event information.
- [ ] Add a photo gallery.
- [ ] Add location and navigation links.
- [ ] Add optional music controls.
- [ ] Test the layout on mobile and desktop.

## Task 2.4 — Islamic Template

- [ ] Create a dedicated demo page.
- [ ] Use an elegant Islamic-inspired visual identity.
- [ ] Include an invitation cover.
- [ ] Add suitable introductory text.
- [ ] Display couple names and event information.
- [ ] Add a photo gallery.
- [ ] Add location and navigation links.
- [ ] Add optional music controls where appropriate.
- [ ] Test the layout on mobile and desktop.

## Task 2.5 — Shared Interactive Features

- [ ] Implement an accessible invitation-opening interaction.
- [ ] Add smooth but restrained animations.
- [ ] Add photo gallery interactions where appropriate.
- [ ] Provide accessible controls for background music.
- [ ] Do not autoplay audio unexpectedly.
- [ ] Respect reduced-motion preferences where practical.
- [ ] Ensure interactive controls work with keyboard and touch.
- [ ] Avoid broken image and audio references.

## Task 2.6 — Demo Navigation

- [ ] Define named Laravel routes for each demo.
- [ ] Connect the landing page's demo buttons to valid routes.
- [ ] Provide a way to return to the template catalog.
- [ ] Handle invalid demo routes appropriately.

## Phase 2 Acceptance Criteria

- [ ] All three invitation demos are accessible.
- [ ] Each template has a distinct visual identity.
- [ ] Opening interactions work correctly.
- [ ] Event information is easy to read.
- [ ] Galleries and optional music controls behave correctly.
- [ ] All demos work on mobile and desktop.
- [ ] No broken links or critical browser errors remain.

---

# 5. Phase 3 — Administrator Dashboard

**Goal:** Provide a secure administrative interface for managing templates and customer invitations.

## Task 3.1 — Authentication and Authorization Planning

- [ ] Review Laravel's existing authentication capabilities.
- [ ] Choose an appropriate authentication implementation.
- [ ] Define administrator access requirements.
- [ ] Plan protected administrative routes.
- [ ] Prevent public visitors from accessing administrative features.
- [ ] Avoid implementing customer registration unless explicitly required.

## Task 3.2 — Admin Layout

- [ ] Create an administrator dashboard layout.
- [ ] Add sidebar or navigation.
- [ ] Add a dashboard overview.
- [ ] Add navigation for templates and invitations.
- [ ] Provide clear validation and status messages.
- [ ] Ensure the dashboard works on smaller screens.

## Task 3.3 — Template Management

- [ ] Define template fields and validation rules.
- [ ] Create templates listing.
- [ ] Implement template creation.
- [ ] Implement template editing.
- [ ] Implement template deletion with confirmation.
- [ ] Implement publication status.
- [ ] Support previewing a template before publication.
- [ ] Validate uploaded images if image uploads are implemented.

## Task 3.4 — Customer Invitation Management

- [ ] Define invitation data requirements.
- [ ] Create an invitation listing.
- [ ] Implement invitation creation.
- [ ] Implement invitation editing.
- [ ] Implement invitation deletion with confirmation.
- [ ] Associate each invitation with a template.
- [ ] Store couple names, event details, location, and gallery references.
- [ ] Support draft and published states.
- [ ] Preview invitations before publishing.

## Task 3.5 — Public Invitation URLs

- [ ] Define a safe unique identifier or slug strategy.
- [ ] Create public routes for published invitations.
- [ ] Ensure each invitation has a shareable URL.
- [ ] Prevent unpublished invitations from being publicly accessible.
- [ ] Handle missing or invalid identifiers.
- [ ] Ensure invitation content is escaped and safely rendered.

## Task 3.6 — Security and Validation

- [ ] Validate all submitted data on the server.
- [ ] Use Laravel CSRF protection.
- [ ] Enforce authentication and authorization.
- [ ] Validate uploaded file types and sizes.
- [ ] Prevent unauthorized changes to invitations.
- [ ] Avoid exposing sensitive configuration.
- [ ] Test invalid and unauthorized requests.

## Phase 3 Acceptance Criteria

- [ ] Only authorized administrators can access the dashboard.
- [ ] Template CRUD operations work.
- [ ] Invitation CRUD operations work.
- [ ] Published invitations have unique public URLs.
- [ ] Draft invitations are not publicly accessible.
- [ ] Validation and authorization tests pass.
- [ ] Administrative operations provide clear feedback.

---

# 6. Phase 4 — MySQL Integration and Data Management

**Goal:** Persist templates and invitation data reliably using MySQL.

## Task 4.1 — Database Design

- [ ] Review existing migrations before designing new tables.
- [ ] Define the templates table.
- [ ] Define the invitations table.
- [ ] Define any required relationships.
- [ ] Determine whether gallery images need a separate table.
- [ ] Define unique constraints and indexes.
- [ ] Document the proposed schema before implementation.
- [ ] Obtain approval before major schema changes.

## Task 4.2 — Migrations and Models

- [ ] Create migrations for approved tables.
- [ ] Create Eloquent models.
- [ ] Define relationships and mass-assignment protections.
- [ ] Add suitable database constraints.
- [ ] Run migrations in the development environment.
- [ ] Verify data persistence.

## Task 4.3 — Data Integration

- [ ] Load published templates from MySQL.
- [ ] Load published invitations from MySQL.
- [ ] Connect admin forms to database operations.
- [ ] Validate database writes.
- [ ] Handle missing records gracefully.
- [ ] Avoid hard-coded production content where database content is required.

## Task 4.4 — Database Testing

- [ ] Test template creation and updates.
- [ ] Test invitation creation and updates.
- [ ] Test template-invitation relationships.
- [ ] Test unique invitation identifiers.
- [ ] Test draft and publication visibility.
- [ ] Confirm existing project data is not unintentionally deleted.

## Phase 4 Acceptance Criteria

- [ ] Templates and invitations persist in MySQL.
- [ ] Relationships work correctly.
- [ ] Migrations run successfully.
- [ ] Database validation and constraints are effective.
- [ ] Existing unrelated databases and Docker services remain unchanged.

---

# 7. Phase 5 — Testing, Security, and Performance

**Goal:** Prepare the application for reliable use.

## Task 5.1 — Functional Testing

- [ ] Test all public routes.
- [ ] Test all invitation demo routes.
- [ ] Test all administrative CRUD operations.
- [ ] Test authentication and authorization.
- [ ] Test published and unpublished invitations.
- [ ] Test WhatsApp contact links.

## Task 5.2 — Responsive and Accessibility Testing

- [ ] Test common mobile screen sizes.
- [ ] Test tablet and desktop layouts.
- [ ] Check keyboard navigation.
- [ ] Check form labels and accessible names.
- [ ] Check image alternative text.
- [ ] Check color contrast.
- [ ] Check reduced-motion behavior where applicable.

## Task 5.3 — Security Review

- [ ] Verify authorization on sensitive actions.
- [ ] Review server-side validation.
- [ ] Verify CSRF protection.
- [ ] Review file-upload security if uploads are supported.
- [ ] Ensure production debugging is disabled.
- [ ] Ensure secrets are not committed to version control.
- [ ] Review public exposure of draft invitations.

## Task 5.4 — Performance Review

- [ ] Optimize image sizes.
- [ ] Avoid unnecessary JavaScript dependencies.
- [ ] Reduce unnecessary database queries.
- [ ] Review page loading behavior.
- [ ] Ensure animations do not significantly impair performance.

## Phase 5 Acceptance Criteria

- [ ] Core feature tests pass.
- [ ] No known critical authorization issue remains.
- [ ] The website is usable across common screen sizes.
- [ ] No critical console or application errors remain.
- [ ] Performance issues discovered during testing are addressed or documented.

---

# 8. Phase 6 — Production Deployment

**Goal:** Prepare and deploy the website to a production environment.

## Task 6.1 — Deployment Planning

- [ ] Choose a hosting environment appropriate for Laravel.
- [ ] Verify the supported PHP version and required extensions.
- [ ] Plan database provisioning.
- [ ] Plan file storage and public asset handling.
- [ ] Document environment variables required for production.
- [ ] Plan HTTPS and domain configuration.

## Task 6.2 — Production Configuration

- [ ] Configure production environment variables securely.
- [ ] Set the application debug mode to disabled.
- [ ] Generate and protect the application key as appropriate for the deployment.
- [ ] Configure database credentials securely.
- [ ] Run production migrations through a reviewed deployment process.
- [ ] Configure storage permissions.
- [ ] Configure caches and optimized assets where appropriate.

## Task 6.3 — Deployment Verification

- [ ] Verify the homepage loads.
- [ ] Verify public invitation URLs.
- [ ] Verify administrator authentication.
- [ ] Verify database connectivity.
- [ ] Verify WhatsApp links.
- [ ] Verify HTTPS.
- [ ] Document backup and recovery procedures.
- [ ] Document how to update and maintain the application.

## Phase 6 Acceptance Criteria

- [ ] The application works in the chosen production environment.
- [ ] Sensitive configuration is protected.
- [ ] HTTPS is enabled where supported.
- [ ] Public and administrative routes work as intended.
- [ ] Backup and maintenance procedures are documented.

---

# 9. Global Development Workflow

Follow this workflow for every task.

## Step 1 — Inspect

- Read the relevant parts of `PLAN.md`.
- Inspect existing routes, views, assets, and tests.
- Identify the smallest set of files required for the task.
- Do not assume files or features exist without checking.

## Step 2 — Plan

- Explain the intended implementation.
- List the files expected to change.
- Identify possible risks and dependencies.
- Ask for approval before significant architectural changes.

## Step 3 — Implement

- Work only on the requested phase and task.
- Follow existing Laravel conventions.
- Avoid unrelated refactoring.
- Do not change `.env`, Docker configuration, or database settings without explicit approval.
- Do not install unnecessary dependencies.
- Preserve existing unrelated functionality.

## Step 4 — Verify

- Run the appropriate tests and checks.
- Review changed files.
- Check relevant pages in the browser when possible.
- Report any failed tests or unverified behavior honestly.

## Step 5 — Update the Plan

- Mark a checklist item complete only after verification.
- Keep unfinished items unchecked.
- Record blockers and follow-up work.
- Do not mark an entire phase complete if any acceptance criterion remains unmet.

## Step 6 — Report

Summarize:
- What was implemented.
- Which files changed.
- Which checks were performed.
- Any outstanding issues.
- The recommended next task.

---

# 10. Project Safety Rules

- Do not expose API keys, passwords, tokens, or other secrets.
- Do not overwrite unrelated user changes.
- Do not delete existing data or tables without explicit approval.
- Do not modify Docker services belonging to other projects.
- Do not change database configuration without explicit approval.
- Do not implement future phases without being asked.
- If an instruction conflicts with the current project structure, explain the conflict before making risky changes.
- Prefer small, reversible changes.

---

# 11. Current Project Progress

Update this section as the project progresses.

- [x] Laravel project initialized.
- [x] MySQL Docker container started for local development.
- [x] PHP MySQL driver installed and verified.
- [x] Laravel database migration successfully executed.
- [x] Phase 0 — Project Inspection and Preparation.
- [ ] Phase 1 — Public Landing Page.
- [ ] Phase 2 — Interactive Invitation Templates.
- [ ] Phase 3 — Administrator Dashboard.
- [ ] Phase 4 — MySQL Integration and Data Management.
- [ ] Phase 5 — Testing, Security, and Performance.
- [ ] Phase 6 — Production Deployment.

**Progress note:** The environment setup tasks above are based on the development session. Re-verify the current state before relying on them.

### Cleanup Update

**Removed legacy Virtual Try-On code and assets**
- Cleaned `routes/web.php` and `routes/api.php` 
- Deleted 7 old application files (controllers, model, command, seeder, migration, resources, views)
- Removed 6 JS modules and CSS, 5 frame images from `public/`
- Preserved all Laravel core infrastructure: `.env`, Docker config, DB, uploads, Git history
- Updated framework reference from Laravel 13 to Laravel 12 to match `composer.json`

The project is now ready for Phase 1 — building the digital invitation public landing page.

---

# 12. How to Request Work

Use explicit phase and task identifiers when requesting work.

Examples:

- "Inspect Phase 0 and report findings without changing files."
- "Plan Phase 1, Task 1.1 only. Do not edit files yet."
- "Implement Phase 1, Task 1.2 only."
- "Review and test Phase 1, Task 1.2."
- "Continue with Phase 1, Task 1.3."
- "Audit Phase 1 against its acceptance criteria."
- "Update the progress checklist only for verified tasks."

**Initial instruction:** Create or update only `PLAN.md` with this roadmap. Do not implement website features while creating the document.
