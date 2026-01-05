# Quickstart Guide: Recipe Filter Application

**Date**: 2026-01-05  
**Branch**: `001-recipe-filter-app`  
**Prerequisites**: PHP 8.2+, Composer, Node.js 18+, npm/pnpm

---

## Initial Setup

### 1. Install Laravel

```bash
# Create new Laravel project (if not already created)
composer create-project laravel/laravel recipe-finder
cd recipe-finder

# Or if using existing project
cd /Users/boghaert/sites/vulpo/recipe-finder
```

### 2. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database (for SQLite - simplest for development)
touch database/database.sqlite
```

Edit `.env`:

```env
APP_NAME="Recipe Finder"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# Comment out MySQL/PostgreSQL settings

# Optional: Configure mail, cache, etc.
```

### 3. Install Dependencies

```bash
# PHP dependencies
composer install

# Install Livewire
composer require livewire/livewire

# Frontend dependencies
npm install

# Install Sass for SCSS compilation
npm install --save-dev sass
```

### 4. Configure Vite for SCSS

Edit `vite.config.js`:

```javascript
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/scss/app.scss", "resources/js/app.js"],
      refresh: true,
    }),
  ],
});
```

### 5. Database Setup

```bash
# Create migration
php artisan make:migration create_recipes_table

# Create model
php artisan make:model Recipe

# Create seeder
php artisan make:seeder RecipeSeeder

# Run migrations
php artisan migrate

# Seed database with recipes from data.json
php artisan db:seed --class=RecipeSeeder
```

**Important**: Ensure `starter-code/data.json` is present in project root before seeding.

### 6. Create Livewire Components

```bash
# Create components
php artisan make:livewire RecipeList
php artisan make:livewire RecipeDetail

# Optional: Separate filters component
php artisan make:livewire RecipeFilters
```

### 7. Create Blade Components

```bash
php artisan make:component RecipeCard
```

---

## Development Workflow

### Start Development Servers

**Option 1: Two separate terminals**

Terminal 1 (Laravel):

```bash
php artisan serve
# Runs on http://localhost:8000
```

Terminal 2 (Vite):

```bash
npm run dev
# Hot module replacement for CSS/JS
```

**Option 2: Single command (using Laravel Herd or Valet)**

```bash
# If using Laravel Herd (macOS)
# Just navigate to project directory
# Access via: http://recipe-finder.test

npm run dev
```

### Access Application

- **Homepage**: http://localhost:8000
- **About**: http://localhost:8000/about
- **Recipes**: http://localhost:8000/recipes
- **Recipe Detail**: http://localhost:8000/recipes/{slug}

---

## Project Structure Setup

### SCSS Structure

Create the ITCSS directory structure:

```bash
mkdir -p resources/scss/{0-settings,1-tools,2-generic,3-elements,4-objects,5-components,6-utilities}
```

Create main SCSS files:

```bash
# Settings (design tokens)
touch resources/scss/0-settings/_colors.scss
touch resources/scss/0-settings/_typography.scss
touch resources/scss/0-settings/_spacing.scss
touch resources/scss/0-settings/_radius.scss

# Tools
touch resources/scss/1-tools/_mixins.scss
touch resources/scss/1-tools/_functions.scss

# Generic
touch resources/scss/2-generic/_reset.scss

# Elements
touch resources/scss/3-elements/_page.scss
touch resources/scss/3-elements/_typography.scss
touch resources/scss/3-elements/_forms.scss

# Objects
touch resources/scss/4-objects/_container.scss
touch resources/scss/4-objects/_grid.scss

# Components
touch resources/scss/5-components/_navigation.scss
touch resources/scss/5-components/_recipe-card.scss
touch resources/scss/5-components/_filters.scss
touch resources/scss/5-components/_footer.scss
touch resources/scss/5-components/_button.scss

# Utilities
touch resources/scss/6-utilities/_utilities.scss

# Main entry point
touch resources/scss/app.scss
```

### Font Setup

Convert Nunito fonts to woff2 and organize:

```bash
mkdir -p public/assets/fonts/Nunito

# Convert fonts (use online tool or fonttools)
# Place woff2 files in public/assets/fonts/Nunito/
```

**Font conversion tools**:

- Online: https://cloudconvert.com/ttf-to-woff2
- CLI: `pip install fonttools brotli && fonttools ttLib.woff2 compress font.ttf`

### Copy Starter Code Images

```bash
# Copy images from starter-code to public
cp -r starter-code/assets/images public/assets/
```

---

## Key Configuration Files

### routes/web.php

```php
<?php

use App\Http\Livewire\RecipeList;
use App\Http\Livewire\RecipeDetail;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/about', 'pages.about')->name('about');

Route::get('/recipes', RecipeList::class)->name('recipes.index');
Route::get('/recipes/{slug}', RecipeDetail::class)->name('recipes.show');
```

### resources/views/layouts/app.blade.php

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Recipe Finder' }}</title>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <x-navigation />

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    @livewireScripts
</body>
</html>
```

### resources/scss/app.scss

```scss
// Main SCSS entry point with CSS layers
@layer reset, base, components, utilities;

// Settings (no output)
@use "0-settings/colors";
@use "0-settings/typography";
@use "0-settings/spacing";
@use "0-settings/radius";

// Tools (no output)
@use "1-tools/mixins";
@use "1-tools/functions";

// Generic (reset layer)
@layer reset {
  @use "2-generic/reset";
}

// Elements (base layer)
@layer base {
  @use "3-elements/page";
  @use "3-elements/typography";
  @use "3-elements/forms";
}

// Objects (base layer - layout patterns)
@layer base {
  @use "4-objects/container";
  @use "4-objects/grid";
}

// Components (components layer)
@layer components {
  @use "5-components/navigation";
  @use "5-components/recipe-card";
  @use "5-components/filters";
  @use "5-components/footer";
  @use "5-components/button";
}

// Utilities (utilities layer - highest specificity)
@layer utilities {
  @use "6-utilities/utilities";
}
```

---

## Common Commands

### Database

```bash
# Fresh migration (drops all tables and re-migrates)
php artisan migrate:fresh

# Fresh migration + seed
php artisan migrate:fresh --seed

# Rollback last migration
php artisan migrate:rollback

# Seed only
php artisan db:seed

# Specific seeder
php artisan db:seed --class=RecipeSeeder
```

### Artisan

```bash
# Clear all caches
php artisan optimize:clear

# Cache configuration
php artisan config:cache

# Cache routes (production)
php artisan route:cache

# List all routes
php artisan route:list

# Tinker (Laravel REPL)
php artisan tinker
```

### Livewire

```bash
# Clear Livewire cache
php artisan livewire:delete-uploads

# List all Livewire components
php artisan livewire:list
```

### Asset Compilation

```bash
# Development (watch mode)
npm run dev

# Build for production
npm run build

# Preview production build
npm run preview
```

---

## Development Tips

### Using Tinker for Testing

```bash
php artisan tinker
```

```php
// Test Recipe model
$recipe = Recipe::first();
$recipe->title;
$recipe->ingredients;

// Test filtering
Recipe::search('chickpea')->get();
Recipe::maxPrepTime(15)->get();
Recipe::maxCookTime(30)->get();

// Test related recipes
Recipe::randomRelated(1, 3)->get();
```

### Debugging Livewire

Add to component for debugging:

```php
public function render()
{
    logger('RecipeList render', [
        'searchTerm' => $this->searchTerm,
        'maxPrepTime' => $this->maxPrepTime,
        'maxCookTime' => $this->maxCookTime,
    ]);

    return view('livewire.recipe-list');
}
```

View logs:

```bash
tail -f storage/logs/laravel.log
```

### Hot Reload for Livewire

Add to `vite.config.js`:

```javascript
refresh: [
    'app/Http/Livewire/**',
    'resources/views/**/*.blade.php',
],
```

---

## Testing Checklist (Manual)

### Navigation

- [ ] Click logo → home page
- [ ] Click "Home" → home page
- [ ] Click "About" → about page
- [ ] Click "Recipes" → recipes page
- [ ] Click "Browse Recipes" button → recipes page

### Recipe List

- [ ] All recipes displayed by default
- [ ] Recipe cards show all required info (image, title, description, servings, times, ingredient count)
- [ ] Pagination works (if >12 recipes)
- [ ] "View Recipe" button navigates to detail page

### Filters

- [ ] Search by recipe name filters results
- [ ] Search by ingredient filters results
- [ ] Search updates with 300ms debounce (not instant)
- [ ] Max prep time filter works
- [ ] Max cook time filter works
- [ ] Combined filters work (search + prep + cook)
- [ ] Clear filters button resets all

### Recipe Detail

- [ ] All recipe information displayed
- [ ] Images load correctly (large on desktop, small on mobile)
- [ ] Ingredients list renders
- [ ] Instructions list renders
- [ ] Related recipes section shows 1-3 recipes
- [ ] Related recipes exclude current recipe
- [ ] Invalid slug shows 404 page

### Responsive Design

- [ ] Mobile (320px-767px): Hamburger menu works, cards stack
- [ ] Tablet (768px-1023px): 2-3 column grid
- [ ] Desktop (1024px+): 3-4 column grid
- [ ] Font sizes scale smoothly (clamp values)
- [ ] Touch targets are 44x44px minimum

### Accessibility

- [ ] All interactive elements keyboard accessible (tab navigation)
- [ ] Focus states visible
- [ ] Images have alt text
- [ ] Form labels present
- [ ] Color contrast sufficient (WCAG AA)

---

## Troubleshooting

### Issue: Livewire not found

**Solution**:

```bash
composer require livewire/livewire
php artisan optimize:clear
```

### Issue: SCSS not compiling

**Solution**:

```bash
npm install --save-dev sass
npm run dev
```

Check `vite.config.js` has correct input path.

### Issue: Images not loading

**Solution**:

- Ensure images are in `public/assets/images/`
- Use `asset()` helper in Blade: `{{ asset('assets/images/recipe.webp') }}`
- Check image paths in database match public directory structure

### Issue: Filters not updating

**Solution**:

- Check Livewire directives: `wire:model.live` or `wire:model.debounce.300ms`
- Clear Livewire cache: `php artisan livewire:delete-uploads`
- Check browser console for JavaScript errors
- Ensure `@livewireScripts` in layout

### Issue: Database seeding fails

**Solution**:

- Verify `starter-code/data.json` exists
- Check JSON syntax: `php -r "json_decode(file_get_contents('starter-code/data.json'));"`
- Check seeder field mapping matches migration

### Issue: CSS layers not working

**Solution**:

- Ensure browser supports CSS layers (Chrome 99+, Firefox 97+, Safari 15.4+)
- Check for syntax errors in SCSS files
- Clear browser cache

---

## Production Deployment

### Build Assets

```bash
npm run build
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Environment Variables

Update `.env` for production:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql  # or pgsql
DB_HOST=your-db-host
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password
```

### Database

```bash
# Run migrations (production)
php artisan migrate --force

# Seed data (production)
php artisan db:seed --class=RecipeSeeder --force
```

### Server Requirements

- PHP 8.2+
- MySQL 8.0+ or PostgreSQL 13+
- Composer
- Node.js 18+ (for building assets)

### Recommended Hosting

- **Laravel Forge** (easiest Laravel deployment)
- **DigitalOcean App Platform**
- **AWS Elastic Beanstalk**
- **Heroku** (with PostgreSQL)
- **Shared hosting** (with PHP 8.2+ support)

---

## Next Steps

After completing quickstart:

1. **Implement SCSS design tokens** (colors, typography, spacing, radius)
2. **Create navigation component** with hamburger menu
3. **Build recipe card component** with all metadata
4. **Implement RecipeList Livewire component** with filters
5. **Implement RecipeDetail Livewire component** with related recipes
6. **Add View Transitions API** for smooth filter changes
7. **Test responsive design** across devices
8. **Optimize images** and lazy loading
9. **Accessibility audit** with keyboard navigation
10. **Production deployment**

---

## Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Livewire Documentation](https://livewire.laravel.com/docs)
- [Vite Laravel Plugin](https://laravel.com/docs/vite)
- [ITCSS Architecture](https://www.xfive.co/blog/itcss-scalable-maintainable-css-architecture/)
- [OKLCH Color Picker](https://oklch.com/)
- [CSS Clamp Calculator](https://clamp.font-size.app/)
- [View Transitions API](https://developer.chrome.com/docs/web-platform/view-transitions/)

---

**Quickstart Complete**: Follow steps in order to set up development environment and begin implementation.
