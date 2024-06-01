# Tailored Pages

**Version:** 0.1  
**Author:** Andries Bester

## Description

Tailored Pages is a WordPress plugin that enables users to create and manage custom post types for brands, landing pages, brochures, and listing pages. The plugin provides a structured and efficient way to handle different types of content with custom templates, meta boxes, and scripts.

## Features

- Custom Post Types: Brands, Landing Pages, Brochures, and Listing Pages.
- Meta Boxes for Template Selection.
- Custom Columns in Admin Listings.
- Template Inclusion Based on Selection.
- Enqueue Admin and Public Scripts.
- Filtering Admin Listings by Associated Brands.

## Installation

### Upload the Plugin:

1. Download the Tailored Pages plugin files.
2. Upload the `tailored-pages` directory to the `/wp-content/plugins/` directory.

### Activate the Plugin:

1. Navigate to the Plugins menu in WordPress.
2. Activate the Tailored Pages plugin.

## Usage

### Creating Custom Post Types

- **Brands:** Use this post type to create and manage brands.
- **Landing Pages:** Use this post type to create and manage landing pages.
- **Brochures:** Use this post type to create and manage brochures.
- **Listing Pages:** Use this post type to create and manage listing pages.

### Adding and Selecting Templates

1. **Add Meta Box:**
   - A meta box for template selection is available on the edit screens of Brochures, Landing Pages, and Listing Pages.

2. **Select a Template:**
   - Choose the desired template from the dropdown in the meta box.

### Filtering by Associated Brand

- In the admin listing pages for Landing Pages and Listing Pages, you can filter the posts by the associated brand by clicking on the brand name in the "Assigned Brand" column.

## File Structure

```plaintext
tailored-pages/
├── acf-fields/
├── dist/
│   ├── css/
│   │   └── style.css
├── includes/
│   ├── admin/
│   │   └── admin-menus.php
│   ├── custom-post-types.php
│   ├── custom-columns.php
│   ├── meta-boxes.php
│   └── public/
│       └── public-scripts.php
├── js/
│   ├── accordion.js
│   └── custom-admin.js
├── src/
│   ├── scss/
│   │   └── pages/
│   │       └── style.scss
├── templates/
│   ├── brochures/
│   ├── landing-pages/
│   └── listing-pages/
├── .gitignore
├── gulpfile.js
├── package.json
├── package-lock.json
└── tailored-pages.php

# Tailored Pages Plugin

## Code Reference

### Register Custom Post Types
**Located in `includes/custom-post-types.php`:**
- Brands
- Landing Pages
- Brochures
- Listing Pages

### Enqueue Styles and Scripts
**Located in `includes/public/public-scripts.php`:**
- Enqueue `style.css` for front-end.
- Enqueue `accordion.js` for front-end.

### Meta Box for Template Selection
**Located in `includes/meta-boxes.php`:**
- Add Meta Box for selecting templates.
- Save selected template.

### Filtering by Associated Brand
**Located in `includes/custom-columns.php` and `includes/admin/admin-menus.php`:**
- Add custom columns for "Assigned Brand".
- Filter posts by associated brand.

### Include Selected Template
**Located in `tailored-pages.php`:**
- Include the selected template based on post type.

## Development
To contribute to the Tailored Pages plugin, clone the repository and follow the typical WordPress plugin development workflow. Ensure all changes are tested thoroughly before pushing to the repository.

## License
This project is licensed under the MIT License - see the LICENSE file for details.
